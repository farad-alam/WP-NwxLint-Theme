<?php

function nexlint_style_and_script_enqueue(){
    // theme style (style.css)
    wp_enqueue_style(
        'nexlint_style',
        get_stylesheet_uri(),
        array(),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    // custom css (css/custom.css)
    $custom_css_path = get_template_directory() . '/css/custom.css';
    wp_enqueue_style(
        'nexlint_custom',
        get_template_directory_uri() . '/css/custom.css',
        array('nexlint_style'),
        file_exists($custom_css_path) ? filemtime( $custom_css_path ) : null
    );

    // Tailwind CDN (developer CDN, good for local/dev). Use the official script:
    wp_enqueue_script(
        'tailwind_cdn',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false // load in head so utilities are available for your CSS/HTML
    );

    // ensure jQuery is available, then enqueue main.js depending on jQuery
    wp_enqueue_script('jquery'); // core WP jQuery

    $main_js_path = get_template_directory() . '/js/main.js';
    wp_enqueue_script(
        'nexlint_main',
        get_template_directory_uri() . '/js/main.js',
        array('jquery'),
        file_exists($main_js_path) ? filemtime( $main_js_path ) : '1.0.0',
        true // load in footer
    );
}
add_action('wp_enqueue_scripts', 'nexlint_style_and_script_enqueue');

// google Fonts
function nexlint_add_google_font(){
    $google_font_url = "https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap";
    wp_enqueue_style( "google_fonts", $google_font_url, array(), null );
}

add_action( "wp_enqueue_scripts",  "nexlint_add_google_font");