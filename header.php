<?php 
/**
 * This Template for displaying the header
 * 
 */
?>

<?php 
$menu_position = get_theme_mod("nexlint_menu_position_setting", "left_menu");
$menu_position === "right_menu" ? "flex-row-reverse" : ( $menu_position === "center_menu" ? "justify-center" : "justify-between");



$menu_position = get_theme_mod('nexlint_menu_position_setting', 'left_menu');
$flex_class = 'justify-between'; // default

if ( $menu_position === 'right_menu' ) {
  $flex_class = 'flex-row-reverse justify-center';
} elseif ( $menu_position === 'center_menu' ) {
  $flex_class = 'flex-col py-7';
}

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
    <div class="flex <?= $flex_class ?> items-center">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="<?= esc_url( home_url("/")) ?>" class="flex items-center gap-3">
          <img src="<?php echo get_theme_mod( 'nexlint_logo', get_template_directory_uri() . '/img/nexlint-logo.jpg' ); ?>" alt="Logo" class="w-10 h-10 rounded-md object-cover">
          <span class="text-xl font-semibold tracking-tight">
            <?php bloginfo( "name"); ?>
          </span>
        </a>
      </div>

      <!-- nav -->
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
      <!-- Button -->
      <div class="hidden lg:flex" >
        <a class="text-decoration-none px-3 py-2 rounded-xl bg-blue-500 text-blue-50" href="/">Contact Us</a>
      </div>
    </div>
  </div>
</header>