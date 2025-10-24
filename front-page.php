<?php
/**
 * front-page.php
 * Always show custom front layout unless admin explicitly chose a static page.
 * Place in: wp-content/themes/your-active-theme/front-page.php
 */

get_header();
?>

<main class="container mx-auto px-4 py-8">

<?php
// OPTIONAL: remove this debug line once everything works
echo '<!-- front-page.php active - show_on_front: ' . esc_html( get_option('show_on_front') ) . ' -->';

// If admin explicitly selected a static page for the front page, render that page.
if ( get_option( 'show_on_front' ) === 'page' ) {

    $front_page_id = (int) get_option( 'page_on_front' );

    if ( $front_page_id ) {
        $front_post = get_post( $front_page_id );

        // Make sure get_post returned a post object before accessing properties
        if ( $front_post && is_a( $front_post, 'WP_Post' ) ) {

            // set up postdata so template tags work if needed
            setup_postdata( $front_post );

            $content = $front_post->post_content;

            if ( has_blocks( $content ) || ! empty( trim( $content ) ) ) {
                // Show the page content (Gutenberg / classic)
                echo apply_filters( 'the_content', $content );
            } else {
                // Page exists but has no content — fallback to theme front part
                get_template_part( 'parts/content', 'front' );
            }

            wp_reset_postdata();

        } else {
            // Could not fetch the page object — fallback
            get_template_part( 'parts/content', 'front' );
        }

    } else {
        // Edge case: no page id set — fallback
        get_template_part( 'parts/content', 'front' );
    }

} else {
    // Admin selected "Your latest posts". Show the theme's custom front layout.
    get_template_part( 'parts/content', 'front' );
}
?>

</main>

<?php
get_footer();








