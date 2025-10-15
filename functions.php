<?php

// theme title
add_theme_support( "title-tag");


// theme css and js calling
function nexlint_style_and_script_enqueue(){
    // default style.css enqueue
    wp_enqueue_style( "nexlint_style", get_stylesheet_uri( ) );

    //register & enqueue custom css and js
    wp_register_style( "customcss", get_template_directory_uri()."/css/custom.css", array(), "1.0.0", "all" );
    wp_enqueue_style( "customcss" );

    // jquery
    wp_enqueue_script( "jquery" );
    wp_enqueue_script( "mainjs", get_template_directory_uri()."/js/main.js", array(), "1.0.0", true );
    

}

add_action("wp_enqueue_scripts","nexlint_style_and_script_enqueue" );