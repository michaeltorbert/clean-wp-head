<?php
/*
Plugin Name: Clean WP Head
Plugin URI: http://semperfiwebdesign.com/wordpress-plugins/clean-wp-head/
Description: Removes extra output in websites header area.
Author: Michael Torbert
Version: .2.1
Author URI: http://semperfiwebdesign.com/
*/

/*
Copyright (C) 2008-2009 Michael Torbert, semperfiwebdesign.com (michael AT semperfiwebdesign DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );



add_action('admin_menu', 'cwh_add_page');

function cwh_add_page() {
    add_options_page('Clean WP Head', 'Clean WP Head', 'administrator', 'cleanwphead', 'cwh_options_page');

  
}


function cwh_options_page() {
	?>
	<div class="wrap">
	<h2>Clean WP Head</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
Remove what you don't want to show up in the head section of your website.	
	<table class="form-table">
		
		
	<?php
	
	$mrt_cwh_stuffinhead_ary = array('red_link','wlwmanifest_link','wp_generator','feed_links_extra', 'feed_links', 'rsd_link', 'index_rel_link', 'parent_post_rel_link', 'start_post_rel_link', 'adjacent_posts_rel_link', 'locale_stylesheet', 'noindex', 'wp_print_styles');
	
	foreach($mrt_cwh_stuffinhead_ary as $key){
	//	echo $key;
	$mrt_cwh_stuffinhead_str = $mrt_cwh_stuffinhead_str . $key . ',';
		?>
		<tr valign="top">
		<th scope="row"><?php echo $key; ?></th>
		<td><input type="checkbox" name="<?php echo $key; ?>" <?php if(get_option($key)) echo 'checked="1"'; ?> /></td>
		</tr>
		<?php
		
	}
	
	
?>


	</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="<?php echo $mrt_cwh_stuffinhead_str; ?>" />

	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>

	</form>
	</div>

<?php
 
}

foreach($mrt_cwh_stuffinhead_ary as $key){
	if(get_option($key)) remove_action('wp_head',$key);
}


?>
