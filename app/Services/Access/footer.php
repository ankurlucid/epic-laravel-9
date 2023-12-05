<?php

/**

 * The template for displaying the footer

 *

 * Contains the closing of the #content div and all content after

 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */

?>







    

<div class="footer">
<div class="container">
<div class="footer-grid">


<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							)
						);
						
					?>
                    <span class="copyright">© <?php echo date('Y'); ?> via.<span/>

</div>

<div id="divMsg" class="alert alert-dismissible text-center cookiealert "> 
    <div class="cookie_wrapper">
      <div class="cookiealert-container ">
          <div class="description-cookioe ">
            <p>This website uses cookies to ensure you get the best exprience on our website.
              By continuing to browse the site you are agreeing to our use of cookies.</p>
          </div>
          <a href="javascript:void(0);" class="acceptcookies" title="Accept">Accept.</a>
          <a href="javascript:void(0);" class="close_cookies" onClick="showHideDiv('divMsg')">       
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
              <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
            </svg> -->
            <img src="<?php echo home_url() ?>/wp-content/themes/via/images/close_cookies.png" id="closecooki" alt=""> 
          </a>
        </div> 
    </div>
   </div>

<div class="clearfix"> </div> 
</div>
				

		

					  

					 

<div class="clearfix"> </div>



</div>

    

      

    



     

<?php wp_footer(); ?>





 <script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/overview.built.js'></script>	
 
<!-- <script src="<?php //echo get_stylesheet_directory_uri() ?>/js/bootstrap.min.js"></script> --->

<!--<link rel="stylesheet" type="text/css" href="<?php //echo get_stylesheet_directory_uri() ?>/css/bootstrap.css">-->

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.cookie.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js"></script>   -->

<!--   <script> 
jQuery(document).keydown(function(evt){
    "use strict";
    evt = evt || window.event;
    switch (evt.keyCode) {
    case 37:
        break;
    case 39:
        break;
    }
});
</script> -->



<script>
jQuery(function () {
    "use strict";

    if (!getCookie("acceptCookies")) {
       jQuery(".cookiealert").addClass("show");
    }

    jQuery(".acceptcookies").click(function () {
       setCookie("acceptCookies", true, { expires: 60 });
        jQuery(".cookiealert").removeClass("show");
    });
});

// Cookie functions stolen from w3schools
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

</script>


<!-- 
<script id="rendered-js">

var didScroll;
var lastScrollTop = 0;
var delta = 150;
var navbarHeight = jQuery('.menu-footer-menu-container').outerHeight();
var navbarHeight = jQuery('.next-block').outerHeight();
var navbarHeight = jQuery('.prev-next-block').outerHeight();
var navbarHeight = jQuery('.prev-block').outerHeight();
var navbarHeight = jQuery('.custom-share-block').outerHeight();

jQuery(window).scroll(function (event) {
  didScroll = true;
});

setInterval(function () {
  if (didScroll) {
    hasScrolled();
    didScroll = false;
  }
}, 150);

function hasScrolled() {
  var st = jQuery(this).scrollTop();

  // Make sure they scroll more than delta
  if (Math.abs(lastScrollTop - st) <= delta)
  return;

  // If they scrolled down and are past the navbar, add class .nav-up.
  // This is necessary so you never see what is "behind" the navbar.
  if (st > lastScrollTop && st > navbarHeight) {
    // Scroll Down
    if (st + jQuery(window).height() < jQuery(document).height()) {
      jQuery('.menu-footer-menu-container').removeClass('nav-up').addClass('menu-footer-menu-container');
      jQuery('.next-block').removeClass('nav-up').addClass('next-block');
      jQuery('.prev-next-block').removeClass('nav-up').addClass('prev-next-block');
      jQuery('.prev-block').removeClass('nav-up').addClass('prev-block');
      jQuery('.custom-share-block').removeClass('nav-up').addClass('custom-share-block');
    }
  } else {
    // Scroll Up
    jQuery('.menu-footer-menu-container').addClass('nav-up');
    jQuery('.next-block').addClass('nav-up');
    jQuery('.prev-next-block').addClass('nav-up');
    jQuery('.prev-block').addClass('nav-up');
    jQuery('.custom-share-block').addClass('nav-up');
  }

  lastScrollTop = st;
}

    </script>
 -->
	
 
 <script>
    jQuery('.studio-sub-menues').click(function(e) {
       jQuery('.mobile-menu').toggleClass("menu_open_active");
    jQuery(".navbar-menu").toggleClass("navbar-menu_open");
    jQuery("body").toggleClass("main_menu_open_active");
    jQuery(".navbar-menu").slideToggle();
});
   

    
</script> 

<script>
  jQuery(document).ready(function(){
    jQuery('iframe').vimeo('play');  
  });
</script>

<script>
  function showHideDiv(ele) {
                var srcElement = document.getElementById(ele);
                if (srcElement != null) {
                    if (srcElement.style.display == "none") {
                        srcElement.style.display = 'none';
                    }
                    else {
                        srcElement.style.display = 'none';
                    }
                    return false;
                }
            }
</script>

</body>

</html>

