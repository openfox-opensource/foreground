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
        $(".header .open-menu").click(function() {
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