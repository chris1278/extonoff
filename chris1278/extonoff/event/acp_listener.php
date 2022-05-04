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
	protected $template;
	protected $config;
	protected $container;
	protected $u_action;

	public function __construct(
		\phpbb\template\template $template,
		\phpbb\config\config $config,
		\Symfony\Component\DependencyInjection\ContainerInterface $container
	)
	{
		$this->template 			= $template;
		$this->config				= $config;
		$this->container			= $container;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.acp_extensions_run_action_before'	=> 'extonoff_run',
		];
	}

	public function extonoff_run($event)
	{
		$this->template->assign_vars([
			'EXTONOFF_LISTENER_BUTTONS'			=> $this->config['extonoff_enable_buttons'],
		]);

		$acp_controller_for_buttons = $this->container->get('chris1278.extonoff.controller.acp');
		$acp_controller_for_buttons->display_options();
	}
}
