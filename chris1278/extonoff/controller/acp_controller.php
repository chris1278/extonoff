<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff\controller;

class acp_controller
{
	protected $extension_manager;
	protected $request;
	protected $language;
	protected $config;
	protected $config_text;
	protected $template;
	protected $log;
	protected $user;
	protected $cache;
	protected $u_action;
	protected $migrator;

	public function __construct(
		\phpbb\extension\manager $ext_manager,
		\phpbb\request\request $request,
		\phpbb\language\language $language,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\template\template $template,
		\phpbb\log\log $log,
		\phpbb\user $user,
		\phpbb\cache\driver\driver_interface $cache,
		\phpbb\db\migrator $migrator
	)
	{
		$this->extension_manager	= $ext_manager;
		$this->request				= $request;
		$this->language				= $language;
		$this->config				= $config;
		$this->config_text			= $config_text;
		$this->template				= $template;
		$this->log					= $log;
		$this->user					= $user;
		$this->cache				= $cache;
		$this->migrator				= $migrator;
	}

	public function enable_disable_confirm()
	{
		if ($this->request->is_set_post('extonoff_disable_all'))
		{
			$ext_count_enabled_clean = count($this->extension_manager->all_enabled()) - 1;

			if ($this->config['extonoff_enable_confirmation'])
			{
				if (confirm_box(true))
				{
					$this->enable_disable("disable");
				}
				else
				{
					confirm_box(
						false,
						$this->language->lang('EXTONOFF_MSG_CONFIRM_DISABLE', $this->language->lang('EXTONOFF_EXTENSION_PLURAL', $ext_count_enabled_clean)),
						build_hidden_fields([
							'extonoff_disable_all' => true,
							'extonoff_confirm_box' => true,
							'u_action' => $this->u_action
						]),
						'@chris1278_extonoff/acp_extonoff_confirm.html'
					);
				}
			}
			else
			{
				$this->enable_disable("disable");
			}
		}
		else if ($this->request->is_set_post('extonoff_enable_all'))
		{
			$ext_count_disabled = count($this->remove_exts_with_migrations($this->extension_manager->all_disabled()));

			if ($this->config['extonoff_enable_confirmation'])
			{
				if (confirm_box(true))
				{
					$this->enable_disable("enable");
				}
				else
				{
					confirm_box(
						false,
						$this->language->lang('EXTONOFF_MSG_CONFIRM_ENABLE', $this->language->lang('EXTONOFF_EXTENSION_PLURAL', $ext_count_disabled)),
						build_hidden_fields([
							'extonoff_enable_all' => true,
							'extonoff_confirm_box' => true,
							'u_action' => $this->u_action
						]),
						'@chris1278_extonoff/acp_extonoff_confirm.html'
					);
				}
			}
			else
			{
				$this->enable_disable("enable");
			}
		}

		redirect($this->request->variable('u_action', ''));
	}

