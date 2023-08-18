# dmkrtz-um-show-socials
WP x Ultimate Member function that adds a shortcode to show authors'/users' socials anywhere

## Installation
Paste the content of `dmkrtz_um_show_socials.php` into your theme functions.php or where ever you store your custom functions.

## Usage
Use the shortcode `[um-show-socials]` in your post or page template to echo the author social links anywhere you like.
For posts and pages the shortcode will retrieve the author social links.
Anywhere else it will display the currently queried/logged in user social links.

## Dependencies
Of course this shortcode needs the user plugin Ultimate Member in order to work.
A function check is included in the shortcode and will return an error message if the "UM" class doesn't exist.
