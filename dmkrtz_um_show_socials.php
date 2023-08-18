add_shortcode("um-show-socials", "dmkrtz_um_show_socials");
function dmkrtz_um_show_socials( $atts ) {
	// make sure Ultimate Member is active
	if(class_exists('UM')) {
		/*
		 fetch a new um user, otherwise the code tries to get all user fields of currently logged in User
		 we want to get the user fields of the post author, most likely, when using the shortcode in a post
		 otherwise it will use the fields of the current user.
		*/
		if(is_single() || is_page()) {
			$author_id = get_the_author_meta( "ID" );
			um_fetch_user( $author_id );
		}
		
		// function show_social_urls() of ultimate_member/includes/core/class-fields.php
		$social = array();

		$fields = UM()->builtin()->get_all_user_fields();
		foreach ( $fields as $field => $args ) {
			if ( isset( $args['advanced'] ) && $args['advanced'] == 'social' ) {
				$social[ $field ] = $args;
			}
		}
		
		if($social) {
			$style = "";
			
			if(isset($atts['style'])) {
				$style = " style='" . $atts['style'] . "'";
			}
			
			$output = "<div class='um-profile-connect um-member-connect'$style>";
			
			foreach ( $social as $k => $arr ) {
				if ( um_profile( $k ) ) {
					if ( array_key_exists( 'match' , $arr ) ) {
						$match = is_array( $arr['match'] ) ? $arr['match'][0] : $arr['match'];
					} else {
						$match = null;
					}

					$output .= "<a href='" . esc_url( um_filtered_social_link( $k, $match ) ) . "' style='background: " . esc_attr( $arr['color'] ) . "; text-decoration: none;' target='" . esc_attr( $arr['url_target'] ?? "_blank" ) . "' class='um-tip-n' title='" . esc_attr( $arr['title'] ) . "'><i class='" . esc_attr( $arr['icon'] ) . "'></i></a>";
				}
			}
			
			$output .= '</div>';
			
			return __($output, "dmkrtz-um-show-socials");
		}
	}
	
	/* display error message for admin */
	if(current_user_can("manage_options"))
		return __("This shortcode only works with Ultimate Member", "dmkrtz-um-show-socials");
}
