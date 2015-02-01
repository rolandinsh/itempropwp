<?php 

	define('SMCIPWPM',dirname(__FILE__)); // location general @since 1.0
	define('SMCIPWPF','itempropwp'); // location folder @since 1.0 
	define('IPWPT',__('itemprop WP for SERP/SEO Rich snippets','itempropwp')); // Name @since 1.1
	define('IPWPTSN',__('itemprop WP','itempropwp')); // Name @since 3.3.0
	define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Plugin URI @since 1.0

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