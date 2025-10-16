<?php 
/**
 * This Template for displaying the header
 * 
 */
?>

<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>" class="no-js">
<head>
    <meta charset="<?php bloginfo( "charset" ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<!-- Header Area -->


<header class="bg-white border-b">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="<?php esc_url( home_url("/")) ?>" class="flex items-center gap-3">
          <img src="<?php echo get_theme_mod( 'nexlint_logo', get_template_directory_uri() . '/img/nexlint-logo.jpg' ); ?>" alt="Logo" class="w-10 h-10 rounded-md object-cover">
          <span class="text-xl font-semibold tracking-tight">
            <?php bloginfo( "name"); ?>
            <!-- <?php echo esc_html( get_theme_mod("nexlint_tagline")); ?> -->
            
          </span>
          <p class="text-[10px]"></p>
          
          
        </a>
      </div>

      <!-- Desktop nav -->
      
      <?php 
      
        wp_nav_menu( array(
          'theme_location'  => 'main_menu',   // make sure this is registered in functions.php
          'container'       => 'nav',         // nav element wrapper
          'container_id'    => 'site-nav',    // outer container id (unique)
          'container_class' => 'site-nav-wrap',
          'menu_id'         => 'main-menu',   // id for the <ul>
          'menu_class'      => 'menu',        // class for the <ul> (we'll style .menu)
          'depth'           => 3,
          'fallback_cb'     => false,
        ) );
      ?>
      <div class="hidden lg:flex" >
        <a class="text-decoration-none px-5 py-3 rounded-xl bg-blue-500 text-blue-50" href="/">Contact Us</a>
      </div>

</header>

<main>
  <p>NexLint Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perspiciatis rem unde expedita excepturi blanditiis vero inventore facilis eos dolore necessitatibus.</p>
<h1 class="text-2xl" >Hello NexLint</h1>
</main>







    <?php  wp_footer(); ?>
</body>
</html>