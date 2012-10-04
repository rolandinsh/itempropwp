=== itemprop WP for SERP/SEO Rich snippets ===
Contributors: rolandinsh
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=Z4ALL9WUMY3CL&lc=LV&item_name=Umbrovskis%2e%20WordPress%20plugins&item_number=002&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: SEO, schema, schema.org, itemprop, schema.org itemprop, images, microdata, rich snippets, richsnippets, SERP, html5, structured data
Requires at least: 3.3
Tested up to: 3.4.2
Stable tag: 3.1.3
License: simplemediacode
License URI: http://simplemediacode.com/license/gpl/

Add human invisible schema.org itemprop code to post content

== Description ==

This plugin is very simple. Using WordPress built in function to filter element attributes and adding < meta > tags with schema.org item properties.

Example output:

`
<span itemscope itemtype="http://schema.org/Article">
<!-- Itemprop WP 3.1.3 by Rolands Umbrovskis http://umbrovskis.com -->
 <meta itemprop="name" content="Title of the Article" />
 <meta itemprop="url" content="http://example.com/seo-optimized-article/" />
 <meta itemprop="image" content="http://example.com/images/example.jpg" />
 <meta itemprop="author" content="http://example.com/author/authorusername/"/>
 <meta itemprop="description" content="excerpt from post" />
 <meta itemprop="datePublished" content="2012-09-13 19:17:21" />
 <meta itemprop="interactionCount" content="UserComments:356" />
<!-- Itemprop WP 3.1.3 by Rolands Umbrovskis http://umbrovskis.com end -->
</span>
`

How does it work?

There are no options. yet!

This asumes that Yout page is not fully integrated with HTML5's data properties for microdata. This plugin will create small code inside Your full content, with extra microdata from schema.org. This will be ONLY on singular pages - post, page or your custom post type.

Once we are on singular page:

# we will extract from it EXCERPT.
# If You haven't provided excerpt, plugin will look-up for post content, and downsize it to 170 symbols up to full word.
# If your content consist ONLY of shortcode, it will strip it out, and leave empty content. :(
# If we have empty content, from previous step, we will use post title. Not best choise, but at least we have some `description`.
# If Your post do not have even title, plugin will giveup and your description will be ampty. (This ir very bad :') )

Other options, like `datePublished`, `UserComments`, `url` are taken from post



NEW in 3.1

* itemprop="description"

NEW in 3.0 

* new: context, without context for SEO this plugin was somehow useless. We FIXED it ;)
* new: itemprop="name"
* new: itemprop="url"
* new: itemprop="image"
* new: itemprop="author"
* new: itemprop="datePublished"
* new: "UserComments:325" itemprop="interactionCount"

Add human invisible schema.org `itemprop` code to images (post thumbnails!).

* [Project Page](http://simplemediacode.info/snippets/itemprop-attributes-for-wordpress-serp-results/)
* [Documentation](http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/)
* [SMC Facebook](http://www.facebook.com/pages/SimpleMediaCode/125547717479727)

Development: [Git at bitbucket](https://bitbucket.org/simplemediacode/itempropwp) | [Github](https://github.com/rolandinsh/itempropwp)

Developer on twitter [@UmbrovskisCom](http://twitter.com/UmbrovskisCom)  /  [@SimpleMediaCode](http://twitter.com/SimpleMediaCode)

== Installation ==

1. Unzip the download package
1. Upload `itempropwp` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. See `itempropwp.php` for usage

== Frequently Asked Questions ==
There are no questions for now! [Ask!](http://simplemediacode.info/snippets/itemprop-attributes-for-wordpress-serp-results/)

== Changelog ==

= 3.1.3 =

* fixed: itemprop="description"

= 3.1.2 =

* fix: itemprop="description"

= 3.1.1 =

* new: itemprop="description"

= 3.0 =

* new: context
* new: itemprop="name"
* new: itemprop="url"
* new: itemprop="image"
* new: itemprop="author"
* new: itemprop="datePublished"
* new: "UserComments:325" itemprop="interactionCount"

= 2.0 =
* new code
* now as extendable class function
* new: using WordPress filter for image attributed on thumbnails

= 1.1 =
* fix: SMCIPWPURL

= 1.0 =
* init

== Upgrade Notice ==

= 3.1.3 =

* new: itemprop="description"

= 2.0 =
* new: as extendable class function
* new: using WordPress filter for image attributed on thumbnails

= 3.0 =
* new: context
* new: itemprop="name"
* new: itemprop="url"
* new: itemprop="image"
* new: itemprop="author"
* new: itemprop="datePublished"
* new: "UserComments:325" itemprop="interactionCount"

== Screenshots ==
1. 3.0 Full futured example http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/