	public function enable_disable($action)
	{
		$safe_time_limit = (ini_get('max_execution_time') / 2);
		$start_time = time();

		if ($action == "disable")
		{
			$ext_list_enabled = $this->extension_manager->all_enabled();
			$ext_count_enabled_clean = count($ext_list_enabled) - 1;
			$ext_count_success = 0;

			$this->config->set('extonoff_exec_todo', 1);
			$this->config->set('extonoff_todo_purge_cache', 1);

			unset($ext_list_enabled['chris1278/extonoff']);
			foreach ($ext_list_enabled as $ext_name => $value)
			{
				while ($this->extension_manager->disable_step($ext_name))
				{
					if ((time() - $start_time) >= $safe_time_limit)
					{
						meta_refresh(0);
					}
				}

				if ($this->extension_manager->is_disabled($ext_name))
				{
					$ext_count_success++;
				}
			}

			if ($this->config['extonoff_enable_log'])
			{
				$this->config_text->set('extonoff_todo_add_log', $this->get_log_json(
					$ext_count_success,
					$ext_count_enabled_clean,
					$this->language->lang('EXTONOFF_LOG_DEACTIVATED')
				));
			}

			trigger_error($this->language->lang('EXTONOFF_MSG_DEACTIVATION_SUCCESFULL', $ext_count_success, $ext_count_enabled_clean) . adm_back_link($this->u_action), (($ext_count_success == 0) ? E_USER_WARNING : E_USER_NOTICE));
		}
		else if ($action == "enable")
		{
			$ext_list_disabled = $this->remove_exts_with_migrations($this->extension_manager->all_disabled());

			$ext_count_disabled = count($ext_list_disabled);
			$ext_count_success = 0;

			$this->config->set('extonoff_exec_todo', 1);
			$this->config->set('extonoff_todo_purge_cache', 1);

			foreach ($ext_list_disabled as $ext_name => $value)
			{
				$ext_display_name = $this->extension_manager->create_extension_metadata_manager($ext_name)->get_metadata('display-name');
				$this->template->assign_vars([
					'EXTONOFF_LAST_EXT_NAME'			=> $ext_name,
					'EXTONOFF_LAST_EXT_DISPLAY_NAME'	=> $ext_display_name,
				]);

				while ($this->extension_manager->enable_step($ext_name))
				{
					if ((time() - $start_time) >= $safe_time_limit)
					{
						meta_refresh(0);
					}
				}

				if ($this->extension_manager->is_enabled($ext_name))
				{
					$ext_count_success++;
				}

				if ($this->config['extonoff_enable_log'])
				{
					$this->config_text->set('extonoff_todo_add_log', $this->get_log_json(
						$ext_count_success,
						$ext_count_disabled,
						$this->language->lang('EXTONOFF_LOG_ACTIVATED')
					));
				}
			}

			$this->template->assign_vars([
				'EXTONOFF_LAST_EXT_NAME'			=> '',
				'EXTONOFF_LAST_EXT_DISPLAY_NAME'	=> '',
			]);

			trigger_error($this->language->lang('EXTONOFF_MSG_ACTIVATION_SUCCESFULL', $ext_count_success, $ext_count_disabled) . adm_back_link($this->u_action), (($ext_count_success == 0) ? E_USER_WARNING : E_USER_NOTICE));
		}
	}

	public function ext_manager($event)
	{
		$this->u_action = $event['u_action'];

		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');

		if ($this->request->is_set_post('extonoff_enable_all') || $this->request->is_set_post('extonoff_disable_all'))
		{
			$this->enable_disable_confirm();
			return;
		}

		$ext_list_disabled = $this->extension_manager->all_disabled();
		$ext_list_migrations_technames = $this->get_exts_with_migration_technames($ext_list_disabled);

		$ext_count_available = count($this->extension_manager->all_available());
		$ext_count_configured = count($this->extension_manager->all_configured());
		$ext_count_enabled = count($this->extension_manager->all_enabled());
		$ext_count_disabled = count($ext_list_disabled);
		$ext_count_migrations = count($ext_list_migrations_technames);

		$this->template->assign_vars([
			'EXTONOFF_INTEGRATION' 			=> $this->config['extonoff_enable_integration'],
			'EXTONOFF_COUNT_ACTIVE'			=> $ext_count_enabled,
			'EXTONOFF_COUNT_INACTIVE'		=> $ext_count_disabled,
			'EXTONOFF_COUNT_NOT_INSTALLED'	=> $ext_count_available - $ext_count_configured,
			'EXTONOFF_COUNT_HAS_MIGRATION'	=> $ext_count_migrations,
			'EXTONOFF_MIGRATION_TECHNAMES'	=> $ext_list_migrations_technames,
		]);
	}

