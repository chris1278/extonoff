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
	'EXTONOFF_EXPLAIN'						=> 'Hier haben Sie die Möglichkeit alle Erweiterungen auf einmal zu deaktivieren bzw. zu aktivieren.<br><br>Zusätzlich haben Sie die Möglichkeit auch entsprechend die Buttons direkt in der Ansicht <strong>„Erweiterungen verwalten“</strong> anzeigen zu lassen und diese dort zu nutzen.<br><br><strong style="color: red">Achtung:</strong>  Es lassen sich nur installierte Erweiterungen aktivieren bzw. deaktivieren. Erweiterungen die zwar in der Liste aufgeführt, aber noch nicht installiert sind, werden dabei nicht berücksichtigt.',
	'EXTONOFF_ACTIVATE_OPTION'				=> 'Alle Erweiterungen aktivieren/deaktivieren',
	'EXTONOFF_ACTIVATE'						=> 'Alle Erweiterungen aktivieren',
	'EXTONOFF_ACTIVATE_EXPLAIN'				=> 'Durch drücken des Buttons <strong>„Alle Erweiterungen aktivieren“</strong> werden alle installierten aber deaktivierten Erweiterungen aktiviert.',
	'EXTONOFF_ALL_ENABLE'					=> 'Alle Erweiterungen aktivieren',
	'EXTONOFF_ACTIVATION_SUCCESFULL'		=> '%1$u von %2$u deaktivierten Erweiterungen wurden aktiviert.',
	'EXTONOFF_ACTIVATION_UNNECESSARY'		=> 'Die Erweiterungen sind bereits alle aktiviert. Eine nochmalige Aktivierung ist nicht notwendig.',
	'EXTONOFF_DEACTIVATE'					=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_DEACTIVATE_EXPLAIN'			=> 'Durch drücken des Buttons <strong>„Alle Erweiterungen deaktivieren“</strong> werden alle aktivierten Erweiterungen deaktiviert.<br><br><strong>Hinweis:</strong> Die Erweiterung <strong>„Enable/disable extensions completely“</strong> bleibt dabei aktiviert. Diese müssen Sie dann manuell deaktivieren.',
	'EXTONOFF_ALL_DISABLE'					=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_DEACTIVATION_SUCCESFULL'		=> '%1$u von %2$u aktivierten Erweiterungen wurden deaktiviert.',
	'EXTONOFF_DEACTIVATION_UNNECESSARY'		=> 'Die Erweiterungen sind bereits alle deaktiviert. Eine nochmalige Deaktivierung ist nicht notwendig.',
	'EXTONOFF_DEACTIVATION_INFO'			=> 'Es können von insgesamt <strong>%2$u</strong> aktiven Erweiterungen <strong>%1$u</strong> Erweiterungen mittels dieser Erweiterung deaktiviert werden.',
	'EXTONOFF_EXTRA_BUTTONS'				=> 'Zusatz Buttons in der Ansicht „Erweiterungen verwalten“',
	'EXTONOFF_ENABLE_BUTTONS'				=> 'Zusatz-Buttons aktivieren',
	'EXTONOFF_ENABLE_BUTTONS_EXPLAIN'		=> 'Wenn Sie diese Option aktivieren, werden in der Ansicht <strong>„Erweiterungen verwalten“</strong> ebenfalls Buttons eingeblendet, mit denen Sie auch dort alle Erweiterungen aktiveren bzw. deaktivieren können.',
	'EXTONOFF_ADMIN_LOG'					=> 'Log-Eintrag',
	'EXTONOFF_ENABLE_LOG'					=> 'Log-Eintrag aktivieren',
	'EXTONOFF_ENABLE_LOG_EXPLAIN'			=> 'Hier können Sie festlegen, ob bei den Aktionen <strong>„Alle Erweiterungen aktivieren“</strong> und <strong>„Alle Erweiterungen deaktivieren“</strong> ein Eintrag im Administrator-Log hinzugefügt werden soll.',
	'EXTONOFF_DEFAULT'						=> 'Standard',
	'EXTONOFF_MSG_ACTIVATION_ABORTED'		=> 'Der Vorgang „Alle Erweiterungen aktivieren“ wurde unterbrochen, da die folgende Erweiterung nicht aktiviert werden konnte:',
	'EXTONOFF_MSG_SETTINGS_SAVED'			=> 'Einstellungen erfolgreich gespeichert.',
]);
