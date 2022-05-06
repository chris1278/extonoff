<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” … „ “

$lang = array_merge($lang, [
	'EXTONOFF_EXPLAIN'						=> 'Here you have the option of deactivating or activating all extensions at once.<br><br>Here you can either activate all or deactivate all extensions that are activated using the buttons.<br><br>You also have the option of displaying the buttons directly in the <b>"Manage Extensions"</b> view and using them there.<br><br><b style="color: red">Warning:</b> Only the extensions that are installed can be activated or deactivated. The extensions that are in the list but are not yet installed are not taken into account.',
	'EXTONOFF_ACTIVATE_OPTION'				=> 'All Extensions enable/disable',
	'EXTONOFF_ACTIVATE'						=> 'Activate all extensions',
	'EXTONOFF_ACTIVATE_EXPLAIN'				=> 'By pressing the <b>"Activate all extensions"</b> button, all installed but deactivated extensions will be activated.',
	'EXTONOFF_ALL_ACTIVATE'					=> 'Activate all extensions',
	'EXTONOFF_ACTIVATION_SUCCESFULL'		=> 'The extensions have all been activated successfully.',
	'EXTONOFF_ACTIVATION_UNNECESSARY'		=> 'The extensions are already activated. A renewed activation is not necessary.',
	'EXTONOFF_DEACTIVATE'					=> 'Disable all extensions',
	'EXTONOFF_DEACTIVATE_EXPLAIN'			=> 'By pressing the button <b>"Disable all extensions"</b>, all extensions that are installed and activated are deactivated.<br><br><b>Note:</b> The extension <b>"Enable /disable extensions completely"</b> remains activated. You then have to deactivate them manually.',
	'EXTONOFF_ALL_DEACTIVATE'				=> 'Disable all extensions',
	'EXTONOFF_DEACTIVATION_SUCCESFULL'		=> 'All active extensions have been successfully deactivated.',
	'EXTONOFF_DEACTIVATION_UNNECESSARY'		=> 'The extensions are already disabled. A repeated deactivation is not necessary.',
	'EXTONOFF_DEACTIVATION_INFO'			=> 'Out of a total of <b>%2$s</b> active extensions, <b>%1$s</b> extensions can be deactivated using this extension.',
	'EXTONOFF_EXTRA_BUTTONS'				=> 'Additional buttons in the "Manage extensions" view',
	'EXTONOFF_ENABLE_BUTTONS'				=> 'Activate additional buttons',
	'EXTONOFF_ENABLE_BUTTONS_EXPLAIN'		=> 'If you activate this option, buttons are also displayed in the <b>"Manage extensions"</b> view with which you can activate or deactivate all extensions there.',
	'EXTONOFF_ADMIN_LOG'					=> 'Switch log entry on/off',
	'EXTONOFF_ENABLE_LOG'					=> 'Activate log entry',
	'EXTONOFF_ENABLE_LOG_EXPLAIN'			=> 'Here you can control the log entry that you can find in the maintenance area of the forum. If you deactivate the log entry, no more entries will be added to the list of log entries. This only affects the entries that are noted in the log by the extension <b>„Enable/disable extensions completely“</b>.<br><br><b>Default:</b> Yes',
	'EXTONOFF_ACTIVATION_ABORTED'			=> 'The "Activate all extensions" operation was interrupted because the following extension could not be activated:',
	'EXTONOFF_SETTINGS_SAVED'				=> 'Settings saved successfully.',
]);
