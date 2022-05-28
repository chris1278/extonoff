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
	// language pack author
	'EXTONOFF_LANG_DESC'					=> 'Deutsch (Sie)',
	'EXTONOFF_LANG_EXT_VER' 				=> '2.0.0',
	'EXTONOFF_LANG_AUTHOR'	 				=> 'chris1278 & LukeWCS',

	// settings head
	'EXTONOFF_EXPLAIN_1'					=> 'Hier haben Sie die Möglichkeit alle Erweiterungen auf einmal zu deaktivieren bzw. zu aktivieren.',
	'EXTONOFF_EXPLAIN_2'					=> 'Zusätzlich haben Sie die Möglichkeit die Buttons auch direkt in der Ansicht „Erweiterungen verwalten“ anzeigen zu lassen.',
	'EXTONOFF_EXPLAIN_3'					=> '<strong style="color: red">Achtung:</strong> Es lassen sich nur installierte Erweiterungen aktivieren. Erweiterungen die zwar in der Liste aufgeführt, aber noch nicht installiert sind, werden dabei nicht berücksichtigt.',

	// settings buttons
	'EXTONOFF_ACTIVATE_OPTION'				=> 'Alle Erweiterungen aktivieren/deaktivieren',
	'EXTONOFF_DEACTIVATE'					=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_DEACTIVATE_EXPLAIN'			=> 'Mit dieser Funktion werden alle aktivierten Erweiterungen deaktiviert, mit Ausnahme der Erweiterung „Enable/disable extensions completely“. Diese müssen Sie manuell deaktivieren.',
	'EXTONOFF_ACTIVATE'						=> 'Alle Erweiterungen aktivieren',
	'EXTONOFF_ACTIVATE_EXPLAIN'				=> 'Mit dieser Funktion werden alle installierten aber deaktivierten Erweiterungen aktiviert.',

	// settings
	'EXTONOFF_SETTINGS_TITLE'				=> 'Einstellungen',
	'EXTONOFF_INTEGRATION'					=> 'Integration in „Erweiterungen verwalten“',
	'EXTONOFF_INTEGRATION_EXPLAIN'			=> 'Wenn Sie diese Option aktivieren, werden in der Ansicht „Erweiterungen verwalten“ ebenfalls Buttons eingeblendet, mit denen Sie auch dort alle Erweiterungen aktiveren bzw. deaktivieren können. Zusätzlich wird die Anzahl der aktivierten, deaktivierten und nicht installierten Erweiterungen angezeigt, sowie die Anzahl der Erweiterungen mit neuen Migrationsdateien.',
	'EXTONOFF_LOG'							=> 'Log-Eintrag',
	'EXTONOFF_LOG_EXPLAIN'					=> 'Hier können Sie festlegen, ob bei den Aktionen „Alle aktivieren“ und „Alle deaktivieren“ ein Eintrag im Administrator-Log hinzugefügt werden soll.',
	'EXTONOFF_CONFIRMATION'					=> 'Rückfrage',
	'EXTONOFF_CONFIRMATION_EXPLAIN'			=> 'Hier können Sie festlegen, ob bei den Aktionen „Alle aktivieren“ und „Alle deaktivieren“ eine Rückfrage erfolgen soll, die bestätigt werden muss.',

	// settings expert
	'EXTONOFF_EXPERT_SETTINGS_TITLE'		=> 'Experten-Einstellungen',
	'EXTONOFF_MIGRATIONS'					=> 'Erlaube Migrationen',
	'EXTONOFF_MIGRATIONS_EXPLAIN'			=> 'Wenn Sie diese Option aktivieren, dann können bei der Aktion „Alle aktivieren“ auch diejenigen Erweiterungen aktiviert werden, bei denen neue Migrationsdateien vorliegen. Das trifft auf aktualisierte Erweiterungen zu, die einen Ordner „migrations“ enthalten. Ohne diese Option müssen solche Erweiterungen manuell aktiviert werden, was empfohlen wird.',

	// ext manager
	'EXTONOFF_ALL_DISABLE'					=> 'Alle deaktivieren',
	'EXTONOFF_ALL_ENABLE'					=> 'Alle aktivieren',
	'EXTONOFF_INSTALLED'					=> 'installiert',
	'EXTONOFF_NOT_INSTALLED'				=> 'nicht installiert',
	'EXTONOFF_HAS_MIGRATION'				=> 'neue Migrationen',

	// misc
	'EXTONOFF_DEFAULT'						=> 'Standard',
	'EXTONOFF_EXTENSION_PLURAL'				=> [
		0 => "0 Erweiterungen",
		1 => "%u Erweiterung",
		2 => "%u Erweiterungen",
	],

	// tooltips
	'EXTONOFF_TOOLTIP_HAS_MIGRATION'		=> 'Diese Erweiterung hat neue Migrationsdateien, die beim aktivieren der Erweiterung übernommen werden.',
	'EXTONOFF_TOOLTIP_BUTTON_DISABLE'		=> '%s deaktivieren.',
	'EXTONOFF_TOOLTIP_BUTTON_ENABLE'		=> '%s aktivieren.',

	// messages
	'EXTONOFF_MSG_CONFIRM_DISABLE'			=> 'Sind Sie sich sicher, dass Sie %s deaktivieren möchten?',
	'EXTONOFF_MSG_CONFIRM_ENABLE'			=> 'Sind Sie sich sicher, dass Sie %s aktivieren möchten?',
	'EXTONOFF_MSG_SETTINGS_SAVED'			=> 'ExtOnOff: Einstellungen erfolgreich gespeichert.',
	'EXTONOFF_MSG_ACTIVATION_ABORTED'		=> 'ExtOnOff: Der Vorgang „Alle aktivieren“ wurde unterbrochen, da die folgende Erweiterung nicht aktiviert werden konnte:',
	'EXTONOFF_MSG_DEACTIVATION_SUCCESFULL'	=> 'ExtOnOff: %1$u von %2$u aktivierten Erweiterungen wurden deaktiviert.',
	'EXTONOFF_MSG_ACTIVATION_SUCCESFULL'	=> 'ExtOnOff: %1$u von %2$u deaktivierten Erweiterungen wurden aktiviert.',
	'EXTONOFF_MSG_LANGUAGEPACK_OUTDATED'	=> 'Hinweis: Das Sprachpaket der Erweiterung <strong>%1$s</strong> ist nicht mehr aktuell. (vorhanden: %2$s / benötigt: %3$s)',
]);
