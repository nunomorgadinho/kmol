<?php
/*
 ===============================================================
Theme Options Page
===============================================================
*/

// create custom theme settings menu 

add_action('admin_menu', 'kmol_options');

function kmol_options() {

	//create new top-level menu
	add_menu_page('Opções KMOL', 'KMOL', 'administrator', 'kmol_options_page', 'kmol_options_page');


}

//call register settings function
add_action( 'admin_init', 'register_kmol_options' );

function register_kmol_options() {

	if (isset($_POST["update_settings"])) {
		// Do the saving
		update_option('articles', $_POST['articles']);
		update_option('books', $_POST['books']);
		update_option('interviews', $_POST['interviews']);
		update_option('cases', $_POST['cases']);
		update_option('blog', $_POST['blog']);
		update_option('recomend', $_POST['recomend']);
		
		update_option('banner1', $_POST['banner1']);
		update_option('banner2', $_POST['banner2']);
		update_option('banner3', $_POST['banner3']);
		update_option('banner4', $_POST['banner4']);
		
		update_option('twitter', $_POST['twitter']);
		update_option('facebook', $_POST['facebook']);
	}
	
	
	
	//register our settings
	register_setting( 'categories-group', 'articles' );
	register_setting( 'categories-group', 'books' );
	register_setting( 'categories-group', 'interviews' );
	register_setting( 'categories-group', 'cases' );
	register_setting( 'categories-group', 'blog' );
	register_setting( 'categories-group', 'recomend' );
	
	register_setting( 'banners-home', 'banner1' );
	register_setting('banners-home', 'banner2');
	register_setting('banners-home', 'banner3');
	register_setting('banners-home', 'banner4');
	
	register_setting('social-links','twitter');
	register_setting('social-links', 'facebook');
}

function kmol_options_page() {
	?>
<div class="wrap">
	<h2><?php _e('Opções Tema KMOL','kmol');?></h2>

	<form method="post" action="options.php">
	
	<!-- CATEGORIAS -->
		<h2><?php _e('Atribuição de Categorias:','kmol');?></h2>
		<?php settings_fields( 'categories-group' ); ?>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Artigos','kmol');?></th>
				<td>
					<?php wp_dropdown_categories(array('name'=>'articles', 'selected'=>get_option('articles'))); ?>
				</td>
			</tr>
 
			<tr valign="top">
				<th scope="row"><?php _e('Livros','kmol');?></th>
				<td>
					<?php wp_dropdown_categories(array('name'=>'books', 'selected'=>get_option('books'))); ?>
				</td>
			</tr>
	
			<tr valign="top">
				<th scope="row"><?php _e('Entrevistas','kmol');?></th>
				<td><?php wp_dropdown_categories(array('name'=>'interviews','selected'=>get_option('interviews'))); ?></td>
			</tr>
	
			<tr valign="top">
				<th scope="row"><?php _e('Casos','kmol');?></th>
				<td><?php wp_dropdown_categories(array('name'=>'cases','selected'=>get_option('cases'))); ?></td>
			</tr> 
			
			<tr valign="top">
				<th scope="row"><?php _e('Blog');?></th>
				<td>
					<?php wp_dropdown_categories(array('name'=>'blog','selected'=>get_option('blog'))); ?></td>
			</tr> 
			
			<tr valign="top">
				<th scope="row"><?php _e('Recomendações','kmol');?></th>
				<td>
					<?php wp_dropdown_categories(array('name'=>'recomend','selected'=>get_option('recomend'))); ?></td>
			</tr> 
		</table>
	
	<!-- BANNERS HOME -->
		<h2><?php _e('Banners:','kmol');?></h2>
		<?php settings_fields( 'banners-home' ); ?>
	
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Banner 300x251 (home)','kmol');?></th>
				<td>
					<label for="banner1">
						<input id="banner1" type="text" size="36" name="banner1" value="<?php echo get_option('banner1');?>" />
						<input id="upload_image_button" type="button" value="Upload Imagem" />
						<br /><?php _e('Adiciona um URL ou faz upload de uma imagem para banner 300x251.');?>
					</label>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php _e('Banner 620x100 (home)','kmol');?></th>
				<td>
					<label for="banner2">
						<input id="banner2" type="text" size="36" name="banner2" value="<?php echo get_option('banner2');?>" />
						<input id="upload_image_button2" type="button" value="Upload Imagem" />
						<br /><?php _e('Adiciona um URL ou faz upload de uma imagem para banner 620x100.');?>
					</label>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php _e('Banner 220x100','kmol');?></th>
				<td>
					<label for="banner2">
						<input id="banner3" type="text" size="36" name="banner3" value="<?php echo get_option('banner3');?>" />
						<input id="upload_image_button3" type="button" value="Upload Imagem" />
						<br /><?php _e('Adiciona um URL ou faz upload de uma imagem para banner 220x100.');?>
					</label>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php _e('Banner 700x100','kmol');?></th>
				<td>
					<label for="banner4">
						<input id="banner4" type="text" size="36" name="banner4" value="<?php echo get_option('banner4');?>" />
						<input id="upload_image_button2" type="button" value="Upload Imagem" />
						<br /><?php _e('Adiciona um URL ou faz upload de uma imagem para banner 700x100.');?>
					</label>
				</td>
			</tr>
		</table>
		
		
		<!-- SOCIAL LINKS -->
		<h2><?php _e('Social Links:','kmol');?></h2>
		<?php settings_fields( 'social-links' ); ?>
	
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Twitter','kmol');?></th>
				<td>
					<input id="twitter" type="text" size="30" name="twitter" value="<?php echo get_option('twitter');?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Facebook','kmol');?></th>
				<td>
					<input id="facebook" type="text" size="30" name="facebook" value="<?php echo get_option('facebook');?>" />
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="update_settings" value="Y" />  
	
		<?php submit_button(); ?>

	</form>
</div>
<?php }
/*
===============================================================
END Theme Options Page
===============================================================
*/