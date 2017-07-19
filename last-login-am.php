<?php 
/**
 * @package Pevent_re-assiging_capabilities
 */
/*
Plugin Name: Last time someone logged in
Description: displays when the last time someone logged into wordpress -- does not work with miniorange
Author: Aaron Madhavan
Version: 1.2

*/


/* displays when the last time someone logged into wordpress -- does not work with miniorange */   
/* last login */
add_action('wp_login','wpdb_capture_user_last_login', 10, 2);
function wpdb_capture_user_last_login($user_login, $user){
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}

add_filter( 'manage_users_columns', 'wpdb_user_last_login_column');
function wpdb_user_last_login_column($columns){
    $columns['lastlogin'] = __('Last Login', 'lastlogin');
    return $columns;
}
 
add_action( 'manage_users_custom_column',  'wpdb_add_user_last_login_column', 10, 3); 
function wpdb_add_user_last_login_column($value, $column_name, $user_id ) {
    if ( 'lastlogin' != $column_name )
        return $value;
 
    return get_user_last_login($user_id,false);
}
 
function get_user_last_login($user_id,$echo = true){
    $date_format = get_option('date_format') . ' ' . get_option('time_format');
    $last_login = get_user_meta($user_id, 'last_login', true);
    $login_time = 'Never logged in';
    if(!empty($last_login)){
       if(is_array($last_login)){
            $login_time = mysql2date($date_format, array_pop($last_login), false);
        }
        else{
            $login_time = mysql2date($date_format, $last_login, false);
        }
    }
    if($echo){
        echo $login_time;
    }
    else{
        return $login_time;
    }
}

/*end last login */
?>
