=== itemprop WP for SERP/SEO Rich snippets ===
Contributors: rolandinsh
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=Z4ALL9WUMY3CL&lc=LV&item_name=Umbrovskis%2e%20WordPress%20plugins&item_number=002&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: SEO, schema, schema.org, itemprop, schema.org itemprop, images, microdata, rich snippets, richsnippets, SERP, html5, structured data, itemprop article, itemprop review
Requires at least: 3.3
Tested up to: 3.6
Stable tag: 3.4.0
License: simplemediacode
License URI: http://simplemediacode.com/license/gpl/

Add human invisible schema.org itemprop code to post content for search engines and bots for better SERP results

== Description ==

This plugin is very simple. Using WordPress built in function to filter element attributes and adding < meta > tags with schema.org item properties.

[Project itempropWP homepage](http://simplemediacode.com/wordpress-pugins/itemprop-wp/?utm_source=http://wordpress.org/extend/plugins/itempropwp/&utm_medium=link&utm_campaign=itempropWP-WordPress-theme-feature-requests-3.4.0&utm_content=WordPress-plugin-itempropwp-3.4.0)

Example output:

`
<span itemscope itemtype="http://schema.org/Article" class="itempropwp-wrap">
<!-- Itemprop WP 3.4.0 by Rolands Umbrovskis http://umbrovskis.com -->
 <meta itemprop="name" content="Title of the Article" />
 <meta itemprop="url" content="http://example.com/seo-optimized-article/" />
 <meta itemprop="image" content="http://example.com/images/example.jpg" />
 <meta itemprop="author" content="http://example.com/author/authorusername/"/>
 <meta itemprop="description" content="excerpt from post" />
 <meta itemprop="datePublished" content="2012-09-13 19:17:21" />
 <meta itemprop="dateModified" content="2012-09-29 13:33:25" />
 <meta itemprop="interactionCount" content="UserComments:356" />
<!-- Itemprop WP 3.4.0 by Rolands Umbrovskis http://umbrovskis.com end -->
</span>
`

Review

`
<div itemprop="review" itemscope itemtype="http://schema.org/Review">
  <meta itemprop="name" content="Item Title is greate!" />
  <meta itemprop="author" content="Rolands Umbrovskis" />
  <meta itemprop="datePublished" content="2011-03-25" />
    <span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
      <meta itemprop="worstRating" content = "1"/>
      <meta itemprop="ratingValue" content="4.5" />
      <meta itemprop="bestRating" content="5" />
    </span>
    <span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
      <meta itemprop="name" content="Item Title" />
    </span>
	
   <div itemscope itemtype="http://schema.org/Product">
      <meta itemprop="name" content="Item Title" />
      <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <meta itemprop="price" content="55.36" />
        <meta itemprop="priceCurrency" content="USD" />
        <link itemprop="availability" href="http://schema.org/InStock" />
      </span>
    </div>
    <meta itemprop="description" content="Great Item Title for the price." />
</div>
`

How does it work?

This asumes that Your page is not fully integrated with HTML5's data properties for microdata. This plugin will create small code inside Your `full content`, with extra microdata from schema.org. This will be ONLY on singular pages - post, page or your custom post type.


Once we are on singular page:

# we will extract from it EXCERPT.
# If You haven't provided excerpt, plugin will look-up for post content, and downsize it to 170 symbols up to full word.
# If your content consist ONLY of shortcode, it will strip it out, and leave empty content. :(
# If we have empty content, from previous step, we will use post title. Not best choise, but at least we have some `description`.
# If Your post do not have even title, plugin will giveup and your description will be ampty. (This ir very bad :') )

Other options, like `datePublished`, `dateModified` (if enabled), `UserComments` (if enabled), `url` are taken from post

* [SMC Facebook](http://www.facebook.com/pages/SimpleMediaCode/125547717479727)

Development: [Git at bitbucket](https://bitbucket.org/simplemediacode/itempropwp) | [Github](https://github.com/rolandinsh/itempropwp)

Developer on twitter [@UmbrovskisCom](http://twitter.com/UmbrovskisCom)  /  [@SimpleMediaCode](http://twitter.com/SimpleMediaCode)

Require PHP at least 5.3

== Installation ==

1. Unzip the download package
1. Upload `itempropwp` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. See `itempropwp.php` for usage

== Frequently Asked Questions ==
There are no questions for now! [Ask!](http://simplemediacode.com/wordpress-pugins/itemprop-wp/)

== Changelog ==

= 3.4.0 = 

* updated: in Review - default price now with filter
* updated: in Review - default currency now with filter

= 3.3.6 = 

* fixed: wp_register_style was called incorrectly. More info [bitbucket.org/simplemediacode/itempropwp](http://xh.lv/20). Reported RFT Group.

= 3.3.5 = 

* small bugfix in rare cases: "For some reason all blog articles now have Type: http://schema.org/Review;", thanks to [indevd bugreport](http://wordpress.org/support/topic/schemaorgreview?replies=4#post-3882462) 

= 3.3.4 = 

* small bugfix in rare cases: "loading content multiple times", thanks to [sirene's commit on SimpleMediaCode.org](http://simplemediacode.org/forums/topic/schema-display-3-times/#post-97) 

= 3.3.3 = 

* small bugfix "Fixing undeclared variables", thanks to [semplon's commit on github](https://github.com/rolandinsh/itempropwp/commit/d4e18904329faabb84f6c47a7011a261c973b6bf) 

= 3.3.2 =

* Compatibility with NextGen gallery. Thanks to [indevd](http://wordpress.org/support/topic/mod-for-nextgen-gallery-users?replies=2#post-3807567)

= 3.3.1  =

* Review summary fix
* updated: better naming
* updated: review On/Off positions 

= 3.3.0  =

* new: itemprop="review"
* updated: admin interface for options

= 3.2.0  =

* updated: admin interface for options
* new: CSS class for wrapper

= 3.1.4 =

* updated: itemprop="description"
* Admin interface for options: description lenght (if excerpt not provided),show/hide UserComments:325,  show/hide dateModified 

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

= 3.4.0 = 

* updated: in Review - default price now with filter
* updated: in Review - default currency now with filter

= 3.3.6 = 

* fixed: wp_register_style was called incorrectly. More info [bitbucket.org/simplemediacode/itempropwp](http://xh.lv/20). Reported RFT Group.

= 3.3.5 = 

* small bugfix in rare cases: "For some reason all blog articles now have Type: http://schema.org/Review;", thanks to [indevd bugreport](http://wordpress.org/support/topic/schemaorgreview?replies=4#post-3882462) 

= 3.3.4 = 

* small bugfix in rare cases: "loading content multiple times if more than one the_content()", thanks to [sirene's commit on SimpleMediaCode.org](http://simplemediacode.org/forums/topic/schema-display-3-times/#post-97) 


= 3.3.3 = 

* small bugfix "Fixing undeclared variables", thanks to [semplon's commit on github](https://github.com/rolandinsh/itempropwp/commit/d4e18904329faabb84f6c47a7011a261c973b6bf) 

== Screenshots ==
1. 3.0 Full futured example http://simplemediacode.com/wordpress-pugins/itemprop-wp/
3. 3.3.0 Full futured Review example http://simplemediacode.com/wordpress-pugins/itemprop-wp/