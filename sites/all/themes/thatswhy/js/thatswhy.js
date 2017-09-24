(function ($) {
  winw = prevw = $(window).width();//windowwidth, previouswidth
  curs = prevs = $(window).scrollTop(); //currentscroll, previousscroll

  var init = true;
  var resize_array = [
    function() { nav_height();},
    function() { footer_height();}
  ];
  add_browser_class();
  nav_height();
  footer_height();
  mapbox_map();
  set_mobile();

  if(!$('body').hasClass('logged-in')) {
    set_ga();
  }

  if($('body').hasClass('page-node-4') && window.location.hash) {
    var loc = window.location.hash.replace('#', '');
    loc = $('h2[data-cl="' + loc + '"]').first().closest('.taxonomy-term').first();
    loc.addClass('active-tmp');

    loc.on('mouseout', function() {
      loc.removeClass('active-tmp');
    });

    $('html, body').animate({
      scrollTop: loc.offset().top - $('#header').outerHeight()
    }, 1000);
  }

  if($('body').hasClass('node-type-blog') && !$('html').hasClass('touch') && !$('body').hasClass('page-node-edit') && !$('body').hasClass('page-node-delete')) {
    var isRevealed,
        noScroll,
        isAnimating,
        container = $('.main-wr'),
        header = $('.header.downward').first();

    init_blog_scroll();
  }

  // Document.load
  $(window).load(function() {
    if($('.view.diensten.id-main').length > 0) {
      resize_array.push(function() {diensten_eq_h();});
    }

    $('.id-cwr').each(function() {
      if ($(this).children().length > 1) {
        $(this).on('init', function(event, slick) {
          $(this).find('.slick-active').addClass('fr-r');
        });

        $(this).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
          $(this).find('.slick-track .node-banner-item').removeClass('fr-l').removeClass('fr-r');
          var addClass = 'fr-l';
          if(nextSlide > currentSlide) {
            addClass = 'fr-r';
          }
          $(this).find('.slick-track .node-banner-item[data-slick-index=' + nextSlide + ']').addClass(addClass);
        });

        $(this).on('afterChange', function(event, slick, currentSlide){
          $(this).find('.slick-track .node-banner-item[data-slick-index!=' + currentSlide + ']').removeClass('fr-l').removeClass('fr-r');
        });

        var settings = {
          dots: true,
          speed: 2000,
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          arrows: true,
          slide: '.node.node-banner-item',
          draggable: false,
        };

        if(Modernizr.touch) {
          settings.arrows = false;
        }
        $(this).slick(settings);
      }
    });

    $(window).trigger('resize');
  });

  $(window).bind('resize', function() {
    for (var i = resize_array.length - 1; i >= 0; i--) {
      resize_array[i]();
    }
  });

  function nav_height() {
      var pt = $('.nav-wr').first().outerHeight(true);
      var ph = $('.nav-wr').first().outerWidth(true);


      var pti = $('.main-wr').first();
      var ptp = 30;

      if($('.header-wr').length > 0) {
        pti = $('.header-wr').first();
        ptp = 0;
      }

      if($('.maps-wr').length > 0) {
        pti = $('.maps-wr').first();
        ptp = 0;
      }

      if($('body').hasClass('node-type-blog')) {
        ptp = 0;
      }

      if(pt > ph) {
        // LANDSCAPE!
        pt = ptp = 0;
      }

      pti.css('padding-top', pt + ptp);
  }

  function footer_height() {
    var pb = $('.footer-wr').first().outerHeight(true);
    var pbi = $('.main-wr').first();
    var pbp = 30;

    if($('body').hasClass('front')) {
      pbp = 0;
    }

    pbi.css('padding-bottom', pb + pbp);
  }

  function diensten_eq_h() {
    if($('.view.diensten.id-main').length > 0) {
      var maxh = 0;
      var terms = $('.view.diensten.id-main .taxonomy-term');
      terms.each(function() {
        if($(this).outerHeight(true) > maxh) {
          maxh = $(this).outerHeight(true);
        }
      });

      terms.each(function() {
        $(this).height(maxh - ($(this).outerHeight(true) - $(this).height()));
      });
    }
  }

  function projecten_eq_w() {
    if($('.view.projecten.id-fp').length > 0) {
      var w = $(window).width() / 3;
      $('.view.projecten.id-fp .node-project').width(w);
    }
  }

  function set_mobile() {
    $('.mob-only.menu-clicker, .mob-only.menu-closer').bind('click', function(e) {
      var menu = $('.nav-wr .nav').first();
      menu.toggleClass('active');
      e.preventDefault();
    });
  }

  function mapbox_map() {
    if ($('#map').length > 0 && (!$('html').hasClass('ms-ie') && $('html').hasClass('no-touch'))) {
      L.mapbox.accessToken = 'pk.eyJ1IjoidGhhdHN3aHkiLCJhIjoic19oZ09ucyJ9.6HXovraWWfDt1GMc9QyU4Q';
      // Create a map in the div #mapbox-map
      var map = L.mapbox.map('map', 'thatswhy.l87ooi10');
      map.setZoom(12);
      map.scrollWheelZoom.disable();
      if(Modernizr.touch) {
        map.touchZoom.disable();
        map.dragging.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();

        if(map.tap) map.tap.disable();
      }
      map.panTo(new L.LatLng(50.811141, 3.190752));
    } else {
      $('#map').remove();
    }
  }

  function init_blog_scroll () {
    // Add resize function for the header height etc;
    resize_array.push(function() {set_blog_header();});

    $('.header.downward').find('a.down-icon').on('click', function(e) {
      if(!isRevealed) {
        toggleHeader(true);
      }

      e.preventDefault();
    });

    $(window).scroll(function(e) {
      prevs = curs;
      curs = $(window).scrollTop();

      if(noScroll) {
        // e.preventDefault();
        if(curs < 0) return false;
        curs = 1;
        $(window).scrollTop(curs);
      }

      if(container.hasClass('notrans')) {
        container.removeClass('notrans');
        return false;
      }

      if(isAnimating) {
        if(curs > 1 && isRevealed) {
          curs = 1;
          $(window).scrollTop(curs);
        }

        return false;
      }

      if(curs > prevs && !isRevealed) {
        // Scrolling down = reveal
        toggleHeader(true);
      } else if (prevs > curs && isRevealed && curs <= 0) {
        // Scrolling up = hide
        toggleHeader(false);
      }
    });
  }

  function set_blog_header() {
    var header = $('.header.downward').first();
    header.height($(window).height() - $('.nav-wr').height());

    center_image(header.find('img').first(), 0, '.header.downward');
  }

  function toggleHeader (show) {
    isAnimating = true;
    noScroll = true;
    disable_scroll();

    if(show) {
      $('body').addClass('d-s'); // Disable scroll
      container.addClass('modify');
      header.css('max-height', header.find('.title-wr').height());
      if(curs > 1) {
        $(window).scrollTop(1);
      }
    } else {
      $('body').addClass('d-s'); // Disable scroll
      container.removeClass('modify');
      header.css('max-height', '2000px');
    }

    setTimeout(function () {
      isRevealed = !isRevealed;
      isAnimating = false;
      noScroll = false;
      $('body').removeClass('d-s');
      if(show) {
        $(window).scrollTop(1);
        enable_scroll();
      }
    }, 1000);
  }

  function set_ga() {
    $('.view.banner .node .cta').each(function() {
      $(this).on('click', function(e) {
        var label = $(this).attr('title');
        ga("send", "event", "Banner", "CTA-click", label);
      });
    });

    $('.taxonomy-term.view-mode-teaser .cta > a').each(function() {
      $(this).on('click', function(e) {
        var label = $(this).parent().parent().children('h2').first().text();
        ga("send", "event", "Contact", "CTA-click", label);
      });
    });

    $('.page-blog a.node-webform').on('click', function(e) {
      ga("send", "event", "Contact", "Big-click", "blog");
    });

    $('.page-taxonomy-term a.node-webform').on('click', function(e) {
      var label = $('h1').first().text().replace(' gerelateerde artikels', '');
      ga("send", "event", "Contact", "Big-click", label);
    });
  }

  // disable/enable scroll (mousewheel and keys) from http://stackoverflow.com/a/4770179
  // left: 37, up: 38, right: 39, down: 40,
  // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
  var keys = [32, 37, 38, 39, 40], wheelIter = 0;

  function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
    e.preventDefault();
    e.returnValue = false;
  }

  function keydown(e) {
    for (var i = keys.length; i--;) {
      if (e.keyCode === keys[i]) {
        preventDefault(e);
        return;
      }
    }
  }

  function touchmove(e) {
    preventDefault(e);
  }

  function wheel(e) {
    // for IE
    //if( ie ) {
      //preventDefault(e);
    //}
  }

  function disable_scroll() {
    window.onmousewheel = document.onmousewheel = wheel;
    document.onkeydown = keydown;
    document.body.ontouchmove = touchmove;
  }

  function enable_scroll() {
    window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;
  }

  function add_browser_class() {
    var nAgt = navigator.userAgent;
    var browserName  = navigator.appName;
    var nameOffset,verOffset,ix;

    // In Opera, the true version is after "Opera" or after "Version"
    if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
       browserName = "opera";
    }
    // In MSIE, the true version is after "MSIE" in userAgent
    // COULD ALSO BE IEMobile
    else if ((verOffset=nAgt.indexOf("MSIE"))!=-1 || (verOffset=nAgt.indexOf("IEMobile"))!=-1) {
       browserName = "ms-ie";
    }
    // In Chrome, the true version is after "Chrome"
    else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
       browserName = "chrome";
    }
    // In Safari, the true version is after "Safari" or after "Version"
    else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
       browserName = "safari";
    }
    // In Firefox, the true version is after "Firefox"
    else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
        browserName = "firefox";
    }
    // In most other browsers, "name/version" is at the end of userAgent
    else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < (verOffset=nAgt.lastIndexOf('/')) ) {
        browserName = nAgt.substring(nameOffset,verOffset);
    }
    $('html').addClass(browserName.toLowerCase());
    $('html').addClass(navigator.platform.toLowerCase());

  }

  function center_image(img, count, element) {
    var parent = img.closest(element).first();
    var wratio = img.width() / img.height();


    if(img.width() < parent.width()) {
      // Afbeelding moet worden vergroot tot breedte
      img.width(parent.width());
      img.height(img.width() * (1/wratio));
    } else if (img.height() < parent.height()) {
      // Afbeelding moet worden vergroot tot hoogte

      img.height(parent.height());
      img.width(img.height() * wratio);
    }

    if((img.width() < parent.width() || img.height() < parent.height()) && count < 5) {
      center_image(img, count+1, element);
    } else {
      var m = 0;
      if(img.width() > parent.width()) {
        m = (parent.width() - img.width()) / 2 * -1;
        img.css('margin-left', '-' + m + 'px');
      }

      if(img.height() > parent.height()) {
        m = (parent.height() - img.height()) / 2 * -1;
        img.css('margin-top', '-' + m + 'px');
      }
    }
  }


})(jQuery);
