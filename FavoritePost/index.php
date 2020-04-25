<?php 
/*
    Plugin Name: FavoritePost
    Plugin URI: https://github.com/aydevelop
    Description: Add posts to favorites
    Author: juwric
    Author URI: http://juwric.info
    Version: 1.0.0
    Text Domain: frp
    Licence: GPL
*/

function frp_add_post_link ( $content ) {
    if( is_user_logged_in() ){
        if( is_single()){

            global $post;
            $favorites = get_user_meta( wp_get_current_user()->ID, "frp_favorites" );
            if( !in_array( $post->ID, $favorites ) ){ 
                return "<p><a data-action='add' class='frp_post_link' href='#'>&#9733; <span> ".__( "Add to Favourites", "frp" )."</span> &#9733;</a></p>" . $content;
            }else{
                return "<p><a data-action='del' class='frp_post_link' href='#'>&#9733; <span> ".__( "Delete from Favourites", "frp" )."</span> &#9733;</a></p>" . $content;
            }
        }        
        return $content;

    }
    return $content;
}
add_action( 'the_content' , 'frp_add_post_link' );

function frp_enqueue_scripts_styles ( $content ) {
    wp_enqueue_script( 'frp_script', plugins_url("script.js", __FILE__), array('jquery'), null, true );
    wp_enqueue_style( 'frp_style', plugins_url("style.css", __FILE__) );

    global $post;
    wp_localize_script( 'frp_script', 'frp_obj', 
        array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce(),
                'postId' => $post->ID
            )
    );
}
add_action('wp_enqueue_scripts', 'frp_enqueue_scripts_styles');

function wp_ajax_wf_add () {    
    if(!wp_verify_nonce( $_POST['nonce'] )){
        echo "Error";
    }

    $post_id = (int)$_POST["postId"];
    $user_id = wp_get_current_user()->ID;
    $favorites = get_user_meta( $user_id, "frp_favorites" );

    if( in_array( $post_id, $favorites ) ){ wp_die("Is added"); }
    add_user_meta( $user_id, "frp_favorites", $post_id);
    wp_die("Added");
}
add_action('wp_ajax_frp_add', 'wp_ajax_wf_add');

function wp_ajax_wf_del () { 
    $post_id = (int)$_POST["postId"];
    $user_id = wp_get_current_user()->ID; 
    delete_user_meta( $user_id, "frp_favorites", $post_id);
    wp_die("Deleted");
}
add_action('wp_ajax_frp_del', 'wp_ajax_wf_del');