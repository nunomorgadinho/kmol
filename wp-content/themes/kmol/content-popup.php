<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>
<div class="popup_page">
<div class="popup_container aligncenter">


	<div class="popup_counter">
		<h1>266</h1>
		<h2>utilizadores registados</h2>
	</div>
	<div class="popup_box_register">
		<div class="popup_title">
			<h2>Registe-se no </h2>
			<h1>KMOL</h1>
		</div>
		<div class="popup_register">
			<p>Diga-nos quem é, comente e obtenha a sua página pessoal com registo das suas contribuições!</p>
			<div class="alignright">
				<label class="label_principal" for="nome">Nome</label>
				<input type="text" class="popup_field" for="nome"></input>
			</div>
			<span class="clear"></span>
			<div class="alignright">
				<label class="label_principal" for="e-mail">E-mail</label>
				<input type="text" class="popup_field"></input>
			</div>
			<span class="clear"></span>
			<div class="alignright alpha">
				<input type="checkbox"></input>
				<label class="label_secondary" for="checkbox-1">Clique para receber por email a newsletter mensal do KMOL</label>
			</div>
			<span class="clear"></span>
			<div class="alignright alpha">
				<input type="checkbox"></input>
				<label class="label_secondary" for="checkbox-2">Clique para receber por email informação de parceiros</label>
			</div>
			<span class="clear"></span>
			<div class="popup_submit">
				<input class="alignright" type="submit" value="<?php _e('submeter registo','kmol'); ?>" ></input>
			</div>
		</div>
	</div>

</div>
</div>