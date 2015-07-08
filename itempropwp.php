<?php

/**
  Plugin Name: itemprop WP for SERP (and SEO) Rich snippets
  Plugin URI: http://simplemediacode.com/?utm_source=wordpress&utm_medium=wpplugin&utm_campaign=itempropWP&utm_content=v-3.4.7a-itempropWP_load_widgets
  Description: Add human invisible schema.org code to content
  Version: 3.4.7-alpha
  Requires at least: 3.3
  Tested up to: 4.2.2
  Author: Rolands Umbrovskis
  Author URI: http://umbrovskis.com
  License: simplemediacode
  License URI: http://simplemediacode.com/license/gpl/

  Copyright (C) 2008-2015, Rolands Umbrovskis - rolands@simplemediacode.com

 */
/*
 * Simple check for WordPress. Make sure we don't expose any info if called directly
 * @since 3.4.6
 * @version 1.0.0
 */
if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
/* some old fashion constants */
define('SMCIPWPV', '3.4.7-alpha'); // location general @since 1.0
define('SMCIPWPM', dirname(__FILE__)); // location general @since 1.0
define('SMCIPWPF', 'itempropwp'); // location folder @since 1.0 
define('IPWPT', __('itemprop WP for SERP/SEO Rich snippets', 'itempropwp')); // Name @since 1.1
define('IPWPTSN', __('itemprop WP', 'itempropwp')); // Name @since 3.3.0
define('SMCIPWPURL', plugin_dir_url(__FILE__)); // Plugin URI @since 1.0
define('SMCIPWPDIR', dirname(plugin_basename(__FILE__))); /* @since 3.2.0 */
$smcipwp_url = SMCIPWPURL; // @since 3.1 Use of undefined constant SMCIPWPURL - assumed 'SMCIPWPURL' in 
$smcipwp_f = SMCIPWPF; // @since 3.1 Use of undefined constant SMCIPWPF - assumed 'SMCIPWPF' in 

define('SMCIPWPI', trailingslashit($smcipwp_url . '/img')); // Image location @since 1.0
define('SMCIPWPORG', 'https://wordpress.org/plugins/' . trailingslashit($smcipwp_f)); // Plugin on WordPress.org @since 1.0

/** Plugin homepage based on WP language
 * @since 3.1.4
 */
$plugref = '?utm_campaign=' . SMCIPWPF . '&utm_content=' . SMCIPWPF . '-' . SMCIPWPV . '&utm_medium=link&utm_source=' . SMCIPWPF . '-plugin';
switch (WPLANG) {
    case 'lv':
        define('IPWPT_HOMEPAGE', 'http://simplemediacode.com/' . $plugref); // Homepage @since 3.1.4
        define('IPWPT_HOMEPAGEC', 'http://simplemediacode.com/'); // Homepage @since 3.3.0
        break;

    default:
        define('IPWPT_HOMEPAGE', 'http://simplemediacode.com/' . $plugref); // Homepage @since 3.1
        define('IPWPT_HOMEPAGEC', 'http://simplemediacode.com/'); // Homepage @since 3.3.0
        break;
}

define('IPWPT_GITHUB', 'https://github.com/rolandinsh/' . $smcipwp_f); // Homepage @since 3.1 
//define('IPWPT_VERSUPPORT', 'http://simplemediacode.org/forums/topic/itempropwp-3-3-0/' . $plugref); // Version specific support @since 3.3.0

/*
  Disable Itemprop on Woocommerce #8

  @author rolandinsh
  @date 2015-03-04
  @since 3.4.3
  @url https://github.com/rolandinsh/itempropwp/issues/8

  @TODO: Optimize
 */
 define('IPWPT_WC', false);
// dummy way to test via http://docs.woothemes.com/document/create-a-plugin/#section-1
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    define('IPWPT_WC', true);
}
/*
 * itempropwp class
 * @since 2.0
 */

class itempropwp
{

    public function __construct()
    {
        add_action('init', array($this, 'init'), 11);
        add_action('plugin_row_meta', array($this, 'smcwpd_set_plugin_meta'), 11, 2);
    }

    // Initialize
    public function init()
    {

        /*
         * itempropwp Admin interface
         * @since 3.1.4
         * @version 1.0
         */
        if (is_admin()):
            include_once(SMCIPWPM . '/admin/adminipwp.php');
        endif;
        /*
         * itempropwp CSS
         * @since 3.2.0
         * @version 1.0
         */
        if (!is_admin()):
            wp_register_style('itempropwp', SMCIPWPURL . 'assets/css/itempropwp.css', false, SMCIPWPV, 'all');
            wp_enqueue_style('itempropwp');
        endif;

        load_plugin_textdomain('itempropwp', false, SMCIPWPDIR . '/lang/');
        add_filter('the_content', array($this, 'ipwp_the_content_filter'), 10, 2); // Adding context @since 3.0
    }

