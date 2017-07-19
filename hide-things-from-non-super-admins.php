<?php 
 /**
* @package hide-things-from-non-super-admins
 */
/*
Plugin Name: Hide things from non super admins
Description: Hide things from non super admins
Author: Aaron Madhavan
Version: 1.0

*/
if ( ! function_exists( 'hsa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function hsa_setup() {
//hide theme and customize on admin bar and backend for anyone that is not an admin
// hide acf menu item
function hide_acf() {
  remove_menu_page('edit.php?post_type=acf-field-group');
}
function admin_bar_hide()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_node( 'themes' );
}

function customize_admin_menu_hide(){
	
global $submenu;
// Appearance customize Menu
unset($submenu['themes.php'][6]);	
	
}
//hide the customize on admin bar
function wpse200296_before_admin_bar_render()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('customize');
}
$the_current_site = get_bloginfo('name');


  // only show p h2 h3 h4 and preformatted in wysiwyg 
   function myformatTinyMCE($in){
$in['block_formats'] = "Paragraph=p;Header 2=h2;Header 3=h3;Header 4=h4;Preformatted=pre";
return $in;
}
	if ( !is_super_admin() ) {
	add_action( 'wp_before_admin_bar_render', 'admin_bar_hide' ); 
	add_action('admin_menu', 'customize_admin_menu_hide', 999);
	add_action( 'wp_before_admin_bar_render', 'wpse200296_before_admin_bar_render' ); 
	add_action('admin_menu', 'hide_acf');
	add_filter('tiny_mce_before_init', 'myformatTinyMCE'); 
	}
}
endif; // hsa_setup
add_action( 'after_setup_theme', 'hsa_setup' );

?>