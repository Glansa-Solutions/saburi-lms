(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');

    // Add active class to nav-link based on URL dynamically
    // Active class can also be hardcoded directly in the HTML file as needed

    function addActiveClass(element) {
      if (element.length) { // Check if the element exists
        if (current === "") {
          // for the root URL
          if (element.attr('href') && element.attr('href').indexOf("index.html") !== -1) {
            element.parents('.nav-item').last().addClass('active');
            if (element.parents('.sub-menu').length) {
              element.closest('.collapse').addClass('show');
              element.addClass('active');
            }
          }
        } else {
          // for other URLs
          if (element.attr('href') && element.attr('href').indexOf(current) !== -1) {
            element.parents('.nav-item').last().addClass('active');
            if (element.parents('.sub-menu').length) {
              element.closest('.collapse').addClass('show');
              element.addClass('active');
            }
            if (element.parents('.submenu-item').length) {
              element.addClass('active');
            }
          }
        }
      }
    }

    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    $('.nav li a', sidebar).each(function() {
      var $this = $(this);
      addActiveClass($this);
    });

    $('.horizontal-menu .nav li a').each(function() {
      var $this = $(this);
      addActiveClass($this);
    });

    // Close other submenu in the sidebar when opening any
    sidebar.on('show.bs.collapse', '.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });

    // Change sidebar and content-wrapper height
    applyStyles();

    function applyStyles() {
      // Applying Perfect Scrollbar
      if (!body.hasClass("rtl")) {
        if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
          const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
        }
        if ($('.chats').length) {
          const chatsScroll = new PerfectScrollbar('.chats');
        }
        if (body.hasClass("sidebar-fixed")) {
          if ($('#sidebar .nav').length) {
            var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
          }
        }
      }
    }

    $('[data-bs-toggle="minimize"]').on("click", function() {
      if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
        body.toggleClass('sidebar-hidden');
      } else {
        body.toggleClass('sidebar-icon-only');
      }
    });

    // Checkbox and radios
    $(".form-check label, .form-radio label").append('<i class="input-helper"></i');

    // Horizontal menu in mobile
    $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
      $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
    });

    // Horizontal menu navigation in the mobile menu on click
    var navItemClicked = $('.horizontal-menu .page-navigation > .nav-item');
    navItemClicked.on("click", function(event) {
      if (window.matchMedia('(max-width: 991px)').matches) {
        if (!$(this).hasClass('show-submenu')) {
          navItemClicked.removeClass('show-submenu');
        }
        $(this).toggleClass('show-submenu');
      }
    });

    $(window).scroll(function() {
      if (window.matchMedia('(min-width: 992px)').matches) {
        var header = $('.horizontal-menu');
        if ($(window).scrollTop() >= 70) {
          $(header).addClass('fixed-on-scroll');
        } else {
          $(header).removeClass('fixed-on-scroll');
        }
      }
    });

    if ($.cookie('staradmin2-free-banner') !== "true") {
      document.querySelector('#proBanner').classList.add('d-flex');
      document.querySelector('.navbar').classList.remove('fixed-top');
    } else {
      document.querySelector('#proBanner').classList.add('d-none');
      document.querySelector('.navbar').classList.add('fixed-top');
    }

    if ($(".navbar").hasClass("fixed-top")) {
      document.querySelector('.page-body-wrapper').classList.remove('pt-0');
      document.querySelector('.navbar').classList.remove('pt-5');
    } else {
      document.querySelector('.page-body-wrapper').classList.add('pt-0');
      document.querySelector('.navbar').classList.add('pt-5');
      document.querySelector('.navbar').classList.add('mt-3');
    }

    document.querySelector('#bannerClose').addEventListener('click', function() {
      document.querySelector('#proBanner').classList.add('d-none');
      document.querySelector('#proBanner').classList.remove('d-flex');
      document.querySelector('.navbar').classList.remove('pt-5');
      document.querySelector('.navbar').classList.add('fixed-top');
      document.querySelector('.page-body-wrapper').classList.add('proBanner-padding-top');
      document.querySelector('.navbar').classList.remove('mt-3');
      var date = new Date();
      date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
      $.cookie('staradmin2-free-banner', "true", { expires: date });
    });

    // Focus input when clicking on the search icon
    $('#navbar-search-icon').click(function() {
      $("#navbar-search-input").focus();
    });
  });
})(jQuery);
