<?php
/**
  Plugin Name: itemprop WP - Rich snippets (better SEO and SERP)
  Plugin URI: http://simplemediacode.com/wordpress-pugins/itemprop-wp/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-3.4.3-itempropWP_load_widgets
  Description: Add schema.org code to WordPress content
  Version: 3.5.0
  Requires at least: 3.3
  Tested up to: 4.1
  Author: Rolands Umbrovskis
  Author URI: http://umbrovskis.com
  License: simplemediacode
  License URI: http://simplemediacode.com/license/gpl/

  Copyright (C) 2008-2015, Rolands Umbrovskis - rolands@simplemediacode.com

 */
if ( ! defined( 'WPINC' ) ) {
    die;
}
// real version number
define('SMCIPWPV','3.5.0'); // location general @since 1.0

define('SMCIPWPDIR',dirname( plugin_basename( __FILE__ ) ));/* @since 3.2.0 */
include_once '_depr/old_data.php';

/*
 * Starting itempropwp
 */
new itempropwp();
/*
 * itempropwp class
 * @since 2.0
 */

//if (!class_exists('itempropwp')) {
class itempropwp
{
    protected $version;
    const VERSION = '3.5.0';
    const SMCIPWPF = 'itempropwp';

    public function __construct()
    {
        $this->version = self::VERSION;
        add_action('init', array(&$this, 'init'), 10);
        //add_action('plugin_row_meta', array($this, 'smcwpd_set_plugin_meta'), 10, 2);
    }
}

//}
/* itemprop Review */
include_once('itemprop_review.php');
/* itemprop Person */
/* itemprop LocalBusiness */
/* itemprop RealEstateAgent */