	public function acp_module($u_action)
	{
		$this->u_action = $u_action;

		$this->language->add_lang('acp/extensions');
		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');

		add_form_key('chris1278_extonoff_settings');

		if ($this->request->is_set_post('extonoff_enable_all') || $this->request->is_set_post('extonoff_disable_all'))
		{
			if (!$this->request->is_set_post('extonoff_confirm_box') && !check_form_key('chris1278_extonoff_settings'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->enable_disable_confirm();
			return;
		}

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('chris1278_extonoff_settings'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->config->set('extonoff_enable_integration', $this->request->variable('extonoff_enable_integration', 0));
			$this->config->set('extonoff_enable_log', $this->request->variable('extonoff_enable_log', 0));
			$this->config->set('extonoff_enable_confirmation', $this->request->variable('extonoff_enable_confirmation', 0));
			$this->config->set('extonoff_enable_migrations', $this->request->variable('extonoff_enable_migrations', 0));
			trigger_error($this->language->lang('EXTONOFF_MSG_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$ext_count_enabled = count($this->extension_manager->all_enabled());
		$ext_count_disabled = count($this->remove_exts_with_migrations($this->extension_manager->all_disabled()));

		$this->template->assign_vars([
			'EXTONOFF_COUNT_ACTIVE'			=> $ext_count_enabled - 1,
			'EXTONOFF_COUNT_INACTIVE'		=> $ext_count_disabled,
			'EXTONOFF_ENABLE_INTEGRATION'	=> $this->config['extonoff_enable_integration'],
			'EXTONOFF_ENABLE_LOG'			=> $this->config['extonoff_enable_log'],
			'EXTONOFF_ENABLE_CONFIRMATION'	=> $this->config['extonoff_enable_confirmation'],
			'EXTONOFF_ENABLE_MIGRATIONS'	=> $this->config['extonoff_enable_migrations'],
			'U_ACTION'						=> $this->u_action,
		]);
	}

	public function todo()
	{
		if (!$this->config['extonoff_exec_todo'])
		{
			return;
		}
		$this->config->set('extonoff_exec_todo', 0);

		if ($this->config['extonoff_todo_purge_cache'])
		{
			$this->config->set('extonoff_todo_purge_cache', 0);
			$this->cache->purge();
		}

		if ($this->config_text->get('extonoff_todo_add_log') != '')
		{
			$last_job = json_decode($this->config_text->get('extonoff_todo_add_log'), true);
			$this->config_text->set('extonoff_todo_add_log', '');

			if ($last_job !== null)
			{
				$this->log->add(
					'admin',
					$last_job['user_id'],
					$last_job['user_ip'],
					'EXTONOFF_LOG_ENTRY',
					$last_job['timestamp'],
					[
						$last_job['ext_count_success'],
						$last_job['ext_count'],
						$last_job['action_lang']
					]
				);
			}
		}
	}

	private function get_log_json(int $ext_count_success, int $ext_count, string $action_lang): string
	{
		return json_encode([
			'ext_count_success'	=> $ext_count_success,
			'ext_count'			=> $ext_count,
			'action_lang'		=> $action_lang,
			'user_id'			=> $this->user->data['user_id'],
			'user_ip'			=> $this->user->ip,
			'timestamp'			=> time(),
		]);
	}

	private function remove_exts_with_migrations(array $ext_list): array
	{
		if (!$this->config['extonoff_enable_migrations'])
		{
			foreach ($ext_list as $ext_name => $value)
			{
				$ext_path = $this->extension_manager->get_extension_path($ext_name, true);
				if ($this->has_migration($ext_name, $ext_path))
				{
					unset($ext_list[$ext_name]);
				}
			}
		}

		return $ext_list;
	}

	private function get_exts_with_migration_technames(array $ext_list): array
	{
		$tech_names = [];

		foreach ($ext_list as $ext_name => &$ext_value)
		{
			$ext_path = $this->extension_manager->get_extension_path($ext_name, true);
			if ($this->has_migration($ext_name, $ext_path))
			{
				$tech_names[] = $ext_name;
			}
		}

		return $tech_names;
	}

	private function has_migration(string $ext_name, string $ext_path): bool
	{
		$migrations = $this->extension_manager->get_finder()->extension_directory('/migrations')->find_from_extension($ext_name, $ext_path);
		$migrations_classes = $this->extension_manager->get_finder()->get_classes_from_files($migrations);

		$this->migrator->set_migrations($migrations_classes);
		$migrations = $this->migrator->get_installable_migrations();
		$this->migrator->set_migrations([]);

		return (count($migrations) > 0);
	}
}
