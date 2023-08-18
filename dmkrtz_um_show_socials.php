<?php

/* https://github.com/dmkrtz/dmkrtz-um-show-socials */
add_shortcode("um-show-socials", "dmkrtz_um_show_socials");
function dmkrtz_um_show_socials($atts) {
    // Check if Ultimate Member is active
    if (!class_exists('UM')) {
        // Display error message for admin
        if (current_user_can("manage_options")) {
            return __("This shortcode only works with Ultimate Member", "dmkrtz-um-show-socials");
        }
        return;
    }

    // Fetch the um user for the post author if on a single post or page
    if (is_single() || is_page()) {
        um_fetch_user(get_the_author_meta("ID"));
    }

    // Get social fields
    $social = array_filter(UM()->builtin()->get_all_user_fields(), fn($args) => isset($args['advanced']) && $args['advanced'] == 'social');

    if (!$social) {
        return; // No social fields found
    }

    $style = isset($atts['style']) ? " style='{$atts['style']}'" : '';
    $output = "<div class='um-profile-connect um-member-connect'$style>";

    foreach ($social as $k => $arr) {
        if (!um_profile($k)) {
            continue; // Skip non-existent social profiles
        }

        $match = array_key_exists('match', $arr) ? (is_array($arr['match']) ? $arr['match'][0] : $arr['match']) : null;

        $output .= "<a href='" . esc_url(um_filtered_social_link($k, $match)) . "' style='background: " . esc_attr($arr['color']) . "; text-decoration: none;' target='" . esc_attr($arr['url_target'] ?? "_blank") . "' class='um-tip-n' title='" . esc_attr($arr['title']) . "'><i class='" . esc_attr($arr['icon']) . "'></i></a>";
    }

    $output .= '</div>';
    return __($output, "dmkrtz-um-show-socials");
}
