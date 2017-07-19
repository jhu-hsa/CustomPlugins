<?php
/**
 * @package formidable-special-functions
 */
/*
Plugin Name: Formidable special functions
Description: Formidable special functions
Author: Aaron Madhavan
Version: 1.2

*/


/* Formidable special functions */    
/*remove attachments from email*/
add_filter('frm_notification_attachment', 'remove_my_attachment', 10, 3);
function remove_my_attachment($attachments, $form, $args) {
  if ( $args['email_key'] == 261  ) { //change 1277 to the email ID that you would like to DROP the attachment for if you want to remove attachments on multiple emails use || $args['email_key'] == 260
    $attachments = array(); //remove all attachments
  }
  return $attachments;
} 
/*change query to like title */
add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
function title_like_posts_where( $where, &$wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}
/*exclude category */
function exclude_cat_wps($query) {
    if ($query->is_feed) {
      if(get_current_blog_id()==4){$query->set('cat','-3');}else{}
    }
    return $query;
}
add_filter('pre_get_posts','exclude_cat_wps');
/*minimize all forms*/
add_filter( 'frm_filter_final_form', 'auto_minimize_forms' );
function auto_minimize_forms( $form ) {
  $form = str_replace( array( "\r\n", "\r", "\n", "\t", '    ' ), '', $form );
  return $form;
}
?>