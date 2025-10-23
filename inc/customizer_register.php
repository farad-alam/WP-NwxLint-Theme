<?php

function nexlint_customizer_register($wp_customize){
    // HEADER AREA
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

    // MENU POSITION OPTION
    $wp_customize->add_section("nexlint_menu_position",[
        "title"=> __("Menu Position", "faradalam"),
        "description"=> __("change your menu position from here", "faradalam"),
        "priority"=> 2,
    ]);
    
    $wp_customize->add_setting("nexlint_menu_position_setting", [
        "default"=>"left_menu",
        "capability"=>"edit_theme_options",
        "transport"=>"refresh"
    ]);

    $wp_customize->add_control("nexlint_menu_position_setting", [
        "label"=> __("Chnage Menu To", "faradalam"),
        "description"=> "Chnage menu position",
        "setting"=>"nexlint_menu_position_setting",
        "section"=>"nexlint_menu_position",
        "type"=>"radio",
        "choices"=>[
            "left_menu"=> "Left Menu",
            "right_menu"=>"Right Menu",
            "center_menu"=>"Center Menu"
        ]
    ]);

    // THEME COLOR CUSTOMIZER
    $wp_customize->add_section('nexlint_theme_color', [
        'title' => __('Theme Colors', 'faradalam'),
        'description' => 'Customize yout theme colors.',
        'priority' => 3
    ]);
    // background color
    $wp_customize->add_setting('nexlint_theme_background_color', [
        'default' => '#ffffff',
        "capability"=>"edit_theme_options",
        "transport"=> "refresh",
        'sanitize_callback' => 'sanitize_hex_color'
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexlint_theme_background_color', [
        'label' => __('Background Color', 'faradalam'),
        'description' => "Chnage background color",
        'section' => 'nexlint_theme_color',
        'setting' => 'nexlint_theme_background_color',

    ]));

    // primary color
    $wp_customize->add_setting('nexlint_theme_primary_color', [
        'default' => '#c026d3',
        "capability"=>"edit_theme_options",
        "transport"=> "refresh",
        'sanitize_callback' => 'sanitize_hex_color'
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexlint_theme_primary_color', [
        'label' => __('Primary Color', 'faradalam'),
        'description' => "Chnage primary color",
        'section' => 'nexlint_theme_color',
        'setting' => 'nexlint_theme_primary_color',

    ]));

    // primary Light color
    $wp_customize->add_setting('nexlint_theme_primary_light_color', [
        'default' => '#d946ef',
        "capability"=>"edit_theme_options",
        "transport"=> "refresh",
        'sanitize_callback' => 'sanitize_hex_color'
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexlint_theme_primary_light_color', [
        'label' => __('Primary Light Color', 'faradalam'),
        'description' => "Light version of primary color (use on hover)",
        'section' => 'nexlint_theme_color',
        'setting' => 'nexlint_theme_primary_light_color',

    ]));

    // Secondary Color
    $wp_customize->add_setting('nexlint_theme_secondary_color', [
        'default' => '#4338ca',
        "capability"=>"edit_theme_options",
        "transport"=> "refresh",
        'sanitize_callback' => 'sanitize_hex_color'
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexlint_theme_secondary_color', [
        'label' => __('Secondary Color', 'faradalam'),
        'description' => "Secondary Color (different element like: button color)",
        'section' => 'nexlint_theme_color',
        'setting' => 'nexlint_theme_secondary_color',

    ]));

    // Secondary light Color
    $wp_customize->add_setting('nexlint_theme_secondary_light_color', [
        'default' => '#4f46e5',
        "capability"=>"edit_theme_options",
        "transport"=> "refresh",
        'sanitize_callback' => 'sanitize_hex_color'
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexlint_theme_secondary_light_color', [
        'label' => __('Secondary Light Color', 'faradalam'),
        'description' => "Secondary light Color (button hover color)",
        'section' => 'nexlint_theme_color',
        'setting' => 'nexlint_theme_secondary_light_color',

    ]));

    }

add_action("customize_register", "nexlint_customizer_register");


function nexlint_theme_color_customize(){
    $handle_tailwind = 'tailwindcss';

    $bg_color = sanitize_hex_color(get_theme_mod("nexlint_theme_background_color", '#ffffff'));
    $primary_color = sanitize_hex_color(get_theme_mod('nexlint_theme_primary_color', '#c026d3' ));
    $primary_color_light = sanitize_hex_color(get_theme_mod('nexlint_theme_primary_light_color', '#d946ef' ));
    $secondary_color = sanitize_hex_color(get_theme_mod('nexlint_theme_secondary_color', '#4338ca' ));
    $secondary_light_color = sanitize_hex_color(get_theme_mod('nexlint_theme_secondary_light_color', '#4f46e5' ));

   

    $custom_css_root = "
        :root {
            --color-primary: {$primary_color};
            --color-primary-light: {$primary_color_light};
            --color-secondary: {$secondary_color};
            --color-bg: {$bg_color};
            --color-hover: {$secondary_light_color};
            --color-text: #111827;
            }

        body {
            background: {$bg_color};
        }
    ";

    // wp_add_inline_style( 'nexlint_style', $custom_css_bg );
    wp_add_inline_style( $handle_tailwind, $custom_css_root);
}

add_action('wp_enqueue_scripts', 'nexlint_theme_color_customize');