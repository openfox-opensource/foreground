<?php

/**
 * Skin file for Foreground
 *
 * @file
 * @ingroup Skins
 */
 

class Skinforeground extends SkinTemplate {
	public $skinname = 'foreground', $stylename = 'foreground', $template = 'foregroundTemplate', $useHeadElement = true;

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
		$out->addModuleStyles('skins.foreground');
	}

	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;
		parent::initPage($out);

		$viewport_meta = 'width=device-width, user-scalable=yes, initial-scale=1.0';
	  $out->addMeta('viewport', $viewport_meta);
		$out->addModuleScripts('skins.foreground');
	}

}

class foregroundTemplate extends BaseTemplate {
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
		// Set default variables for footer and switch them if 'showFooterIcons' => true
		$footerLeftClass = 'small-8 large-centered columns text-center';
		$footerRightClass = 'large-12 small-12 columns';
		$poweredbyType = "nocopyright";
		$poweredbyMakeType = 'withoutImage';
		switch ($wgForegroundFeatures['showFooterIcons']) {
			case true:
				$footerLeftClass = 'large-8 small-12 columns';
				$footerRightClass = 'large-4 small-12 columns';
				$poweredbyType = "icononly";
				$poweredbyMakeType = 'withImage';
				break;
			default:
				break;	
		}
?>
<!-- START FOREGROUNDTEMPLATE -->
		<nav class="top-bar">
			<ul class="title-area">
				<li class="name">
					<h1 class="title-name">
					<a href="<?php echo $this->data['nav_urls']['mainpage']['href']; ?>">
					<?php if ($wgForegroundFeatures['navbarIcon'] != '0') { ?>
						<img alt="<?php echo $this->text('sitename'); ?>" src="<?php echo $this->text('logopath') ?>" style="max-width: 64px;height:auto; max-height:36px; display: inline-block; vertical-align:middle;">
					<?php } ?>					
					<div class="title-name" style="display: inline-block;"><?php echo $wgForegroundFeatures['wikiName']; ?></div>
					</a>
					</h1>
				</li>
				<li class="toggle-topbar menu-icon">
					<a href="#"><span><?php echo wfMessage( 'foreground-menutitle' )->text(); ?></span></a>
				</li>
			</ul>

		<section class="top-bar-section">

			<ul id="top-bar-left" class="left">
				<li class="divider"></li>
					<?php foreach ( $this->getSidebar() as $boxName => $box ) { if ( ($box['header'] != wfMessage( 'toolbox' )->text())  ) { ?>
				<li class="has-dropdown active"  id='<?php echo Sanitizer::escapeId( $box['id'] ) ?>'<?php echo Linker::tooltip( $box['id'] ) ?>>
					<a href="#"><?php echo htmlspecialchars( $box['header'] ); ?></a>
						<?php if ( is_array( $box['content'] ) ) { ?>
							<ul class="dropdown">
								<?php foreach ( $box['content'] as $key => $item ) { echo $this->makeListItem( $key, $item ); } ?>
							</ul>
								<?php } } ?>
						<?php } ?>
			</ul>

			<ul id="top-bar-right" class="right">
				<li class="has-form">
					<form action="<?php $this->text( 'wgScript' ); ?>" id="searchform" class="mw-search">
						<div class="row">
						<div class="small-12 columns">
							<?php echo $this->makeSearchInput(array('placeholder' => wfMessage('searchsuggest-search')->text(), 'id' => 'searchInput') ); ?>
							<button type="submit" class="button search"><?php echo wfMessage( 'search' )->text() ?></button>
						</div>
						</div>
					</form>
				</li>
				<li class="divider show-for-small"></li>
				<li class="has-form">

				<li class="has-dropdown active"><a href="#"><i class="fa fa-cogs"></i></a>
					<ul id="toolbox-dropdown" class="dropdown">
						<?php foreach ( $this->getToolbox() as $key => $item ) { echo $this->makeListItem($key, $item); } ?>
						<?php if ($wgForegroundFeatures['showRecentChangesUnderTools']): ?><li id="n-recentchanges"><?php echo Linker::specialLink('Recentchanges') ?></li><?php endif; ?>
						<?php if ($wgForegroundFeatures['showHelpUnderTools']): ?><li id="n-help" <?php echo Linker::tooltip('help') ?>><a href="/wiki/Help:Contents"><?php echo wfMessage( 'help' )->text() ?></a></li><?php endif; ?>
					</ul>
				</li>

				<?php if ($wgUser->isLoggedIn()): ?>
				<li id="personal-tools-dropdown" class="has-dropdown active"><a href="#"><i class="fa fa-user"></i></a>
					<ul class="dropdown">
						<?php foreach ( $this->getPersonalTools() as $key => $item ) { echo $this->makeListItem($key, $item); } ?>
					</ul>
				</li>

