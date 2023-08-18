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
	
    /* 
    Fetch the UM user for the post author if on a single post or page and 
		check if shortcode forces displaying socials of current user when including "force-user" attr 
    */
    if ((is_single() || is_page()) && (is_array($atts) && !in_array("force-user", $atts))) {
        um_fetch_user(get_the_author_meta("ID"));
    }

    // Get social fields
    $social = array_filter(UM()->builtin()->get_all_user_fields(), fn($args) => isset($args['advanced']) && $args['advanced'] == 'social');

    if (!$social) return; // No social fields found

    $style = isset($atts['style']) ? " style='{$atts['style']}'" : '';
    $output = "<div class='um-profile-connect um-member-connect'$style>";
	
    $hasnosocials = true;
    foreach ($social as $k => $arr) {
        if (!um_profile($k)) continue; // Skip non-existent social profiles
        $hasnosocials = false;
		
        $match = array_key_exists('match', $arr) ? (is_array($arr['match']) ? $arr['match'][0] : $arr['match']) : null;
		
        $output .= "<a href='" . esc_url(um_filtered_social_link($k, $match)) . "' style='background: " . esc_attr($arr['color']) . "; text-decoration: none;' target='" . esc_attr($arr['url_target'] ?? "_blank") . "' class='um-tip-n' title='" . esc_attr($arr['title']) . "'><i class='" . esc_attr($arr['icon']) . "'></i></a>";
    }
	
	if($hasnosocials)
		$output .= "None :(";

    $output .= '</div>';
    return __($output, "dmkrtz-um-show-socials");
}
