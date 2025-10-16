<?php

// theme setup

function nexlint_theme_setup() {
    add_theme_support( "title-tag");
//     add_theme_support( 'custom-logo', array(
//         'height'      => 60,
//         'width'       => 60,
//         'flex-height' => false,
//         'flex-width'  => false,
//     ) );
//     add_theme_support( 'post-thumbnails' );
//     add_theme_support( 'custom-background', array(
//   'default-color' => 'ffffff',
//   'default-image' => '',
// ) );
// add_theme_support( 'custom-header', array(
//   'width'              => 1200,
//   'height'             => 280,
//   'flex-height'        => true,
//   'flex-width'         => true,
//   'uploads'            => true,
// ) );
// add_theme_support( 'html5', array(
//   'search-form',
//   'comment-form',
//   'comment-list',
//   'gallery',
//   'caption',
// ) );
//     add_theme_support( 'align-wide' );
//     add_theme_support( 'wp-block-styles' );
//     add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'nexlint_theme_setup' );



// theme css and js calling
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


// Theme Funtion

function nexlint_customizer_register($wp_customize){
    $wp_customize->add_section("nexlint_header_area", array(
        "title"=>__("Header Area","faradalam"),
        "description"=>__("Your can update your logo from here", "faradalam"),
        "priority"=>1
    ));

    $wp_customize->add_setting("nexlint_logo", array(
        "default"=> get_template_directory_uri() . '/img/nexlint-logo.jpg',
        "sanitize_callback" => "esc_url_raw",
        "capability"=> "edit_theme_options",
        "transport"=>"refresh",
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "nexlint_logo", array(
        "label"=> "Upload Your Logo",
        "description"=> "Chnage your logo from here",
        "setting"=> "nexlint_logo",
        "section"=> "nexlint_header_area"
    )));

    // Tagline Setting
    $wp_customize->add_setting("nexlint_tagline",[
        "default"=> "Building NextGen Site",
        "sanitize_callback"=> "sanitize_text_field",
        "capability"=> "edit_theme_options",
        "transport"=>"refresh",
    ]);
    // Tagline COntrol
    $wp_customize->add_control("nexlint_tagline",[
        "label"=>__("Tagline", "faradalam"),
        "description"=> "Set your tagline form here",
        "setting"=> "nexlint_tagline",
        "section"=> "nexlint_header_area",
        "type"=> "text"
    ]);
}

add_action("customize_register", "nexlint_customizer_register");

// google Fornts
function nexlint_add_google_font(){
    $google_font_url = "https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap";
    wp_enqueue_style( "google_fonts", $google_font_url, array(), null );
}

add_action( "wp_enqueue_scripts",  "nexlint_add_google_font");

// Nav Menu Register
function nexlint_register_menus() {
    register_nav_menus( array(
        'main_menu' => __( 'Main Menu', 'textdomain' ),
    ) );
}
add_action( 'after_setup_theme', 'nexlint_register_menus' );