<?php 
/**
 * Plugin Name: itemprop WP for SERP/SEO Rich snippets
 * Plugin URI: http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-2-0-itempropWP_load_widgets
 * Description: Add human invisible schema.org itemprop code to images
 * Version: 3.0
 * Requires at least: 3.3
 * Tested up to: 3.4.2
 * Author: Rolands Umbrovskis
 * Author URI: http://umbrovskis.com
 * License: simplemediacode
 * License URI: http://simplemediacode.com/license/gpl/
 */

/*
 * Starting itempropwp
*/
itempropwp::init();
/*
 * itempropwp class
 * @since 2.0
*/
class itempropwp {
	// Initialize
	public function init() {
		define('SMCIPWPV','3.0'); // location general @since 1.0
		define('SMCIPWPM',dirname(__FILE__)); // location general @since 1.0
		define('SMCIPWPF','itempropwp'); // location folder @since 1.0
		define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Image location @since 1.0
		define('SMCIPWPI',SMCIPWPURL.'/img'); // Image location @since 1.0
		define('SMCIPWPORG','http://wordpress.org/extend/plugins/'.SMCIPWPF); // Image location @since 1.0
		define('IPWPT',__('itemprop WP for SERP/SEO Rich snippets','itempropwp')); // Name @since 1.1
		
		// add_filter('wp_get_attachment_image_attributes', array( 'itempropwp', 'ipwp_img_attr' ), 10, 2 ); // Adding itemprop=image to thumbnails  @since 2.0
		add_filter('the_content', array( 'itempropwp', 'ipwp_the_content_filter' ), 10, 2 ); // Adding context @since 3.0
	}
	/* droped at 3.0 */
	public function ipwp_img_attr($attr) {
		$attr['itemprop'] = 'image';
		return $attr;
	}
	
	public function ipwp_the_content_filter($content) {
		if (is_singular() && !is_feed()){
			
			global $post;
			$thisipwp_post = get_post($post->ID);
			$ipwp_posth = '';
			$ipwp_image = '';
			if ( has_post_thumbnail($post->ID)) {
				$ipwp_post_imga = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); // all other sizes are not permanent :| 
				$ipwp_posth = $ipwp_post_imga[0]; // image link
			}
			if($ipwp_posth){
				$ipwp_image = "\n\t".'<meta itemprop="image" content="'.esc_url($ipwp_posth).'" />'."\n\t";
			}
			
			
			$content = $content."\n".'<span itemscope itemtype="http://schema.org/Article">
<!-- ItemProp WP '.SMCIPWPV.' by Rolands Umbrovskis http://umbrovskis.com -->
	<meta itemprop="name" content="'.esc_attr($thisipwp_post->post_title).'" />
	<meta itemprop="url" content="'.esc_url(get_permalink()).'" />'
	.$ipwp_image.
	'<meta itemprop="author" content="'.get_author_posts_url($thisipwp_post-> post_author).'"/>
	<meta itemprop="datePublished" content="'.esc_attr($thisipwp_post->post_date).'"/>
	<meta itemprop="interactionCount" content="UserComments:'.esc_attr($thisipwp_post->comment_count).'"/>
<!-- ItemProp WP '.SMCIPWPV.' by Rolands Umbrovskis http://umbrovskis.com end -->
</span>'."\n";
		
			return $content;
		}
		return $content;
	}

}