						<?php else: ?>
							<li class="login">
								<?php if (isset($this->data['personal_urls']['anonlogin'])): ?>
								<a href="<?php echo $this->data['personal_urls']['anonlogin']['href']; ?>"><?php echo wfMessage( 'login' )->text() ?></a>
								<?php elseif (isset($this->data['personal_urls']['login'])): ?>
									<a href="<?php echo htmlspecialchars($this->data['personal_urls']['login']['href']); ?>"><?php echo wfMessage( 'login' )->text() ?></a>
									<?php else: ?>
										<?php echo Linker::link(Title::newFromText('Special:UserLogin'), wfMessage( 'login' )->text()); ?>
									<?php endif; ?>
							</li>

				<?php endif; ?>

			</ul>
		</section>
		</nav>
		<?php if ($wgForegroundFeatures['NavWrapperType'] != '0') echo "</div>"; ?>
		
		<div id="page-content">
		<div class="row">
				<div class="large-12 columns">
				<!--[if lt IE 9]>
				<div id="siteNotice" class="sitenotice panel radius"><?php echo $this->text('sitename') . ' '. wfMessage( 'foreground-browsermsg' )->text(); ?></div>
				<![endif]-->

				<?php if ( $this->data['sitenotice'] ) { ?><div id="siteNotice" class="sitenotice"><?php $this->html( 'sitenotice' ); ?></div><?php } ?>
				<?php if ( $this->data['newtalk'] ) { ?><div id="usermessage" class="newtalk panel radius"><?php $this->html( 'newtalk' ); ?></div><?php } ?>
				</div>
		</div>

		<div id="mw-js-message" style="display:none;"></div>

		<div class="row">
				<div id="p-cactions" class="large-12 columns">
					<?php if ($wgUser->isLoggedIn() || $wgForegroundFeatures['showActionsForAnon']): ?>
						<a href="#" class="button dropdown small secondary radius"><i class="fa fa-cog"><span class="show-for-medium-up">&nbsp;<?php echo wfMessage( 'actions' )->text() ?></span></i></a>
						<!--RTL -->
						<ul id="drop1" class="views large-12 columns left f-dropdown">
							<?php foreach( $this->data['content_actions'] as $key => $item ) { echo preg_replace(array('/\sprimary="1"/','/\scontext="[a-z]+"/','/\srel="archives"/'),'',$this->makeListItem($key, $item)); } ?>
							<?php wfRunHooks( SkinTemplateToolboxEnd, array( &$this, true ) );  ?>
						</ul>
						<!--RTL -->
						<?php if ($wgUser->isLoggedIn()): ?>
							<div id="echo-notifications"></div>
						<?php endif; ?>
					<?php endif;
					$namespace = str_replace('_', ' ', $this->getSkin()->getTitle()->getNsText());
					$displaytitle = $this->data['title'];
					if (!empty($namespace)) {
						$pagetitle = $this->getSkin()->getTitle();
						$newtitle = str_replace($namespace.':', '', $pagetitle);
						$displaytitle = str_replace($pagetitle, $newtitle, $displaytitle);
					?><h4 class="namespace label"><?php print $namespace; ?></h4><?php } ?>
					<div id="content">
					<h2  id="firstHeading" class="title"><?php print $displaytitle; ?></h2>
					<?php if ( $this->data['isarticle'] ) { ?><h3 id="tagline"><?php $this->msg( 'tagline' ) ?></h3><?php } ?>
					<h5 id="siteSub" class="subtitle"><?php $this->html('subtitle') ?></h5>
					<div id="contentSub" class="clear_both"></div>
					<div id="bodyContent" class="mw-bodytext">
						<?php $this->html('bodytext') ?>
						<div class="clear_both"></div>
					</div>
		    	<div class="group"><?php $this->html('catlinks'); ?></div>
		    	<?php $this->html('dataAfterContent'); ?>
				</div>
		    </div>
		</div>
<footer class="row">
<div id="footer">
					<div id="footer-widget-wrap" class="clearfix ">
    
            <div id="footer-left" class="clearfix">
            	<div class="footer-widget widget_text clearfix"><h4>פרטי התקשרות</h4>			<div class="textwidget"><p>בית העמותות - רח' סעדיה גאון 26, ת.ד: 20001, תל אביב, מיקוד: 6713521<br>
<br>
טל'   : 072-2785421 <br>פקס: 08-9155961</p><p> 
כתובתינו במייל: office@migzar3.org.il  .</p></div>
		</div><div class="footer-widget widget_text clearfix">			<div class="textwidget"><script src="http://www.guidestar.org.il/sites/all/modules/guidestar/gswidget/gsWidget.js" type="text/javascript"></script><img id="GuidestarAmutaInfo" src="http://www.guidestar.org.il/sites/all/modules/guidestar/gswidget/images/widget-100x100.png" style="cursor: pointer;"><script type="text/javascript">getGuideStarWidget(580108520, "widget-100x100");</script></div>
		</div>            </div><!-- /footer-left -->
            
