<?php 

/**
 * @package back_to_top_and_bottom
 */
/*
Plugin Name: Go back to the top and bottom of page
Description: Go back to the top and bottom of page
Author: Aaron Madhavan
Version: 1.0

*/


/* displays when the last time someone logged into wordpress -- does not work with miniorange */   
/* Back To Top */
if ( is_admin() ) {
    
} else {
    add_action( 'wp_footer', 'back_to_top' );
    function back_to_top() {
    echo '<a class="totop fa-arrow-circle-up" id="totop" href="#topofpage" aria-hidden="true" ><span class="screen-reader-text">go to top </span></a>';
	echo '<a name="bottomofpage"></a>'; 
    }
add_action( 'wp_head', 'go_to_bottom' );
    function go_to_bottom() {
    echo '<a class="tobottom fa-arrow-circle-down" id="tobottom" href="#bottomofpage" aria-hidden="true" ><span class="screen-reader-text">go to bottom </span></a>';
	echo '<a name="topofpage"></a>'; 
    }
    add_action( 'wp_head', 'back_to_top_style' );
    function back_to_top_style() {
    echo '<style type="text/css">
   	 #totop {
    background-color: #ffffff;
    -webkit-border-radius: 10rem; 
    -moz-border-radius: 10rem; 
    border-radius: 10rem;
    
    color: #003b5d;
    display: none;
    height: 3rem;
    position: fixed;
    right: 5rem;
	bottom: 30px;
    width: 3rem;
    }
	 .totop::before {
     display: inline-block;
    font: 51px/1 FontAwesome;
    margin-left: 0.14rem;
    margin-top: -0.06rem;
    
    
   
    }
	#tobottom {
    background-color: #ffffff;
    -webkit-border-radius: 10rem; 
    -moz-border-radius: 10rem; 
    border-radius: 10rem;
    bottom: 30px;
    color: #003b5d;
    display: block;
    height: 3rem;
    position: fixed;
	    top: 11rem;

    right: 5rem;
    width: 3rem;
    position: fixed;
    z-index: 4;
    }
	
 .tobottom::before {
     display: inline-block;
    font: 51px/1 FontAwesome;
    margin-left: 0.14rem;
    margin-top: -0.06rem;
    
    
   
    }	
	
	
	@media screen and (max-width: 730px) {
  #totop, #tobottom {
    visibility: hidden;
    display: none;
  }
}
    </style>';
    }

    add_action( 'wp_footer', 'back_to_top_script' );
    function back_to_top_script() {
    echo '<script type="text/javascript">
    jQuery(document).ready(function($){
    $(window).scroll(function () {
    if ( $(this).scrollTop() > 700 )
    $("#totop").fadeIn();
    else
    $("#totop").fadeOut();
$("#tobottom").css("opacity", 1 - $(window).scrollTop() / 900);
    });

    $("#totop").click(function () {
    $("body,html").animate({ scrollTop: tempheight }, 800 );
    return false;
    });
	$("#totop").click(function () {
    $("body,html").animate({ scrollTop: tempheight }, 800 );
    return false;
    });
    });
    </script>';
    }
}
?>