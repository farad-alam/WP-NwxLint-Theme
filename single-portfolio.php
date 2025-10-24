<?php get_header(); ?>

<?php
// Ensure global post is available
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<section class="container max-w-7xl mx-auto py-12 px-4">
  <!-- Hero / title area -->
  <header class="mb-8">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-3"><?php the_title(); ?></h1>

    <!-- Meta row: date, categories (if any), back to archive -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 mb-4">
      <div class="flex items-center gap-4">
        <span><?php echo get_the_date(); ?></span>
        <?php
          // show terms if you registered a taxonomy, adjust 'portfolio_category' to your taxonomy slug
          $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
          if ( $terms && ! is_wp_error( $terms ) ) : ?>
            <span class="hidden sm:inline">•</span>
            <div class="flex items-center gap-2">
              <?php foreach ( $terms as $term ) : ?>
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                   class="text-blue-600 hover:underline"><?php echo esc_html( $term->name ); ?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
      </div>

      <div class="mt-3 sm:mt-0">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"
           class="text-sm text-gray-700 hover:underline">&larr; Back to portfolio</a>
      </div>
    </div>
  </header>

  <!-- Layout: main content + sidebar on md+ -->
  <div class="flex flex-col lg:flex-row lg:items-start lg:gap-12">

    <!-- Main column -->
    <main class="w-full lg:w-3/4">

      <!-- Featured image / gallery -->
      <?php if ( has_post_thumbnail() ) : ?>
        <figure class="mb-6">
          <!-- Use the_post_thumbnail for srcset/responsive images -->
          <?php the_post_thumbnail( 'large', ['class' => 'w-full h-[460px] object-cover rounded-lg shadow-sm'] ); ?>
        </figure>
      <?php endif; ?>

      <!-- Optional gallery: if you store gallery URLs in custom field 'project_gallery' (array of IDs) -->
      <?php
        $gallery = get_post_meta( get_the_ID(), 'project_gallery', true ); // expects array of attachment IDs
        if ( is_array( $gallery ) && ! empty( $gallery ) ) :
      ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
          <?php foreach ( $gallery as $att_id ) : ?>
            <?php $img = wp_get_attachment_image( $att_id, 'medium', false, ['class' => 'w-full h-36 object-cover rounded'] ); ?>
            <div class="overflow-hidden rounded"><?php echo $img; ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- The content area: project description -->
      <article class="prose prose-lg max-w-none mb-8">
        <?php the_content(); ?>
      </article>

      <!-- Project details box (custom fields) -->
      <div class="bg-white border rounded-lg shadow-sm p-6 mb-8">
        <h3 class="text-xl font-semibold mb-3">Project details</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <?php
            // Example custom fields: client, date, website, technologies
            $client = get_post_meta( get_the_ID(), 'project_client', true );
            $project_date = get_post_meta( get_the_ID(), 'project_date', true );
            $website = get_post_meta( get_the_ID(), 'project_website', true );
            $tech = get_post_meta( get_the_ID(), 'project_technologies', true ); // comma separated or array
          ?>
          <?php if ( $client ) : ?><li><strong>Client:</strong> <?php echo esc_html( $client ); ?></li><?php endif; ?>
          <?php if ( $project_date ) : ?><li><strong>Date:</strong> <?php echo esc_html( $project_date ); ?></li><?php endif; ?>
          <?php if ( $website ) : ?><li><strong>Website:</strong> <a href="<?php echo esc_url( $website ); ?>" class="text-blue-600 hover:underline" target="_blank" rel="noopener"><?php echo esc_html( $website ); ?></a></li><?php endif; ?>
          <?php if ( $tech ) : ?><li><strong>Technologies:</strong> <?php echo esc_html( $tech ); ?></li><?php endif; ?>
        </ul>
      </div>

      <!-- Related projects: simple query by same taxonomy (if exists) -->
      <?php
        // Only show related if taxonomy exists and we have terms
        if ( $terms && ! is_wp_error( $terms ) ) :
          $term_ids = wp_list_pluck( $terms, 'term_id' );
          $related = new WP_Query( [
            'post_type' => 'portfolio',
            'posts_per_page' => 3,
            'post__not_in' => [ get_the_ID() ],
            'tax_query' => [
              [
                'taxonomy' => 'portfolio_category',
                'field'    => 'term_id',
                'terms'    => $term_ids,
              ],
            ],
          ] );
          if ( $related->have_posts() ) :
      ?>
        <div class="mt-8">
          <h3 class="text-2xl font-semibold mb-4">Related Projects</h3>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
              <a href="<?php the_permalink(); ?>" class="block border rounded-lg overflow-hidden hover:shadow-md">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'medium', ['class' => 'w-full h-36 object-cover'] ); ?>
                <?php endif; ?>
                <div class="p-3">
                  <h4 class="text-sm font-medium"><?php the_title(); ?></h4>
                </div>
              </a>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        </div>
      <?php
          endif; // related have_posts
        endif; // terms exists
      ?>

    </main>

    <!-- Sidebar column -->
    <aside class="w-full lg:w-1/4 mt-8 lg:mt-0">
      <div class="lg:sticky lg:top-24 space-y-6">
        <!-- Author / meta card -->
        <div class="bg-white border rounded p-4 shadow-sm">
          <h4 class="text-sm font-semibold mb-2">Project author</h4>
          <div class="flex items-center gap-3">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
            <div>
              <div class="text-sm font-medium"><?php the_author_posts_link(); ?></div>
              <div class="text-xs text-gray-500"><?php the_author_meta( 'description' ); ?></div>
            </div>
          </div>
        </div>

        <!-- Quick links / actions -->
        <div class="bg-white border rounded p-4 shadow-sm">
          <h4 class="text-sm font-semibold mb-2">Project links</h4>
          <ul class="text-sm space-y-2">
            <?php if ( $website ) : ?><li><a href="<?php echo esc_url( $website ); ?>" class="hover:underline text-blue-600" target="_blank" rel="noopener">Live website</a></li><?php endif; ?>
            <li><a href="<?php the_permalink(); ?>#contact" class="hover:underline">Contact for similar project</a></li>
            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="hover:underline">All projects</a></li>
          </ul>
        </div>

        <!-- Sidebar widgets: default sidebar area (optional) -->
        <div class="bg-white border rounded p-4 shadow-sm">
          <?php if ( is_active_sidebar( 'sidebar-portfolio' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-portfolio' ); ?>
          <?php else: ?>
            <?php get_sidebar(); // fallback to default sidebar ?>
          <?php endif; ?>
        </div>
      </div>
    </aside>

  </div> <!-- end layout -->
</section>

<?php
endwhile; endif;
?>

<?php get_footer(); ?>

