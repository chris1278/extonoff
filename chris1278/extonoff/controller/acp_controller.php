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
		$this->template				= $template;
		$this->log					= $log;
		$this->user					= $user;
		$this->cache				= $cache;
		$this->current_ext 			= 'chris1278/extonoff';
	}

	public function enable_disable()
	{
		$this->language->add_lang('acp/extensions');
		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');

		$this->template->assign_vars([
			'EXTONOFF_LISTENER_BUTTONS' => $this->config['extonoff_enable_buttons'],
		]);

		if (!$this->request->is_set_post('extonoff_activate_all') && !$this->request->is_set_post('extonoff_disable_all'))
		{
			return;
		}

		$show_active_ext = count($this->extension_manager->all_enabled()) - 1;
		$show_inactive_ext = count($this->extension_manager->all_disabled());
		$safe_time_limit = (ini_get('max_execution_time') / 2);
		$start_time = time();

		if ($this->request->is_set_post('extonoff_activate_all'))
		{
			$disabled_extensions = $this->extension_manager->all_disabled();

			if ($disabled_extensions)
			{
				$this->config->set('extonoff_purge_cache', 1);
				unset($disabled_extensions[$this->current_ext]);
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
				}
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'EXTONOFF_LOG', false, [$show_inactive_ext, $this->language->lang('EXTONOFF_LOG_ACTIVATED')]);
				trigger_error($this->language->lang('EXTONOFF_ACTIVATION_SUCCESFULL', $show_inactive_ext) . adm_back_link($this->u_action));
			}
			else
			{
				trigger_error($this->language->lang('EXTONOFF_ACTIVATION_UNNECESSARY') . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}

		if ($this->request->is_set_post('extonoff_disable_all'))
		{
			$enabled_extensions = $this->extension_manager->all_enabled();

			if (!$show_active_ext == 0)
			{
				$this->config->set('extonoff_purge_cache', 1);
				unset($enabled_extensions[$this->current_ext]);
				foreach ($enabled_extensions as $ext_name => $value)
				{
					while ($this->extension_manager->disable_step($ext_name))
					{
						if ((time() - $start_time) >= $safe_time_limit)
						{
							meta_refresh(0);
						}
					}
				}
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip,  'EXTONOFF_LOG', false, [$show_active_ext, $this->language->lang('EXTONOFF_LOG_DEACTIVATED')]);
				trigger_error($this->language->lang('EXTONOFF_DEACTIVATION_SUCCESFULL', $show_active_ext) . adm_back_link($this->u_action));
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

		if ($this->request->is_set_post('extonoff_activate_all') || $this->request->is_set_post('extonoff_disable_all'))
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
			trigger_error($this->language->lang('EXTONOFF_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars([
			'EXTONOFF_ENABLE_BUTTONS'		=> $this->config['extonoff_enable_buttons'],
			'EXTONOFF_DEACTIVATION_INFO'	=> sprintf($this->language->lang('EXTONOFF_DEACTIVATION_INFO'), $show_active_ext, $show_active_ext + 1),
			'U_ACTION'						=> $this->u_action,
		]);
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}

	public function purge_cache()
	{
		if ($this->config['extonoff_purge_cache'])
		{
			$this->config->set('extonoff_purge_cache', 0);
			$this->cache->purge();
		}
	}
}
