<?php 
// Sidebar Register

function nexlint_widget_register(){
    register_sidebar(array(
        'name' => __("Main Area Widget", "faradalam"),
        'id' => 'sidebar-1',
        'description' => __('This MAIN widget will appear in sidebar', 'faradalam'),
        'before_widget' => '<div class="child_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_title">',
        'after_title' => '</h2>'
    ) );

    register_sidebar(array(
        'name' => __("Footer 1", "faradalam"),
        'id' => 'footer-1',
        'description' => __('This Footer widget will appear in footer', 'faradalam'),
        'before_widget' => '<div class="child_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_title footer_widget_title">',
        'after_title' => '</h2>'
    ) );

     register_sidebar(array(
        'name' => __("Footer 2", "faradalam"),
        'id' => 'footer-2',
        'description' => __('This Footer widget will appear in footer', 'faradalam'),
        'before_widget' => '<div class="child_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_title footer_widget_title">',
        'after_title' => '</h2>'
    ) );

     register_sidebar(array(
        'name' => __("Footer 3", "faradalam"),
        'id' => 'footer-3',
        'description' => __('This Footer widget will appear in footer', 'faradalam'),
        'before_widget' => '<div class="child_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_title footer_widget_title">',
        'after_title' => '</h2>'
    ) );

}

add_action('widgets_init','nexlint_widget_register');









// <?php
// // Sidebar Register Function

// function ali_widgets_register(){
//   register_sidebar(array(
//     'name' => __('Main Widget Area', 'alihossain'),
//     'id'   => 'sideber-1',
//     'description' => __('Apperas in the sidebar in blog page and also other page', 'alihossain'),
//     'before_widget' => '<div class="child_sidebar">',
//     'after_widget' => '</div>',
//     'before_title' => '<h2 class="title">',
//     'after_title' => '</h2>',
//     ));
//   register_sidebar(array(
//     'name' => __('Footer 1', 'alihossain'),
//     'id'   => 'footer-1',
//     'description' => __('Apperas in the sidebar in blog page and also other page', 'alihossain'),
//     'before_widget' => '<div class="child_sidebar">',
//     'after_widget' => '</div>',
//     'before_title' => '<h2 class="title">',
//     'after_title' => '</h2>',
//     ));
//   register_sidebar(array(
//     'name' => __('Footer 2', 'alihossain'),
//     'id'   => 'footer-2',
//     'description' => __('Apperas in the sidebar in blog page and also other page', 'alihossain'),
//     'before_widget' => '<div class="child_sidebar">',
//     'after_widget' => '</div>',
//     'before_title' => '<h2 class="title">',
//     'after_title' => '</h2>',
//     ));
//   register_sidebar(array(
//     'name' => __('Footer 3', 'alihossain'),
//     'id'   => 'footer-3',
//     'description' => __('Apperas in the sidebar in blog page and also other page', 'alihossain'),
//     'before_widget' => '<div class="child_sidebar">',
//     'after_widget' => '</div>',
//     'before_title' => '<h2 class="title">',
//     'after_title' => '</h2>',
//     ));
// }

// add_action('widgets_init', 'ali_widgets_register');
