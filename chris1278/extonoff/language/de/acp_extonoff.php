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
	'EXTONOFF_EXPLAIN_1'					=> 'Hier hast du die Möglichkeit alle Erweiterungen auf einmal zu deaktivieren bzw. zu aktivieren.',
	'EXTONOFF_EXPLAIN_2'					=> 'Zusätzlich hast du die Möglichkeit dir auch entsprechend die Buttons direkt in der Ansicht „Erweiterungen verwalten“ anzeigen zu lassen.',
	'EXTONOFF_EXPLAIN_3'					=> '<strong style="color: red">Achtung:</strong>  Es lassen sich nur installierte Erweiterungen aktivieren bzw. deaktivieren. Erweiterungen die zwar in der Liste aufgeführt, aber noch nicht installiert sind, werden dabei nicht berücksichtigt.',

	// settings buttons
	'EXTONOFF_ACTIVATE_OPTION'				=> 'Alle Erweiterungen aktivieren/deaktivieren',
	'EXTONOFF_DEACTIVATE'					=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_DEACTIVATE_EXPLAIN'			=> 'Durch drücken des Buttons „Alle Erweiterungen deaktivieren“ werden alle aktivierten Erweiterungen deaktiviert, mit Ausnahme der Erweiterung „Enable/disable extensions completely“. Diese musst du manuell deaktivieren.',
	'EXTONOFF_ALL_DISABLE'					=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_ACTIVATE'						=> 'Alle Erweiterungen aktivieren',
	'EXTONOFF_ACTIVATE_EXPLAIN'				=> 'Durch drücken des Buttons „Alle Erweiterungen aktivieren“ werden alle installierten aber deaktivierten Erweiterungen aktiviert.',
	'EXTONOFF_ALL_ENABLE'					=> 'Alle Erweiterungen aktivieren',

	// settings info
	'EXTONOFF_DEACTIVATION_INFO'			=> 'Es können von insgesamt <strong>%2$u</strong> aktiven Erweiterungen <strong>%1$u</strong> Erweiterungen mittels dieser Erweiterung deaktiviert werden.',

	// settings
	'EXTONOFF_SETTINGS_TITLE'				=> 'Einstellungen',
	'EXTONOFF_INTEGRATION'					=> 'Integration in „Erweiterungen verwalten“',
	'EXTONOFF_INTEGRATION_EXPLAIN'			=> 'Wenn du diese Option aktivierst, werden in der Ansicht „Erweiterungen verwalten“ ebenfalls Buttons eingeblendet, mit denen du auch dort alle Erweiterungen aktiveren bzw. deaktivieren kannst. Ausserdem wird die Anzahl der aktivierten, deaktivierten und nicht installierten Erweiterungen angezeigt.',
	'EXTONOFF_LOG'							=> 'Log-Eintrag',
	'EXTONOFF_LOG_EXPLAIN'					=> 'Hier kannst du festlegen, ob bei den Aktionen „Alle Erweiterungen aktivieren“ und „Alle Erweiterungen deaktivieren“ ein Eintrag im Administrator-Log hinzugefügt werden soll.',
	'EXTONOFF_CONFIRMATION'					=> 'Rückfrage',
	'EXTONOFF_CONFIRMATION_EXPLAIN'			=> 'Hier kannst du festlegen, ob bei den Aktionen „Alle Erweiterungen aktivieren“ und „Alle Erweiterungen deaktivieren“ eine Rückfrage erfolgen soll, die bestätigt werden muss.',

	// misc
	'EXTONOFF_DEFAULT'						=> 'Standard',
	'EXTONOFF_INSTALLED'					=> 'installiert',
	'EXTONOFF_NOT_INSTALLED'				=> 'nicht installiert',

	// messages
	'EXTONOFF_MSG_ACTIVATION_ABORTED'		=> 'Der Vorgang „Alle Erweiterungen aktivieren“ wurde unterbrochen, da die folgende Erweiterung nicht aktiviert werden konnte:',
	'EXTONOFF_MSG_SETTINGS_SAVED'			=> 'Einstellungen erfolgreich gespeichert.',
	'EXTONOFF_MSG_CONFIRM_DISABLE'			=> 'Bist du dir sicher, dass du %1$u Erweiterungen deaktivieren möchtest?',
	'EXTONOFF_MSG_CONFIRM_ENABLE'			=> 'Bist du dir sicher, dass du %1$u Erweiterungen aktivieren möchtest?',
	'EXTONOFF_MSG_DEACTIVATION_SUCCESFULL'	=> '%1$u von %2$u aktivierten Erweiterungen wurden deaktiviert.',
	'EXTONOFF_MSG_DEACTIVATION_UNNECESSARY'	=> 'Die Erweiterungen sind bereits alle deaktiviert. Eine nochmalige Deaktivierung ist nicht notwendig.',
	'EXTONOFF_MSG_ACTIVATION_SUCCESFULL'	=> '%1$u von %2$u deaktivierten Erweiterungen wurden aktiviert.',
	'EXTONOFF_MSG_ACTIVATION_UNNECESSARY'	=> 'Die Erweiterungen sind bereits alle aktiviert. Eine nochmalige Aktivierung ist nicht notwendig.',
]);
