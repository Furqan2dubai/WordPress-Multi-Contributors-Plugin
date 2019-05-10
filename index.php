<?php
 
/*
Plugin Name: WordPress Multi Contributors
Plugin URI: https://furqanhussain.com/
Description: 'WordPress Contributors'
Author: Furqan Hussain
Version: 1.7.2
Author URI: https://furqanhussain.com/
*/

/**
 * Register meta box(es).
 */
function wpdocs_register_meta_boxes() {
    add_meta_box( 'meta-box-id', __( 'Contributors', 'allcontributors' ), 'wpdocs_my_display_callback', 'post' );
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_my_display_callback( $post ) { 
    $users = get_users('role=author'); 
    global $post;
    $custom = get_post_custom($post->ID);
    $contributorId = explode("," , $custom["contributorId"][0]); 
    foreach ($users as $user) 
    {     
    ?> 
        <input type="checkbox" name="contributorId[]" value="<?php echo $user->ID ?>" <?php if( in_array($user->ID, $contributorId) == true ) { ?>checked="checked"<?php } ?> />   
        <?php echo ucwords($user->display_name); ?>
        <br/> 
    <?php
    }//foreach end
} //wpdocs_my_display_callback - function end
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
 
add_action('save_post', 'save_authors');

function save_authors($post_ID = 0) {
    $contributorId = implode(",",$_POST["contributorId"]); 
    $post_ID = (int) $post_ID;
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );

    if ($post_type) {
    update_post_meta($post_ID, "contributorId", $contributorId);
    }
   return $post_ID;
} 

add_filter( 'the_content', 'contributor_after_content' ); 
 
function contributor_after_content( $content ) { 
   if ( is_singular('post')) {
        $contributorBox = '<b>Contributors</b><ol>';
        //global $post;
        $users = get_users('role=author' ); 
        $custom = get_post_custom($post->ID);
        $contributorId = explode("," , $custom["contributorId"][0]); 
        foreach ($users as $user) 
        {     
            if(in_array($user->ID,$contributorId)){
                $contributorBox .= '<li>'.get_avatar($user->ID).'<a href="'.get_author_posts_url($user->ID).'">'.ucwords($user->display_name).'</a></li>';  
            }
        }
       $contributorBox .= '</ol>';

       $content = $content.$contributorBox ;
       
      }

    $a = get_avatar(2);

   return $content;
}

?>