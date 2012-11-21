<?php 
/*
itempropwp itemprom review
*/
?>

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