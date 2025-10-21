<?php 
get_header();
?>


  <!-- Page content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Main column (left) -->
      <section class="lg:col-span-8">
        <h1 class="text-3xl font-bold mb-6">Latest Articles</h1>

        <!-- Blog list -->
        <div class="space-y-6">
          <!-- Blog card (repeat for multiple posts) -->
            <?php 
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        // Get thumbnail URL if exists, otherwise use a fallback
        if ( has_post_thumbnail() ) {
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
        } else {
            // Replace with your default image path or leave empty to skip the img tag
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
                <a href="#" class="text-xs inline-block bg-indigo-50 text-indigo-600 rounded-full px-3 py-1 font-medium">Tutorial</a>
                <h2 class="mt-3 text-xl font-semibold">
                  <a href="<?php the_permalink(); ?>" class="hover:text-indigo-600"><?php the_title(); ?></a>
                </h2>
                <p class="mt-2 text-sm text-gray-600"><?php the_excerpt(); ?></p>
              </div>

              <div class="mt-4 flex items-center justify-between">
                <div class="text-xs text-gray-500"><?php echo get_the_date( 'M j, Y' ); ?> • <?php echo esc_html( get_post_meta( get_the_ID(), 'reading_time', true ) ?: '5 min read' ); ?></div>
                <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-sm font-medium px-3 py-1.5 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Read more
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
              </div>
            </div>
          </div>
        </article>

    <?php
    endwhile;
else :
    _e( "No posts found", 'faradalam' );
endif;
?>


        
          <!-- More cards... (you can copy/paste and change content) -->

        </div>

        <!-- Pagination (simple) -->
        <!-- <nav class="mt-8 flex items-center justify-between bg-white px-4 py-3 rounded-md border border-gray-100">
          <div class="text-sm text-gray-600">Showing 1–6 of 24 results</div>
          <div class="flex items-center gap-2">
            <a href="#" class="px-3 py-1 border rounded-md text-sm">Prev</a>
            <a href="#" class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm">1</a>
            <a href="#" class="px-3 py-1 border rounded-md text-sm">2</a>
            <a href="#" class="px-3 py-1 border rounded-md text-sm">Next</a>
          </div>
        </nav> -->

        <?php 
        if (function_exists("nexlint_pagination")) {
          nexlint_pagination();
        } else {?>
          <?php previous_post_link(); ?>
          <?php next_post_link(); ?>
        <?php } ?>


      </section>

      <!-- Sidebar (right) -->
      <aside class="lg:col-span-4">
        <div class="space-y-6">
          <!-- Search widget -->
          <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Search</h3>
            <form>
              <label for="search-sidebar" class="sr-only">Search posts</label>
              <div class="flex gap-2">
                <input id="search-sidebar" type="text" placeholder="Search posts" class="flex-1 border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                <button class="px-3 py-2 rounded-md bg-indigo-600 text-white text-sm">Go</button>
              </div>
            </form>
          </div>

          <!-- Categories widget -->
          <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Categories</h3>
            <ul class="text-sm space-y-2 text-gray-600">
              <li><a href="#" class="hover:text-indigo-600">Tutorials <span class="text-gray-400">(12)</span></a></li>
              <li><a href="#" class="hover:text-indigo-600">Reviews <span class="text-gray-400">(8)</span></a></li>
              <li><a href="#" class="hover:text-indigo-600">Opinion <span class="text-gray-400">(4)</span></a></li>
              <li><a href="#" class="hover:text-indigo-600">News <span class="text-gray-400">(6)</span></a></li>
            </ul>
          </div>

          <!-- Recent posts widget -->
          <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Recent posts</h3>
            <ul class="space-y-3">
              <li class="flex items-center gap-3">
                <img src="https://images.unsplash.com/photo-1508921912186-1d1a45ebb3c1?q=80&w=200&auto=format&fit=crop&ixlib=rb-4.0.3&s=rp" alt="thumb" class="w-12 h-8 object-cover rounded" />
                <div class="text-sm">
                  <a href="#" class="font-medium hover:text-indigo-600">Small-screen camera review</a>
                  <div class="text-xs text-gray-400">Oct 2, 2025</div>
                </div>
              </li>
              <li class="flex items-center gap-3">
                <img src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=200&auto=format&fit=crop&ixlib=rb-4.0.3&s=rp2" alt="thumb" class="w-12 h-8 object-cover rounded" />
                <div class="text-sm">
                  <a href="#" class="font-medium hover:text-indigo-600">Top 5 budget phones</a>
                  <div class="text-xs text-gray-400">Sep 26, 2025</div>
                </div>
              </li>
            </ul>
          </div>

          <!-- Newsletter widget -->
          <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Subscribe</h3>
            <p class="text-sm text-gray-600 mb-3">Get new posts in your inbox once a week.</p>
            <form>
              <label for="email-sub" class="sr-only">Email</label>
              <input id="email-sub" type="email" placeholder="Your email" class="w-full border rounded-md px-3 py-2 text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
              <button class="w-full px-4 py-2 rounded-md bg-indigo-600 text-white">Subscribe</button>
            </form>
          </div>

          <!-- Tags -->
          <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Tags</h3>
            <div class="flex flex-wrap gap-2">
              <a href="#" class="text-xs px-2 py-1 rounded-md border">tailwind</a>
              <a href="#" class="text-xs px-2 py-1 rounded-md border">responsive</a>
              <a href="#" class="text-xs px-2 py-1 rounded-md border">gadgets</a>
              <a href="#" class="text-xs px-2 py-1 rounded-md border">tutorial</a>
            </div>
          </div>

        </div>
      </aside>
    </div>
  </main>






<?php get_footer( ); ?>