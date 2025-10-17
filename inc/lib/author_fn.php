<?php
// Add author social media fields to user profile
function add_author_social_fields($user) {
    ?>
    <h3>Social Media Profiles</h3>
    <table class="form-table">
        <tr>
            <th><label for="twitter">Twitter</label></th>
            <td>
                <input type="url" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" />
                <p class="description">Enter your Twitter profile URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="facebook">Facebook</label></th>
            <td>
                <input type="url" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" />
                <p class="description">Enter your Facebook profile URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="instagram">Instagram</label></th>
            <td>
                <input type="url" name="instagram" id="instagram" value="<?php echo esc_attr(get_the_author_meta('instagram', $user->ID)); ?>" class="regular-text" />
                <p class="description">Enter your Instagram profile URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="linkedin">LinkedIn</label></th>
            <td>
                <input type="url" name="linkedin" id="linkedin" value="<?php echo esc_attr(get_the_author_meta('linkedin', $user->ID)); ?>" class="regular-text" />
                <p class="description">Enter your LinkedIn profile URL</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_author_social_fields');
add_action('edit_user_profile', 'add_author_social_fields');

// Save author social media fields
function save_author_social_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    
    update_user_meta($user_id, 'twitter', sanitize_text_field($_POST['twitter']));
    update_user_meta($user_id, 'facebook', sanitize_text_field($_POST['facebook']));
    update_user_meta($user_id, 'instagram', sanitize_text_field($_POST['instagram']));
    update_user_meta($user_id, 'linkedin', sanitize_text_field($_POST['linkedin']));
}
add_action('personal_options_update', 'save_author_social_fields');
add_action('edit_user_profile_update', 'save_author_social_fields');
?>