# Display Social Media Links Anywhere with UM Show Socials

**UM Show Socials** is a WordPress plugin that leverages the power of Ultimate Member (UM) to seamlessly integrate a shortcode for showcasing authors' or users' social media profiles on your website.

## Installation
To integrate UM Show Socials into your website, follow these steps:

1. Copy the contents of `dmkrtz_um_show_socials.php`.
2. Paste the copied content into your theme's `functions.php` file or any other location where you manage custom functions.

## Usage
Easily display social media links with the `[um-show-socials]` shortcode within your post or page templates. This shortcode offers the flexibility to present author social links wherever you prefer.

- When used in posts and pages, the shortcode will retrieve the social links of the respective author.
- In all other instances, the shortcode will exhibit social links of the currently logged in or queried user.

## Attributes
The `[um-show-socials]` shortcode supports the following attributes:

- **style:** Customize the `<div>` element's style attribute by providing the desired styling options.
- **force-user:** By using this attribute, the shortcode displays the social media links of the currently logged in user, regardless of the context.

### Examples
1. `[um-show-socials style="text-align: center;"]`
   Output: `<div class='um-profile-connect um-member-connect' style="text-align: center;">`
   
2. `[um-show-socials force-user]`
   Effect: Ensures the display of social media links for the currently logged in user, overriding any post or page author details.

## Dependencies
To utilize this shortcode, it is essential to have the [Ultimate Member](https://ultimatemember.com/) plugin installed on your WordPress site.

A built-in function check within the shortcode ensures compatibility and displays an error message if the "UM" class is unavailable.
