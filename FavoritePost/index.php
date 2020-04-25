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
        if( is_single() || is_home() ){
            return "<p><a class='frp_post_link' href='#'>&#9733; <span> ".__( "Add to favourites", "frp" )."</span> &#9733;</a></p>" . $content;
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

function wp_ajax_wf_test () {
    
    if(!wp_verify_nonce( $_POST['nonce'] )){
        echo "error";
    }

    echo $_POST["postId"];

    wp_die();
}
add_action('wp_ajax_frp', 'wp_ajax_wf_test');