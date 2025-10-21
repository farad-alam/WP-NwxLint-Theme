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