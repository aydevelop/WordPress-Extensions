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
            return "<p><a href='#'>&#9733; ".__( "Add to favourites", "frp" )." &#9733;</a></p>" . $content;
        }        
        return $content;
    }
    return $content;
}
add_action( 'the_content' , 'frp_add_post_link' );

function frp_enqueue_scripts_styles ( $content ) {
    wp_enqueue_script( 'frp_script', plugins_url("script.js", __FILE__), array('jquery'), null, true );
    wp_enqueue_style( 'frp_style', plugins_url("style.css", __FILE__) );
}
add_action('wp_enqueue_scripts', 'frp_enqueue_scripts_styles');