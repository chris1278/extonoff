<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff\migrations;

class database extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\chris1278\extonoff\migrations\acp_module'];
	}

	public function update_data()
	{
		return [
			['config.add',['chris1278_extonoff', 0]],
		];
	}
}
