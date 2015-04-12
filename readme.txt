=== Slidr ===
Contributors: gsarig
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RTB3APJDMT9UN
Tags: carousel, image carousel, thumbnail slider, slideshow, gallery, image gallery
Requires at least: 4.0
Tested up to: 4.1.1
Stable tag: 1.0.1
License: GPLv2 or later

A clean, simple, responsive and touch-friendly Carousel with no bells and whistles but plenty of flexibility. 

== Description ==

Slidr is a clean, simple, responsive and touch-friendly multi-purpose Carousel. It takes a different approach than most other carousel plugins on that it displays posts or custom posts instead of just gallery photos (but it can show gallery photos as well if you like). Its goal is to be as flexible as possible, allowing you to fully customize its appearance via CSS and even overriding the default HTML output.

= Features =
* Responsive.
* Touch friendly.
* You can call it via a shortcode on posts, pages and widgets.
* Customizable queries with more than a dozen of parameters. You can adjust the post type, number of entries, thumbnail size, order and many more.
* You can have different carousels with different queries and different parameters on a single page.
* You can call it conditionally, to load scripts and styles only when needed.
* It can display entries without photos. For example, you can show the titles and excerpts of your recent posts (or custom posts) and style them however you like.
* You can add your custom class on each shortcode, to style each carousel differently.
* Works on every recent version of all popular browsers (Firefox, Chrome, Internet Explorer, Opera, Safari) including even Internet Explorer 8 (as long as your theme doesn't use  the HTML5 "gallery" element via add_theme_support()). 

== Installation ==

1. Upload Slidr plugin to your WordPress plugins directory and activate it. 
2. Go to Tools > Slidr to customize its options and learn how to use the shortcode.

== Frequently Asked Questions ==

= How can I create a carousel? =

Just go to the page you want to show your carousel and add the [slidr] shortcode. This should create a carousel with the default settings, meaning that it will get all the recent posts and display them in descending order. You can customize the output by overriding the default settings with your own values like so: [slidr parameter="value"]. For a full list of the available parameters, check the "Documentation" tab on the plugin's control panel. 

= Can I have more than one carousels in my website? =

Yes. You can create carousels on any post or page you like. Each one of them can accept different parameters.  

= Can I create two carousels on the same page? =

Yes. 

= Can I add a carousel directly in my PHP code? =

Yes. You can use "do_shortcode" like so: <code>&lt;?php echo do_shortcode( '[slidr]' ); ?&gt;</code>.  

= Instead of the title and excerpt I want to display my own content / metadata. Can I customize that output myself? =

Yes. You can override the output of the infobox by adding the following function in your theme's functions.php:
<code>
<?php function slidr_custom_content() {
	echo 'Your custom output here';
} ?>
</code>


= Why is the design so minimal? =

Slidr's main goal is to be lightweight and flexible, with the minimum possible restrictions when it comes to its styling. It comes with a predefined template which can be decativated for those who want to use their custom design. Therefore, to modify its appearance you need to have at least some knowledge of CSS. 


== Screenshots ==

1. The default style of the Carousel, used in the TwentyFifteen theme (that's what you get with no customization at all, just by adding [slidr] in a post/page)
2. The plugin's Settings main page
3. Managing the default settings
4. The documentation tab

== Changelog ==

= 1.0.1 =
* Use un-minified scripts, for better performance with 3rd-party minifiers.

= 1.0 =
* First release.

== Upgrade Notice ==

= 1.0.1 =
* Minor fix: Use un-minified scripts, for better performance with 3rd-party minifiers.

= 1.0 =
* Initial submittion to the WordPress.org repository