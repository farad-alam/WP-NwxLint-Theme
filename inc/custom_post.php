<?php 

/**
 * Register Custom Post Type: Portfolio
 * This creates a "Portfolio" section in WordPress admin
 * where you can add and manage portfolio projects separately from posts.
 */
function nexlint_register_portfolio_post_type() {

    // ---------- LABELS ----------
    // These define how your CPT text will appear in the admin dashboard.
    $labels = [
        'name'               => __('Portfolios', 'faradalam'),          // Plural name (shown in sidebar menu)
        'singular_name'      => __('Portfolio', 'faradalam'),           // Singular name (used for one item)
        'add_new'            => __('Add New', 'faradalam'),             // "Add New" button text
        'add_new_item'       => __('Add New Project', 'faradalam'),     // Page title when adding new item
        'new_item'           => __('New Project', 'faradalam'),         // Used in admin bar for new items
        'all_items'          => __('All Portfolios', 'faradalam'),      // Text for "All" link in sidebar
        'edit_item'          => __('Edit Project', 'faradalam'),        // Page title when editing a portfolio
        'view_item'          => __('View Project', 'faradalam'),        // Link text for viewing the item
        'search_items'       => __('Search Portfolios', 'faradalam'),   // Placeholder text for search box
        'not_found'          => __('No portfolios found', 'faradalam'), // Message when no items found
        'menu_name'          => __('Portfolio', 'faradalam'),           // The name shown in the sidebar menu
    ];

    // ---------- ARGUMENTS ----------
    // These control how the post type behaves in the admin and frontend.
    $args = [
        'labels'             => $labels,                  // Attach the labels defined above
        'public'             => true,                     // Make it visible on both frontend & backend
        'publicly_queryable' => true,                     // Allow URLs like /portfolio/project-name
        'show_ui'            => true,                     // Show the UI in the WordPress admin
        'has_archive'        => true,                     // Enable archive page (e.g., /portfolio/)
        'rewrite'            => ['slug' => 'portfolio'],  // Set URL slug for single and archive pages
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'], // Enable title, content, image, and excerpt fields
        'capability_type'    => 'post',                   // Behaves like a normal post for permissions
        'hierarchical'       => false,                    // False = like posts (flat), True = like pages (can have parents)
        'exclude_from_search'=> false,                    // Include portfolios in WordPress search
        'menu_position'      => 5,                        // Position in sidebar (below "Posts")
        'menu_icon'          => 'dashicons-portfolio',    // Admin menu icon (see dashicons list)
        'show_in_rest'       => true,                     // Enable Gutenberg/Block Editor + REST API support
    ];

    // ---------- REGISTER THE POST TYPE ----------
    register_post_type( 'portfolio', $args );             // Register the custom post type using all settings
}

// Run the function when WordPress initializes
add_action( 'init', 'nexlint_register_portfolio_post_type' );



// Customize admin messages for Portfolio CPT
function nexlint_portfolio_updated_messages( $messages ) {

    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    // Only change messages for 'portfolio' post type
    if ( 'portfolio' !== $post_type ) {
        return $messages;
    }

    $messages['portfolio'] = array(
        0  => '', // Unused
        1  => __( 'Portfolio updated.', 'nexlint' ),
        2  => __( 'Custom field updated.', 'nexlint' ),
        3  => __( 'Custom field deleted.', 'nexlint' ),
        4  => __( 'Portfolio updated.', 'nexlint' ),
        5  => isset($_GET['revision']) ? sprintf( __( 'Portfolio restored to revision from %s', 'nexlint' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => __( 'Portfolio published.', 'nexlint' ),
        7  => __( 'Portfolio saved.', 'nexlint' ),
        8  => __( 'Portfolio submitted.', 'nexlint' ),
        9  => sprintf(
            __( 'Portfolio scheduled for: <strong>%1$s</strong>.', 'nexlint' ),
            date_i18n( __( 'M j, Y @ G:i', 'nexlint' ), strtotime( $post->post_date ) )
        ),
        10 => __( 'Portfolio draft updated.', 'nexlint' ),
    );

    return $messages;
}
add_filter( 'post_updated_messages', 'nexlint_portfolio_updated_messages' );

// Bulk action messages for 'portfolio' CPT
function nexlint_portfolio_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
    $bulk_messages['portfolio'] = array(
        'updated'   => _n( '%s portfolio updated.', '%s portfolios updated.', $bulk_counts['updated'], 'nexlint' ),
        'locked'    => _n( '%s portfolio not updated, somebody is editing it.', '%s portfolios not updated, somebody are editing them.', $bulk_counts['locked'], 'nexlint' ),
        'deleted'   => _n( '%s portfolio permanently deleted.', '%s portfolios permanently deleted.', $bulk_counts['deleted'], 'nexlint' ),
        'trashed'   => _n( '%s portfolio moved to the Trash.', '%s portfolios moved to the Trash.', $bulk_counts['trashed'], 'nexlint' ),
        'untrashed' => _n( '%s portfolio restored from the Trash.', '%s portfolios restored from the Trash.', $bulk_counts['untrashed'], 'nexlint' ),
    );

    return $bulk_messages;
}
add_filter( 'bulk_post_updated_messages', 'nexlint_portfolio_bulk_updated_messages', 10, 2 );