<?php
/**
 * The template for displaying author archive pages
 *
 * @package Your_Theme_Name
 */

get_header();

// Get author information
$author_id = get_queried_object_id();
$author = get_userdata($author_id);
?>

<main class="container mx-auto px-4 py-8">
    <!-- Author Header Section -->
    <section class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <!-- Author Avatar -->
            <div class="flex-shrink-0">
                <?php echo get_avatar($author_id, 120, '', '', array('class' => 'rounded-full w-24 h-24 md:w-32 md:h-32')); ?>
            </div>
            
            <!-- Author Information -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                    <?php echo esc_html($author->display_name); ?>
                </h1>
                
                <?php if ($author->user_description) : ?>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        <?php echo esc_html($author->user_description); ?>
                    </p>
                <?php endif; ?>
                
                <!-- Author Stats -->
                <div class="flex flex-wrap justify-center md:justify-start gap-6 text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span><?php echo count_user_posts($author_id); ?> Articles</span>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <span><?php echo get_comments(array('user_id' => $author_id, 'count' => true)); ?> Comments</span>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Member since <?php echo date('F Y', strtotime($author->user_registered)); ?></span>
                    </div>
                </div>
                
                <!-- Author Social Links -->
                <?php
                $social_links = array(
                    'website' => array(
                        'url' => $author->user_url,
                        'icon' => 'fas fa-globe',
                        'label' => 'Website'
                    ),
                    'twitter' => array(
                        'url' => get_the_author_meta('twitter', $author_id),
                        'icon' => 'fab fa-twitter',
                        'label' => 'Twitter'
                    ),
                    'facebook' => array(
                        'url' => get_the_author_meta('facebook', $author_id),
                        'icon' => 'fab fa-facebook',
                        'label' => 'Facebook'
                    ),
                    'instagram' => array(
                        'url' => get_the_author_meta('instagram', $author_id),
                        'icon' => 'fab fa-instagram',
                        'label' => 'Instagram'
                    ),
                    'linkedin' => array(
                        'url' => get_the_author_meta('linkedin', $author_id),
                        'icon' => 'fab fa-linkedin',
                        'label' => 'LinkedIn'
                    )
                );
                
                $has_social_links = false;
                foreach ($social_links as $network => $data) {
                    if (!empty($data['url'])) {
                        $has_social_links = true;
                        break;
                    }
                }
                
                if ($has_social_links) : ?>
                <div class="flex justify-center md:justify-start space-x-4 mt-4">
                    <?php foreach ($social_links as $network => $data) : ?>
                        <?php if (!empty($data['url'])) : ?>
                            <a href="<?php echo esc_url($data['url']); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="text-gray-400 hover:text-blue-600 transition-colors"
                               aria-label="<?php echo esc_attr($data['label']); ?>">
                                <i class="<?php echo $data['icon']; ?> text-xl"></i>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-8/12">
            <!-- Featured Articles (if any) -->
            <?php
            $featured_posts = new WP_Query(array(
                'author' => $author_id,
                'posts_per_page' => 2,
                'meta_key' => 'featured',
                'meta_value' => 'yes'
            ));
            
            if ($featured_posts->have_posts()) : ?>
            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-blue-600 pl-4">Featured Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
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
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <div class="text-gray-600 mb-4 line-clamp-2">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Featured
                                        </span>
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
                    <?php wp_reset_postdata(); ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- All Articles -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-blue-600 pl-4">All Articles</h2>
                
                <?php if (have_posts()) : ?>
                    <div class="space-y-6">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="md:w-48 flex-shrink-0">
                                            <a href="<?php the_permalink(); ?>" class="block">
                                                <?php the_post_thumbnail('medium', array(
                                                    'class' => 'w-full h-32 md:h-full object-cover rounded-lg'
                                                )); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center text-sm text-gray-500 mb-2">
                                            <time datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                            <span class="mx-2">•</span>
                                            <span><?php echo reading_time(); ?></span>
                                        </div>
                                        
                                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                                            <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        
                                        <div class="text-gray-600 mb-4">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
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
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center items-center space-x-2 mt-8">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => __('&larr; Previous', 'your-theme-textdomain'),
                            'next_text' => __('Next &rarr;', 'your-theme-textdomain'),
                            'class'     => 'pagination',
                        ));
                        ?>
                    </div>
                <?php else : ?>
                    <div class="text-center py-12">
                        <h3 class="text-2xl font-bold text-gray-600 mb-4">
                            <?php _e('No articles found', 'your-theme-textdomain'); ?>
                        </h3>
                        <p class="text-gray-500">
                            <?php _e('This author hasn\'t published any articles yet.', 'your-theme-textdomain'); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="lg:w-4/12">
            <div class="space-y-6">
                <!-- Author Popular Categories -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Author's Top Categories</h3>
                    <ul class="space-y-2">
                        <?php
                        $author_categories = get_categories(array(
                            'author' => $author_id,
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 6
                        ));
                        
                        if (!empty($author_categories)) {
                            foreach ($author_categories as $category) {
                                echo '<li><a href="' . get_category_link($category->term_id) . '" 
                                       class="text-gray-600 hover:text-blue-600 flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                                       <span>' . $category->name . '</span>
                                       <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">' . $category->count . '</span>
                                     </a></li>';
                            }
                        } else {
                            echo '<li class="text-gray-500 text-sm">No categories found</li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- Author Popular Tags -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Author's Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $author_tags = get_tags(array(
                            'author' => $author_id,
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 12
                        ));
                        
                        if (!empty($author_tags)) {
                            foreach ($author_tags as $tag) {
                                echo '<a href="' . get_tag_link($tag->term_id) . '" 
                                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full transition-colors">
                                       ' . $tag->name . ' <span class="text-xs text-gray-500">(' . $tag->count . ')</span>
                                     </a>';
                            }
                        } else {
                            echo '<p class="text-gray-500 text-sm">No tags found</p>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Contact Author -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">Contact Author</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Want to get in touch with <?php echo esc_html($author->display_name); ?>?
                    </p>
                    <a href="mailto:<?php echo esc_attr($author->user_email); ?>" 
                       class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center block">
                        Send Email
                    </a>
                </div>
            </div>
        </aside>
    </div>
</main>

<?php
get_footer();
?>