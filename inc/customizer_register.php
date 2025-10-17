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
        "description"=> "CHnage menu position",
        "setting"=>"nexlint_menu_position_setting",
        "section"=>"nexlint_menu_position",
        "type"=>"radio",
        "choices"=>[
            "left_menu"=> "Left Menu",
            "right_menu"=>"Right Menu",
            "center_menu"=>"Center Menu"
        ]
        ]);
}

add_action("customize_register", "nexlint_customizer_register");