
/*  =Behavior
    A toolbox of useful tools
----------------------------------------------- */
var Behavior = {

  /*  =Opens external hostnames in a new tab/window
  ----------------------------------------------- */
  init_external_links: function() {
    //  Open external links in new window
    $("a").filter(function() {
      return this.hostname && this.hostname !== location.hostname;
    }).each(function() {
      $(this).attr({
        target  : '_blank',
        title   : "Visit " + this.href + " (click to open in a new window)"
      }).addClass('external');
    });
  },

  /*  =Adds class 'selected' to current page nav link
  ----------------------------------------------- */
  init_nav_selection: function() {
    // Get rid of "http://Ó
    loc = location.href.substring(7);

    // Get rid of domain name
    loc = loc.substring(loc.indexOf("/"));
    loc = loc.substring(loc.indexOf("/whats-new"));
    loc = loc.substring(loc.indexOf("/designers"));

    // apply class to current nav link
    //$("nav a[href='" + loc + "']").addClass('selected');

    //var dir = location.pathname.split('/')[1];
    $('#main-nav').find('a[href*="' + loc + '"]').addClass('selected');
  },

  /*  =SubMenu - changeing between vertical and horizontal
  ----------------------------------------------- */
  init_submenu: function() {
    var $window = $(window),
      $container = $('.menu-container');
      $inner = $('.menu-inner');

    function resize() {
      if ($window.width() <= 963) {
        //console.log($window.width());
        return $container.addClass('menu'), $inner.addClass('sub-menu multi-column');
      } else {
        $container.removeClass('menu');
        $inner.removeClass('sub-menu multi-column');
        //console.log($window.width());
      }
    }
    $window
      .resize(resize)
      .trigger('resize');
    },

    /*  =Join Email List Form
    ----------------------------------------------- */
    init_join_email_list: function() {

      $('#email-list-form').attr({
        target  : '_blank'
      }).addClass('external');

      $('#submit-form').click(function() {

        var reg              = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/
        ,   email_address    = $('#email-list-form [name="person[email_address]"]').val()
        ,   data_html        = ''
        ,   alertErrorSpan   = '<span class="alert-message alert-error"></span>'
        ,   alertSuccessSpan = '<span class="alert-message alert-success"></span>';

        if(email_address === "") {
           $('#email-list-form p').append(alertErrorSpan);
           $('.alert-error').html('Your email is required.');
           removeMessage();
           return false;
        } else if(reg.test(email_address) === false) {
          $('#email-list-form p').append(alertErrorSpan);
           $('.alert-error').html('Invalid Email Address.');
           removeMessage();
           return false;
        } else {
           $('.alert-error').html('');

        }
      });
      function removeMessage() {
        setTimeout(function(){
          if ($('.alert-message').length > 0) {
            $('.alert-message').remove();
          }
        }, 3000)
      }
    }

    /*  =Matches the sidebar height to the shopping-cart
    ----------------------------------------------- */
    /*init_getHeight: function() {
      var columnHeight = $('.shopping-cart').height();
      console.log(columnHeight);
      $('.sidebar').css('height', columnHeight);
    }
    */
};