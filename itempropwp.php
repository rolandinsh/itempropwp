<?php 
/**
 * Plugin Name: itemprop WP for SERP/SEO Rich snippets
 * Plugin URI: http://simplemediacode.info/snippets/add-itemprop-image-to-all-wordpress-images/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-2-0-itempropWP_load_widgets
 * Description: Add human invisible schema.org itemprop code to images
 * Version: 2.0
 * Requires at least: 3.3
 * Tested up to: 3.4.1
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
		define('SMCIPWPV','2.0'); // location general @since 1.0
		define('SMCIPWPM',dirname(__FILE__)); // location general @since 1.0
		define('SMCIPWPF','itempropwp'); // location folder @since 1.0
		define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Image location @since 1.0
		define('SMCIPWPI',SMCIPWPURL.'/img'); // Image location @since 1.0
		define('SMCIPWPORG','http://wordpress.org/extend/plugins/'.SMCIPWPF); // Image location @since 1.0
		define('IPWPT',__('itemprop WP for SERP/SEO Rich snippets','itempropwp')); // Name @since 1.1
		
		add_filter('wp_get_attachment_image_attributes', array( 'itempropwp', 'ipwp_img_attr' ), 10, 2 ); // Adding itemprop=image to thumbnails  @since 2.0
	}
	
	public function ipwp_img_attr($attr) {
		$attr['itemprop'] = 'image';
		return $attr;
	}
}
