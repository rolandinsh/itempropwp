<?php 
/*
itempropwp itemprom review
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

*/

class itempropwp_review extends itempropwp  {  
	public function __construct(){
		parent::__construct();
		add_action('init', array( 'itempropwp_review', 'reviewinit' ),10);	
	}
	
	public function reviewinit() {
		add_filter('article_content_before', array( 'itempropwp_review', 'review' ), 11); // Adding context @since 3.0
	}
	
	public function review($content){
		if (is_singular() && !is_feed()){
			global $post;
			//$ipwprprefix = 'ipwp_';
			$reviewid = $post->ID;
			$reviewpost = get_post($post->ID);
			$reviewname = get_post_meta($reviewid, $ipwprprefix.'product_name', true);
			$reviewprice = get_post_meta($reviewid, $ipwprprefix.'product_price', true);
			$reviewcurrency = get_post_meta($reviewid, $ipwprprefix.'currency', true);
			$reviewrating = (float)get_post_meta($reviewid, $ipwprprefix.'rating', true);
			$newcontent = '';
			$pricerows='';
			$reviewratingrow='';
			
			if(!$reviewname){$reviewname = $reviewpost->post_title;}
			if($reviewprice && $reviewcurrency){
				$pricerows = '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><meta itemprop="price" content="'.$reviewprice.'" /><meta itemprop="priceCurrency" content="'.$reviewcurrency.'" /><link itemprop="availability" href="http://schema.org/InStock" /></span>';
			}
			
			if($reviewrating){
				$reviewratingrow = '<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><meta itemprop="worstRating" content = "1"/><meta itemprop="ratingValue" content="4.5" /><meta itemprop="bestRating" content="5" /></span>';
			}
			/*
			$newcontent .= '<span itemprop="review" itemscope itemtype="http://schema.org/Review"><meta itemprop="name" content="'.esc_attr($reviewpost->post_title).'" /><meta itemprop="author" content="'.esc_attr(get_the_author_meta( 'display_name', $reviewpost->post_author )).'" /><meta itemprop="datePublished" content="'.esc_attr($reviewpost->post_date).'" />'
			.$reviewratingrow.'<span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Product"><meta itemprop="name" content="'.esc_attr($reviewname).'" />'
			.$pricerows.'</span><meta itemprop="description" content="'.esc_attr($reviewpost->post_excerpt).'" /></span>';
			*/
			
			$newcontent .= '<span itemprop="review" itemscope itemtype="http://schema.org/Review"><meta itemprop="name" content="'.esc_attr($reviewpost->post_title).'" /><meta itemprop="author" content="'.esc_attr(get_the_author_meta( 'display_name', $reviewpost->post_author )).'" /><meta itemprop="datePublished" content="'.esc_attr($reviewpost->post_date).'" />'
			.'<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><meta itemprop="worstRating" content = "1"/><meta itemprop="ratingValue" content="4.5" /><meta itemprop="bestRating" content="5" /></span>'.'<span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Product"><meta itemprop="name" content="'.esc_attr($reviewname).'" />'
			.'<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><meta itemprop="price" content="56.25" /><meta itemprop="priceCurrency" content="EUR" /><link itemprop="availability" href="http://schema.org/InStock" /></span>'.'</span><meta itemprop="description" content="'.esc_attr($reviewpost->post_excerpt).'" /></span>';

			//$content = $content."\n".'<!-- review -->'.$newcontent.'<!-- review end -->'."\n";
			$content = "\n".'<!-- review -->'.$newcontent.'<!-- review end -->'."\n";
				return $content;
			}
			return $content;
	}
}

new itempropwp_review;
