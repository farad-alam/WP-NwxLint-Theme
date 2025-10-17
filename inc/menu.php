<?php

function nexlint_register_menus() {
    register_nav_menus( array(
        'main_menu' => __( 'Main Menu', 'textdomain' ),
    ) );
}
add_action( 'after_setup_theme', 'nexlint_register_menus' );