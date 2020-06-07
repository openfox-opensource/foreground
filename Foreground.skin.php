<?php

/**
 * Skin file for Sheatufim
 *
 * @file
 * @ingroup Skins
 */

class SkinForeground extends SkinTemplate {
	public $skinname = 'foreground', $stylename = 'foreground', $template = 'ForegroundTemplate', $useHeadElement = true;

	public function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		global $wgForegroundFeatures;
		$wgForegroundFeaturesDefaults = [
			'showActionsForAnon' => true,
			'NavWrapperType' => 'divonly',
			'showHelpUnderTools' => true,
			'showRecentChangesUnderTools' => true,
			'enableTabs' => false,
			'wikiName' => &$GLOBALS['wgSitename'],
			'navbarIcon' => false,
			'IeEdgeCode' => 1,

			'showFooterIcons' => false,
			'addThisPUBID' => '',
			'useAddThisShare' => '',
			'useAddThisFollow' => ''
		];
		foreach ( $wgForegroundFeaturesDefaults as $fgOption => $fgOptionValue ) {
			if ( !isset( $wgForegroundFeatures[$fgOption] ) ) {
				$wgForegroundFeatures[$fgOption] = $fgOptionValue;
			}
		}
		switch ( $wgForegroundFeatures['IeEdgeCode'] ) {
			case 1:
				$out->addHeadItem( 'ie-meta', '<meta http-equiv="X-UA-Compatible" content="IE=edge" />' );
				break;
			case 2:
				if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) )
					header( 'X-UA-Compatible: IE=edge' );
				break;
		}
		$out->addModuleStyles( 'skins.foreground.styles' );
	}

	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;
		parent::initPage( $out );

		$viewport_meta = 'width=device-width, user-scalable=yes, initial-scale=1.0';

		$out->addMeta( 'viewport', $viewport_meta );
		$out->addModules( 'skins.foreground.js' );
	}

}

