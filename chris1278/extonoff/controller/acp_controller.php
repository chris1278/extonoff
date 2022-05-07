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

	public function __construct(
		\phpbb\extension\manager $ext_manager,
		\phpbb\request\request $request,
		\phpbb\language\language $language,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\template\template $template,
		\phpbb\log\log $log,
		\phpbb\user $user,
		\phpbb\cache\driver\driver_interface $cache
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
	}

	public function enable_disable()
	{
		$this->language->add_lang('acp/extensions');
		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');

		$this->template->assign_vars([
			'EXTONOFF_LISTENER_BUTTONS' => $this->config['extonoff_enable_buttons'],
		]);

		if (!$this->request->is_set_post('extonoff_enable_all') && !$this->request->is_set_post('extonoff_disable_all'))
		{
			return;
		}

		$show_active_ext = count($this->extension_manager->all_enabled()) - 1;
		$show_inactive_ext = count($this->extension_manager->all_disabled());
		$safe_time_limit = (ini_get('max_execution_time') / 2);
		$start_time = time();

		if ($this->request->is_set_post('extonoff_enable_all'))
		{
			$disabled_extensions = $this->extension_manager->all_disabled();
			$ext_count_success = 0;

			if ($disabled_extensions)
			{
				$this->config->set('extonoff_exec_todo', 1);
				$this->config->set('extonoff_todo_purge_cache', 1);
				$this->config_text->set('extonoff_todo_add_log', '');

				foreach ($disabled_extensions as $ext_name => $value)
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
							$show_inactive_ext,
							$this->language->lang('EXTONOFF_LOG_ACTIVATED')
						));
					}
				}
				$this->template->assign_vars([
					'EXTONOFF_LAST_EXT_NAME'			=> '',
					'EXTONOFF_LAST_EXT_DISPLAY_NAME'	=> '',
				]);

				trigger_error($this->language->lang('EXTONOFF_ACTIVATION_SUCCESFULL', $ext_count_success, $show_inactive_ext) . adm_back_link($this->u_action), (($ext_count_success == 0) ? E_USER_WARNING : E_USER_NOTICE));
			}
			else
			{
				trigger_error($this->language->lang('EXTONOFF_ACTIVATION_UNNECESSARY') . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}

		if ($this->request->is_set_post('extonoff_disable_all'))
		{
			$enabled_extensions = $this->extension_manager->all_enabled();
			$ext_count_success = 0;

			if (!$show_active_ext == 0)
			{
				$this->config->set('extonoff_exec_todo', 1);
				$this->config->set('extonoff_todo_purge_cache', 1);
				unset($enabled_extensions['chris1278/extonoff']);
				foreach ($enabled_extensions as $ext_name => $value)
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
						$show_active_ext,
						$this->language->lang('EXTONOFF_LOG_DEACTIVATED')
					));
				}

				trigger_error($this->language->lang('EXTONOFF_DEACTIVATION_SUCCESFULL', $ext_count_success, $show_active_ext) . adm_back_link($this->u_action));
			}
			else
			{
				trigger_error($this->language->lang('EXTONOFF_DEACTIVATION_UNNECESSARY') . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}
	}

	public function acp_module()
	{
		$this->language->add_lang('acp/extensions');
		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');

		$show_active_ext = count($this->extension_manager->all_enabled()) - 1;

		if ($this->request->is_set_post('extonoff_enable_all') || $this->request->is_set_post('extonoff_disable_all'))
		{
			$this->enable_disable();
		}
		else if ($this->request->is_set_post('submit'))
		{
			if ($this->request->is_set_post('extonoff_general'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->config->set('extonoff_enable_buttons', $this->request->variable('extonoff_enable_buttons', 0));
			$this->config->set('extonoff_enable_log', $this->request->variable('extonoff_enable_log', 0));
			trigger_error($this->language->lang('EXTONOFF_MSG_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars([
			'EXTONOFF_ENABLE_BUTTONS'		=> $this->config['extonoff_enable_buttons'],
			'EXTONOFF_ENABLE_LOG'			=> $this->config['extonoff_enable_log'],
			'EXTONOFF_DEACTIVATION_INFO'	=> sprintf($this->language->lang('EXTONOFF_DEACTIVATION_INFO'), $show_active_ext, $show_active_ext + 1),
			'U_ACTION'						=> $this->u_action,
		]);
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
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
			if ($last_job !== null)
			{
				$this->config_text->set('extonoff_todo_add_log', '');
				$this->log->add(
					'admin',
					$last_job['user_id'],
					$last_job['user_ip'],
					'EXTONOFF_LOG',
					$last_job['timestamp'],
					[$last_job['ext_count_success'], $last_job['ext_count'], $last_job['action_lang']]
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
}
