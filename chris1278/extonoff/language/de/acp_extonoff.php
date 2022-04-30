<?php
/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278
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

$lang = array_merge($lang, [
	'EXTONOFF_EXPLAIN'										=> 'Hier hast du die Möglichkeit alle Erweiterungen auf einmal zu deaktivieren bzw. zu aktivieren.<br><br>Hier kannst du alle Erweiterungen die Aktiviert sind mittels der Buttons entweder alle aktivieren oder alle deaktivieren.<br><br>Zusätzlich hast du die Möglichkeit dir auch entsprechend die Buttons direkt in der Ansicht <b>"Erweiterungen verwalten"</b> anzeigen zu lassen und diese dort zu nutzen.<br><br><b style="color: red">Achtung:</b>  Es lassen sich nur die Erweiterungen die auch installiert sind aktivieren bzw. deaktivieren. Die Erweiterungen die zwar in der Liste sind, aber noch nicht installiert sind, werden dadurch nicht berücksichtigt.',
	'EXTONOFF_ACTIVATE_OPTION'								=> 'Alle Erweiterungen "Aktivieren/Deaktiveren"',
	'EXTONOFF_ACTIVATE'										=> 'Alle Erweiterungen aktivieren',
	'EXTONOFF_ACTIVATE_EXPLAIN'								=> 'Durch drücken des Buttons <b>"Alle Erweiterungen aktivieren"</b> werden alle installierten aber deaktivierten Erweiterungen aktiviert.',
	'EXTONOFF_ALL_ACTIVATE'									=> 'Alle Erweiterungen aktivieren',
	'EXTONOFF_ACTIVATION_SUCCESFULL'						=> 'Die Erweiterungen wurden alle erfolgreich aktiviert.',
	'EXTONOFF_ACTIVATION_SUCCESFULL_INFO'					=> 'Die Erweiterungen sind schon alle aktiviert. Eine nochmalige Aktivierung ist nicht notwendig.',
	'EXTONOFF_DEACTIVATE'									=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_DEACTIVATE_EXPLAIN'							=> 'Durch drücken des Buttons <b>"Alle Erweiterungen deaktivieren"</b> werden alle Erweiterungen die installiert und aktiviert sind deaktiviert.<br><br><b>Zusatz-Information:</B> Die Erweiterung <b>"Enable/disable extensions completely"</b> bleibt dabei aktiviert. Diese musst du dann manuell deaktivieren.',
	'EXTONOFF_ALL_DEACTIVATE'								=> 'Alle Erweiterungen deaktivieren',
	'EXTONOFF_DEACTIVATION_SUCCESFULL'						=> 'Alle Aktiven Erweiterungen wurden erfolgreich deaktiviert.',
	'EXTONOFF_DEACTIVATION_SUCCESFULL_INFO'					=> 'Die Erweiterungen sind schon alle deaktiviert. Eine nochmalige Deaktivierung ist nicht notwendig.',
	'EXTONOFF_DEACTIVATION_INFO'							=> 'Es können von insgesammt <b>%2$s</b> aktiven Erweiterungen <b>%1$s</b> Erweiterungen mittels dieser Erweiterung deaktiviert werden.',
	'EXTONOFF_EXTRA_BUTTONS'								=> 'Zusatz Buttons in der Ansicht "Erweiterungen verwalten"',
	'CHRIS1278_EXTONOFF'									=> 'Zusatz-Buttons aktivieren',
	'CHRIS1278_EXTONOFF_EXPLAIN'							=> 'Wenn du diese Option aktivierst werden in der Ansicht <b>"Erweiterungen verwalten"</b> ebenfalls Buttons eingeblendet mit denen du dort auch alle Erweiterungen aktiveren bzw. deaktivieren kannst.',
	'ACP_EXTONOFF_SETTING_SAVED'							=> 'Einstellungen erfolgreich gespeichert.',
]);
