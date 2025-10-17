<?php
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