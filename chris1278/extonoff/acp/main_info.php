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

class main_info
{
	public function module()
	{
		return [
			'filename'	=>	'\chris1278\extonoff\acp\main_module',
			'title'		=>	'EXTONOFF_TITLE',
			'modes'		=> [
				'settings'	=>	[
					'title'	=>	'EXTONOFF_TITLE',
					'auth'	=>	'ext_chris1278/extonoff && acl_a_extensions',
					'cat'	=>	['ACP_EXTENSION_MANAGEMENT'],
				],
			],
		];
	}
}
