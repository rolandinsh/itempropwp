<?php 
/**
Plugin Name: itemprop WP for SERP (and SEO) Rich snippets
Plugin URI: http://simplemediacode.com/wordpress-pugins/itemprop-wp/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-3.3.3-itempropWP_load_widgets
Description: Add human invisible schema.org code to conent
Version: 3.3.3
Requires at least: 3.3
Tested up to: 3.5
Author: Rolands Umbrovskis
Author URI: http://umbrovskis.com
License: simplemediacode
License URI: http://simplemediacode.com/license/gpl/

Copyright (C) 2008-2013, Rolands Umbrovskis - rolands@simplemediacode.com

*/
	define('SMCIPWPV','3.3.3'); // location general @since 1.0
	define('SMCIPWPM',dirname(__FILE__)); // location general @since 1.0
	define('SMCIPWPF','itempropwp'); // location folder @since 1.0 
	define('IPWPT',__('itemprop WP for SERP/SEO Rich snippets','itempropwp')); // Name @since 1.1
	define('IPWPTSN',__('itemprop WP','itempropwp')); // Name @since 3.3.0
	define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Plugin URI @since 1.0
	define('SMCIPWPDIR',dirname( plugin_basename( __FILE__ ) ));/* @since 3.2.0 */
	$smcipwp_url = SMCIPWPURL; // @since 3.1 Use of undefined constant SMCIPWPURL - assumed 'SMCIPWPURL' in 
	$smcipwp_f = SMCIPWPF; // @since 3.1 Use of undefined constant SMCIPWPF - assumed 'SMCIPWPF' in 
	
	define('SMCIPWPI',trailingslashit( $smcipwp_url. '/img' )); // Image location @since 1.0
	define('SMCIPWPORG','http://wordpress.org/extend/plugins/'.trailingslashit($smcipwp_f)); // Plugin on WordPress.org @since 1.0
	
/** Plugin homepage based on WP language
* @since 3.1.4
*/
	$plugref='?utm_campaign='.SMCIPWPF.'&utm_content='.SMCIPWPF.'-'.SMCIPWPV.'&utm_medium=link&utm_source='.SMCIPWPF.'-plugin';
	if(WPLANG=='lv'){ 
		define('IPWPT_HOMEPAGE','http://simplemediacode.com/wordpress-pugins/itemprop-wp/'.$plugref); // Homepage @since 3.1.4
		define('IPWPT_HOMEPAGEC','http://simplemediacode.com/wordpress-pugins/itemprop-wp/'); // Homepage @since 3.3.0
	}else{
		define('IPWPT_HOMEPAGE','http://simplemediacode.com/wordpress-pugins/itemprop-wp/'.$plugref); // Homepage @since 3.1
		define('IPWPT_HOMEPAGEC','http://simplemediacode.com/wordpress-pugins/itemprop-wp/'); // Homepage @since 3.3.0
	}
	
	define('IPWPT_GITHUB','https://github.com/rolandinsh/'.$smcipwp_f); // Homepage @since 3.1
	define('IPWPT_BITBUCKET','https://bitbucket.org/simplemediacode/'.$smcipwp_f); // Homepage @since 3.1
	define('IPWPT_VERSUPPORT','http://simplemediacode.org/forums/topic/itempropwp-3-3-0/'.$plugref); // Version specific support @since 3.3.0
	
