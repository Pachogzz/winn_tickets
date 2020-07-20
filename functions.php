<?php

/* Add custom JS */
function winn_js() {
    wp_enqueue_script( 'winn_js', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'winn_js' );

/* Extra fields on product admin page */
include get_stylesheet_directory() . '/inc/winn-event-data.php';
include get_stylesheet_directory() . '/inc/boletos.php';;
include get_stylesheet_directory() . '/inc/winn-event-mods.php';;