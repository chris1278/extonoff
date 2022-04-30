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

class acp_module extends \phpbb\db\migration\migration
{

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v310\dev'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_EXTENSION_MANAGEMENT',
				[
					'module_basename'	=> '\chris1278\extonoff\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
