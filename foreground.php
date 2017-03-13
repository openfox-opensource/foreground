<?php

/**
 * Sheatufim Skin
 *
 * @file
 * @ingroup Skins
 * @license 2-clause BSD
 */

if( !defined( 'MEDIAWIKI' ) ) {
    die( 'This is a skin to the MediaWiki package and cannot be run standalone.' );
}

$wgValidSkinNames['foreground'] = 'Foreground';
$wgAutoloadClasses['SkinForeground'] = __DIR__ . '/sheatufim.skin.php';
$wgMessagesDirs['SkinForeground'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['SkinForeground'] = __DIR__ . '/Foreground.i18n.php';

$wgResourceModules['skins.foreground'] = array(
    'position'       => 'top',
    'scripts'        => array(
        'foreground/assets/scripts/vendor/custom.modernizr.js',
       'foreground/assets/scripts/foreground.js',
        'foreground/assets/scripts/sheatufim.js',
        //'foreground/assets/scripts/jquery.1.9.2.js', //Doalogue
        //'foreground/assets/scripts/jquery.shapeshift.min.js',//Doalogue
        'foreground/assets/scripts/vendor/fastclick.js',
        'foreground/assets/scripts/vendor/responsive-tables.js',
        'foreground/assets/scripts/foundation/foundation.js',
        'foreground/assets/scripts/foundation/foundation.topbar.js',
        'foreground/assets/scripts/foundation/foundation.dropdown.js',
        'foreground/assets/scripts/foundation/foundation.section.js',
        'foreground/assets/scripts/foundation/foundation.clearing.js',
        'foreground/assets/scripts/foundation/foundation.cookie.js',
        'foreground/assets/scripts/foundation/foundation.placeholder.js',
        'foreground/assets/scripts/foundation/foundation.forms.js',
        'foreground/assets/scripts/foundation/foundation.alerts.js',

        'foreground/assets/scripts/group-user.js'
    ),
    'styles'         => array(
        'foreground/assets/stylesheets/normalize.css',
        'foreground/assets/stylesheets/font-awesome.css',
        'foreground/assets/stylesheets/foundation.css',
        'foreground/assets/stylesheets/foreground.css',
        'foreground/assets/stylesheets/foreground-print.css',
        'foreground/assets/stylesheets/jquery.autocomplete.css',
        'foreground/assets/stylesheets/responsive-tables.css',
        'foreground/assets/stylesheets/foreground-doalogue.css',
        'foreground/assets/stylesheets/jquery-ui.css',//Doalogue
        'foreground/assets/stylesheets/sheatufim-icons.css',
        'foreground/assets/stylesheets/kwiki-icons.css',
        'foreground/assets/stylesheets/material-icons.css',
        'foreground/assets/stylesheets/sheatufim.css',
        'foreground/assets/stylesheets/accessibility.css',
        'foreground/assets/stylesheets/responsive.css',
        'foreground/assets/stylesheets/templates.css',
        'foreground/assets/stylesheets/group-user.css'
    ),
    'remoteBasePath' => &$GLOBALS['wgStylePath'],
    'localBasePath'  => &$GLOBALS['wgStyleDirectory']
);
