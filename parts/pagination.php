<?php 
        if (function_exists("nexlint_pagination")) {
          nexlint_pagination();
        } else {?>
          <?php previous_post_link(); ?>
          <?php next_post_link(); ?>
        <?php } ?>