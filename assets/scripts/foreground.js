jQuery.migrateTrace = true;
jQuery(document).ready(function() {
  jQuery("ol.special").owlCarousel({
      items : 5, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : [200,1] // itemsMobile disabled - inherit from itemsTablet option
  });
    
  // Add the 'less than IE9' class to appropriate version of IE by checking for their support of cssFloat (true in v9)
  if (!jQuery.support.cssFloat) { jQuery('html').addClass('lt-ie9').addClass('no-js'); }
  
  //  jQuery('#load-jobiz').load('/outsource/jobiz.html .searchResults.timeLine'); //jobiz manhigut

  // Log errors
  jQuery(document).foundation(function (response) {
    if (window.console) console.log(response.errors);
  });
  
  // The Echo extension puts an item in personal tools that Foreground really should have in the top menu
  // to make this easier, we move it here and loaded earlier to speed up transform
  jQuery("#pt-notifications").prependTo("#echo-notifications-alerts");
  jQuery("#pt-notifications-message").prependTo("#echo-notifications-messages");
  jQuery("#pt-notifications-alert").prependTo("#echo-notifications-alerts");
  jQuery("#pt-notifications-notice").prependTo("#echo-notifications-notice");
  
  // Append font-awesome icons
  jQuery('[id^=ca-nstab] a').prepend('<div class="drop-icon"><i class="fa fa-file fa-fw"></i></div>')
  jQuery('li#ca-talk a').prepend('<div class="drop-icon"><i class="fa fa-comments-o fa-fw"></i></div>')
  jQuery('li#ca-edit a').prepend('<div class="drop-icon"><i class="fa fa-pencil-square-o fa-fw"></i></div>')
  jQuery('li#ca-form_edit a').prepend('<div class="drop-icon"><i class="fa fa-pencil-square fa-fw"></i></div>')
  jQuery('li#ca-formedit a').prepend('<div class="drop-icon"><i class="fa fa-pencil-square fa-fw"></i></div>')
  jQuery('li#ca-history a').prepend('<div class="drop-icon"><i class="fa fa-history fa-fw"></i></div>')
  jQuery('li#ca-delete a').prepend('<div class="drop-icon"><i class="fa fa-trash-o fa-fw"></i></div>')
  jQuery('li#ca-move a').prepend('<div class="drop-icon"><i class="fa fa-truck fa-fw"></i></div>')
  jQuery('li#ca-protect a').prepend('<div class="drop-icon"><i class="fa fa-shield fa-fw"></i></div>')
  jQuery('li#ca-unprotect a').prepend('<div class="drop-icon"><i class="fa fa-shield fa-fw"></i></div>')
  jQuery('li#ca-watch a').prepend('<div class="drop-icon"><i class="fa fa-star-o fa-fw"></i></div>')
  jQuery('li#ca-unwatch a').prepend('<div class="drop-icon"><i class="fa fa-star fa-fw"></i></div>')
  jQuery('li#ca-purge a').prepend('<div class="drop-icon"><i class="fa fa-refresh fa-fw"></i></div>')
  jQuery('li#ca-undelete a').prepend('<div class="drop-icon"><i class="fa fa-undo fa-fw"></i></div>')
  jQuery('li#ca-ask_delete_permanently a').prepend('<div class="drop-icon"><i class="fa fa-cut fa-fw"></i></div>')
  jQuery('li#t-cite a').prepend('<div class="drop-icon"><i class="fa fa-graduation-cap fa-fw"></i></div>')

  if ( jQuery( '#ca-addsection' ).length ) {
    jQuery('li#ca-addsection a').html('<div class="drop-icon"><i class="fa fa-plus fa-fw"></i></div>' + jQuery('li#ca-addsection a').attr('title').replace(/\[.+/g,""))
  }

  jQuery('li#pt-uls a').prepend('<div class="drop-icon"><i class="fa fa-language fa-fw"></i></div>')
  jQuery('li#pt-userpage a').prepend('<div class="drop-icon"><i class="fa fa-user fa-fw"></i></div>')
  jQuery('li#pt-mytalk a').prepend('<div class="drop-icon"><i class="fa fa-comments fa-fw"></i></div>')
  jQuery('li#pt-adminlinks a').prepend('<div class="drop-icon"><i class="fa fa-bolt fa-fw"></i></div>')
  jQuery('li#pt-preferences a').prepend('<div class="drop-icon"><i class="fa fa-ellipsis-h fa-fw"></i></div>')
  jQuery('li#pt-watchlist a').prepend('<div class="drop-icon"><i class="fa fa-th-list fa-fw"></i></div>')
  jQuery('li#pt-mycontris a').prepend('<div class="drop-icon"><i class="fa fa-smile-o fa-fw"></i></div>')
  jQuery('li#pt-logout a').prepend('<div class="drop-icon"><i class="fa fa-sign-out fa-fw"></i></div>')
  jQuery('li#pt-login a').prepend('<div class="drop-icon"><i class="fa fa-sign-in fa-fw"></i></div>')
  jQuery('li#pt-createaccount a').prepend('<div class="drop-icon"><i class="fa fa-lock fa-fw"></i></div>')
  jQuery('li#pt-anonuserpage a').prepend('<div class="drop-icon"><i class="fa fa-user-secret fa-fw"></i></div>')
  jQuery('li#pt-anontalk a').prepend('<div class="drop-icon"><i class="fa fa-commenting-o fa-fw"></i></div>')
  
  jQuery('li#t-smwbrowselink a').prepend('<div class="drop-icon"><i class="fa fa-eye fa-fw"></i></div>')
  jQuery('li#t-whatlinkshere a').prepend('<div class="drop-icon"><i class="fa fa-arrows fa-fw"></i></div>')
  jQuery('li#t-blockip a').prepend('<div class="drop-icon"><i class="fa fa-ban fa-fw"></i></div>')
  jQuery('li#t-recentchangeslinked a').prepend('<div class="drop-icon"><i class="fa fa-bars fa-fw"></i></div>')
  jQuery('li#t-contributions a').prepend('<div class="drop-icon"><i class="fa fa-smile-o fa-fw"></i></div>')
  jQuery('li#t-log a').prepend('<div class="drop-icon"><i class="fa fa-bars fa-fw"></i></div>')
  jQuery('li#t-emailuser a').prepend('<div class="drop-icon"><i class="fa fa-envelope fa-fw"></i></div>')
  jQuery('li#t-userrights a').prepend('<div class="drop-icon"><i class="fa fa-gavel fa-fw"></i></div>')
  jQuery('li#t-upload a').prepend('<div class="drop-icon"><i class="fa fa-upload fa-fw"></i></div>')
  jQuery('li#t-specialpages a').prepend('<div class="drop-icon"><i class="fa fa-magic fa-fw"></i></div>')
  jQuery('li#t-print a').prepend('<div class="drop-icon"><i class="fa fa-print fa-fw"></i></div>')
  jQuery('li#t-permalink a').prepend('<div class="drop-icon"><i class="fa fa-dot-circle-o fa-fw"></i></div>')
  jQuery('li#t-info a').prepend('<div class="drop-icon"><i class="fa fa-info fa-fw"></i></div>')
  jQuery('li#feedlinks a').prepend('<div class="drop-icon"><i class="fa fa-rss fa-fw"></i></div>')
  
  jQuery('ul#toolbox-dropdown.dropdown>li#n-recentchanges a').prepend('<div class="drop-icon"><i class="fa fa-tasks fa-fw"></i></div>')
  jQuery('ul#toolbox-dropdown.dropdown>li#n-help a').prepend('<div class="drop-icon"><i class="fa fa-question fa-fw"></i></div>')


  // Turn categories into labels
  jQuery('#mw-normal-catlinks ul li a').addClass('label');


  // Make the Page Action button respond to hover
  //jQuery('button.button').mouseenter(function(){
  //  jQuery('ul#drop1').addClass('open').addClass('right').css('top', '32px').css('left', '785px');
  //});
  //jQuery('ul#drop1').mouseleave(function(){
  //  jQuery('ul#drop1').removeClass('open').css('top', '-9999px').css('left', '785px');
  //});
  
// הרחב בדף ערך
  jQuery('.expand').each(function () {
    jQuery('p:gt(0)', this).hide();
    var paras = this;
    jQuery('a.read-more').click(function () {
        jQuery('p:gt(0)', paras).slideToggle();
		jQuery(this).text(function(i, text){
         // return text === "סגור" ? "הצג עוד" : "סגור";
           return text === "הצג פחות" ? "הצג עוד" : "הצג פחות";
			})
    });
  });

  // קיצור כותרת במרחב שם מטא
  if ($('#firstHeading:contains("המתווכת:")').length) {
    $('#firstHeading').html($('#firstHeading').html().replace('המתווכת:', ''));
  }



  // Have to wait until the window is fully loaded because of Visual Editor to prepend icons for editing
  jQuery(window).load(function() {
    jQuery('li#ca-ve-edit a').prepend('<div class="drop-icon"><i class="fa fa-pencil fa-fw"></i></div>')
    jQuery('li#ca-viewsource a').prepend('<div class="drop-icon"><i class="fa fa-book fa-fw"></i></div>')
  });

});