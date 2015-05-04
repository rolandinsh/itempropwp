# itemprop WP for SERP/SEO Rich snippets

Add human invisible schema.org itemprop code to post content

* [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=Z4ALL9WUMY3CL&lc=LV&item_name=Umbrovskis%2e%20WordPress%20plugins&item_number=002&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted) or promote this work 
* License URI: http://simplemediacode.com/license/gpl/

## Description

Have a good idea for improvement? [Share it](https://github.com/rolandinsh/itempropwp/issues) | [BUG report](https://github.com/rolandinsh/itempropwp/issues) | 

Example output:
### Example:

Article

	<span itemscope itemtype="http://schema.org/Article" class="itempropwp-wrap">
	<!-- Itemprop WP 3.4.0 by Rolands Umbrovskis http://umbrovskis.com -->
	 <meta itemprop="name" content="Title of the Article" />
	 <meta itemprop="url" content="http://fulllink.example.com/seo-optimized-article/" />
	 <meta itemprop="image" content="http://fulllink.example.com/seo-optimized-article/example.jpg" />
	 <meta itemprop="author" content="http://fulllink.example.com/author/authorusername/"/>
	 <meta itemprop="description" content="excerpt from post OR first 170 symbols (with full word), ..." />
	 <meta itemprop="datePublished" content="2012-09-13 19:17:21"/>
	 <meta itemprop="dateModified" content="2012-09-29 13:33:25" />
	 <meta itemprop="interactionCount" content="UserComments:356"/>
	<!-- Itemprop WP 3.4.0 by Rolands Umbrovskis http://umbrovskis.com end -->
	</span>

Review

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

### How does it work?

This asumes that Your page is not fully integrated with HTML5's data properties for microdata. This plugin will create small code inside Your `full content`, with extra microdata from schema.org. This will be ONLY on singular pages - post, page or your custom post type.

Once we are on singular page:

* NEW in 3.3.0 itemprop="review".
* we will extract from it EXCERPT.
* If You haven't provided excerpt, plugin will look-up for post content, and downsize it to 170 symbols up to full word.
* If your content consist ONLY of shortcode, it will strip it out, and leave empty content. :(
* If we have empty content, from previous step, we will use post title. Not best choise, but at least we have some `description`.
* If Your post do not have even title, plugin will giveup and your description will be ampty. (This ir very bad :') )

Other options, like `datePublished`, `UserComments`, `url` are taken from post

### Features

* Admin interface for options: description lenght (if excerpt not provided),show/hide UserComments:325,  show/hide dateModified 
* itemprop="description" (since 3.1.1)
* itemprop="name" (since 3.0)
* itemprop="url" (since 3.0)
* itemprop="image" (since 1.0)
* itemprop="author" (since 3.0)
* itemprop="datePublished" (since 3.0)
* "UserComments:325" itemprop="interactionCount" (since 3.0)
* itemprop="review" (since 3.3.0)

### Links

* [Project Page](http://simplemediacode.com/wordpress-pugins/itemprop-wp/)
* [SMC Facebook](http://www.facebook.com/SimpleMediaCode/)
* Development: [Github](https://github.com/rolandinsh/itempropwp)

## Installation

1. Unzip the download package
1. Upload `itempropwp` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. See `itempropwp.php` for usage

Require PHP at least 5.3

## Frequently Asked Questions

There are no questions for now! [Ask!](http://simplemediacode.com/wordpress-pugins/itemprop-wp/)
