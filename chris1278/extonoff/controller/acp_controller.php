<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278
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
	protected $db;
	protected $log;
	protected $user;
	protected $u_action;

	public function __construct(
		\phpbb\extension\manager $ext_manager,
		\phpbb\request\request $request,
		\phpbb\language\language $language,
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\log\log $log,
		\phpbb\user $user
	)
	{
		$this->extension_manager	= $ext_manager;
		$this->request				= $request;
		$this->language				= $language;
		$this->config				= $config;
		$this->template				= $template;
		$this->db  					= $db;
		$this->log					= $log;
		$this->user					= $user;
		$this->current_ext 			= 'chris1278/extonoff';
		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');
	}

	public function display_options()
	{
		$show_active_ext	= $this->request->variable('show_active_ext', 0);
		$show_active_ext 	= $this->get_exton();
		$active_complete 	= ($show_active_ext +1);

		$safe_time_limit = (ini_get('max_execution_time') / 2);
		$start_time = time();

		if ($this->request->is_set_post('extonoff_activate_all'))
		{
			$enabled_extensions = $this->extension_manager->all_disabled();

			if ($this->extension_manager->all_disabled())
			{
				unset($enabled_extensions[$this->current_ext]);
				foreach ($enabled_extensions as $ext_name => $value)
				{
					while ($this->extension_manager->enable_step($ext_name))
					{
						if ((time() - $start_time) >= $safe_time_limit)
						{
							meta_refresh(0);
						}
					}
				}
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_EXTONOFF_ACTIVATED');
				trigger_error($this->language->lang('EXTONOFF_ACTIVATION_SUCCESFULL') . adm_back_link($this->u_action));

			}
			else
			{
				trigger_error($this->language->lang('EXTONOFF_ACTIVATION_SUCCESFULL_INFO') . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}

		if ($this->request->is_set_post('extonoff_disable_all'))
		{
			$show_active_ext	= $this->request->variable('show_active_ext', 0);
			$show_active_ext 	= $this->get_exton();
			$disabled_extensions = $this->extension_manager->all_enabled();

			if (!$show_active_ext == 0)
			{
				unset($disabled_extensions[$this->current_ext]);
				foreach ($disabled_extensions as $ext_name => $value)
				{
					while ($this->extension_manager->disable_step($ext_name))
					{
						if ((time() - $start_time) >= $safe_time_limit)
						{
							meta_refresh(0);
						}
					}
				}

				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_EXTONOFF_DEACTIVATED');
				trigger_error($this->language->lang('EXTONOFF_DEACTIVATION_SUCCESFULL') . adm_back_link($this->u_action));
			}
			else
			{
				trigger_error($this->language->lang('EXTONOFF_DEACTIVATION_SUCCESFULL_INFO') . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}

		if ($this->request->is_set_post('submit'))
		{
			if ($this->request->is_set_post('extonoff_general'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->config->set('chris1278_extonoff', $this->request->variable('chris1278_extonoff', 0));
			trigger_error($this->language->lang('ACP_EXTONOFF_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars([
			'CHRIS1278_EXTONOFF'			=> $this->config['chris1278_extonoff'],
			'EXTON_INFO'					=> sprintf($this->language->lang('EXTONOFF_DEACTIVATION_INFO'), $show_active_ext, $active_complete),
			'U_ACTION'						=> $this->u_action,

		]);
	}

	public function get_exton()
	{
		$sql = 'SELECT COUNT(ext_active) AS active_ext
				FROM ' . EXT_TABLE . "
					WHERE ext_active = 1
					AND ext_name <> '" . $this->db->sql_escape($this->current_ext) . "'";

		$result		= $this->db->sql_query($sql);
		$ext_is_active	= (int) $this->db->sql_fetchfield('active_ext');

		$this->db->sql_freeresult($result);

		return $ext_is_active;
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
