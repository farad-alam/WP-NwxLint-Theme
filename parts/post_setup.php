<?php
/**
 * Single post template for Nexlint-like theme
 * 
 */

?>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl mx-auto'); ?>>

      <!-- Featured image / fallback -->
      <?php
      if ( has_post_thumbnail() ) :
        $feat_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
      else :
        $feat_url = get_template_directory_uri() . '/img/nexlint-logo.jpg';
      endif;
      ?>

      <div class="mb-8">
        <img src="<?php echo esc_url( $feat_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-64 md:h-96 object-cover rounded-xl shadow-sm" />
      </div>

      <!-- Title & meta -->
      <header class="mb-6">
        <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
          <span><?php echo get_the_date( 'M j, Y' ); ?></span>
          <span>•</span>
          <span><?php echo esc_html( get_post_meta( get_the_ID(), 'reading_time', true ) ?: '5 min read' ); ?></span>
          <?php if ( has_category() ) : ?>
            <span class="hidden md:inline">•</span>
            <span class="hidden md:inline"><?php the_category( ', ' ); ?></span>
          <?php endif; ?>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2"><?php the_title(); ?></h1>
        <?php if ( get_the_excerpt() ) : ?>
          <p class="text-gray-600 mt-2"><?php echo get_the_excerpt(); ?></p>
        <?php endif; ?>
      </header>

      <!-- Author box -->
      <div class="flex items-center gap-4 mb-8">
        <div class="flex-shrink-0">
          <?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', get_the_author() , array( 'class' => 'rounded-full' ) ); ?>
        </div>
        <div>
          <div class="text-sm font-medium"><?php the_author_posts_link(); ?></div>
          <div class="text-xs text-gray-500">Published on <?php echo get_the_date(); ?></div>
        </div>
      </div>

      <!-- Post content -->
      <div class="prose max-w-none mb-8">
        <?php the_content(); ?>
      </div>

      <!-- Tags -->
      <?php if ( has_tag() ) : ?>
        <div class="mb-8">
          <h3 class="text-sm font-semibold text-gray-700 mb-2">Tags</h3>
          <div class="flex flex-wrap gap-2">
            <?php the_tags( '<span class="inline-block text-xs px-3 py-1 rounded-full bg-gray-100">', '</span><span class="inline-block text-xs px-3 py-1 rounded-full bg-gray-100">', '</span>' ); ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- Post navigation (prev/next) -->
      <div class="flex items-center justify-between mt-8 border-t pt-6">
        <div>
          <?php previous_post_link( '%link', '&larr; %title', true ); ?>
        </div>
        <div class="text-sm text-gray-500">Back to posts</div>
        <div>
          <?php next_post_link( '%link', '%title &rarr;', true ); ?>
        </div>
      </div>

      <!-- Related posts (by category) -->
      <?php
      $cats = wp_get_post_categories( get_the_ID() );
      if ( ! empty( $cats ) ) :
        $related = new WP_Query( array(
          'category__in'   => $cats,
          'post__not_in'   => array( get_the_ID() ),
          'posts_per_page' => 3,
          'ignore_sticky_posts' => 1,
        ) );

        if ( $related->have_posts() ) : ?>
          <section class="mt-10">
            <h3 class="text-lg font-semibold mb-4">Related posts</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="block bg-white rounded-lg p-3 shadow-sm hover:shadow-md border">
                  <div class="mb-2">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-28 object-cover rounded' ) ); ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url( get_template_directory_uri() . '/img/nexlint-logo.jpg' ); ?>" class="w-full h-28 object-cover rounded" alt="" />
                    <?php endif; ?>
                  </div>
                  <h4 class="text-sm font-medium"><?php the_title(); ?></h4>
                </a>
              <?php endwhile; wp_reset_postdata(); ?>
            </div>
          </section>
        <?php endif;
      endif;
      ?>

      

    </article>

  <?php endwhile; else : ?>
    <p class="text-center text-gray-500">No post found.</p>
  <?php endif; ?>
  </div>