/*
 * Starting itempropwp
*/
new itempropwp;
/*
 * itempropwp class
 * @since 2.0
*/
//if (!class_exists('itempropwp')) {
	class itempropwp {
		public function __construct(){
			add_action('init', array( 'itempropwp', 'init' ),10);
			add_action('plugin_row_meta', array( 'itempropwp', 'smcwpd_set_plugin_meta' ), 10, 2 );

/*
 * itempropwp Admin interface
 * @since 3.1.4
 * @version 1.0
*/
			if(is_admin()):
				include_once(SMCIPWPM.'/admin/adminipwp.php');
			endif;
/*
 * itempropwp CSS
 * @since 3.2.0
 * @version 1.0
*/
			if(!is_admin()):	
				wp_register_style('itempropwp', SMCIPWPURL.'assets/css/itempropwp.css', array(), SMCIPWPV, 'all');
				wp_enqueue_style('itempropwp');
			endif;
		} 
		// Initialize
		public function init() {
			load_plugin_textdomain( 'itempropwp', false, SMCIPWPDIR. '/lang/');
			add_filter('the_content', array( 'itempropwp', 'ipwp_the_content_filter' ), 10, 2 ); // Adding context @since 3.0
			
		}

		function smcwpd_set_plugin_meta($links, $file) {
			$plugin = plugin_basename(__FILE__);
			// create link
			if ($file == $plugin) {
				return array_merge( $links, array( 
					'<a href="http://simplemediacode.org/forums/forum/itempropwp-plugin/">' . __("Support Forum","itempropwp") . '</a>',
					'<a href="'.IPWPT_VERSUPPORT.'">' . sprintf(__("Support for version %s","itempropwp"),SMCIPWPV) . '</a>',
					'<a href="http://simplemediacode.org/forums/forum/itempropwp-plugin/suggestions-for-itempropwp/">' . __('Feature request') . '</a>',
					// '<a href="http://simplemediacode.org/forums/forum/itempropwp-plugin/">' . __("Join Members group","itempropwp") . '</a>',
				));
			}
			return $links;
		}

		/* 3.0 drop */
		public function ipwp_img_attr($attr) {
			$attr['itemprop'] = 'image';
			return apply_filters('ipwp_img_attr_filter', $attr); // Extending @since 3.1
		}


/*
 * if post has no excerpt, we will use this
 * @Todo rewrite
 * @since 3.1
*/
		public function ipwp_excerpt_maxchr($charlength=170,$ipwp_content='') {
			/* did we get content? No, let's make it from post */
			if($ipwp_content==''){
				global $post;  
				$ipwp_content = apply_filters('ipwp_excmc_filter_excerpt', $post->post_excerpt);  // Extending @since 3.1.2
				if(!$ipwp_content||$ipwp_content==''){
					$ipwp_content = apply_filters('ipwp_excmc_filter_content', strip_shortcodes($post->post_content));  // Extending @since 3.1
					$ipwp_content = str_replace(array("\r\n", "\n", "\r", "\t"), "", $ipwp_content);
				}
			}
			
			$charlength++;
			
			if ( mb_strlen( $ipwp_content ) > $charlength ) {
				$subex = mb_substr( $ipwp_content, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					return apply_filters('ipwp_excmc_filter0', mb_substr( $subex, 0, $excut )); // Extending @since 3.1
				} else {
					return apply_filters('ipwp_excmc_filter1', $subex); // Extending @since 3.1
				}
				return apply_filters('ipwp_excmc_filter_more', '[...]'); // Extending @since 3.1
			}elseif(!$ipwp_content||$ipwp_content==''){
/** rare cases where post content is ONLY shortcode
* heeeeey! We still have no content! OK, let's tray get post title
* @since 3.1.3
*/
				global $post;
				$ipwp_content = $post->post_title;
				return apply_filters('ipwp_excmc_nocontent', $ipwp_content);
			}
			else{
				/* I give up! Some very rare,rare cases where we do not have content AND we do not have title. That's weird!*/
				return apply_filters('ipwp_excmc_nocontent_notitle', $ipwp_content);
			}

		}
/** indevd:As a NextGen Gallery user, I encountered a problem showing my image URL for post where postthumbnail was not uploaded to the WP media gallery but picked from the NextGen Gallery.
 * http://wordpress.org/support/topic/mod-for-nextgen-gallery-users?replies=2#post-3807567
 * @since 3.3.2
 * @author indevd
 * @date 2013-02-06
*/
		public function itempropwp_get_image_path($post_id) {
			if(!$post_id||$post_id==''){
				global $post;
				$post_id = $post->ID;
			}
			$id = get_post_thumbnail_id($post_id);
			
			if(stripos($id,'ngg-') !== false && class_exists('nggdb')){
				$nggImage = nggdb::find_image(str_replace('ngg-','',$id));
				$thumbnail = array(
					$nggImage->imageURL,
					$nggImage->width,
					$nggImage->height
				);
			} else {
				$thumbnail = wp_get_attachment_image_src($id,'full');
				//$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			}
			$theimage = $thumbnail[0];
			$theimage = str_replace('?uamfiletype=nggImage','',$theimage);
			return apply_filters('ipwp_post_imguri', $theimage);
		}
		public function ipwp_the_content_filter($content) {
			if (is_singular() && !is_feed()){
				global $post;
				$post_id = $post->ID;
	
				$thisipwp_post = get_post($post_id);
				$ipwp_posth = '';
				$ipwp_image = '';
				$showcommcount = '';
				$ipwp_datemodified='';
				$ipwpdatemodified = get_option('smcipwp_datemodified');

				$ipwp_post_dsc = apply_filters('ipwp_post_dsc', $thisipwp_post->post_excerpt);
				if (function_exists('has_post_thumbnail')) {
					if ( has_post_thumbnail($post_id)) {
						$itempropwpimg = new itempropwp;
						$ipwp_posth = $itempropwpimg->itempropwp_get_image_path($post_id);
						// removed @since 3.3.2 replaced with  itemprop_get_image_path()
						//$ipwp_post_imga = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); // all other sizes are not permanent :| 
						//$ipwp_posth = apply_filters('ipwp_post_imguri', $ipwp_post_imga[0]); // image link + Extending @since 3.1
					}
				}
				
				
				if($ipwp_posth){
					$ipwp_image = '<meta itemprop="image" content="'.esc_url($ipwp_posth).'" />';
				}
	
				if(!$ipwp_post_dsc){
					$ipwp_n = new itempropwp;
					$ipwp_post_dsc = apply_filters('ipwp_post_dsc', $ipwp_n->ipwp_excerpt_maxchr(get_option('smcipwp_maxlenght'), strip_shortcodes($thisipwp_post->post_content) )); // Extending @since 3.1
				}
				
				if(get_option('smcipwp_showcommcount')=='on'){
					$showcommcount = '<meta itemprop="interactionCount" content="UserComments:'.esc_attr($thisipwp_post->comment_count).'" />';
				}
				if($ipwpdatemodified=='on'){
					$ipwp_datemodified= '<meta itemprop="dateModified" content="'.esc_attr($thisipwp_post->post_modified).'" />';
				}
				
				$smcipwp_author_link = get_option('smcipwp_author_link'); /* Per post options @since 3.3.0 */
				if($smcipwp_author_link==''){
					$smcipwp_author_link = get_author_posts_url($thisipwp_post->post_author);
				}
				$postauthoris = esc_url($smcipwp_author_link);
				
				$ipwp_contentx = apply_filters('itempropwp_article_content_before','<span itemscope itemtype="http://schema.org/Article" class="itempropwp-wrap"><!-- ItemProp WP '.SMCIPWPV.' by Rolands Umbrovskis http://umbrovskis.com/ --><meta itemprop="name" content="'.esc_attr($thisipwp_post->post_title).'"><meta itemprop="url" content="'.esc_url(get_permalink()).'">'
	.$ipwp_image.'<meta itemprop="author" content="'.$postauthoris.'"><meta itemprop="description" content="'.strip_tags(str_replace(array("\r\n", "\n", "\r", "\t"), "", $ipwp_post_dsc)).'"><meta itemprop="datePublished" content="'.esc_attr($thisipwp_post->post_date).'">'
	.$ipwp_datemodified
	.$showcommcount.'<!-- ItemProp WP '.SMCIPWPV.' by Rolands Umbrovskis http://umbrovskis.com/ end --></span>');

				$content = $content.$ipwp_contentx;
				$content = apply_filters('itempropwp_article_content', $content);
				
				return $content;
			}
			return $content;
		}
	
	}
//}
/* itemprop Review */
include_once(SMCIPWPM.'/itemprop_review.php');
/* itemprop Person */
/* itemprop LocalBusiness */
/* itemprop RealEstateAgent */
