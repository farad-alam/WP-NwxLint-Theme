<?php
function nexlint_theme_setup() {
    add_theme_support( "title-tag");
    add_theme_support( "post-thumbnails", array("post", "page", 'portfolio'));
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

// Excerpt More
function nexlint_excerpt_more($more){
    return "...";
}

add_filter("excerpt_more", "nexlint_excerpt_more");


// Excerpt Length
function nexlint_excerpt_length($length){
    return 30;
}

add_filter("excerpt_length", "nexlint_excerpt_length");



// Pagination -------------
function nexlint_pagination() {
    global $wp_query;

    $big = 9999999999;
    $max = $wp_query->max_num_pages;
    $current = max(1, get_query_var('paged'));

    if ($max > 1) {
        // Generate links as an array
        $links = paginate_links(array(
            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'    => '?paged=%#%',
            'current'   => $current,
            'total'     => $max,
            'prev_text' => 'Prev',
            'next_text' => 'Next',
            'type'      => 'array',
        ));

        if (is_array($links)) {
            // Start your raw HTML structure
            echo '<nav class="mt-8 flex items-center justify-between bg-white px-4 py-3 rounded-md border border-gray-100">';
            
            // Left text: current page info
            echo '<div class="text-sm text-gray-600">Page ' . $current . ' of ' . $max . '</div>';
            
            // Pagination buttons
            echo '<div class="flex items-center gap-2">';

            foreach ($links as $link) {
                // Check if this link is the current page
                if (strpos($link, 'current') !== false) {
                    echo '<span class="px-3 py-1 bg-secondary text-white rounded-md text-sm">' . $link . '</span>';
                } else {
                    // Normal link
                    echo str_replace(
                        'page-numbers',
                        'px-3 py-1 border rounded-md text-sm hover:bg-indigo-50',
                        $link
                    );
                }
            }

            echo '</div>'; // end right side
            echo '</nav>';
        }
    }
}










// function nexlint_pagination(){
// global $wp_query;
// $big = 9999999999;
// $max = $wp_query->max_num_pages;
// $current = max(1, get_query_var("paged"));

// if ($max > 1) {
//     echo '<div class="nexlint_pagenav">';
//     echo '<p>Page' . $current .'<span>of</span> ' . $max .'</p>';

//     echo paginate_links( array(
//         'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//         'format' => '?paged=%#%',
//         'current' => $current,
//         'total' => $max,
//         'prev_text' => '« Prev',
//         'next_text' => 'Next »'
//     ) );

//      echo '</div>';

// }
// }