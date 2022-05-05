<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class acp_listener implements EventSubscriberInterface
{
	public function __construct(
		\chris1278\extonoff\controller\acp_controller $extonoff
	)
	{
		$this->extonoff	= $extonoff;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.common'							=> 'purge_cache',
			'core.acp_extensions_run_action_before'	=> 'enable_disable',
		];
	}

	public function enable_disable()
	{
		$this->extonoff->enable_disable();
	}

	public function purge_cache()
	{
		$this->extonoff->purge_cache();
	}
}
