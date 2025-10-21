<?php
/**
 * The template for displaying archive pages
 *
 * @package Your_Theme_Name
 */

get_header();
?>

<main class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-8/12">
            <header class="mb-8 border-b border-gray-200 pb-6">
                <?php if (have_posts()) : ?>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        <?php
                        if (is_category()) {
                            printf(__('Category: %s', 'your-theme-textdomain'), single_cat_title('', false));
                        } elseif (is_tag()) {
                            printf(__('Tag: %s', 'your-theme-textdomain'), single_tag_title('', false));
                        } elseif (is_author()) {
                            printf(__('Author: %s', 'your-theme-textdomain'), get_the_author());
                        } elseif (is_date()) {
                            if (is_year()) {
                                printf(__('Year: %s', 'your-theme-textdomain'), get_the_date('Y'));
                            } elseif (is_month()) {
                                printf(__('Month: %s', 'your-theme-textdomain'), get_the_date('F Y'));
                            } elseif (is_day()) {
                                printf(__('Day: %s', 'your-theme-textdomain'), get_the_date('F j, Y'));
                            }
                        } else {
                            echo get_the_archive_title();
                        }
                        ?>
                    </h1>
                    
                    <?php
                    $description = get_the_archive_description();
                    if ($description) : ?>
                        <div class="text-gray-600 text-lg leading-relaxed">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </header>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="aspect-w-16 aspect-h-9">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', array(
                                            'class' => 'w-full h-48 object-cover'
                                        )); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <time datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                    <span class="mx-2">•</span>
                                    <span><?php echo reading_time(); ?></span>
                                </div>
                                
                                <h2 class="text-xl font-bold text-gray-900 mb-3">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="text-gray-600 mb-4 line-clamp-3">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" 
                                                   class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full hover:bg-blue-200 transition-colors">' .
                                                   esc_html($categories[0]->name) . '</a>';
                                        }
                                        ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" 
                                       class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="col-span-full text-center py-12">
                        <h2 class="text-2xl font-bold text-gray-600 mb-4">
                            <?php _e('No posts found', 'your-theme-textdomain'); ?>
                        </h2>
                        <p class="text-gray-500">
                            <?php _e('Sorry, but nothing matched your archive criteria.', 'your-theme-textdomain'); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if (have_posts()) : ?>
                <div class="flex justify-center items-center space-x-2 mb-8">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('&larr; Previous', 'your-theme-textdomain'),
                        'next_text' => __('Next &rarr;', 'your-theme-textdomain'),
                        'class'     => 'pagination',
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="lg:w-4/12">
            <div class="space-y-6">
                <!-- Search Widget -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Search</h3>
                    <?php get_search_form(); ?>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Categories</h3>
                    <ul class="space-y-2">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
                            'number'  => 8
                        ));
                        
                        foreach ($categories as $category) {
                            echo '<li><a href="' . get_category_link($category->term_id) . '" 
                                   class="text-gray-600 hover:text-blue-600 flex justify-between items-center py-1">
                                   <span>' . $category->name . '</span>
                                   <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">' . $category->count . '</span>
                                 </a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- Recent Posts Widget -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Recent Posts</h3>
                    <ul class="space-y-3">
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        
                        foreach ($recent_posts as $post) {
                            echo '<li class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded overflow-hidden">
                                        ' . get_the_post_thumbnail($post['ID'], 'thumbnail', array('class' => 'w-full h-full object-cover')) . '
                                    </div>
                                    <div>
                                        <a href="' . get_permalink($post['ID']) . '" 
                                           class="text-gray-900 hover:text-blue-600 font-medium text-sm leading-tight">
                                           ' . $post['post_title'] . '
                                        </a>
                                        <div class="text-gray-500 text-xs mt-1">' . get_the_date('', $post['ID']) . '</div>
                                    </div>
                                  </li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- Tags Widget -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $tags = get_tags(array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
                            'number'  => 15
                        ));
                        
                        foreach ($tags as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '" 
                                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full transition-colors">
                                   ' . $tag->name . '
                                 </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</main>

<?php
get_footer();
?>