<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff\migrations;

class v_2_0_0_database extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\chris1278\extonoff\migrations\v_2_0_0_acp_module'];
	}

	public function update_data()
	{
		return [
			['config.add',		['extonoff_enable_integration', 0]],
			['config.add',		['extonoff_enable_log', 1]],
			['config.add',		['extonoff_enable_confirmation', 1]],
			['config.add',		['extonoff_enable_migrations', 0]],
			['config.add',		['extonoff_exec_todo', 0]],
			['config.add',		['extonoff_todo_purge_cache', 0]],
			['config_text.add', ['extonoff_todo_add_log', '']],
		];
	}
}
