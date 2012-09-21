# itemprop WP for SERP/SEO Rich snippets

Add human invisible schema.org itemprop code to post content

* Contributors: rolandinsh (Rolands Umbrovskis)
* [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=Z4ALL9WUMY3CL&lc=LV&item_name=Umbrovskis%2e%20WordPress%20plugins&item_number=002&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted) or promote this work 
* Tags: SEO, schema, schema.org, itemprop, schema.org itemprop, images, microdata, rich snippets, richsnippets, SERP, html5, structured data
* Requires at least: 3.3
* Tested up to: 3.4.2
* Stable tag: 3.0
* License: simplemediacode
* License URI: http://simplemediacode.com/license/gpl/

## Description

This plugin is very simple. Using WordPress built in function to filter element attributes. It will add human invisible / search engine visible schema.org `itemprop` code to content (via META tags).

Example:

	<span itemscope itemtype="http://schema.org/Article">
	<!-- Itemprop WP 3.0 by Rolands Umbrovskis http://umbrovskis.com -->
	 <meta itemprop="name" content="Title of the Article" />
	 <meta itemprop="url" content="http://fulllink.example.com/seo-optimized-article/" />
	 <meta itemprop="image" content="http://fulllink.example.com/seo-optimized-article/example.jpg" />
	 <meta itemprop="author" content="http://fulllink.example.com/author/authorusername/"/>
	 <meta itemprop="description" content="excerpt from post OR first 128 symbols (with full word), ..." />
	 <meta itemprop="datePublished" content="2012-09-13 19:17:21"/>
	 <meta itemprop="interactionCount" content="UserComments:356"/>
	<!-- Itemprop WP 3.0 by Rolands Umbrovskis http://umbrovskis.com end -->
	</span>

### Features

* itemprop="description" (since 3.1.1)
* context, without context for SEO this plugin was somehow useless. We FIXED it ;)
* itemprop="name" (since 3.0)
* itemprop="url" (since 3.0)
* itemprop="image" (since 1.0)
* itemprop="author" (since 3.0)
* itemprop="datePublished" (since 3.0)
* "UserComments:325" itemprop="interactionCount" (since 3.0)

### Links

* [Project Page](http://simplemediacode.info/snippets/itemprop-attributes-for-wordpress-serp-results/)
* [Documentation](http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/)
* [SMC Facebook](http://www.facebook.com/pages/SimpleMediaCode/125547717479727)
* Development: [Git at bitbucket](https://bitbucket.org/simplemediacode/itempropwp) | [Github](https://github.com/rolandinsh/itempropwp)

## Installation

1. Unzip the download package
1. Upload `itempropwp` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. See `itempropwp.php` for usage

## Frequently Asked Questions

There are no questions for now! [Ask!](http://simplemediacode.info/snippets/itemprop-attributes-for-wordpress-serp-results/)

## Changelog

### 3.1.1

* new: itemprop="description" 

### 3.0

* new: context
* new: itemprop="name"
* new: itemprop="url"
* new: itemprop="image"
* new: itemprop="author"
* new: itemprop="datePublished"
* new: "UserComments:325" itemprop="interactionCount"

### 2.0

* new code
* now as extendable class function
* new: using WordPress filter for image attributed on thumbnails

### 1.1
* fix: SMCIPWPURL

### 1.0

* init

## Screenshots
1. 3.0 Full futured example http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/