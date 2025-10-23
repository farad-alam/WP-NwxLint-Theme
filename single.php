
<?php 
get_header();
?>
  <!-- Page content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Main column (left) -->
      <section class="lg:col-span-8">
       
        <!-- Blog Content -->
        <div class="space-y-6">
          <!-- Blog card (repeat for multiple posts) -->
           <?php get_template_part('parts/post_setup') ?>
        </div>
        
        <!-- Comments -->
      <div class="mt-12">
        <?php
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
        ?>
      </div>
      </section>

      <!-- Sidebar (right) -->

      <aside class="lg:col-span-4">
        <div class="space-y-6">
          <?php 
          get_sidebar()
          ?>

        </div>
         
      </aside>
    </div>
  </main>

<?php get_footer( ); ?>