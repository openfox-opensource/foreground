<?php

/**
 * Skin file for Sheatufim
 *
 * @file
 * @ingroup Skins
 */
 
class Skinsheatufim extends SkinTemplate {
    public $skinname = 'sheatufim', $stylename = 'sheatufim', $template = 'sheatufimTemplate', $useHeadElement = true;

	public function setupSkinUserCss(OutputPage $out) {
		parent::setupSkinUserCss($out);
		global $wgForegroundFeatures;
		$wgForegroundFeaturesDefaults = array(
			'showActionsForAnon' => true,
			'NavWrapperType' => 'divonly',
			'showHelpUnderTools' => true,
			'showRecentChangesUnderTools' => true,
			'wikiName' => &$GLOBALS['wgSitename'],
			'navbarIcon' => false,
			'IeEdgeCode' => 1,
			'showFooterIcons' => 0,
			'addThisFollowPUBID' => ''
		);
		foreach ($wgForegroundFeaturesDefaults as $fgOption => $fgOptionValue) {
			if ( !isset($wgForegroundFeatures[$fgOption]) ) {
				$wgForegroundFeatures[$fgOption] = $fgOptionValue;
			}
		}
		switch ($wgForegroundFeatures['IeEdgeCode']) {
			case 1:
				$out->addHeadItem('ie-meta', '<meta http-equiv="X-UA-Compatible" content="IE=edge" />');
				break;
			case 2:
				if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
					header('X-UA-Compatible: IE=edge');
				break;
		}
        $out->addModuleStyles('skins.sheatufim');
	}

	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;
		parent::initPage($out);

		$viewport_meta = 'width=device-width, user-scalable=yes, initial-scale=1.0';
	  $out->addMeta('viewport', $viewport_meta);
        $out->addModuleScripts('skins.sheatufim');
	}

}

class sheatufimTemplate extends BaseTemplate {
	public function execute() {
		global $wgUser;
		global $wgForegroundFeatures;
		wfSuppressWarnings();
		$this->html('headelement');
		switch ($wgForegroundFeatures['NavWrapperType']) {
			case '0':
				break;
			case 'divonly':
				echo "<div id='navwrapper'>";
				break;
			default:
				echo "<div id='navwrapper' class='". $wgForegroundFeatures['NavWrapperType']. "'>";
				break;
		}
        
        $displaytitle = $this->data['title'];
        $namespace = str_replace('_', ' ', $this->getSkin()->getTitle()->getNsText()); 
        if (!empty($namespace)) {
            $pagetitle = $this->getSkin()->getTitle();
            $newtitle = str_replace($namespace.':', '', $pagetitle);
            $displaytitle = str_replace($pagetitle, $newtitle, $displaytitle);
        } 
?>
    <!-- START SheatufimTemplate -->
    <header class="header">
        <div class="header-site">
			<a class="logo" href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>">
							<img alt="<?php echo $this->text('sitename'); ?>" class="top-logo" src="<?php echo $this->text('logopath') ?>">
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
									<?php echo $this->makeSearchInput(array('placeholder' => wfMessage('searchsuggest-search')->text(), 'id' => 'searchInput') ); ?> 
									<span class="icon icon-svg_icons_Search" title="<?php echo wfMessage( 'search' )->text() ?>"></span>                
				</form>
			</div>
            <div class="hide WSmallShow WSWideShow WMediumShow open-menu"><span></span><span></span><span></span></div>
            <div class="hide WSmallShow WSWideShow open-search icon-svg_icons_Search"></div><span class="mmarrow hide"></span>
        </div>        
    </header>

    <?php if ($wgForegroundFeatures['NavWrapperType'] != '0') echo "</div>"; ?>

    <div id="page-content">
        <div class="site">
            <div id="contentSub" class="clear_both sh-border-top">
                <div class="sh-breadcrumbs">
                    <div class="sh-breadcrumbs-item">
					<?php if ( $namespace != '') { ?>
						<a href="/<?php print $namespace;?>"><?php print $namespace;?>
					</a> <?php }
						else { ?>
						<a href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>">מאגר הידע</a> <?php } ?>
                        <span> &gt; </span>
                        <a href="#">
                            <?php print $displaytitle; ?>                                    
                        </a>
                    </div>
                    <?php if ($wgUser->isLoggedIn() || $wgForegroundFeatures['showActionsForAnon']): ?>
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
                            <?php foreach( $this->data['content_actions'] as $key => $item ) { 
        echo preg_replace(array('/\sprimary="1"/','/\scontext="[a-z]+"/','/\srel="archives"/'),'',
                          $this->makeListItem($key, $item)); } ?>
                            <?php wfRunHooks( SkinTemplateToolboxEnd, array( &$this, true ) );  ?>
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
                            <?php $this->html('bodytext') ?>
                            <div class="clear_both"></div>
                        </div>
                        <div class="group">
                            <?php $this->html('catlinks'); ?>
                        </div>
                        <?php $this->html('dataAfterContent'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="sh-footer">
        <?php if ($wgForegroundFeatures['addThisFollowPUBID'] != '') { ?>
        <div class="social-footer large-12 small-12 columns">
            <div class="social-links">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_horizontal_follow_toolbox"></div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $wgForegroundFeatures['addThisFollowPUBID'];?>"></script>
            </div>
        </div>
        <?php } ?>
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
				 <?php if (!$wgUser->isLoggedIn()): ?>
                <li class=""><a href="/מיוחד:כניסה_לחשבון" class="">
                        <i class="fa fa-sign-in" aria-hidden="true">
                            <span class="show-for-medium-up">&nbsp;התחבר</span>
                        </i>
                    </a>
				</li>                    <?php endif; ?>
            </nav>
            <a class="logo" href="http://www.sheatufim.org.il/">
                <img title="שיתופים - אסטרטגיות להשפעה חברתית" src="/w/upload/sheatufim/logo-footer.png">
            </a>
            <div class="contact-info"><span>כתובת: ת.ד. 3225 בית יהושע 40591</span><span>טלפון: 09-8301400</span><span>פקס: 09-8990889</span></div>
            <div class="bottom">
                <div class="credits">
                    <a href="http://www.kwiki.co.il/">נבנה על ידי Kwiki - פשוט לנהל את הידע</a>
                </div>
                <span class="stf-credit">כל הזכויות שמורות לשיתופים - אסטרטגיות להשפעה חברתית</span>
            </div>
        </div>
    </footer>
    <?php $this->printTrail(); ?>

    </body>

    </html>

    <?php
		wfRestoreWarnings();
	}
}
?>
