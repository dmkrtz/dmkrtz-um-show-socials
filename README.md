# UM Show Socials Anywhere
WP x Ultimate Member function that adds a shortcode to show authors'/users' socials anywhere

## Installation
Paste the content of `dmkrtz_um_show_socials.php` into your theme functions.php or where ever you store your custom functions.

## Usage
Use the shortcode `[um-show-socials]` in your post or page template to echo the author social links anywhere you like.

For posts and pages the shortcode will retrieve the author social links.

Anywhere else it will display the currently queried/logged in user social links.

## Attributes
The shortcode allows these attributes:
- style (allows to populate the `<div>` style attribute)
- force-user (set to "true" to force showing current user socials)

### Examples
- `[um-show-socials style="text-align: center;"]`
-> `<div class='um-profile-connect um-member-connect' style="text-align: center;">`
- `[um-show-socials force-user="true"]`
-> prevents fetching the post or page author

## Dependencies
Of course this shortcode needs the user plugin [Ultimate Member](https://ultimatemember.com/) in order to work.

A function check is included in the shortcode and will return an error message if the "UM" class doesn't exist.