class ForegroundTemplate extends BaseTemplate {
	public function execute() {
		global $wgUser;
		global $wgForegroundFeatures;

		Wikimedia\suppressWarnings();
		$this->html( 'headelement' );
		switch ( $wgForegroundFeatures['enableTabs'] ) {
			case true:
				ob_start();
				$this->html( 'bodytext' );
				$out = ob_get_contents();
				ob_end_clean();
				$markers = [ "&lt;a", "&lt;/a", "&gt;" ];
				$tags = [ "<a", "</a", ">" ];
				$body = str_replace( $markers, $tags, $out );
				break;
			default:
				$body = '';
				break;
		}

		$displaytitle = $this->data['title'];
		$namespace = str_replace( '_', ' ', $this->getSkin()->getTitle()->getNsText() );
		if ( !empty( $namespace ) ) {
			$pagetitle = $this->getSkin()->getTitle();
			$newtitle = str_replace( $namespace . ':', '', $pagetitle );
			$displaytitle = str_replace( $pagetitle, $newtitle, $displaytitle );
		}

		// Set default variables for footer and switch them if 'showFooterIcons' => true
		$footerLeftClass = 'small-12 large-centered columns text-center';
		$footerRightClass = 'large-12 small-12 columns';
		$poweredbyType = "nocopyright";
		$poweredbyMakeType = 'withoutImage';
		switch ( $wgForegroundFeatures['showFooterIcons'] ) {
			case true:
				$footerLeftClass = 'large-8 small-12 columns';
				$footerRightClass = 'large-4 small-12 columns';
				$poweredbyType = "icononly";
				$poweredbyMakeType = 'withImage';
				break;
			default:
				break;
		}
		switch ( $wgForegroundFeatures['NavWrapperType'] ) {
			case '0':
				break;
			case 'divonly':
				echo "<div id='navwrapper'>";
				break;
			default:
				echo "<div id='navwrapper' class='" . $wgForegroundFeatures['NavWrapperType'] . "'>";
				break;
		}
	?>
	<?php //dont print new nav
		if ( false ) { ?>
		<nav class="top-bar" data-topbar role="navigation" data-options="back_text: <?php echo wfMessage( 'foreground-menunavback' )->text(); ?>">
			<ul class="title-area">
				<li class="name">
					<div class="title-name">
					<a href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>">
					<?php if ( $wgForegroundFeatures['navbarIcon'] != '0' ) { ?>
						<img alt="<?php echo $this->text( 'sitename' ); ?>" class="top-bar-logo" src="<?php echo $this->text( 'logopath' ) ?>">
					<?php } ?>					
					<div class="title-name" style="display: inline-block;"><?php echo $wgForegroundFeatures['wikiName']; ?></div>
					</a>
					</div>
				</li>
				<li class="toggle-topbar menu-icon">
					<a href="#"><span><?php echo wfMessage( 'foreground-menutitle' )->text(); ?></span></a>
				</li>
			</ul>

		<section class="top-bar-section">

			<ul id="top-bar-left" class="left">
				<li class="divider show-for-small"></li>
				<?php foreach ( $this->getSidebar() as $boxName => $box ) { if ( ( $box['header'] != wfMessage( 'toolbox' )->text() ) ) { ?>
					<li class="has-dropdown active"  id='<?php echo Sanitizer::escapeId( $box['id'] ) ?>'<?php echo Linker::tooltip( $box['id'] ) ?>>
						<a href="#"><?php echo htmlspecialchars( $box['header'] ); ?></a>
						<?php if ( is_array( $box['content'] ) ) { ?>
							<ul class="dropdown">
								<?php foreach ( $box['content'] as $key => $item ) { echo $this->makeListItem( $key, $item );
					   } ?>
							</ul>
						<?php } ?>
					</li>
				<?php } ?>
	   <?php
		  }
	   ?>
			</ul>

			<ul id="top-bar-right" class="right">
				<li class="has-form">
					<form action="<?php $this->text( 'wgScript' ); ?>" id="searchform" class="mw-search">
						<div class="row collapse">
						<div class="small-12 columns">
							<?php echo $this->makeSearchInput( [ 'placeholder' => wfMessage( 'searchsuggest-search' )->text(), 'id' => 'searchInput' ] ); ?>
							<button type="submit" class="button search"><?php echo wfMessage( 'search' )->text() ?></button>
						</div>
						</div>
					</form>
				</li>
				<li class="divider show-for-small"></li>

				<li class="has-dropdown active"><a href="#"><i class="fa fa-cogs"></i></a>
					<ul id="toolbox-dropdown" class="dropdown">
						<?php foreach ( $this->getToolbox() as $key => $item ) { echo $this->makeListItem( $key, $item );
			   } ?>
						<?php if ( $wgForegroundFeatures['showRecentChangesUnderTools'] ): ?><li id="n-recentchanges"><?php echo Linker::specialLink( 'Recentchanges' ) ?></li><?php
			   endif; ?>
						<?php if ( $wgForegroundFeatures['showHelpUnderTools'] ): ?><li id="n-help" <?php echo Linker::tooltip( 'help' ) ?>><a href="<?php echo Skin::makeInternalOrExternalUrl( wfMessage( 'helppage' )->inContentLanguage()->text() )?>"><?php echo wfMessage( 'help' )->text() ?></a></li><?php
			   endif; ?>
					</ul>
				</li>

				<li id="personal-tools-dropdown" class="has-dropdown active"><a href="#"><i class="fa fa-user"></i></a>
					<ul class="dropdown">
						<?php foreach ( $this->getPersonalTools() as $key => $item ) { echo $this->makeListItem( $key, $item );
			   } ?>
					</ul>
				</li>

			</ul>
		</section>
		</nav>
		
		<?php if ( $wgForegroundFeatures['NavWrapperType'] != '0' ) {
			echo "</div>";
		}
		?>

	<?php
		//end of no nav
		}
	?>
	<!-- START SheatufimTemplate -->
	<header class="header">
		<div class="header-site">
			<a class="logo" href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>">
							<img alt="<?php echo $this->text( 'sitename' ); ?>" class="top-logo" src="<?php echo $this->text( 'logopath' ) ?>">
			</a>
						
			<div class="mmmrap">
				<div class="mmrap exmenu">
					<div class="aaa">
						<span class="InvertColors">
							<i class="material-icons">invert_colors</i>
						</span>
						<!--<span class="BlackWhite icon-svg_icons_Contrast">-->
						<span class="BlackWhite">
							<i class="material-icons">brightness_6</i>
						</span>
						<span class="fonts">
							<span class="fontSmall curr">א</span>
							<span class="fontMedium">א</span>
							<span class="fontLarge">א</span>
						</span>
					</div>
				</div>
			</div>
			<div class="head-wrapper">
				<div class="menues mmrap">
					<nav class="smenu">
						<ul>
							<li><a href="/על_פורטל_הידע"><span class="smtlp">על הפורטל<span class="hide icon icon-svg_icons_arrow"></span></a></span></li>
							<li><a href="//sheatufim.org.il">על שיתופים<span class="hide icon icon-svg_icons_arrow"></span></a></li>
							<li><a href="/ארגז_כלים:שולחן העבודה למנהל החברתי"><span class="smtlp">ארגזי כלים<span class="hide icon icon-svg_icons_arrow"></span></a></span>
								<div class="smtlp-arrow"></div>
								<div class="smtlp-rap">
									<a href="/ארגז_כלים:שולחן העבודה למנהל החברתי">שולחן העבודה למנכ"ל החברתי<span class="hide icon-svg_icons_arrow"></span></a>
									<a href="/%D7%90%D7%A8%D7%92%D7%96_%D7%9B%D7%9C%D7%99%D7%9D:%D7%94%D7%A1%D7%A4%D7%A8%D7%99%D7%99%D7%94_-_%D7%9E%D7%93%D7%A8%D7%99%D7%9B%D7%99%D7%9D_%D7%9C%D7%9E%D7%A0%D7%9B%22%D7%9C_%D7%94%D7%97%D7%91%D7%A8%D7%AA%D7%99"> הספרייה – מדריכים למנכ"ל החברתי<span class="hide icon-svg_icons_arrow"></span></a>
									<a href="/ארגז_כלים:ארגז הכלים לניהול פיננסי"> ארגז הכלים לניהול פיננסי<span class="hide icon-svg_icons_arrow"></span></a>
									<a href="/ארגז_כלים:ארגז הכלים לניהול מענקים">ארגז הכלים לניהול מענקים<span class="hide icon-svg_icons_arrow"></span></a>
									<a href="/ארגז_כלים:ארגז כלים לניהול אסטרטגי"> ארגז הכלים לניהול אסטרטגי<span class="hide icon-svg_icons_arrow"></span></a>
								</div>
							</li>
							<li><a href="http://www.sheatufim.org.il/contact-us/">צור קשר<span class="hide icon icon-svg_icons_arrow"></span></a></li>			
						</ul>
					</nav>
				</div>
				<form action="<?php $this->text( 'wgScript' ); ?>" id="searchform" class="search-rap">
									<?php echo $this->makeSearchInput( [ 'placeholder' => wfMessage( 'searchsuggest-search' )->text(), 'id' => 'searchInput' ] ); ?> 
									<span class="icon icon-svg_icons_Search" title="<?php echo wfMessage( 'search' )->text() ?>"></span>                
				</form>
			</div>
			<div class="hide WSmallShow WSWideShow WMediumShow open-menu"><span></span><span></span><span></span></div>
			<div class="hide WSmallShow WSWideShow open-search icon-svg_icons_Search"></div><span class="mmarrow hide"></span>
		</div>        
	</header>


	<div id="page-content">
		<div class="site">
			<div id="contentSub" class="clear_both sh-border-top">
				<div class="sh-breadcrumbs">
					<div class="sh-breadcrumbs-item">
					<?php if ( $namespace != '' ) { ?>
						<a href="/<?php print $namespace;?>"><?php print $namespace;?>
					<?php }
 else { ?>
						<a href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>">מאגר הידע</a> <?php
 } ?>
						<span> &gt; </span>
						<a href="#">
							<?php print $displaytitle; ?>                                    
						</a>
					</div>
					<?php if ( $wgUser->isLoggedIn() || $wgForegroundFeatures['showActionsForAnon'] ): ?>
					<a href="/מיוחד:יציאה_מהחשבון" class="nav-bar-btn">
						<i class="fa fa-sign-out" aria-hidden="true">
							<span class="show-for-medium-up">&nbsp;התנתק</span>
						</i>
					</a>
					<div id="actions-menu">
						<a href="#" class="options-btn dropdown radius">
							<i class="fa fa-cog">
								<span class="show-for-medium-up">&nbsp;<?php echo wfMessage( 'actions' )->text() ?></span>
							</i>
						</a> 
						<!--RTL -->
						<ul id="drop1" class="views right f-dropdown">
							<?php foreach ( $this->data['content_actions'] as $key => $item ) {
		echo preg_replace( [ '/\sprimary="1"/','/\scontext="[a-z]+"/','/\srel="archives"/' ], '',
						  $this->makeListItem( $key, $item ) );
				   } ?>
							<?php Hooks::run( SkinTemplateToolboxEnd, [ &$this, true ] );  ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>  
			</div>
		</div>
		<div id="mw-js-message" style="display:none;"></div>
		
		<div id="main-img-area">
			<div class="site">
				<div id="p-cactions">
					<div id="content">
						<div id="bodyContent" class="mw-bodytext sh-content">
							<h2 id="firstHeading" class="title">
								<?php print $displaytitle; ?>
							</h2>
							<?php $this->html( 'bodytext' ) ?>
							<div class="clear_both"></div>
						</div>
						<div class="group">
							<?php $this->html( 'catlinks' ); ?>
						</div>
						<?php $this->html( 'dataAfterContent' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer id="sh-footer">
		<div class="site">
			<div class="sh-social-links">
				<a target="_blank" href="https://www.facebook.com/sheatufim/" class="icon-svg_icons_facebook"></a>
				<a target="_blank" href="https://www.linkedin.com/company/2069207?trk=tyah&amp;trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A2069207%2Cidx%3A2-1-2%2CtarId%3A1473755607458%2Ctas%3Asheatu" class="icon-svg_icons_linkedin"></a>
				<a target="_blank" href="https://www.youtube.com/user/sheatufim" class="icon-svg_icons_youtube"></a>
			</div>
			<nav class="fmenu">
				<li class=""><a href="/על_פורטל_הידע">על הפורטל</a></li>
				<li class=""><a target="_blank" href="//www.sheatufim.org.il">אתר שיתופים</a></li>
				<li class=""><a href="//www.sheatufim.org.il/contact-us/">צור קשר</a></li>
				<li class=""><a href="//www.sheatufim.org.il/תנאי-שימוש/">תנאי שימוש</a></li>
				 <?php if ( !$wgUser->isLoggedIn() ): ?>
				<li class=""><a href="/מיוחד:כניסה_לחשבון" class="">
						<i class="fa fa-sign-in" aria-hidden="true">
							<span class="show-for-medium-up">&nbsp;התחבר</span>
						</i>
					</a>
				<<?php endif; ?>
			</nav>
			<a class="logo" href="http://www.sheatufim.org.il/">
				<img title="שיתופים - אסטרטגיות להשפעה חברתית" src="/w/upload/sheatufim/logo-footer.png">
			</a>
			<div class="contact-info"><span>כתובת: ת.ד. 3225 בית יהושע 40591</span><span>טלפון: 09-8301400</span><span>פקס: 09-8990889</span></div>
			<div class="bottom">
				<div class="credits">
					<a href="https://openfox.co.il/">נבנה על ידי OpenFox</a>
<?php if ( false ) { ?>
		
<!-- START FOREGROUNDTEMPLATE -->

		
		<div id="page-content">
		<div class="row">
				<div class="large-12 columns">
					<!-- Output page indicators -->
					<?php echo $this->getIndicators(); ?>
					<!-- If user is logged in output echo location -->
					<?php if ( $wgUser->isLoggedIn() ): ?>
					<div id="echo-notifications">
					<div id="echo-notifications-alerts"></div>
					<div id="echo-notifications-messages"></div>
					<div id="echo-notifications-notice"></div>
					</div>
					<?php endif; ?>
				<!--[if lt IE 9]>
				<div id="siteNotice" class="sitenotice panel radius"><?php echo $this->text( 'sitename' ) . ' ' . wfMessage( 'foreground-browsermsg' )->text(); ?></div>
				<![endif]-->

				<?php if ( $this->data['sitenotice'] ) { ?><div id="siteNotice" class="sitenotice"><?php $this->html( 'sitenotice' ); ?></div><?php
	   } ?>
				<?php if ( $this->data['newtalk'] ) { ?><div id="usermessage" class="newtalk panel radius"><?php $this->html( 'newtalk' ); ?></div><?php
	   } ?>
				</div>
		</div>

		<div id="mw-js-message" style="display:none;"></div>

		<div class="row">
				<div id="p-cactions" class="large-12 columns">
					<?php if ( $wgUser->isLoggedIn() || $wgForegroundFeatures['showActionsForAnon'] ): ?>
						<a id="actions-button" href="#" data-dropdown="actions" data-options="align:left; is_hover: true; hover_timeout:700" class="button small secondary radius"><i class="fa fa-cog"><span class="show-for-medium-up">&nbsp;<?php echo wfMessage( 'actions' )->text() ?></span></i></a>
						<!--RTL -->
						<ul id="actions" class="f-dropdown" data-dropdown-content>
							<?php foreach ( $this->data['content_actions'] as $key => $item ) { echo preg_replace( [ '/\sprimary="1"/','/\scontext="[a-z]+"/','/\srel="archives"/' ], '', $this->makeListItem( $key, $item ) );
				   } ?>
							<?php Hooks::run( 'SkinTemplateToolboxEnd', [ &$this, true ] );  ?>
						</ul>
						<!--RTL -->
					<?php endif;
					$namespace = str_replace( '_', ' ', $this->getSkin()->getTitle()->getNsText() );
					$displaytitle = $this->data['title'];
					if ( !empty( $namespace ) ) {
						$pagetitle = $this->getSkin()->getTitle();
						$newtitle = str_replace( $namespace . ':', '', $pagetitle );
						$displaytitle = str_replace( $pagetitle, $newtitle, $displaytitle );
					?><h4 class="namespace label"><?php print $namespace; ?></h4><?php
		   } ?>
					<div id="content">
					<h1  id="firstHeading" class="title"><?php print $displaytitle; ?></h1>
						<?php if ( $wgForegroundFeatures['useAddThisShare'] !== '' ) { ?>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<div class="<?php echo $wgForegroundFeatures['useAddThisShare']; ?> hide-for-print"></div>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<?php } ?>
					<?php if ( $this->data['isarticle'] ) { ?><h3 id="tagline"><?php $this->msg( 'tagline' ) ?></h3><?php
		   } ?>
					<h5 id="siteSub" class="subtitle"><?php $this->html( 'subtitle' ) ?></h5>
					<div id="contentSub" class="clear_both"></div>
					<div id="bodyContent" class="mw-bodytext">
						<?php
							switch ( $wgForegroundFeatures['enableTabs'] ) {
								case true:
									echo $body;
									break;
								default:
								$this->html( 'bodytext' );
									break;
							}
						?>
						<div class="clear_both"></div>
					</div>
				<div class="group"><?php $this->html( 'catlinks' ); ?></div>
				<?php $this->html( 'dataAfterContent' ); ?>
				</div>
			</div>
		</div>

			<footer class="row">
				<div id="footer">
					<?php if ( $wgForegroundFeatures['useAddThisFollow'] !== '' ) { ?>
						<div class="social-follow hide-for-print">
							<!-- Go to www.addthis.com/dashboard to customize your tools -->
							<div class="<?php echo $wgForegroundFeatures['useAddThisFollow']; ?> hide-for-print"></div>
						</div>
					<?php } ?>
					<div id="footer-left" class="<?php echo $footerLeftClass;?>">
					<ul id="footer-left">
						<?php foreach ( $this->getFooterLinks( "flat" ) as $key ) { ?>
							<li id="footer-<?php echo $key ?>"><?php $this->html( $key ) ?></li>
						<?php } ?>									
					</ul>
					</div>	
					<div id="footer-right-icons" class="<?php echo $footerRightClass;?>">
					<ul id="poweredby">
						<?php foreach ( $this->getFooterIcons( $poweredbyType ) as $blockName => $footerIcons ) { ?>
							<li class="<?php echo $blockName ?>"><?php foreach ( $footerIcons as $icon ) { ?>
								<?php echo $this->getSkin()->makeFooterIcon( $icon, $poweredbyMakeType ); ?>
															   <?php } ?>
							</li>
						<?php } ?>
					</ul>
					</div>								
<?php } ?>
				</div>
				<span class="stf-credit">כל הזכויות שמורות לשיתופים - אסטרטגיות להשפעה חברתית</span>
			</div>
		</div>

	</footer>
	<?php $this->printTrail(); ?>
	<?php if ( $wgForegroundFeatures['addThisFollowPUBID'] != '' ) { ?>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $wgForegroundFeatures['addThisFollowPUBID'];?>"></script>
	<?php } ?>
	</body>

	</html>

	<?php
		Wikimedia\RestoreWarnings();
	}
}

