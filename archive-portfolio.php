<?php get_header(); ?>

<section class="container max-w-7xl mx-auto py-12 px-4">
  <h1 class="text-3xl font-bold mb-8">My Portfolio</h1>

  <!-- Outer wrapper: stack on small screens, row on md+ -->
  <div id="portfolios-archive" class="flex flex-col md:flex-row md:items-start md:gap-8">

    <!-- Main content area -->
    <main id="portfolio-list" class="w-full md:w-3/4 space-y-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article class="border rounded-lg overflow-hidden shadow-sm bg-white flex flex-col">
            <?php if ( has_post_thumbnail() ): ?>
              <!-- responsive image: fixed height but cover -->
              <a href="<?php the_permalink(); ?>" class="block">
                <img src="<?php the_post_thumbnail_url('medium'); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                     class="w-full h-48 sm:h-56 object-cover" />
              </a>
            <?php endif; ?>

            <div class="p-4 flex flex-col flex-1">
              <h2 class="text-xl font-semibold mb-2">
                <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
              </h2>

              <p class="text-gray-600 flex-1"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>

              <div class="mt-4">
                <a href="<?php the_permalink(); ?>" class="inline-block text-blue-500 hover:underline">
                  View Project &rarr;
                </a>
              </div>
            </div>
          </article>
        <?php endwhile; else: ?>
          <p><?php _e( 'No portfolios found.', 'faradalam' ); ?></p>
        <?php endif; ?>
      </div>

      <!-- Pagination (if needed) -->
      <div class="mt-8">
        <?php
          the_posts_pagination( array(
            'mid_size' => 1,
            'prev_text' => __('&larr; Prev', 'faradalam'),
            'next_text' => __('Next &rarr;', 'faradalam'),
            'screen_reader_text' => __('Portfolio navigation', 'faradalam'),
          ) );
        ?>
      </div>
    </main>

    <!-- Sidebar: full width on small, fixed column on md+ -->
    <aside id="sidebar" class="w-full md:w-1/4 mt-8 md:mt-0">
      <!-- Make sidebar sticky on larger screens -->
      <div class="space-y-5">
        <?php get_sidebar(); ?>
      </div>
    </aside>

  </div> <!-- end portfolios-archive -->
</section>

<?php get_footer(); ?>

