<?php

/**
 * Sheatufim Skin
 *
 * @file
 * @ingroup Skins
 * @license 2-clause BSD
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is a skin to the MediaWiki package and cannot be run standalone.' );
}

$wgValidSkinNames['sheatufim'] = 'Sheatufim';
$wgAutoloadClasses['SkinSheatufim'] = __DIR__ . '/sheatufim.skin.php';
$wgMessagesDirs['SkinSheatufim'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['SkinSheatufim'] = __DIR__ . '/Sheatufim.i18n.php';

$wgResourceModules['skins.sheatufim'] = [
	'position'       => 'top',
	'scripts'        => [
		'sheatufim/assets/scripts/sheatufim.js',
		'sheatufim/assets/scripts/vendor/custom.modernizr.js',
	   'sheatufim/assets/scripts/foreground.js',
		'sheatufim/assets/scripts/vendor/fastclick.js',
		'sheatufim/assets/scripts/vendor/responsive-tables.js',
		'sheatufim/assets/scripts/foundation/foundation.js',
		'sheatufim/assets/scripts/foundation/foundation.topbar.js',
		'sheatufim/assets/scripts/foundation/foundation.dropdown.js',
		'sheatufim/assets/scripts/foundation/foundation.section.js',
		'sheatufim/assets/scripts/foundation/foundation.clearing.js',
		'sheatufim/assets/scripts/foundation/foundation.tooltips.js',
		'sheatufim/assets/scripts/foundation/foundation.cookie.js',
		'sheatufim/assets/scripts/foundation/foundation.placeholder.js',
		'sheatufim/assets/scripts/foundation/foundation.forms.js',
		'sheatufim/assets/scripts/foundation/foundation.alerts.js',
		'sheatufim/assets/scripts/group-user.js'
	],
	'styles'         => [
		'sheatufim/assets/stylesheets/normalize.css',
		'sheatufim/assets/stylesheets/font-awesome.css',
		'sheatufim/assets/stylesheets/foundation.css',
		'sheatufim/assets/stylesheets/foreground.css',
		'sheatufim/assets/stylesheets/foreground-print.css',
		'sheatufim/assets/stylesheets/jquery.autocomplete.css',
		'sheatufim/assets/stylesheets/responsive-tables.css',
		'sheatufim/assets/stylesheets/foreground-doalogue.css',
		'sheatufim/assets/stylesheets/jquery-ui.css',//Doalogue
		'sheatufim/assets/stylesheets/sheatufim-icons.css',
		'sheatufim/assets/stylesheets/kwiki-icons.css',
		'sheatufim/assets/stylesheets/material-icons.css',
		'sheatufim/assets/stylesheets/sheatufim.css',
		'sheatufim/assets/stylesheets/accessibility.css',
		'sheatufim/assets/stylesheets/templates.css',
		'sheatufim/assets/stylesheets/group-user.css',
		'sheatufim/assets/stylesheets/responsive.css'
	],
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath'  => &$GLOBALS['wgStyleDirectory']
];
