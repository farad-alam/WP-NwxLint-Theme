<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area mt-12">

    <?php if ( have_comments() ) : ?>
        <h3 class="text-xl font-semibold mb-6">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( _x( 'One Comment', 'comments title', 'nexlint' ) );
            } else {
                printf(
                    _nx(
                        '%1$s Comment',
                        '%1$s Comments',
                        $comments_number,
                        'comments title',
                        'nexlint'
                    ),
                    number_format_i18n( $comments_number )
                );
            }
            ?>
        </h3>

        <ol class="comment-list space-y-6">
            <?php
            wp_list_comments([
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback' => null, // You can make custom markup here later
            ]);
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="comment-navigation">
                <?php
                paginate_comments_links([
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                ]);
                ?>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    // Display the comment form (includes name/email fields automatically)
    comment_form([
        'class_form'         => 'space-y-4 mt-8',
        'class_submit'       => 'bg-secondary text-white px-4 py-2 rounded hover:bg-hover transition',
        'title_reply_before' => '<h3 class="text-lg font-semibold">',
        'title_reply_after'  => '</h3>',
        'comment_field'      => '
            <p class="comment-form-comment">
                <label for="comment" class="block font-medium">Comment</label>
                <textarea id="comment" name="comment" cols="45" rows="5" required class="w-full border border-gray-300 rounded-lg p-2"></textarea>
            </p>
        ',
        'fields' => [
            'author' => '
                <p class="comment-form-author">
                    <label for="author" class="block font-medium">Name</label>
                    <input id="author" name="author" type="text" value="" size="30" required class="w-full border border-gray-300 rounded-lg p-2">
                </p>
            ',
            'email' => '
                <p class="comment-form-email">
                    <label for="email" class="block font-medium">Email</label>
                    <input id="email" name="email" type="email" value="" size="30" required class="w-full border border-gray-300 rounded-lg p-2">
                </p>
            ',
            'url' => '
                <p class="comment-form-url">
                    <label for="url" class="block font-medium">Website (optional)</label>
                    <input id="url" name="url" type="url" value="" size="30" class="w-full border border-gray-300 rounded-lg p-2">
                </p>
            ',
        ],
    ]);
    ?>

</div>
