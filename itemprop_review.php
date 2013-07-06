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
	
	private function reviewvers(){
		return '1.2.0';
	}

	public function reviewinit() {
		add_filter('itempropwp_article_content_before', array( 'itempropwp_review', 'review' ), 11); // Adding context @since 3.0
		add_filter('add_meta_boxes', array( 'itempropwp_review', 'itempropwp_review_metabox' ), 11); // Adding context @since 3.3.0
		add_filter('save_post', array( 'itempropwp_review', 'itempropwp_review_save' ), 11); // Adding context @since 3.3.0
	}
	
	public function review($content){
		if (is_singular() && !is_feed()){
			global $post;
			
			$reviewinit = new itempropwp_review;
			$reviewv = $reviewinit->reviewvers();

			$ipwprprefix = 'ipwp_';
			$reviewid = $post->ID;
			$reviewpost = get_post($post->ID);
			$reviewname = get_post_meta($reviewid, $ipwprprefix.'product_name', true);
			$reviewprice = get_post_meta($reviewid, $ipwprprefix.'product_price', true);
			$reviewcurrency = get_post_meta($reviewid, $ipwprprefix.'currency', true);
			$reviewrating = get_post_meta($reviewid, $ipwprprefix.'rating', true);
			$reviewonoff = get_post_meta($reviewid, $ipwprprefix.'reviewonoff', true);
			$newcontent = '';
			$pricerows='';
			$reviewratingrow='';
			
			if(isset($reviewrating['rate'])){
				$itemrating = $reviewrating['rate'];
			}else{
				$itemrating = 0;
			}
			if(isset($reviewonoff['onoff'])){
				if($reviewonoff['onoff']=="on"){
					if(!$reviewname){$reviewname = $reviewpost->post_title;}
					if($reviewprice || $reviewcurrency){ // @since 1.2.0 with || not &&
						$pricerows = '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><meta itemprop="price" content="'.$reviewprice.'"><meta itemprop="priceCurrency" content="'.$reviewcurrency.'"><link itemprop="availability" href="http://schema.org/InStock"></span>';
					}
					
					if($reviewrating){
						$reviewratingrow = '<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><meta itemprop="worstRating" content = "1"><meta itemprop="ratingValue" content="'.$itemrating.'"><meta itemprop="bestRating" content="5"></span>';
					}
					
					
					$review_descr = apply_filters('ipwp_reviewpost_dsc', $reviewpost->post_excerpt); // Extending @since 3.3.1
					
					if(!$review_descr){
						$ipwrp_n = new itempropwp;
						$review_descr = apply_filters(
							'ipwp_reviewpost_dsc',
							$ipwrp_n->ipwp_excerpt_maxchr(
								get_option('smcipwp_maxlenght'),
								strip_tags( strip_shortcodes($reviewpost->post_content) )
							)
						); // Extending @since 3.3.1
					}
					$newcontent .= '<span itemprop="review" itemscope itemtype="http://schema.org/Review"><meta itemprop="name" content="'.esc_attr($reviewpost->post_title).'"><meta itemprop="author" content="'.esc_attr(get_the_author_meta( 'display_name', $reviewpost->post_author )).'"><meta itemprop="datePublished" content="'.esc_attr($reviewpost->post_date).'">'
					.$reviewratingrow.'<span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Product"><meta itemprop="name" content="'.esc_attr($reviewname).'">'
					.$pricerows.'</span><meta itemprop="description" content="'.strip_tags(str_replace(array("\r\n", "\n", "\r", "\t"), "", $review_descr)).'"></span>';
	
					$content = "\n".'<!-- '.IPWPTSN.' '.SMCIPWPV.'/ Review '.$reviewv.' by Rolands Umbrovskis '.IPWPT_HOMEPAGEC.' -->'.$newcontent.'<!-- '.IPWPTSN.' '.SMCIPWPV.'/ Review '.$reviewv.' end -->'."\n";
				}
			}// isset($reviewonoff['onoff'])

				return $content;
			}
			return $content;
	}
	
	public function itempropwp_review_metabox(){
		$ipwprprefix = 'ipwp_';

		add_meta_box($ipwprprefix.'postbox_review', sprintf(__( "%s Review","itempropwp" ),IPWPTSN), array( 'itempropwp_review', 'ipwp_cpbox' ),'post', 'normal', 'high');
		add_meta_box($ipwprprefix.'pagebox_review', sprintf(__( "%s Review","itempropwp" ),IPWPTSN), array( 'itempropwp_review', 'ipwp_cpbox' ),'page', 'normal', 'high');
	}
	function ipwp_cpbox( $post ) {
		$ipwprprefix = 'ipwp_';
		wp_nonce_field( plugin_basename( __FILE__ ), $ipwprprefix.'pt_post_nonce' );

		echo '<table class="form-table"><tbody>';
		$reviewonoff['onoff']='off';
		$reviewonoff = get_post_meta( $post->ID, $ipwprprefix.'reviewonoff', true);
		$rating = get_post_meta( $post->ID, $ipwprprefix.'rating', true);

		echo '<tr>';
		echo '<th scope="row"><div class="'.$ipwprprefix.'postcbox-label">';
			echo '<label for="'.$ipwprprefix.'reviewonoff">'.__("Turn On/Off review mode","itempropwp" ).'</label> ';
		echo '</div></th>';
			echo '<td>';
				echo '<div class="'.$ipwprprefix.'postcbox-input">';
					echo '<select name="'.$ipwprprefix.'reviewonoff[onoff]" id="'.$ipwprprefix.'reviewonoff">';
						echo '<option value="off" '.selected($reviewonoff['onoff'], "off", false).'>Off</option>';
						echo '<option value="on" '.selected($reviewonoff['onoff'], "on", false).'>On</option>';
					echo '</select>';
				echo '</div>';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr>';
			echo '<th scope="row">';
				echo '<div class="'.$ipwprprefix.'postcbox-label">';
					echo '<label for="'.$ipwprprefix.'product_name">'.__("Name of item","itempropwp" ).'</label>';
				echo '</div>';
			echo '</th>';
			echo '<td>';
				echo '<div class="'.$ipwprprefix.'postcbox-input">';
					echo '<input type="text" id="'.$ipwprprefix.'product_name" name="'.$ipwprprefix.'product_name" value="'.esc_attr(get_post_meta( $post->ID, $ipwprprefix.'product_name', true)).'" size="25" class="large-text" />';
				echo '</div>';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr>';
			echo '<th scope="row">';
				echo '<div class="'.$ipwprprefix.'postcbox-label">';
					echo '<label for="'.$ipwprprefix.'product_price">'.__("Price of item","itempropwp" ).'</label> ';
				echo '</div>';
			echo '</th>';
			echo '<td><div class="'.$ipwprprefix.'postcbox-input"><input type="text" id="'.$ipwprprefix.'product_price" name="'.$ipwprprefix.'product_price" value="'.esc_attr(get_post_meta( $post->ID, $ipwprprefix.'product_price', true)).'" size="25" /></div></td>';
		echo '</tr>';
		
		echo '<tr><th scope="row"><div class="'.$ipwprprefix.'postcbox-label">';
			echo '<label for="'.$ipwprprefix.'currency">'.__("Currency of item","itempropwp" ).'</label> ';
		echo '</div></th>';
		echo '<td><div class="'.$ipwprprefix.'postcbox-input"><input type="text" id="'.$ipwprprefix.'currency" name="'.$ipwprprefix.'currency" value="'.esc_attr(get_post_meta( $post->ID, $ipwprprefix.'currency', true)).'" size="25" /></div></td></tr>';
		
		echo '<tr><th scope="row"><div class="'.$ipwprprefix.'postcbox-label">';
			echo '<label for="'.$ipwprprefix.'rating">'.__("Rating of item","itempropwp" ).'</label> ';
		echo '</div></th>';
		if(!isset($rating['rate'])){
			$rating['rate'] = 0;
		}
		echo '<td><div class="'.$ipwprprefix.'postcbox-input">
		<select name="'.$ipwprprefix.'rating[rate]" id="'.$ipwprprefix.'reviewonoff">
			<option value="0"	'.selected($rating['rate'], "0",	false).'>0.0</option>
			<option value="0.5" '.selected($rating['rate'], "0.5",	false).'>0.5</option>
			<option value="1.0" '.selected($rating['rate'], "1.0",	false).'>1.0</option>
			<option value="1.5" '.selected($rating['rate'], "1.5",	false).'>1.5</option>
			<option value="2.0" '.selected($rating['rate'], "2.0",	false).'>2.0</option>
			<option value="2.5" '.selected($rating['rate'], "2.5",	false).'>2.5</option>
			<option value="3.0" '.selected($rating['rate'], "3.0",	false).'>3.0</option>
			<option value="3.5" '.selected($rating['rate'], "3.5",	false).'>3.5</option>
			<option value="4.0" '.selected($rating['rate'], "4.0",	false).'>4.0</option>
			<option value="4.5" '.selected($rating['rate'], "4.5",	false).'>4.5</option>
			<option value="5"	'.selected($rating['rate'], "5",	false).'>5.0</option>
		</select>';
		echo '</div></td></tr>';
		echo '</tbody></table>';
	}

	function itempropwp_review_save( $post_id ) {
		$ipwprprefix = 'ipwp_';
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;
		
		if ( !wp_verify_nonce( $_POST[$ipwprprefix.'pt_post_nonce'], plugin_basename( __FILE__ ) ) )
			return;
		if ( 'page' == $_POST['post_type'] ){
			if ( !current_user_can( 'edit_page', $post_id ) )
				return;
		}
		else{
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
		}
		
		$product_name = $_POST[$ipwprprefix.'product_name'];
		$product_price = $_POST[$ipwprprefix.'product_price'];
		$currency = $_POST[$ipwprprefix.'currency'];
		$rating = $_POST[$ipwprprefix.'rating'];
		$reviewonoff = $_POST[$ipwprprefix.'reviewonoff'];
		// Default price
		if(!$product_price||$product_price==''){
			$product_price = apply_filters('ipwp_reviewpost_noprice', '0.00'); // @since 1.2.0 apply_filters
		}
		// Default currency
		if(!$currency||$currency==''){
			$currency = apply_filters('ipwp_reviewpost_nocurrency', 'USD'); // @since 1.2.0 apply_filters
		}
		
		update_post_meta($post_id, $ipwprprefix.'product_name', $product_name);
		update_post_meta($post_id, $ipwprprefix.'product_price', $product_price);
		update_post_meta($post_id, $ipwprprefix.'currency', $currency);
		update_post_meta($post_id, $ipwprprefix.'rating', $rating);
		update_post_meta($post_id, $ipwprprefix.'reviewonoff', $reviewonoff);

	}
}

new itempropwp_review;
