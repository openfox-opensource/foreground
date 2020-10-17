<?php

/**
 * Foreground Skin
 *
 * @file
 * @ingroup Skins
 * @author Garrick Van Buren, Jamie Thingelstad, Tom Hutchison
 * @license BSD-2-Clause
 */

if ( function_exists( 'wfLoadSkin' ) ) {
	wfLoadSkin( 'foreground' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['foreground'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for the Foregrond skin. Please use wfLoadSkin instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the Foreground skin requires MediaWiki 1.25+' );
}
/*
$wgExtensionCredits['skin'][] = array(
	'path'		 => __FILE__,
	'name'		 => 'Foreground',
	'url'		 => 'http://foreground.thingelstad.com/',
	'author'	 => array(
		'Garrick Van Buren',
		'Jamie Thingelstad',
		'Tom Hutchison',
		'...'
	),
	'version' => '2.0.0 (Albert)',
	'descriptionmsg' => 'foreground-desc'
);

$wgValidSkinNames['foreground'] = 'Foreground';

$wgAutoloadClasses['SkinForeground'] = __DIR__ . '/Foreground.skin.php';
$wgAutoloadClasses['foregroundTemplate'] = __DIR__ . '/Foreground.skin.php';

$wgMessagesDirs['SkinForeground'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['SkinForeground'] = __DIR__ . '/Foreground.i18n.php';

$wgResourceModules['skins.foreground.styles'] = array(
	'position'       => 'top',
	'styles'         => array(
		'foreground/assets/stylesheets/normalize.css',
		'foreground/assets/stylesheets/font-awesome.css',
	//	'foreground/assets/stylesheets/font-opensanshebrew.css'
		'foreground/assets/stylesheets/foundation.css',
		'foreground/assets/stylesheets/foreground.css',
		'foreground/assets/stylesheets/foreground-print.css',
		'foreground/FullCalendar/fullcalendar.css',
		'../../js/owl/owl.theme.css',
		'../../js/owl/owl.carousel.css'
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath'  => &$GLOBALS['wgStyleDirectory']
);

$wgResourceModules['skins.foreground.modernizr'] = array(
	'position'       => 'top',
	'scripts'        => array(
		'foreground/assets/scripts/vendor/modernizr.js'
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath'  => &$GLOBALS['wgStyleDirectory']
);

$wgResourceModules['skins.foreground.js'] = array(
	'position'       => 'bottom',
	'scripts'        => array(
		'foreground/assets/scripts/vendor/fastclick.js',
		'foreground/assets/scripts/vendor/placeholder.js',
		'foreground/assets/scripts/foundation/foundation.js',
		'foreground/assets/scripts/foreground.js',
		'foreground/assets/scripts/foundation/foundation.orbit.js',
		'foreground/assets/scripts/foundation/foundation.topbar.js',
		'foreground/assets/scripts/foundation/foundation.dropdown.js',
		'foreground/assets/scripts/foundation/foundation.joyride.js',
		'foreground/assets/scripts/foundation/foundation.accordion.js',
		'foreground/assets/scripts/foundation/foundation.alert.js',
		'foreground/assets/scripts/foundation/foundation.clearing.js',
		'foreground/assets/scripts/foundation/foundation.equalizer.js',
		'foreground/assets/scripts/foundation/foundation.interchange.js',
		'foreground/assets/scripts/foundation/foundation.offcanvas.js',
		'foreground/assets/scripts/foundation/foundation.reveal.js',
		'foreground/assets/scripts/foundation/foundation.tab.js',
		'foreground/assets/scripts/foundation/foundation.tooltip.js',
		'../../js/owl/owl.carousel.js'
	),
	'dependencies'   => array(
		'jquery.cookie',
		'skins.foreground.modernizr',
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath'  => &$GLOBALS['wgStyleDirectory']
);
*/