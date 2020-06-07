/**
 * ext.SheatufimSearchBox
 *
 * @author Hagai Asaban
 * @license MIT
 */

( function ( mw, $ ) {
    
    $( function () {  
        // to fix margin of the main-img.
        $("#main-img-block").prependTo("#main-img-area");
        
        /*
        if ($('.portal').length > 0) { 
            $( phead );

            function phead() {

                // Move the paragraph from #myDiv1 to #myDiv2
                $('#bodyContent').prepend( $('#mw-content-text>p:first-child') );
            }
        }
        */
        var $affectedResizeElements = $("*").not(".access-no-resize");
        var $affectedContrastElements = $("*").not(".access-no-contrast");		
        var $affectedImagesElements = $("img");        

        function resetContrastElements(){            
            $(".aaa span.InvertColors").removeClass('curr');
            $(".aaa span.BlackWhite").removeClass('curr');
            
            //iterate through every element
            $affectedImagesElements.each(function() {
                var $this = $(this);					
                $this.removeClass('contrast-grayscale');
                $this.removeClass('contrast-invert');
            });

            $affectedContrastElements.each( function() {
                var $this = $(this);

                if($this.css('background-image'))
                {						
                    $this.removeClass('contrast-grayscale');
                    $this.removeClass('contrast-invert');
                }					
            });
        }

        function invertColors() {
            //iterate through every element in reverse order...
            $affectedContrastElements.each(function() {
                var $this = $(this);
                $this.addClass("contrast-invert");
            });

            //iterate through every element
            $affectedImagesElements.each(function() {
                var $this = $(this);
                $this.addClass("contrast-invert");
            });
        }	

        function changeColorBlackAndWhite() {
            //iterate through every element in order...
            $affectedContrastElements.each(function() {
                var $this = $(this);
                $this.addClass("contrast-grayscale");									
            });

            //iterate through every element
            $affectedImagesElements.each(function() {
                var $this = $(this);
                $this.addClass("contrast-grayscale");
            });
        }

        /*
        $(window).scroll(function() {
            if ( $(window).scrollTop() >= 75 ) {
                $('body').addClass('stickyMenu');
            } else {
                $('body').removeClass('stickyMenu');
            }
        });
        */
	$(window).resize(function() {
		setWindow();
		setImages();
	});
	function setWindow() {
		// WSmall			|	320			-	545
		// WSWide			|	546			-	799
		// WMedium			|	976			-	1023
		// WLarge			|	1024	  	-  	1150
		// WDefault			|	1151  		-  	1320
		var changed=false;
		if ( $("body.WSmall").length == 0 && $(window).width() <= 545 ) {
			$("body").addClass('WSmall');
			$("body").removeClass('WSWide').removeClass('WMedium').removeClass('WLarge').removeClass('WDefault');
			changed=true;
//			move("WSmall");
//			setImages();
		} else if ( $("body.WSWide").length == 0 && $(window).width() > 545 && $(window).width() <= 975 ) {
			$("body").addClass('WSWide');
			$("body").removeClass('WSmall').removeClass('WMedium').removeClass('WLarge').removeClass('WDefault');
			changed=true;
//			setImages();
		} else if ( $("body.WMedium").length == 0 && $(window).width() > 976 && $(window).width() <= 1023 ) {
			$("body").addClass('WMedium');
			$("body").removeClass('WSmall').removeClass('WSWide').removeClass('WLarge').removeClass('WDefault');
			changed=true;
//			move("WMedium");
//			setImages();
		} else if ( $("body.WLarge").length == 0 && $(window).width() > 1023 && $(window).width() <= 1150 ) {
			$("body").addClass('WLarge');
			$("body").removeClass('WSmall').removeClass('WSWide').removeClass('WMedium').removeClass('WDefault');
			changed=true;
//			move("WMedium");
//			setImages();
		} else if ( $("body.WDefault").length == 0 && $(window).width() > 1150 ) {
			$("body").addClass('WDefault');
			$("body").removeClass('WLarge').removeClass('WMedium').removeClass('WSWide').removeClass('WSmall');
			changed=true;
//			move("WDefault");
//			setImages();
		}
		if ( changed ) {
//			pgUpdate(false);
		}
	}
	$(document).ready(function() {
		setImages();
	});
	$(".main-img .imgrap img").load(function() {
		setImages();
	});
	function setImages() {
		
		if ( $(".main-img").length > 0 ) {
			if ( $("body.WSmall").length == 0 && $("body.WSWide").length == 0 ) {
				if ( $(".main-img .imgrap.mslide").length == 0 ) {
					var hh = (window.innerHeight-650);
				} else {
					var hh = (window.innerHeight-350);
				}
				var hhi = parseInt($(".main-img .mtrap").height())+80;
				if ( hh < hhi ) {
					hh = hhi;
				}
				//$(".fontLarge").html(parseInt($(".main-img .mtext").height()));
				//$(".main-img").css('height',hh+'px');
				if ( $(".sidebar .psidebar").length > 0 ) {
					$(".contentrap").css('min-height',$(".sidebar .psidebar").height()+'px');
				}
			} else {
				$(".main-img").css('height','auto');
				$(".contentrap").css('min-height','0px');
			}
			$(".main-img .imgrap img").each(function() {
/* 				if ( $(".main-img .imgrap").width() < $(this).width() ) {
					$(this).css('margin-left',($(".main-img .imgrap").width()-$(this).width())/2+'px');
				} else {
					$(this).css('margin-left','0px');
				}
				if ( $(".main-img .imgrap").height() < $(this).height() ) {
					$(this).css('margin-top',($(".main-img .imgrap").height()-$(this).height())/2+'px');
				} else {
					$(this).css('margin-top','0px');
				} */
				$(this).fadeIn();
			});
/*  			if ( $(".main-img .imgrap.mslide").length > 0 ) {
				if ( $("body.WSmall").length != 0 || $("body.WSWide").length != 0 ) {
					$(".main-img .imgrap.mslide").css('margin-top',$(".main-img .mtext").height()+'px');
					$(".main-img").css('padding-bottom',$(".main-img .imgrap.mslide.curr").height()+'px');
				} else {
					$(".main-img .imgrap.mslide").css('margin-top','0px');
					$(".main-img").css('padding-bottom','0px');
					
				} 
			} */
		}
		// programs width
		if ( $(".programs.box").length > 0 && $(".lang.en").length == 0 && $("body.home").length == 0 ) {
			if ( $("body.WSWide").length == 0 && $("body.WSmall").length == 0  && $("body.WMedium").length == 0 ) {				
				$(".programs.box .item").css('width',(($(".programs.box").width()-20)/3)+'px');
			} else if ( $("body.WSWide").length > 0 ) {				
				$(".programs.box .item").css('width',(($(".programs.box").width()-10)/3)+'px');
			} else {
				$(".programs.box .item").css('width','');
			}
		}
		// programs mobile
		if ( $(".contentrap.boxlist").length > 0 ) {
			if ( $("body.WSmall").length > 0 || $("body.WSWide").length > 0 ) {
				$(".content.entry .section").each(function() {
					//alert($(this).find(".stitle").height());
					var h = parseInt($(this).find(".stitle").height())
						+ parseInt($(this).find(".stitle").css('margin-top').replace('px',''))
						+ parseInt($(this).find(".stitle").css('padding-top').replace('px',''))
						+ parseInt($(this).find(".stitle").css('padding-bottom').replace('px',''));
					$(this).parent().css('min-height',h+'px');
				});
			}
		}
		
	}
        $(".header .open-menu").on('click',function() {
            if ( $(".header").attr('class').indexOf('mopened') >= 0 ) {
                $(".header").removeClass('mopened');
            } else {
                $(".header .mmmrap").css('max-height',(window.innerHeight-(70))+'px');
                $(".header").removeClass('sopened');
                $(".header").addClass('mopened');
            }		
        });
        $(".header .search-rap .icon").click(function() {
            $(this).parent().submit();
        });
        $(".header .open-search").click(function() {
            if ( $(".header").attr('class').indexOf('sopened') >= 0 ) {
                $(".header").removeClass('sopened');
            } else {
                $(".header").removeClass('mopened');
                $(".header input.search").focus();
                $(".header").addClass('sopened');
            }		
        });
        $(".box .stitle").click(function() {
            if ( $(this).parent().parent().attr('class').indexOf('opened') >= 0 ) {
                $(this).parent().parent().removeClass('opened');
            } else {
                $(this).parent().parent().addClass('opened');
            }
        });
        $(".box.content-text .read-more").click(function() {
            if ( $(this).parent().attr('class').indexOf('opened') >= 0 ) {
                $(this).parent().removeClass('opened');
            } else {
                $(this).parent().addClass('opened');
            }
        });

        $(".mmenu .mtlp-close").click(function() {
            $(this).parent().parent().removeClass("wopened");		
        });
        $(".smenu span.smtlp").click(function() {
            if ( $(this).parent().attr('class').indexOf('topened') >= 0 ) {
                $(this).parent().removeClass('topened');
            } else {
                $(this).parent().addClass('topened');
            }

        });
        $(".mmenu .mlink").click(function() {
            if ( $("body.WSmall,body.WSWide,body.WMedium,body.stickyMenu").length > 0 ) { return; }
            if ( $(this).parent().find(".mtlp-rap").length > 0 ) {
                if ( $(this).parent().attr('class').indexOf("wopened") >= 0 ) {
                    $(this).parent().removeClass("wopened");
                } else {
                    $(".mmenu li").removeClass("wopened");
                    $(this).parent().addClass("wopened");
                }
                return false;
            }
        });
        $(".mmenu .mtlp-back").click(function() {
            $(this).parent().parent().removeClass('wopened');
        });
        $(".box .arrow-down").click(function() {
            //$("body,html").animate({scrollTop:(window.innerHeight)});
            $("body,html").animate({scrollTop:($(".content.entry").offset().top)-30});
        });

        $(".aaa span.BlackWhite").click(function() {
            resetContrastElements();

            if ( $("body").attr('class').indexOf('BlackWhite') >= 0 ) {
                $("body").removeClass('BlackWhite');   
            } else {
                changeColorBlackAndWhite();
                $(this).addClass('curr');
                $("body").addClass('BlackWhite');
            }
        });
        
        $(".aaa span.InvertColors").click(function() {
            resetContrastElements();
            
            if ( $("body").attr('class').indexOf('InvertColors') >= 0 ) {                
                $("body").removeClass('InvertColors');    
            } else {
                invertColors();
                $(this).addClass('curr');
                $("body").addClass('InvertColors');
            }
        });        
        
        $(".aaa .fonts span").click(function() {
            $(".aaa .fonts span").removeClass('curr');
            $(".aaa .fonts span").each(function() {
                $("body").removeClass($(this).attr('class'));
            });
            $("body").addClass($(this).attr('class'));
            $(this).addClass('curr');
            $(window).resize();
        });
        $(".float").click(function() {
            $(".float").fadeOut();
            $(".float iframe").remove();
        });    
    });
}( mediaWiki, jQuery ) );