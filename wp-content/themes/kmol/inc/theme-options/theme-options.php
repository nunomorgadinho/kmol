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
	add_menu_page('Opções KMOL', 'KMOL', 'administrator', __FILE__, 'kmol_options_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_kmol_options' );
}


function register_kmol_options() {
	//register our settings
	register_setting( 'categories-group', 'articles' );
	register_setting( 'categories-group', 'books' );
	register_setting( 'categories-group', 'interviews' );
	register_setting( 'categories-group', 'cases' );
	register_setting( 'categories-group', 'blog' );
	
	register_setting( 'banners-home', 'banner1' );
	register_setting('banners-home', 'banner2');
	
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
		</table>
	
	<!-- BANNERS HOME -->
		<h2><?php _e('Banners Home:','kmol');?></h2>
		<?php settings_fields( 'banners-home' ); ?>
	
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Banner 300x251','kmol');?></th>
				<td>
					<label for="banner1">
						<input id="banner1" type="text" size="36" name="banner1" value="<?php echo get_option('banner1');?>" />
						<input id="upload_image_button" type="button" value="Upload Imagem" />
						<br /><?php _e('Adiciona um URL ou faz upload de uma imagem para banner 300x251.');?>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Banner 620x100','kmol');?></th>
				<td>
					<label for="banner2">
						<input id="banner2" type="text" size="36" name="banner2" value="<?php echo get_option('banner2');?>" />
						<input id="upload_image_button2" type="button" value="Upload Imagem" />
						<br /><?php _e('Adiciona um URL ou faz upload de uma imagem para banner 620x100.');?>
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
		
		
	
		<?php submit_button(); ?>

	</form>
</div>
<?php }
/*
===============================================================
END Theme Options Page
===============================================================
*/