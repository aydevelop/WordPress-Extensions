<?php 
/*
    Plugin Name: CustomPostTypes+Taxonomy
    Plugin URI: http://juwric.info
    Description: Pellentesque et tellus gravida, finibus risus sed, sagittis orci. Praesent ac nibh varius, lacinia purus ut, euismod purus. Maecenas mattis molestie ante vitae dapibus. Curabitur et aliquet lectus.
    Author: juwric
    Author URI: http://juwric.info
    Version: 1.0.0
    Text Domain: cptt
    Licence: GPL
*/

function cptt_enqueue_scripts_styles() {
    wp_register_style( 'cptt_style', WP_PLUGIN_URL . '/CustomPostTypes+Taxonomy/style.css' );
    wp_enqueue_style( 'cptt_style');

    wp_register_script( 'cptt_script', WP_PLUGIN_URL . '/CustomPostTypes+Taxonomy/script.js' );
    wp_enqueue_script( 'cptt_script' );
}
add_action('wp_enqueue_scripts', 'cptt_enqueue_scripts_styles');

require_once(WP_PLUGIN_DIR . '/CustomPostTypes+Taxonomy/register.php');