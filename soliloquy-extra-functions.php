<?php
/**
 * @package soliloquy-extra-functions
 */
/*
Plugin Name: Soliloquy extra functions
Description: Soliloquy extra functions
Author: Aaron Madhavan
Version: 1.2

*/
add_action( 'init', 'tgm_soliloquy_restrict_admin_access', -1 );
    function tgm_soliloquy_restrict_admin_access() {
     
        if ( ! is_admin() ) {
            return;
        }
     
        if ( class_exists( 'Soliloquy' ) ) {
            if ( ! current_user_can( 'manage_sites' ) ) {
                remove_action( 'init', array( Soliloquy::get_instance(), 'init' ), 0 );
                remove_action( 'widgets_init', array( Soliloquy::get_instance(), 'widget' ) );
            }
        }
     
    }
add_filter( 'soliloquy_defaults', 'tgm_soliloquy_set_defaults', 100, 2 );
function tgm_soliloquy_set_defaults( $defaults, $post_id ) {
     	
		 $defaults['slider_theme']  = 'classic';
        // You can easily set default values here. See the get_config_defaults method in the includes/global/common.php file for all available defaults to modify (around L250).
        // In this example, we will modify the default slider size to 1000 x 500.
        $defaults['slider_width']  = 1000;
        $defaults['slider_height'] = 500;
		$defaults['duration'] = 5000; 
		$defaults['speed'] = 400; 
		$defaults['position'] = 'center';
		$defaults['gutter'] = 20;
		$defaults['arrows'] = 1;
		$defaults['auto'] = 1;
		$defaults['hover'] = 1;
		$defaults['loop'] = 1;
		$defaults['delay'] = 400;
        // Return the modified defaults.
        return $defaults;
     
}
      add_action( 'soliloquy_api_after_transition', 'tgm_soliloquy_force_auto' );
    function tgm_soliloquy_force_auto( $data ) {
    	
    	ob_start();
    	?>
    	soliloquy_slider['<?php echo $data['id']; ?>'].startAuto();
    	<?php
    	echo ob_get_clean();
    	
    }

?>