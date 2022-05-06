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

class v_1_0_1_database extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\chris1278\extonoff\migrations\v_1_0_0_database'];
	}

	public function update_data()
	{
		return [
			['config.add',		['extonoff_enable_buttons',	$this->config['chris1278_extonoff']]],
			['config.add',		['extonoff_purge_cache', 0]],
			['config.remove',	['chris1278_extonoff']],
		];
	}
}
