/**
*
* Enable/disable extensions completely from Chris1278. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, Chris1278 & LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

$(window).ready(function () {
	$('div.errorbox p').prepend(ExtOnOff.TemplateVars.LastExtMsg);
});
