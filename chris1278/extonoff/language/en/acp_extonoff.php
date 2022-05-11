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
	// settings head
	'EXTONOFF_EXPLAIN_1'					=> 'Here you have the option of deactivating or activating all extensions at once.',
	'EXTONOFF_EXPLAIN_2'					=> 'You also have the option of displaying the buttons directly in the "Manage Extensions" view.',
	'EXTONOFF_EXPLAIN_3'					=> '<strong style="color: red">Warning:</strong> Only the extensions that are installed can be activated or deactivated. Extensions that are in the list but are not yet installed are not taken into account.',

	// settings buttons
	'EXTONOFF_ACTIVATE_OPTION'				=> 'All Extensions enable/disable',
	'EXTONOFF_DEACTIVATE'					=> 'Disable all extensions',
	'EXTONOFF_DEACTIVATE_EXPLAIN'			=> 'By pressing the button "Disable all extensions", all activated extensions will be deactivated execept for the extension "Enable /disable extensions completely". You have to deactivate them manually.',
	'EXTONOFF_ALL_DISABLE'					=> 'Disable all extensions',
	'EXTONOFF_ACTIVATE'						=> 'Activate all extensions',
	'EXTONOFF_ACTIVATE_EXPLAIN'				=> 'By pressing the "Activate all extensions" button, all installed but deactivated extensions will be activated.',
	'EXTONOFF_ALL_ENABLE'					=> 'Activate all extensions',

	// settings
	'EXTONOFF_SETTINGS_TITLE'				=> 'Settings',
	'EXTONOFF_INTEGRATION'					=> 'Activate additional buttons',
	'EXTONOFF_INTEGRATION_EXPLAIN'			=> 'If you activate this option, buttons are also displayed in the "Manage extensions" view with which you can activate or deactivate all extensions there. In addition, the number of activated, deactivated and not installed extensions is displayed.',
	'EXTONOFF_LOG'							=> 'Log entry',
	'EXTONOFF_LOG_EXPLAIN'					=> 'Here you can specify whether an entry should be added to the administrator log for the actions "Activate all extensions" and "Deactivate all extensions".',
	'EXTONOFF_CONFIRMATION'					=> 'Confirmation',
	'EXTONOFF_CONFIRMATION_EXPLAIN'			=> 'Here you can specify whether the actions "Activate all extensions" and "Deactivate all extensions" should be prompted and must be confirmed.',

	// misc
	'EXTONOFF_DEFAULT'						=> 'Default',
	'EXTONOFF_INSTALLED'					=> 'installed',
	'EXTONOFF_NOT_INSTALLED'				=> 'not installed',
	'EXTONOFF_EXTENSION_PLURAL'				=> [
		0 => "0 extensions",
		1 => "%u extension",
		2 => "%u extensions",
	],

	// messages
	'EXTONOFF_MSG_ACTIVATION_ABORTED'		=> 'The "Activate all extensions" operation was interrupted because the following extension could not be activated:',
	'EXTONOFF_MSG_SETTINGS_SAVED'			=> 'Settings saved successfully.',
	'EXTONOFF_MSG_CONFIRM_DISABLE'			=> 'Are you sure that you wish to disable %s?',
	'EXTONOFF_MSG_CONFIRM_ENABLE'			=> 'Are you sure that you wish to enable %s?',
	'EXTONOFF_MSG_DEACTIVATION_SUCCESFULL'	=> '%1$u of %2$u enabled extensions have been disabled.',
	'EXTONOFF_MSG_ACTIVATION_SUCCESFULL'	=> '%1$u of %2$u disabled extensions have been enabled.',
]);
