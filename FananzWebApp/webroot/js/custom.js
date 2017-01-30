(function($) {
    "use strict"; // Start of use strict

//    // jQuery for page scrolling feature - requires jQuery Easing plugin
//    $('a.page-scroll').bind('click', function(event) {
//        var $anchor = $(this);
//        $('html, body').stop().animate({
//            scrollTop: ($($anchor.attr('href')).offset().top - 50)
//        }, 1250, 'easeInOutExpo');
//        event.preventDefault();
//    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });
		
        $(document).ready(function(){
            $(".dropdown").hover(            
                function() {
                  //  $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                    $(this).toggleClass('open');        
                },
                function() {
                   // $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                    $(this).toggleClass('open');       
                }
            );
        });
     $(document).ready(function() {
              $("#show_pwd").click(function() {
                if ($("#cor_password").attr("type") == "password") {
                    $("#cor_password").attr("type", "text");
                    $("#show_icon").addClass('fa-eye-slash');
                     $("#show_icon").removeClass('fa-eye');

                } else {
                  $("#cor_password").attr("type", "password");
                     $("#show_icon").removeClass('fa-eye-slash');
                     $("#show_icon").addClass('fa-eye');
                }
              });
              $("#show_pwd_fl").click(function() {
                if ($("#fl_password").attr("type") == "password") {
                    $("#fl_password").attr("type", "text");
                    $("#show_icon_fl").addClass('fa-eye-slash');
                     $("#show_icon_fl").removeClass('fa-eye');

                } else {
                  $("#fl_password").attr("type", "password");
                     $("#show_icon_fl").removeClass('fa-eye-slash');
                     $("#show_icon_fl").addClass('fa-eye');
                }
              });
               
            $("#show_pwd1").click(function() {
                    if ($("#password").attr("type") == "password") {
                        $("#password").attr("type", "text");
                        $("#show_icon1").addClass('fa-eye-slash');
                         $("#show_icon1").removeClass('fa-eye');

                    } else {
                      $("#password").attr("type", "password");
                         $("#show_icon1").removeClass('fa-eye-slash');
                         $("#show_icon1").addClass('fa-eye');
                    }
                });
                $("#show_pwd2").click(function() {
                    if ($("#conf_password").attr("type") == "password") {
                        $("#conf_password").attr("type", "text");
                        $("#show_icon2").addClass('fa-eye-slash');
                         $("#show_icon2").removeClass('fa-eye');

                    } else {
                      $("#conf_password").attr("type", "password");
                         $("#show_icon2").removeClass('fa-eye-slash');
                         $("#show_icon2").addClass('fa-eye');
                    }
                });
        });
    
    })(jQuery);