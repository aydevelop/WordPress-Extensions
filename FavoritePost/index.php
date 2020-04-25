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