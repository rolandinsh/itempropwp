<?php 
/**
 * Plugin Name: itemprop WP for SERP/SEO Rich snippets
 * Plugin URI: http://simplemediacode.com/wordpress/itempropwp/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-3-1-1-itempropWP_load_widgets
 * Description: Add human invisible schema.org itemprop code to images
 * Version: 3.1.2
 * Requires at least: 3.3
 * Tested up to: 3.5
 * Author: Rolands Umbrovskis
 * Author URI: http://umbrovskis.com
 * License: simplemediacode
 * License URI: http://simplemediacode.com/license/gpl/
 */
	define('SMCIPWPV','3.1.2'); // location general @since 1.0
	define('SMCIPWPM',dirname(__FILE__)); // location general @since 1.0
	define('SMCIPWPF','itempropwp'); // location folder @since 1.0 
	define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Plugin URI @since 1.0
	$smcipwp_url = SMCIPWPURL; // @since 3.1 Use of undefined constant SMCIPWPURL - assumed 'SMCIPWPURL' in 
	$smcipwp_f = SMCIPWPF; // @since 3.1 Use of undefined constant SMCIPWPF - assumed 'SMCIPWPF' in 
	
	define('SMCIPWPI',trailingslashit( $smcipwp_url. '/img' )); // Image location @since 1.0
	define('SMCIPWPORG','http://wordpress.org/extend/plugins/'.trailingslashit($smcipwp_f)); // Plugin on WordPress.org @since 1.0
	define('IPWPT',__('itemprop WP for SERP/SEO Rich snippets','itempropwp')); // Name @since 1.1
	define('IPWPT_HOMEPAGE','http://simplemediacode.com/wordpress/itempropwp/'); // Homepage @since 3.1
	define('IPWPT_GITHUB','https://github.com/rolandinsh/itempropwp'); // Homepage @since 3.1
	define('IPWPT_BITBUCKET','https://bitbucket.org/simplemediacode/itempropwp'); // Homepage @since 3.1
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
			// add_filter('wp_get_attachment_image_attributes', array( 'itempropwp', 'ipwp_img_attr' ), 10, 2 ); // Adding itemprop=image to thumbnails  @since 2.0
			add_filter('the_content', array( 'itempropwp', 'ipwp_the_content_filter' ), 10, 2 ); // Adding context @since 3.0
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
		public function ipwp_excerpt_maxchr($charlength,$ipwp_content='') {
			if($ipwp_content==''){
				global $post;  
				
				$ipwp_content = apply_filters('ipwp_excmc_filter_content', $post->post_excerpt);  // Extending @since 3.1.2
				
				if(!$ipwp_content||$ipwp_content==''){
					$ipwp_content = apply_filters('ipwp_excmc_filter_content', $post->post_content);  // Extending @since 3.1
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
			} else {
				return $ipwp_content;
			}
		}
		
		public function ipwp_the_content_filter($content) {
			if (is_singular() && !is_feed()){
				global $post;
				/* var_dump($post); */
	
				$thisipwp_post = get_post($post->ID);
				$ipwp_posth = '';
				$ipwp_image = '';
				$ipwp_post_dsc = apply_filters('ipwp_post_dsc', $thisipwp_post->post_excerpt);
				if ( has_post_thumbnail($post->ID)) {
					$ipwp_post_imga = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); // all other sizes are not permanent :| 
					$ipwp_posth = apply_filters('ipwp_post_imguri', $ipwp_post_imga[0]); // image link + Extending @since 3.1
				}
				
				if($ipwp_posth){
					$ipwp_image = "\n\t".'<meta itemprop="image" content="'.esc_url($ipwp_posth).'" />'."\n\t";
				}
	
				
				if(!$ipwp_post_dsc){
					//$ipwp_n = new itempropwp;
					//$ipwp_post_dsc = apply_filters('ipwp_post_dsc', $ipwp_n->ipwp_excerpt_maxchr(128,$thisipwp_post->post_content)); // Extending @since 3.1
					$ipwp_post_dsc = apply_filters('ipwp_post_dsc', $thisipwp_post->post_title); // Extending @since 3.1.2
				}
				
	
				$content = $content."\n".'<span itemscope itemtype="http://schema.org/Article">
<!-- ItemProp WP '.SMCIPWPV.' by Rolands Umbrovskis http://umbrovskis.com -->
	<meta itemprop="name" content="'.esc_attr($thisipwp_post->post_title).'" />
	<meta itemprop="url" content="'.esc_url(get_permalink()).'" />'
	.$ipwp_image.
	'<meta itemprop="author" content="'.get_author_posts_url($thisipwp_post-> post_author).'" />
	<meta itemprop="description" content="'.esc_html($ipwp_post_dsc).'"/>
	<meta itemprop="datePublished" content="'.esc_attr($thisipwp_post->post_date).'" />
	<meta itemprop="interactionCount" content="UserComments:'.esc_attr($thisipwp_post->comment_count).'" />
<!-- ItemProp WP '.SMCIPWPV.' by Rolands Umbrovskis http://umbrovskis.com end -->
</span>'."\n";
			
				return $content;
			}
			return $content;
		}
	
	}
