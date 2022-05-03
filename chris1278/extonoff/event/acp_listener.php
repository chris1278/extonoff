<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class acp_listener implements EventSubscriberInterface
{
	protected $extension_manager;
	protected $template;
	protected $language;
	protected $config;
	protected $log;
	protected $user;
	protected $u_action;

	public function __construct(
		\phpbb\extension\manager $extension_manager,
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\config\config $config,
		\phpbb\log\log $log,
		\phpbb\user $user
	)
	{
		$this->extension_manager 	= $extension_manager;
		$this->template 			= $template;
		$this->language				= $language;
		$this->config				= $config;
		$this->log					= $log;
		$this->user					= $user;
		$this->language->add_lang('acp_extonoff', 'chris1278/extonoff');
	}

	public static function getSubscribedEvents()
	{
		return array(
			'core.acp_extensions_run_action_before'	=> 'extonoff_run',
		);
	}

	public function extonoff_run($event)
	{
		$this->template->assign_vars([
			'EXTONOFF_LISTENER_BUTTONS'			=> $this->config['extonoff_enable_buttons'],
			'EXTONOFF_DISABLE_ALL'				=> ($event['u_action'] . '&action=disable-all'),
			'EXTONOFF_ACTIVATE_ALL'				=> ($event['u_action'] . '&action=activate-all'),
		]);

		if ($event['action'] == 'disable-all')
		{
			$safe_time_limit = (ini_get('max_execution_time') / 2);
			$start_time = time();
			$enabled_extensions = $this->extension_manager->all_enabled();
			unset($enabled_extensions['chris1278/extonoff']);
			foreach ($enabled_extensions as $ext_name => $value)
			{
				while ($this->extension_manager->disable_step($ext_name))
				{
					if ((time() - $start_time) >= $safe_time_limit)
					{
						meta_refresh(0, $this->u_action . '&amp;action=disable-all');
					}
				}
			}
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_EXTONOFF_DEACTIVATED');
		}

		if ($event['action'] == 'activate-all')
		{
			$safe_time_limit = (ini_get('max_execution_time') / 2);
			$start_time = time();
			$enabled_extensions = $this->extension_manager->all_disabled();
			unset($enabled_extensions['chris1278/extonoff']);
			foreach ($enabled_extensions as $ext_name => $value)
			{
				while ($this->extension_manager->enable_step($ext_name))
				{
					if ((time() - $start_time) >= $safe_time_limit)
					{
						meta_refresh(0, $this->u_action . '&amp;action=activate-all');
					}
				}
			}
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_EXTONOFF_ACTIVATED');
		}
	}
}