    function smcwpd_set_plugin_meta($links, $file)
    {
        $plugin = plugin_basename(__FILE__);
        // create link
        if ($file == $plugin) {
            return array_merge($links, array(
                     '<a href="http://www.amazon.de/registry/wishlist/3ARHPQ1SLAMPV">' . __("My Amazon wishlist","itempropwp") . '</a>',
                    // '<a href="' . IPWPT_VERSUPPORT . '">' . sprintf(__("Support for version %s", "itempropwp"), SMCIPWPV) . '</a>',
                    //'<a href="http://simplemediacode.org/forums/forum/itempropwp-plugin/suggestions-for-itempropwp/">' . __('Feature request') . '</a>',
                    // '<a href="http://simplemediacode.org/forums/forum/itempropwp-plugin/">' . __("Join Members group","itempropwp") . '</a>',
            ));
        }
        return $links;
    }

    /* 3.0 drop */

    public function ipwp_img_attr($attr)
    {
        $attr['itemprop'] = 'image';
        return apply_filters('ipwp_img_attr_filter', $attr); // Extending @since 3.1
    }

    /*
     * if post has no excerpt, we will use this
     * @Todo rewrite
     * @since 3.1
     */

    public function ipwp_excerpt_maxchr($charlength = 170, $ipwp_content = '')
    {
        /* did we get content? No, let's make it from post */
        if ($ipwp_content == '') {
            global $post;
            $ipwp_content = apply_filters('ipwp_excmc_filter_excerpt', $post->post_excerpt);  // Extending @since 3.1.2
            if (!$ipwp_content || $ipwp_content == '') {
                $ipwp_content = apply_filters('ipwp_excmc_filter_content', strip_shortcodes($post->post_content));  // Extending @since 3.1
                $ipwp_content = str_replace(array("\r\n", "\n", "\r", "\t"), "", $ipwp_content);
            }
        }

        $charlength++;

        if (mb_strlen($ipwp_content) > $charlength) {
            $subex = mb_substr($ipwp_content, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                return apply_filters('ipwp_excmc_filter0', mb_substr($subex, 0, $excut)); // Extending @since 3.1
            } else {
                return apply_filters('ipwp_excmc_filter1', $subex); // Extending @since 3.1
            }
            return apply_filters('ipwp_excmc_filter_more', '[...]'); // Extending @since 3.1
        } elseif (!$ipwp_content || $ipwp_content == '') {
            /** rare cases where post content is ONLY shortcode
             * heeeeey! We still have no content! OK, let's tray get post title
             * @since 3.1.3
             */
            global $post;
            $ipwp_content = $post->post_title;
            return apply_filters('ipwp_excmc_nocontent', $ipwp_content);
        } else {
            /* I give up! Some very rare,rare cases where we do not have content AND we do not have title. That's weird! */
            return apply_filters('ipwp_excmc_nocontent_notitle', $ipwp_content);
        }
    }

