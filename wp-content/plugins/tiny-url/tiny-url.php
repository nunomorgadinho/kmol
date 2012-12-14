<?php
/*
Plugin Name: Tiny URL
Plugin URI: http://www.prasannasp.net/wordpress-plugins/tiny-url/
Description: This plugin automatically adds a tiny URL for all blog posts after post content. Uses http://tinyurl.com/ service to get Tiny URLs.
Version: 1.3
Author: Prasanna SP
Author URI: http://www.prasannasp.net/
*/

/*  This file is part of Tiny URL plugin. Copyright 2012 Prasanna SP (email: prasanna@prasannasp.net)

    TinyURL is a trademark of TinyURL, LLC

    Tiny URL plugin is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Tiny URL plugin is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Tiny URL plugin.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * This plugin is based on some code snippets by Jean-Baptiste Jung - http://wp.smashingmagazine.com/2009/04/15/10-exceptional-wordpress-hacks/ 
 * The Copy URL function uses ZeroClipboard project by Jon Rohan - https://github.com/jonrohan/ZeroClipboard which is released under MIT license - https://github.com/jonrohan/ZeroClipboard/blob/master/LICENSE
*/

function tu_tiny_url($url) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}


function show_tu_copy_button() {
	$options = get_option('tinyurl_options');
	$buttontext = $options['tinyurl_button_text'];
	if ( isset($options['copy_url_button']) )
	
	return '<span id="tiny-url-button-div" style="position:relative"><button type="button" id="tiny-url-button" class="tiny-url-button">'.$buttontext.'</button></span>';
}

function tu_show_tiny_url($showtinyurl) {
	$options = get_option('tinyurl_options');
	$tinyurlposttitle = $options['tinyurl_title'];
	$tinyurlpagetitle = $options['tinyurl_page_title'];
	$url = tu_tiny_url(get_permalink($post->ID));
	if ( is_single() && ! isset($options['hide_on_posts']) )
 {
		$showtinyurl .= '<p class="tiny-url" id="tiny-url"><strong>'.$tinyurlposttitle.'</strong><br /><input type="text" id="tinyurl" onClick="TinyURLSelectAll(\'tinyurl\');" size="18" value="'.$url.'" />&nbsp;'.show_tu_copy_button().'</p>';
			}
	
	elseif ( is_page() && isset($options['show_on_pages']) )
 {
		$showtinyurl .= '<p class="tiny-url" id="tiny-url"><strong>'.$tinyurlpagetitle.'</strong><br /><input type="text" id="tinyurl" onClick="TinyURLSelectAll(\'tinyurl\');" size="18" value="'.$url.'" />&nbsp;'.show_tu_copy_button().'</p>';
			}
	
	return $showtinyurl;
}

add_filter('the_content', 'tu_show_tiny_url');

function tu_tinyurl_select_script() {
	$options = get_option('tinyurl_options');
	if ( is_single() && ! isset($options['hide_on_posts']) || is_page() && isset($options['show_on_pages']) ) {
?>
<script type="text/javascript">
function TinyURLSelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
<?php
	}
}

add_action('wp_footer', 'tu_tinyurl_select_script');

function tu_tinyurl_copy_script() {
	$options = get_option('tinyurl_options');
	if ( is_single() && isset($options['copy_url_button']) || is_page() && isset($options['copy_url_button']) ) {
?>
<script type="text/javascript" src="<?php echo '' .plugins_url( 'js/ZeroClipboard.js' , __FILE__ ). ''; ?>"></script>
<script language="JavaScript">
  ZeroClipboard.setMoviePath( '<?php echo '' .plugins_url( 'swf/ZeroClipboard10.swf' , __FILE__ ). ''; ?>' );
      var clip = new ZeroClipboard.Client();

      clip.setText( '' ); // will be set later on mouseDown
      clip.setHandCursor( true );
      clip.setCSSEffects( true );

      clip.addEventListener( 'onComplete', function(client, text) {
        alert("Tiny URL copied to clipboard:");
      } );

      clip.addEventListener( 'onMouseDown', function(client) {

        clip.setText( document.getElementById('tinyurl').value );

      } );

      clip.glue( 'tiny-url-button', 'tiny-url-button-div' );
    </script>
<?php
	}
}

add_action('wp_footer', 'tu_tinyurl_copy_script');

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'tinyurl_add_defaults');
register_uninstall_hook(__FILE__, 'tinyurl_delete_plugin_options');
add_action('admin_init', 'tinyurl_init' );
add_action('admin_menu', 'tinyurl_add_options_page');
add_filter('plugin_action_links', 'tinyurl_plugin_action_links', 10, 2 );

// Delete options table entries ONLY when plugin deactivated AND deleted
function tinyurl_delete_plugin_options() {
	delete_option('tinyurl_options');
}

function tinyurl_add_defaults() {
	$tmp = get_option('tinyurl_options');
	if(($tmp['tinyurl_default_options_db']=='1')||(!is_array($tmp))) {
		$arr = array(	"tinyurl_title" => "Tiny URL for this post:",
				"tinyurl_page_title" => "Tiny URL for this page:",
				"tinyurl_default_options_db" => "",
				"tinyurl_button_text" => "Copy"

		);
		update_option('tinyurl_options', $arr);
	}
   }

function tinyurl_init(){
	register_setting( 'tinyurl_plugin_options', 'tinyurl_options', 'tinyurl_validate_options' );
}

function tinyurl_add_options_page() {
	add_options_page('Tiny URL Options Page', 'Tiny URL', 'manage_options', __FILE__, 'tinyurl_options_page_form');
}