            <div id="footer-middle" class="clearfix">
            	<div class="footer-widget widget_text clearfix"><h4>הרשמה לניוזלטר</h4>			<div class="textwidget">
                <div class="gf_browser_chrome gform_wrapper" id="gform_wrapper_2"><form method="post" enctype="multipart/form-data" id="gform_2" action="/">
                        <div class="gform_body"><ul id="gform_fields_2" class="gform_fields top_label form_sublabel_below description_below"><li id="field_2_1" class="gfield gfield_contains_required field_sublabel_below field_description_below"><label class="gfield_label" for="input_2_1">שם מלא<span class="gfield_required">*</span></label><div class="ginput_container"><input name="input_1" id="input_2_1" type="text" value="" class="large" tabindex="1"></div></li><li id="field_2_10" class="gfield field_sublabel_below field_description_below"><label class="gfield_label" for="input_2_10">שם העמותה (אופציונלי)</label><div class="ginput_container">
                                    <input name="input_10" id="input_2_10" type="text" value="" class="medium" tabindex="2">
                                </div></li><li id="field_2_2" class="gfield gfield_contains_required field_sublabel_below field_description_below"><label class="gfield_label" for="input_2_2">כתובת דואר אלקטרוני<span class="gfield_required">*</span></label><div class="ginput_container">
                            <input name="input_2" id="input_2_2" type="text" value="" class="large" tabindex="3">
                        </div></li><li id="field_2_9" class="gfield field_sublabel_below field_description_below"><label class="gfield_label"></label><div class="ginput_container"><ul class="gfield_checkbox" id="input_2_9"><li class="gchoice_2_9_1">
								<input name="input_9.1" type="checkbox" value="מעוניין להיות ברשימת התפוצה של מנהיגות אזרחית, ולקבל מידע על אודות פעילותה של מנהיגות אזרחית" id="choice_2_9_1" tabindex="4">
								<label for="choice_2_9_1" id="label_2_9_1">מעוניין להיות ברשימת התפוצה של מנהיגות אזרחית, ולקבל מידע על אודות פעילותה של מנהיגות אזרחית</label>
							</li></ul></div></li>
                            </ul></div>
        <div class="gform_footer top_label"> <input type="submit" id="gform_submit_button_2" class="gform_button button" value="הרשם" tabindex="5" onclick="if(window[&quot;gf_submitting_2&quot;]){return false;}  window[&quot;gf_submitting_2&quot;]=true;  "> 
            <input type="hidden" class="gform_hidden" name="is_submit_2" value="1">
            <input type="hidden" class="gform_hidden" name="gform_submit" value="2">
            
            <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
            <input type="hidden" class="gform_hidden" name="state_2" value="WyJbXSIsIjkzNzQwYjU3OGUxNmM1NzBiMWRmZDIxN2UwZTNhODAxIl0=">
            <input type="hidden" class="gform_hidden" name="gform_target_page_number_2" id="gform_target_page_number_2" value="0">
            <input type="hidden" class="gform_hidden" name="gform_source_page_number_2" id="gform_source_page_number_2" value="1">
            <input type="hidden" name="gform_field_values" value="">
            
        </div>
                        </form>
                        </div><script type="text/javascript"> jQuery(document).bind('gform_post_render', function(event, formId, currentPage){if(formId == 2) {} } );jQuery(document).bind('gform_post_conditional_logic', function(event, formId, fields, isInit){} );</script><script type="text/javascript"> jQuery(document).ready(function(){jQuery(document).trigger('gform_post_render', [2, 1]) } ); </script></div>
		</div>            </div><!-- /footer-middle -->
            
            <div id="footer-right" class="clearfix">
            	<div class="footer-widget widget_text clearfix"><h4>הפייסבוק שלנו</h4>			<div class="textwidget"><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fmanhigut.ez&amp;width=280&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=true&amp;appId=1427873904143989" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:280px; height:258px;" allowtransparency="true"></iframe></div>
		</div>            </div><!-- /footer-right -->
        
        </div>							
				</div>
</footer>
		</div>
		
		<?php $this->printTrail(); ?>

		</body>
		</html>

<?php
		wfRestoreWarnings();
	}
}
?>
