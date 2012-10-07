<?php 
/*
 * itempropwp Admin interface
 * @since 3.1.4
 * @version 1.0
*/
add_action('admin_menu', 'smc_ipwp_admin_menu');

function smc_ipwp_admin_menu() {
	//create new top-level menu
	add_menu_page(__('itemprop WP for SERP/SEO Rich snippets','itempropwp'), __('itemprop WP','itempropwp'), 'activate_plugins', 'smcipwp_menu', 'smcipwp_settings');
	//add_submenu_page( 'smcipwp_menu', __('Help','itempropwp'), __('Help','itempropwp'), 'edit_posts', 'smcipwphelp', 'smcipwp_help');
	register_setting( 'smcipwp-settings', 'smcipwp_maxlenght' );
	register_setting( 'smcipwp-settings', 'smcipwp_showcommcount' );
	register_setting( 'smcipwp-settings', 'smcipwp_datemodified' );

}

function smcipwp_settings(){ ?><div class="wrap"><div class="icon32" id="icon-tools"><br /></div>
	<h2><?php _e('Settings');?></h2>
	<form method="post" action="options.php">
<?php 

settings_fields( 'smcipwp-settings' );

$smcipwp_maxlenght = get_option('smcipwp_maxlenght');
$smcipwp_showcommcount = get_option('smcipwp_showcommcount');
$smcipwp_datemodified = get_option('smcipwp_datemodified');

if(!$smcipwp_maxlenght||$smcipwp_maxlenght==''){
	$smcipwp_maxlenght = '170'; /* well, we need some value anyway */
}

?>
<table class="form-table table">
	<tr>
		<th valign="top"><?php _e('Description max lenght if no excerpt is provided','itempropwp');?></th>
		<td valign="top"><input type="text" id="smcipwp_maxlenght" name="smcipwp_maxlenght" value="<?php echo $smcipwp_maxlenght;?>" /></td>
	</tr>
	<tr>
		<th valign="top"><?php _e('Show comment count?','itempropwp');?></th>
		<td valign="top"><input type="checkbox" id="smcipwp_showcommcount" name="smcipwp_showcommcount" <?php checked($smcipwp_showcommcount,'on') ?> /></td>
	</tr>
	<tr>
		<th valign="top"><?php _e('Show dateModified?','itempropwp');?></th>
		<td valign="top"><input type="checkbox" id="smcipwp_datemodified" name="smcipwp_datemodified" <?php checked($smcipwp_datemodified,'on') ?> /></td>
	</tr>
 </table>
    <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes','itempropwp') ?>" /></p>
</form>
<hr />
<p class="description">
	<a href="http://simplemediacode.com/" target="_blank">SimpleMediaCode.com - custom WordPress development</a> | 
	<a href="http://twitter.com/SimpleMediaCode" target="_blank">Follow @SimpleMediaCode</a> | 
	Freelance WordPress developer <a href="http://umbrovskis.com/" target="_blank">Rolands Umbrovskis</a>
</p>
</div><?php } // smcwpd_settings()