function tinyurl_options_page_form() {
	?>
	<div class="wrap">

		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Tiny URL Options</h2>
		<h3>Set your options for Tiny URL plugin.</h3>

		<form method="post" action="options.php">
			<?php settings_fields('tinyurl_plugin_options'); ?>
			<?php $options = get_option('tinyurl_options');
			      $tinyurladminpagetitle = $options['tinyurl_title']; ?>

			<table class="form-table">
			
				<h4>Title Settings</h4>
				<tr>
					<th scope="row">Tiny URL title for posts:</th>
					<td>
						<input type="text" size="50" name="tinyurl_options[tinyurl_title]" value="<?php echo $options['tinyurl_title']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Tiny URL title for pages:</th>
					<td>
						<input type="text" size="50" name="tinyurl_options[tinyurl_page_title]" value="<?php echo $options['tinyurl_page_title']; ?>" />
					</td>
				</tr>
			</table>
			
			<table class="form-table">

				<h4>Tiny URL Appearance</h4>
				<tr>
					<th scope="row">Show Tiny URL on pages</th>
					<td>
						<label><input name="tinyurl_options[show_on_pages]" type="checkbox" value="1" <?php if (isset($options['show_on_pages'])) { checked('1', $options['show_on_pages']); } ?> /> <br />
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">Hide Tiny URL on blog posts</th>
					<td>
						<label><input name="tinyurl_options[hide_on_posts]" type="checkbox" value="1" <?php if (isset($options['hide_on_posts'])) { checked('1', $options['hide_on_posts']); } ?> /> <br />
					</td>
				</tr>
			</table>
			<table class="form-table">

				<h4>Copy URL to Clipboard Option</h4>
				<tr valign="top">
					<th scope="row">Show <strong>Copy</strong> URL button</th>
					<td>
						<label><input name="tinyurl_options[copy_url_button]" type="checkbox" value="1" <?php if (isset($options['copy_url_button'])) { checked('1', $options['copy_url_button']); } ?> /> <br />
						<span class="description">Selecting this will add a button next to Tiny URL to copy the URL to clipboard. (See live example below) Flash is required for this function</span>
					</td>
				</tr>
				<tr>
					<th scope="row">Copy URL button text:</th>
					<td>
						<input type="text" size="25" name="tinyurl_options[tinyurl_button_text]" value="<?php echo $options['tinyurl_button_text']; ?>" />
					</td>
				</tr>
				<tr><td colspan="2"><div style="margin-top:10px;"></div></td></tr>
				<tr valign="top" style="border-top:#dddddd 1px solid;">
					<th scope="row">Database Options:</th>
					<td>
						<label><input name="tinyurl_options[tinyurl_default_options_db]" type="checkbox" value="1" <?php if (isset($options['tinyurl_default_options_db'])) { checked('1', $options['tinyurl_default_options_db']); } ?> /> Restore defaults upon plugin deactivation/reactivation</label>
						<br /><span style="color:#666666;margin-left:2px;">Only check this if you want to reset plugin settings upon Plugin reactivation</span>
					</td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		<div style="border:6px ridge orange;">
			<table class="form-table">
				<tr>
					<th scope="row"><h3>Live example</h3></th>
					<td>
						<p class="tiny-url" id="tiny-url"><strong><?php echo $tinyurladminpagetitle; ?></strong><br /><input type="text" id="tinyurl" size="18" value="http://tinyurl.com/tinyurlplugin" />&nbsp;<?php echo show_tu_copy_button(); ?></p>
					</td>
				</tr>
			</table>
		</div>
		</form>
<hr />
<p style="margin-top:15px;font-size:12px;">If you have found this plugin is useful, please consider making a <a href="http://prasannasp.net/donate/" target="_blank">donation</a> to support the further development of this plugin. Thank you!</p>
	</div>
	<?php	
}

// Sanitize and validate input
function tinyurl_validate_options($input) {
	 // strip html from textboxes
	$input['tinyurl_title'] =  wp_filter_nohtml_kses($input['tinyurl_title']); // strip html tags, and escape characters
	$input['tinyurl_page_title'] =  wp_filter_nohtml_kses($input['tinyurl_page_title']);
	return $input;
}

// Display a Settings link on the main Plugins page
function tinyurl_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$tinyurl_links1 = '<a href="'.get_admin_url().'options-general.php?page=tiny-url/tiny-url.php" title="Tiny URL Settings Page">'.__('Settings').'</a>';
		$tinyurl_links2 = '<a href="http://forum.prasannasp.net/forum/plugin-support/tiny-url/" title="Tiny URL Support Forum" target="_blank">'.__('Support').'</a>';
		
		// make the 'Settings' link appear first
		array_unshift( $links, $tinyurl_links1, $tinyurl_links2 );
	}

	return $links;
}

// Donate link on manage plugin page
function tinyurl_pluginspage_links( $links, $file ) {

$plugin = plugin_basename(__FILE__);

// create links
if ( $file == $plugin ) {
return array_merge(
$links,
array( '<a href="http://www.prasannasp.net/donate/" target="_blank" title="Donate for this plugin via PayPal">Donate</a>',
'<a href="http://www.prasannasp.net/wordpress-plugins/" target="_blank" title="View more plugins from the developer">More Plugins</a>',
'<a href="http://twitter.com/prasannasp" target="_blank" title="Follow me on twitter!">twitter!</a>'
 )
);
			}
return $links;

	}
add_filter( 'plugin_row_meta', 'tinyurl_pluginspage_links', 10, 2 );
?>