    /** indevd:As a NextGen Gallery user, I encountered a problem showing my image URL for post where postthumbnail was not uploaded to the WP media gallery but picked from the NextGen Gallery.
     * http://wordpress.org/support/topic/mod-for-nextgen-gallery-users?replies=2#post-3807567
     * @since 3.3.2
     * @author indevd
     * @date 2013-02-06
     */
    public function itempropwp_get_image_path($post_id)
    {
        if (!$post_id || $post_id == '') {
            global $post;
            $post_id = $post->ID;
        }
        $id = get_post_thumbnail_id($post_id);

        if (stripos($id, 'ngg-') !== false && class_exists('nggdb')) {
            $nggImage = nggdb::find_image(str_replace('ngg-', '', $id));
            $thumbnail = array(
                $nggImage->imageURL,
                $nggImage->width,
                $nggImage->height
            );
        } else {
            $thumbnail = wp_get_attachment_image_src($id, 'full');
            //$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        }
        $theimage = $thumbnail[0];
        $theimage = str_replace('?uamfiletype=nggImage', '', $theimage);
        return apply_filters('ipwp_post_imguri', $theimage);
    }

    public function ipwp_the_content_filter($content)
    {
        /*
          Content loading multiple times. patch by sirene http://simplemediacode.org/forums/topic/schema-display-3-times/#post-97
          Now, the $ipwp_contentx is loading just one time and not multiple time if you have more than one the_content(); in your page
          @author sirene
          @date 2013-02-18
          @version 1.0.0
          @since 3.3.4
         */
        static $done_ipwp_post = FALSE;

        if (is_singular() && !is_feed()) {
            global $post;
            $post_id = $post->ID;

            $thisipwp_post = get_post($post_id);
            $ipwp_posth = FALSE;
            $ipwp_image = '';
            $showcommcount = '';
            $ipwp_datemodified = '';
            $ipwpdatemodified = get_option('smcipwp_datemodified');

            $ipwp_post_dsc = apply_filters('ipwp_post_dsc', $thisipwp_post->post_excerpt);
            if (function_exists('has_post_thumbnail')) {
                if (has_post_thumbnail($post_id)) {
                    $itempropwpimg = new itempropwp;
                    $ipwp_posth = $this->itempropwp_get_image_path($post_id);
                }
            }

            if ($ipwp_posth) {
                $ipwp_image = '<meta itemprop="image" content="' . esc_url($ipwp_posth) . '" />';
            }

            if (!$ipwp_post_dsc) {
                $ipwp_n = new itempropwp;
                $ipwp_post_dsc = apply_filters(
                        'ipwp_post_dsc', $this->ipwp_excerpt_maxchr(get_option('smcipwp_maxlenght'), strip_tags(strip_shortcodes($thisipwp_post->post_content)))
                ); // Extending @since 3.1
            }

            if (get_option('smcipwp_showcommcount') == 'on') {
                $showcommcount = '<meta itemprop="interactionCount" content="UserComments:' . esc_html($thisipwp_post->comment_count) . '" />';
            }
            if ($ipwpdatemodified == 'on') {
                $ipwp_datemodified = '<meta itemprop="dateModified" content="' . esc_html(apply_filters('itempropwp_article_post_modified', $thisipwp_post->post_modified)) . '" />'; /* @since 3.3.4 */
            }

            $smcipwp_author_link = get_option('smcipwp_author_link'); /* Per post options @since 3.3.0 */
            if ($smcipwp_author_link == '') {
                $smcipwp_author_link = get_author_posts_url(apply_filters('itempropwp_article_post_author', $thisipwp_post->post_author)); /* @since 3.3.4 */
            }
            $postauthoris = esc_url($smcipwp_author_link);

            $ipwp_contentx = apply_filters('itempropwp_article_content_before', '<span itemscope itemtype="http://schema.org/Article" class="itempropwp-wrap"><!-- ItemProp WP ' . SMCIPWPV . ' by Rolands Umbrovskis http://umbrovskis.com/ --><meta itemprop="name" content="' . esc_html($thisipwp_post->post_title) . '" /><meta itemprop="url" content="' . esc_url(get_permalink()) . '" />'
                    . $ipwp_image . '<meta itemprop="author" content="' . $postauthoris . '" /><meta itemprop="description" content="' .
                    esc_html(str_replace(array("\r\n", "\n", "\r", "\t"), "", $ipwp_post_dsc)) . '" /><meta itemprop="datePublished" content="' . esc_html($thisipwp_post->post_date) . '" />'
                    . $ipwp_datemodified
                    . $showcommcount . '<!-- ItemProp WP ' . SMCIPWPV . ' by Rolands Umbrovskis http://umbrovskis.com/ end --></span>');

            if ($done_ipwp_post) { /* @since 3.3.4 */
                return $content;
            } else {
                $content = $content . $ipwp_contentx;
                $content = apply_filters('itempropwp_article_content', $content);  /* @since 3.3.4 */
                $done_ipwp_post = TRUE;
            }

            do_action('ipwp_post_before_content_end'); /* @since 3.3.4 */
            return apply_filters('itempropwp_article_content_distilled', $content); /* @since 3.3.4 */
            do_action('ipwp_post_after_content_end'); /* @since 3.3.4 */
        }

        do_action('ipwp_post_before_end'); /* @since 3.3.4 */
        $done_ipwp_post = TRUE; /* @since 3.3.4 */
        return apply_filters('itempropwp_article_content_undistilled', $content); /* @since 3.3.4 */
        do_action('ipwp_post_after_end'); /* @since 3.3.4 */
    }

}

 /*
 * TODO optimize 
 */
$iswcactive = IPWPT_WC;
if (!$iswcactive) {
    /*
     * Starting itempropwp
     */
    new itempropwp();
    /* itemprop Review */
    include_once(SMCIPWPM . '/itemprop_review.php');
}
    /* itemprop Person */
    /* itemprop LocalBusiness */
    /* itemprop RealEstateAgent */