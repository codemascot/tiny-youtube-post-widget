=== Tiny YouTube Post Widget ===
Contributors: rnaby
Tags: widget, youtube, meta-box, video
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: 3.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a widget to display different YouTube videos in widget assigned for different posts or pages.

== Description ==

This is a widget to display different YouTube videos in widget assigned for different posts or pages. 

Just go to the post or page create admin and you'll get a meta box where you've to put your YouTube URL. Then hit publish. After that go to your widget admin and place the widget. 
If you wanna give any title, you have to give it in title box. You also can provide the height of the video size. Then hit save. Now go to the front end and see the magic.

= Features =


*   Assing video to any kind of post types(Post, Page or any kind of custom post type).
*   Define single as well as multiple post types in which the plugin will enable the YouTube URL field.
*   Assign video to any kind of taxonomies.
*   Define single or multiple taxonomies in which the plugin will enable the YouTube URL field.
*   Shortcode functionlity for post also available.
*   As well as shortcode functionlity for taxonomies.
*   Can set custom height width.

= Shortcodes =
<pre><code>[typw_post id="" height="" width=""]</code></pre> Use this code with this parameters. here <code>id</code> is the post id which video you want to show.
<pre><code>[typw_tax id="" height="" width=""]</code></pre> Use this code with this parameters. here <code>id</code> is the taxonomy id which video you want to show.

== Installation ==

1. Upload `tiny-youtube-post-widget` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
1. Goto widget menu and place the 'Tiny YouTube Post Widget' where you want.

== Frequently Asked Questions ==

= Is it have any shortcode to display the assigned video anywhere else? =

Yes. You can. Just read the description.

= What about 'Display Default YouTube URL if post URL input is empty' check box? =

If this is checked and you've not assigned any video with a post then it's gonna display the default video you provided in the widget for the post.

= Can I assign video to categories or tags? =

Yes. You can. Just look at the screenshots.

= Can I enable the option to only for particular post type? =

Yes. You can.

= Can I enable the option to only for particular type of taxonomy? =

Yes. You can.

== Screenshots ==

1. Tiny YouTube Post Widget Screenshot.
2. YouTube URL meta box assigned to post.
3. YouTube URL meta box assigned to page.
4. YouTube URL meta box assigned to post category.
5. YouTube URL meta box assigned to post tags.
6. Settings Page.

== Changelog ==

= 3.0.1 =
* Multiple user role based authentication added.
* Some code improvement.
* Some bug fixed.

= 3.0.0 =
* Fixed some functions and made compatible with WordPress 4.6.1 .
* Fully refactored with WordPress Plugin Development Boilerplate.
* "Post Type" selection support added. Means now you can define the post types where this plugin should execute its functionality.
* "Taxonomy" selection support added. Means now you can define the taxonomies where this plugin should execute its functionality.
* User role based authentication added.
* Shortcode functionality added.

= 2.0.0 =
* Fixed Some functions and made compatible with WordPress 4.3 .

= 1.0.0 =
* Initial version.