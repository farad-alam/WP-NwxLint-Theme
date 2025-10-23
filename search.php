<?php
/**
 * search.php
 * Search results layout:
 * - Hero (top) containing heading + search form
 * - Two-column layout: results on left, sidebar on right
 */

get_header(); 
?>

<main class="w-10/12 mx-auto px-4 py-10">
  <!-- HERO: spans both columns -->
  <section class="mb-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-2xl md:text-3xl font-bold mb-3">
        <?php
        /* translators: %s: search query */
        printf( esc_html__( 'Search results for: %s', 'your-theme-textdomain' ), '<span class="font-normal">' . esc_html( get_search_query() ) . '</span>' );
        ?>
      </h1>
      <p class="text-sm text-gray-600 mb-4">
        <?php esc_html_e( 'Showing results matching your query. Try different keywords for broader or narrower results.', 'your-theme-textdomain' ); ?>
      </p>

      <!-- inline search form (hero) -->
      <div class="max-w-2xl">
        <?php get_search_form(); ?>
      </div>
    </div>
  </section>

  <!-- MAIN GRID: left results, right sidebar -->
  <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
    <!-- LEFT: Search results (8/12 on md and up) -->
    <section class="md:col-span-8 space-y-6">
      <?php if ( have_posts() ) : ?>

        <div class="space-y-6">
          <?php
          while ( have_posts() ) : the_post();

            // Thumbnail fallback (your existing logic)
            if ( has_post_thumbnail() ) {
              $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            } else {
              $thumbnail_url = get_template_directory_uri() . '/img/nexlint-logo.jpg';
            }
            ?>

            <article class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
              <div class="md:flex ">
                <a href="<?php the_permalink(); ?>" class="md:w-48 flex-shrink-0">
                  <?php if ( ! empty( $thumbnail_url ) ) : ?>
                    <img 
                      src="<?php echo esc_url( $thumbnail_url ); ?>" 
                      alt="<?php the_title_attribute( array( 'echo' => true ) ); ?>" 
                      class="w-full h-36 object-cover overflow-hidden hover:scale-110 transition duration-900 md:h-full md:w-48"
                    />
                  <?php endif; ?>
                </a>

                <div class="p-5 flex flex-col justify-between">
                  <div>
                    <?php
                    // Example: show first category as label (optional)
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                      $cat = $categories[0];
                      echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="text-xs inline-block bg-indigo-50 text-indigo-600 rounded-full px-3 py-1 font-medium">' . esc_html( $cat->name ) . '</a>';
                    } else {
                      echo '<span class="text-xs inline-block bg-indigo-50 text-indigo-600 rounded-full px-3 py-1 font-medium">Tutorial</span>';
                    }
                    ?>
                    <h2 class="mt-3 text-xl font-semibold">
                      <a href="<?php the_permalink(); ?>" class="hover:text-indigo-600"><?php the_title(); ?></a>
                    </h2>
                    <p class="mt-2 text-sm text-gray-600"><?php the_excerpt(); ?></p>
                  </div>

                  <div class="mt-4 flex items-center justify-between">
                    <div class="text-xs text-gray-500"><?php echo get_the_date( 'M j, Y' ); ?> • <?php echo esc_html( get_post_meta( get_the_ID(), 'reading_time', true ) ?: '5 min read' ); ?></div>
                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-sm font-medium px-3 py-1.5 rounded-md bg-secondary text-white hover:bg-hover">
                      Read more
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </article>

          <?php
          endwhile;
          ?>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
          <?php get_template_part('parts/pagination' ) ?>
        </div>

      <?php else : ?>
        <!-- No results -->
        <div class="bg-yellow-50 border border-yellow-200 p-6 rounded">
          <h2 class="text-lg font-semibold mb-2"><?php esc_html_e( 'No results found', 'your-theme-textdomain' ); ?></h2>
          <p class="text-sm text-gray-700 mb-4"><?php printf( esc_html__( 'We couldn\'t find anything for "%s". Try different keywords or browse categories.', 'your-theme-textdomain' ), esc_html( get_search_query() ) ); ?></p>
          

          <div class="mt-6 text-sm text-gray-600">
            <p><?php esc_html_e( 'Suggestions:', 'your-theme-textdomain' ); ?></p>
            <ul class="list-disc ml-5 mt-2">
              <li><?php esc_html_e( 'Check your spelling', 'your-theme-textdomain' ); ?></li>
              <li><?php esc_html_e( 'Try more general keywords', 'your-theme-textdomain' ); ?></li>
              <li><?php esc_html_e( 'Try fewer words', 'your-theme-textdomain' ); ?></li>
            </ul>
          </div>
        </div>
      <?php endif; ?>
    </section>

    <!-- RIGHT: Sidebar (4/12 on md and up) -->
    <aside class="md:col-span-4">
      <?php
      /**
       * Use the theme's sidebar template. 
       * If you don't have a sidebar.php, you can include your sidebar markup directly here.
       */
      get_sidebar();
      ?>
    </aside>
  </div>
</main>

<?php
get_footer();
