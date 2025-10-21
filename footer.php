<?php
/**
 * Footer template
 */
?>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About Section (left, spans 2 cols) -->
                <!-- Quick Links (Footer 1) -->
                <div class="lg:col-span-2">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else: ?>
                        <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog Categories</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Write for Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Newsletter (Footer 2) -->
                <div>
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php else: ?>
                        <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                        <p class="text-gray-400 mb-4">Subscribe to our newsletter for the latest updates and articles.</p>
                        <form class="space-y-2">
                            <input type="email" placeholder="Your email address" 
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Subscribe
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- Footer 3 (extra widget) -->
                <div class="lg:col-span-1">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    <?php else: ?>
                        <!-- optional fallback content -->
                        <h3 class="text-xl font-bold mb-4">More</h3>
                        <p class="text-gray-400 text-sm">Add extra info or links here via Widgets → Appearance → Widgets.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
