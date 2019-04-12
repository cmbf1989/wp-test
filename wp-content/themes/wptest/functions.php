<?php

add_action( 'wp_enqueue_scripts', 'twentysixteen_parent_theme_enqueue_styles' );

function twentysixteen_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'twentysixteen-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'wptest-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'twentysixteen-style' )
    );
}

function tt_hidetitle_class($classes) {

    if ( is_single() || is_page () ) {
        $classes[] = 'display-none-title';

    }

    return $classes;

}

add_filter('post_class', 'tt_hidetitle_class');
