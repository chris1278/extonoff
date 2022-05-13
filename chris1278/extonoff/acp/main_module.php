<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff\acp;

class main_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	public function main()
	{
		global $phpbb_container;

		$this->tpl_name = 'acp_extonoff_main';

		$acp_controller = $phpbb_container->get('chris1278.extonoff.controller.acp');

		$language = $phpbb_container->get('language');

		$this->page_title = $language->lang('EXTONOFF_TITLE');

		$acp_controller->acp_module($this->u_action);
	}
}
