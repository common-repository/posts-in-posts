=== Posts in Posts ===
Contributors: wolfiezero
Tags: posts, recent, category, tag
Requires at least: 3.1
Tested up to: 3.1
Stable tag: 0.6

Posts in Posts grabs posts based on tag, category or just recent, and display them inline with a post

== Description ==

Posts in Posts will allow you to grab recent posts based on category, tag or just recent posts. Then it will display thoses posts in a list in the post or page you have called the Posts in Posts on. It's as easy as all you need to do is write a HTML-esq bit of code.

[posts type="category" name="Lipsum" limit="4" date="d-m-Y"]

This will then output 4 posts from the category 'Lipsum'.

== Installation ==  

Installation is as simple as adding the 'posts-in-posts' folder to your wp-contents/plugins folder or downloading through WordPress itself. From there you'll need to add the short code to where you want the post to be displayed; here are a list of the options.

* 'type' : 'category', 'tag', 'recent' or blank will use 'recent'

* 'name' : the name of a given category or tag in your wordpress taxonmy or if left blank then it will resort to outputting nothing unless the type is 'recent' or blank

* 'limit' : the number of posts you want to display in a given call or if left blank then it resolves to the default of '5'

* 'date' : use the [standard date format for php](http://php.net/manual/en/function.date.php) or if left blank then it won't display a date

== Changelog ==

= 0.6 =

* Updaed readme.txt to use correct shortcode
* Added shortcode [showposts] for compatability

= 0.5 =

* First available public release.

== Frequently Asked Questions ==

None yet, feel free to ask either on [WordPress](http://wordpress.org/tags/posts-in-posts?forum_id=10#postform), [GitHub](https://github.com/WolfieZero/posts-in-posts/issues/new) or [contacting me](http://wolfiezero.com/contact/)