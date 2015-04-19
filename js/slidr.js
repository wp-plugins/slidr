jQuery(document).ready(function($) {

  'use strict';

  $('.slidr-container').each(function() {

    var totalWidth   = 0,
        $slidr  	   = $(this),
        slidrHeight  = $slidr.outerHeight(true),
        $carousel    = $slidr.find('.slidr-items-container'),
        $container   = $carousel.find('.slidr-items'),
        $item        = $container.find('.slidr-item'),
        $nav         = $(this).find('.slidr-nav'),
        $navPrev     = $(this).find('.slidr-nav-prev'),
        $navNext     = $(this).find('.slidr-nav-next');

    function containerWidth() { // Set container width
      $(window).load(function() { // We run it on window.load() because we need all our images loaded before starting calculate the items' widths.
        $item.each(function() {
          totalWidth += $(this).outerWidth(true);
        });
        $container.width(totalWidth);

        if( $container.height() > $carousel.height() ) { // On some occassions the carousel's width is one pixel short.
          $container.width(totalWidth + 1); // When that happens, add the missing pixel.
        }

        if( $slidr.find('div').first().hasClass('slidr-loader') ) { // If loader is enabled,
          $('.slidr-loader').delay(500).fadeOut(); // hide it when all images are loaded.
        }

      }); // $(window).load();
    }

    function autoScroll() { // Autoscroll
      if( $slidr.hasClass('slidr-autoscroll') ) {
        var autoSlide = (function() { $navNext.trigger('click'); }),
            delay     = $slidr.data('speed') !== undefined ? $slidr.data('speed') : 4000,
            timer     = setInterval(autoSlide, delay);
        $slidr.on('mouseover', function(){
          clearInterval(timer);
        }).on('mouseout', function(){
          timer = setInterval(autoSlide, delay);
        });
      }      
    } // autoScroll()

    function slideCarousel() { // Cycle through the items
      var carouselWidth   = $carousel.outerWidth(),
          containerWidth  = $container.outerWidth(),
          grabNum         = ( ($carousel.scrollLeft() + carouselWidth) >= (containerWidth - 1) ) ? 0 : -1,
          $item           = $container.find('.slidr-item'),
          grabNext        = $item.eq(grabNum), // For multiple: item.filter(':eq(0), :eq(1)')
          $setFirst       = $item.first(),
          $setLast        = $item.last(),
          nextWidth       = grabNext.outerWidth(),
          thumbWidth      = $item.hasClass('no-thumb') ? nextWidth + 'px' : 'auto';

      if( $slidr.hasClass('slidr-cycle') ) { // Check if cycle items is enabled

        if( ($carousel.scrollLeft() + carouselWidth) >= (containerWidth - 1) ) { // If we are at the end (-1 goes for Chrome which tends to miss a pixel)

          grabNext.animate({
            'width': '0'
          }, 300, function() {
            $(this).css({'top': '50px', 'position': 'absolute', 'opacity': '0'}).insertAfter($setLast).animate({'top': '0', 'opacity': '1'}, 300).css({'position':'relative', 'width': thumbWidth});
          });
        }
        if( $carousel.scrollLeft() === 0 ) { // If we are at the beginning 
          grabNext.css({'top': '50px', 'position': 'absolute', 'opacity': '0', 'width': '0'}).insertBefore($setFirst).animate({'top': '0', 'opacity': '1', 'width': nextWidth + 'px'}, 300).css({'position':'relative'});
        }
      } else { // If cycle items isn't enabled...
        if ( ($carousel.scrollLeft() + carouselWidth) >= (containerWidth - 1) ) { // ...and if we are at the end
          $navNext.hide(); // hide the "next" button
        } else if ( $carousel.scrollLeft() < 10 ) { // If we are approaching at the beginning...
          $navPrev.hide(); // ...hide the "previous" button
        } else { // else show the nav buttons.
          $nav.fadeIn();
        }
      }

    } // slideCarousel() 

    function interactions() { // Set the interactions on click of a nav button and on scroll (or swipe)
      $navNext.on('click', function() { // Click right button
        $carousel.animate({ 'scrollLeft': '+='+slidrHeight });
        if( $carousel.scrollLeft() !== 0 ) {
          slideCarousel();
        }
      });
      $navPrev.on('click', function() { // Click left button
        $carousel.animate({ 'scrollLeft': '-='+slidrHeight });
        if( $carousel.scrollLeft() === 0 ) {
          slideCarousel();
        }
      });

      if( ! $slidr.hasClass('slidr-cycle') ) { // If cycle items isn't enabled...
        $carousel.on('scroll', function() { // Scroll (swipe on touch devices)
          slideCarousel();   
        });
        if ( $carousel.outerWidth() > $container.outerWidth() ) { // ...and if the carousel width is bigger than the items' container,
          $nav.hide(); // hide nav buttons
        }
        if ( $carousel.scrollLeft() === 0  ) { // Also, if we are at the beginnining, 
          $navPrev.hide(); // hide the "previous" button anyway.
        }
      }

    } // interactions();

   function swipeToCycle() { // When at the carousel's start or end, cycle through items on swipe
      var swipeStart  = window.navigator.pointerEnabled ? 'pointerdown' : 'touchstart',
          swipeEnd    = window.navigator.pointerEnabled ? 'pointerup'   : 'touchend',
          touchStart;
      $carousel.on( swipeStart, function (e) { 
        touchStart    = e.pageX || e.originalEvent.touches[0].pageX;
      }).on( swipeEnd, function (e) { 
        var touchEnd  = e.pageX || e.originalEvent.changedTouches[0].pageX,
            carW      = $carousel.outerWidth(),
            conW      = $container.outerWidth(),
            noNext    = window.navigator.pointerEnabled ? true : $carousel.scrollLeft() + carW >= (conW - 1),
            noPrev    = window.navigator.pointerEnabled ? true : $carousel.scrollLeft() === 0;
        if( touchStart > touchEnd && noNext ) {
          $navNext.trigger( 'click' );
        } else if( touchStart < touchEnd && noPrev ) {
          $navPrev.trigger( 'click' );
        }
      });
    } // swipeToCycle();

    containerWidth();
    autoScroll();
    interactions();
    swipeToCycle();

  }); // $('.slidr-container').each();

});