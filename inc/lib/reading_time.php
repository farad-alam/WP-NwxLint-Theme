<?php
// Add this to your theme's functions.php
function reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    if ($reading_time == 1) {
        return $reading_time . ' min read';
    } else {
        return $reading_time . ' mins read';
    }
}
?>