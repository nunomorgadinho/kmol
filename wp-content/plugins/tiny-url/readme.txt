=== Tiny URL ===
Contributors: prasannasp
Donate link: http://www.prasannasp.net/donate/
License: GPLv3
License URI: http://www.gnu.org/copyleft/gpl.html
Tags: TinyURL, Tiny URL, ShortURL, Short URL, short link, ShortLink, post
Requires at least: 2.5
Tested up to: 3.4.2
Stable tag: 1.3

Show a Tiny URL for all of your blog posts

== Description ==

This plugin shows Tiny URL for each of your blog posts after post content. Tiny URLs are great for sharing your posts on micro-blogging sites like twitter, identi.ca etc., This plugin sends the URL of current post to <a href="http://tinyurl.com">TinyURL.com</a> and gets a Tiny URL for the same. Then it shows that Tiny URL after post content. User can just click on the box to select URL, or click on Copy button to Copy the Tiny URL to clipboard. You can also show Tiny URL for pages by selecting <em>Show Tiny URL on pages</em> option in plugin settings page.

<strong>Note:</strong> Please read TinyURL's <a href="http://tinyurl.com/#terms">terms of use</a> before activating the plugin. You must abide by them after activating the plugin. TinyURL is a trademark of TinyURL, LLC

Visit <a href="http://www.prasannasp.net/wordpress-plugins/">this page</a> for more <strong>WordPress Plugins</strong> from the developer.

== Installation ==

1. Upload the `tiny-url` folder to the `/wp-content/plugins/` directory
2. Activate the Tiny URL plugin through the 'Plugins' menu in WordPress
3. Plugin will automatically add Tiny URLs for blog posts

== Screenshots ==

1. Plugin showing Tiny URL for a blog post
2. Tiny URL with Copy button
3. Tiny URL options page

== Frequently Asked Questions ==

= Where can I get help from? =

Post your questions or report issue in the <a href="http://forum.prasannasp.net/forum/plugin-support/tiny-url/">support forum</a>. You can directly contact the developer using this <a href="http://www.prasannasp.net/contact/">contact form</a>.

= Does it show Tiny URLs for pages as well? =

Yes, it does. But, you need to enable this feature on Tiny URL plugin options page.

= Copy button is not showing up next to Tiny URL. Why? =

Make sure you've selected <strong>Show Copy URL button</strong> in Tiny URL options.

= Copy URL to clipboard is not working =

This function requires flash. Make sure the flash player is installed in your system

== Other Notes ==

= How to style the output? =

The output of this plugin is wrapped in `<p>` tag. Use `.tiny-url` CSS class to style it
Example,

`.tiny-url {
color: #FF0000;
}`

= How to change the style of Copy button? =

Use CSS class `.tiny-url-button` to change it's style.
Example:

`.tiny-url-button {
background: #123456;
color: #654321;
}`

== Changelog ==

= 1.3 =

* Added option to copy URL to clipboard with a single mouse click
* Code enhancements

= 1.2.1 =

* Fixed the issue of select Tiny URL script not being loaded on pages when Tiny URL is enabled for pages.

= 1.2 =

* Added option to show Tiny URL for <strong>pages</strong> as well. This will be disabled by default. User has to enable this on plugin settings page

= 1.1 =

* Added option to change Tiny URL title (Tiny URL for this post:). You can change this in Tiny URL options page on WP-Admin

= 1.0 =

* Initial public release.

== Upgrade Notice ==
* No Upgrade Notice so far.
