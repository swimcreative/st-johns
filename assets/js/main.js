/**
 * Custom js for theme
 */
jQuery(function($) {

  'use strict';

  var stjohns = window.stjohns || {};

  /* =============================================================================
     stjohns SKIP LINK FOCUS FIX (from _s)
     ========================================================================== */

  stjohns.skipLinkFix = function() {
      var is_webkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
          is_opera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
          is_ie = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

      if ((is_webkit || is_opera || is_ie) && document.getElementById && window.addEventListener) {
          window.addEventListener('hashchange', function() {
              var id = location.hash.substring(1),
                  element;

              if (!(/^[A-z0-9_-]+$/.test(id))) {
                  return;
              }

              element = document.getElementById(id);

              if (element) {
                  if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                      element.tabIndex = -1;
                  }

                  element.focus();
              }
          }, false);
      }
  };

  /* =============================================================================
   stjohns NAVIGATION
   ========================================================================== */

  stjohns.navigation = function() {
      var hamburger = $('.menu-toggle');
      var drawer = $('.site-navigation');

      hamburger.click(function() {
          $('body').toggleClass('lock');
          hamburger.toggleClass('close');
          drawer.toggleClass('expanded').slideToggle(150);
          if (drawer.hasClass('expanded')) {
              hamburger.attr('aria-expanded', 'true');
          } else {
              hamburger.attr('aria-expanded', 'false');
          }
      });

      //default body padding for a fixed header
      function bodyPadding() {
          $('.fixed-header').css('padding-top',$('.site-header').height());
      }

      // jQuery to collapse the navbar on scroll
      function minimize() {
          if ($(".site-header").offset().top > 50) {
              $(".site-header").addClass("minimize");
              $('body').trigger('minimized');
          } else {
              $(".site-header").removeClass("minimize");
          }
      }

      $(window).on('minimized', function() {
        //  console.log('worked');
      });

      $(window).scroll(minimize);
      $(window).resize(bodyPadding);
      bodyPadding();
      minimize();


    /*  $('.search-toggle button').click(function() {
        if($('.search-toggle').hasClass('open')) {
            return true;
        } else {

          $('.search-toggle').addClass('open');
          $('.menu-item').addClass('hideAway');

        return false;
      }

    }); */

      $(window).click(function() {
        $('.search-toggle').removeClass('open');
        $('.menu-item').removeClass('hideAway');
      });

      $('.search-toggle').click(function(event){
          event.stopPropagation();
      });

  }

  /* =============================================================================
    stjohns WEBFONT
    ========================================================================== */

  stjohns.webfont = function() {
      try {
          Typekit.load({
              async: true
          });
      } catch (e) {}
  }

  /* =============================================================================
      stjohns WIDGETS
      ========================================================================== */

  stjohns.widgets = function() {

      //rss widget tweaks
      if ($('.widget_rss').length >= 1) {
          //truncate summary
          $('.rssSummary').each(function() {
              var summary = $(this).text(); //replace with your string.
              var maxLength = 70; // maximum number of characters to extract
              //trim the string to the maximum length
              var excerpt = summary.substr(0, maxLength);
              //re-trim if we are in the middle of a word
              excerpt = excerpt.substr(0, Math.min(excerpt.length, excerpt.lastIndexOf(' ')));
              //remove &nbsp;&nbsp; indenting
              excerpt = excerpt.replace(/\s\s+/g, ' ') + '&hellip;';
              $(this).html(excerpt);
          });
      }

      //add badges to category & archive counts
      if ($('.widget_archive, .widget_categories').length >= 1) {
          $('.widget_archive li, .widget_categories li').each(function() {
              var item = $(this).html();
              item = item.replace('(', '<small class="count">');
              item = item.replace(')', '</small>');
              $(this).html(item);
              //add posts
              if ($('.count', this).text() === '1') {
                  $('.count', this).append(' Post');
              } else {
                  //  console.log($('.count', this).text())
                  $('.count', this).append(' Posts');
              }
          });
      }

      //add badges to category & archive counts
      if ($('.widget_tag_cloud').length >= 1) {
          $('.widget_tag_cloud a').each(function() {
              var count = $(this).attr('title');
              count = count.replace(' topics', '');
              count = count.replace(' topic', '');
              $(this).append(' &nbsp;<span class="badge">' + count + '</span>');
          });
      }
  };

  /* =============================================================================
    stjohns FAUXWIDTH
    ========================================================================== */

  stjohns.fauxWidth = function() {

      //var element = $('.fauxwidth, .page .entry-header, .single .entry-header, .size-fullscreen, .comments-area').not('.page-builder .entry-header');
      var element = $('.fauxwidth, .page .entry-header, .single .entry-header, .size-fullscreen, .comments-area').not('.page-builder .entry-header, .layout-sidebar .comments-area');
      var offset;

      function fullwidth(el) {
        el.each(function(){
          offset = el.parent().offset();
          $(this).css({
              'width': '100vw',
              'margin-left': '-' + offset.left + 'px',
          });
        });
      } //fullwidth()

      //sidebar positioning
      function sidebarPos() {
        var box = $('.layout-sidebar .entry-header');
        if (box.length >= 1) {
          $('#secondary').css({
              'margin-top': box.height(),
          });
        }
      } //sidebarPos()

      //init
      if (element.length >= 1) {
        fullwidth(element);
        sidebarPos();

        $(window).resize(function() {
            fullwidth(element);
            sidebarPos();
        });
      }

  }

  /* =============================================================================
  stjohns SMOOTH SCROLL
  ========================================================================== */

 stjohns.smoothScroll = function() {

   var header,
       headerHeight,
       currLink,
       refElement,
       headerLink,
       page,
       hash,
       anchor;

   page = $('html, body');
   header = $('.site-header');
   headerLink = header.find('.menu-item > a');
   anchor = $('a[href*="#"]').not('.top-link a');

   // animation
   function animateScroll(refElement) {
     headerHeight = header.height() - 1;
     if($(window).width() > 720) {
       if($(window).scrollTop() < 50) {
         $('.site-header').clone().appendTo( "body" ).css('z-index','-1000').css('transition','none').addClass('minimize cloned');
         var newHeight = $('.cloned').outerHeight();
         //console.log(newHeight);
         $('.cloned').remove();
       } else {
         newHeight = headerHeight;
       }
      } else {
        newHeight = 0;
     }
     page.animate({
     scrollTop: $(refElement).offset().top - newHeight
    }, 850,  'easeInOutQuint');
   }


   // if arrived from other page
  hash = window.location.hash;
  //if(hash && $('body').hasClass('home')) {
  if(page.find(hash).length >= 1) {
    animateScroll(hash);
   }
  //}

 }


  /* =============================================================================
   stjohns MENU HIGHLIGHT
   ========================================================================== */

  stjohns.menuHighlight = function(){

    var page = $('html, body');
    var header = $('.site-header');
    var classname = 'link-active'; // name of the active class
    var height = header.height();
    var link = header.find('.menu-item > a[href*="#"]');
    var scrollPos,
        currLink,
        refElement;

    function menuScroll(event){
      var scrollPos = $(document).scrollTop() + height;
      link.each(function () {

        // ignore redirecting links
        if(link.hasClass('redirect')) {
          // do nothing
        } else {

        currLink = $(this);
        refElement = $(currLink.attr("href"));
        // height of distance from top and of element combined
        if(page.find(refElement).length >= 1) {
        var fullHeight = refElement.position().top + refElement.outerHeight();
          if(refElement.position().top < scrollPos && scrollPos < fullHeight) {
            link.removeClass(classname);
            currLink.addClass(classname);
          } else {
            currLink.removeClass(classname);
            }
          }
        } // endif redirect
      });
     }

     $(document).on("scroll", menuScroll); // initiate scroll event

    }

    /* =============================================================================
     stjohns PARALLAX
     ========================================================================== */

stjohns.parallax = function() {

if ($(".stjohns-parallax").length) {
    parallax();
}

$(window).scroll(function(e) {
  if ($(".stjohns-parallax").length) {
    parallax();
  }
});

function parallax(){
  if( $(".stjohns-parallax").length > 0 ) {
    var plxBackground = $(".parallax-background");
    var plxWindow = $(".stjohns-parallax");

    var plxWindowTopToPageTop = $(plxWindow).offset().top;
    var windowTopToPageTop = $(window).scrollTop();
    var plxWindowTopToWindowTop = plxWindowTopToPageTop - windowTopToPageTop;

    var plxBackgroundTopToPageTop = $(plxBackground).offset().top;
    var windowInnerHeight = window.innerHeight;
    var plxBackgroundTopToWindowTop = plxBackgroundTopToPageTop - windowTopToPageTop;
    var plxBackgroundTopToWindowBottom = windowInnerHeight - plxBackgroundTopToWindowTop;
    var plxSpeed = 0.35;

    plxBackground.css('top', - (plxWindowTopToWindowTop * plxSpeed) + 'px');
  }
}


}

/* =============================================================================
stjohns VIDEO BACKGROUND
========================================================================== */

stjohns.videoBackground = function() {



  var container = $('.video-background'),
      videoSrc,
      aspectRatio,
      video;

  function resizeVideo() {
          container.each(function(){
          if ( ( $(this).width() / $(this).height() ) < aspectRatio ) {
              $(this).find('video').removeClass().addClass('max-height');
          } else {
              $(this).find('video').removeClass().addClass('max-width');
          }
          }); //container.each()
        //console.log( 'image dimensions: ' + heroImg.attr('width') + ' ' + heroImg.attr('height') + ' hero is ' + heroBox.width() / heroBox.height() + ' img is ' + aspectRatio)
  }

  if( container.length >= 1 ) {
    container.each(function(){
      videoSrc = $(this).data('vid');
      aspectRatio;
      video = $('<video />', {
           id: 'video',
           src: videoSrc,
           type: 'video/mp4',
           controls: false,
           autoplay: true,
           loop: true,
           muted: true
       });

      video.appendTo($(this));
      aspectRatio = video.width() / video.height();
      resizeVideo();
    }); //container.each()
}//if container

$(window).resize( resizeVideo );

}

/* =============================================================================
 stjohns SLIDER
 ========================================================================== */

 stjohns.slider = function() {

   $('.hero_block').each(function() {
     if($(this).find('.hero-slider').length !== 0) {
       $(this).addClass('has-slider');
     }
   });


   //init slider
   var slider = $('.hero-slider').flickity({
        cellAlign: 'left',
        contain: true,
        groupCells: true,
   });

   //carousel nav
   $('.hero-slider').each(function(){
       $(this).find('.flickity-prev-next-button, .flickity-page-dots').wrapAll('<div class="flickity-nav-wrapper">');
   });


  }

/* =============================================================================
 stjohns CAROUSEL
 ========================================================================== */

 stjohns.carousel = function() {

   //set media size
   var aspectRatio,
       mediaImg,
       mediaBox,
       mediaSize = function() {
         $('.media-block-item').each(function(){
           $(this).height($(this).width());
           mediaImg = $('img',this);
           mediaBox = $('a',this);
           aspectRatio = mediaImg.attr('width') / mediaImg.attr('height');

           if ( ( mediaBox.width() / mediaBox.height() ) < aspectRatio ) {
                mediaImg.removeClass().addClass('max-height');
            } else {
                mediaImg.removeClass().addClass('max-width');
            }

         });
       }//mediaSize

   mediaSize();
   $(window).resize( mediaSize );

   //init carousel
  //if($('.hero .calendar tbody').children().length > 3) {
   var carousel = $('.hero .calendar tbody').flickity({
        cellAlign: 'left',
        contain: true,
        autoPlay: 5000,
        groupCells: '100%',
   });
  //}

   //carousel nav
   $('.hero .calendar tbody').each(function(){
       $(this).find('.flickity-prev-next-button').wrapAll('<div class="flickity-nav-wrapper">');
   });

  //lightbox
  var lightbox = function( el ) {
           var imgSrc = $( el ).data('img');
           $('.block-lightbox').removeClass('close').append('<img src="'+imgSrc+'">');

           if( $( el ).data('height') > $( el ).data('width') ) {
             $('.block-lightbox img').addClass('max-height');
           }
  }

  $(document).on('click','#close',function(){
        event.preventDefault();
        $('.block-lightbox').addClass('close').find('img').remove();
  });

   //open lightbox
   carousel.on( 'staticClick.flickity', function( event, pointer, cellElement, cellIndex ) {
     // dismiss if cell was not clicked
     if ( !cellElement ) {
       return;
     }
     //console.log( 'Cell ' + ( cellIndex + 1 )  + ' clicked' );
     lightbox( $(cellElement).find('a') );
   });

   $('.media-block-grid .media-block-item a').click(function(){
        lightbox( $(this) );
   });

  }

  /* =============================================================================
   stjohns TOGGLES
   ========================================================================== */

  stjohns.toggles = function() {
    //add class to first tab/panel
    $('.toggle-block-tabs, .toggle-block-accordion').each(function(index) {
       $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
     });

     //toggle tab
     $('.toggle-block-tabs').on('click', 'li > a.tab-link', function(event) {
       if (!$(this).hasClass('is-active')) {
         event.preventDefault();
         var accordionTabs = $(this).closest('.toggle-block');
         accordionTabs.find('.is-open').removeClass('is-open').toggle();

         $(this).next().toggleClass('is-open').toggle();
         accordionTabs.find('.is-active').removeClass('is-active');
         $(this).addClass('is-active');
       } else {
         event.preventDefault();
       }
     });


     //toggle accordion
     $('.toggle-block-accordion').on('click', 'li > a.tab-link', function(event) {
       if (!$(this).hasClass('is-active')) {
         event.preventDefault();
         var accordionTabs = $(this).closest('.toggle-block');
         accordionTabs.find('.is-open').removeClass('is-open').toggle();

         $(this).next().toggleClass('is-open').toggle();
         accordionTabs.find('.is-active').removeClass('is-active');
         $(this).addClass('is-active');
       } else {
         event.preventDefault();
       }
     });

     //toggle expander
     $('.toggle-block-expander').on('click', 'li > a.tab-link', function(event) {
         event.preventDefault();
         $(this).next().toggleClass('is-open').toggle();
         $(this).toggleClass('is-active');
     });

  }

  /* =============================================================================
HERO PARALAX EFFECTS
========================================================================== */


stjohns.parallax = function() {
 //only run on larger screens
 if($(window).width() > 480) {
   // selectors
  var elems = $('#banner');
  // vertical parallax
  var scrolled = $(window).scrollTop() * 2;
  var width = $(window).width();
  var calc = 50 / width / 2;
  var calc = 50 - calc * scrolled;
  //console.log(calc);
  elems.css('background-position', '50% '+calc+'%');
  }
}


// fitvids


stjohns.fidVids = function() {
  $("iframe").parent().fitVids();
}


/* =============================================================================
  ACADEMICS NAV
========================================================================== */

stjohns.academicsNav = function() {
  $('#primary-nav .main-menu > li:nth-child(2) .sub-menu-content li.menu-item-has-children:not(:last-child)').wrapAll('<div class="grades-teachers"></div>');

  var grades = $('.grades-teachers'),
      nav_items = $('.academics-menu-header');

      nav_items.find('a:first-child').click(function(e) {
        nav_items.find('a').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        grades.find('> li').hide();
        grades.find('> li:first-child').fadeIn();
      });

      nav_items.find('a:last-child').click(function(e) {
        nav_items.find('a').removeClass('active');
        e.preventDefault();
        $(this).addClass('active');
        grades.find('> li').hide();
        grades.find('> li:last-child').fadeIn();
      });


}



/* =============================================================================
HERO PARALAX EFFECTS
========================================================================== */

var height = $('#masthead').outerHeight() + $('#upper-nav').outerHeight();;

stjohns.headerFix = function() {
//only run on larger screens
var header = $('#masthead'),
    body = $('body'),
    top = height;

    if($(window).scrollTop() > top) {
      if($('body').hasClass('fixed-header')) {
        // nada
      } else {
        $('body').addClass('fixed-header');
      }
    } else {
      $('body').removeClass('fixed-header');
    }
}


  /* =============================================================================
      INIT
      ========================================================================== */

  $(document).ready(function() {
      stjohns.skipLinkFix();
      stjohns.navigation();
      //stjohns.menuHighlight();
      //stjohns.smoothScroll();
      //stjohns.webfont();
      stjohns.widgets();
      //stjohns.fauxWidth();
      //stjohns.parallax();
      stjohns.videoBackground();
      stjohns.slider();
      stjohns.carousel();
      stjohns.toggles();
      stjohns.academicsNav();
      stjohns.fidVids();
      //stjohns.parallax();
      //stjohns.headerFix();
  });

  $(window).on('scroll',function() {
     //stjohns.parallax()
     //stjohns.headerFix();
  });

  $(window).resize(function() {
     //stjohns.parallax();
     stjohns.fidVids();
  });
});
