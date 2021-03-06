<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace chris1278\extonoff;

class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$valid_phpbb = phpbb_version_compare(PHPBB_VERSION, '3.2.11', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.4.0', '<');
		$valid_php = phpbb_version_compare(PHP_VERSION, '7.0.0', '>=') && phpbb_version_compare(PHP_VERSION, '8.2.0', '<');

		return ($valid_phpbb && $valid_php);
	}
}
