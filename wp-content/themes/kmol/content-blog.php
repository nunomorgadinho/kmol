<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>
<div class="container_12">
	<div class="grid_9 alpha">
		<div class="default_page">
			<select class="filter alignright"  name="filter">
				<option value="Autor"><?php _e ('filtrar por autor','kmol'); ?></option>
				<option value="Data" selected><?php _e ('filtrar por data','kmol'); ?></option>
			</select>
			<div class="general_title alignleft"><?php _e ('Blog','kmol'); ?></div>
				
			<div id="container_blog">
				  <div class="sublayer grid_8 alpha sublayer_single">
	                    <p class="sublayer_title"><a href="#">O Trabalhador da Mudança</a></p>
	                    
	                    <p class="news_excerpt excerpt_single">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu nisi nibh, at convallis turpis. 
                            Maecenas consectetur facilisis suscipit. Donec consectetur sagittis nibh, sit amet blandit mi scelerisque eget. 
                            Sed at faucibus.</p>
	                    <span class="readmore_single alignright"><a href="#"><?php _e ('Ler Mais...','kmol'); ?></a></span>
	              </div>
         	 
			
	         	 <div class="sublayer grid_8 alpha sublayer_single">
	                    <p class="sublayer_title"><a href="#">O Trabalhador da Mudança</a></p>
	                    
	                    <p class="news_excerpt excerpt_single">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu nisi nibh, at convallis turpis. 
                            Maecenas consectetur facilisis suscipit. Donec consectetur sagittis nibh, sit amet blandit mi scelerisque eget. 
                            Sed at faucibus.</p>
	                    <span class="readmore_single alignright"><a href="#"><?php _e ('Ler Mais...','kmol'); ?></a></span>
	              </div>  

	                <div class="sublayer grid_8 alpha sublayer_single">
	                    <p class="sublayer_title"><a href="#">Influenciando comportamentos</a></p>
	                    
	                    <p class="news_excerpt excerpt_single">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu nisi nibh, at convallis turpis. 
                            Maecenas consectetur facilisis suscipit. Donec consectetur sagittis nibh, sit amet blandit mi scelerisque eget. 
                            Sed at faucibus.</p>
	                    <span class="readmore_single alignright"><a href="#"><?php _e ('Ler Mais...','kmol'); ?></a></span>
	                </div>
	     
                <div class="sublayer grid_8 alpha sublayer_single">
                	<div class="image_sublayer"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/barometro_inovacao.jpg"/></div>
                    <p class="sublayer_title"><a href="#">O Trabalhador da Mudança</a></p>
                    
                    <p class="news_excerpt excerpt_single">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu nisi nibh, at convallis turpis. 
                            Maecenas consectetur facilisis suscipit. Donec consectetur sagittis nibh, sit amet blandit mi scelerisque eget. 
                            Sed at faucibus.</p>
                    <span class="readmore_single alignright"><a href="#"><?php _e ('Ler Mais...','kmol'); ?></a></span>
                </div>
</div>
                

				<div class="grid_8 alpha">
				     		<div class="more_single alignright">
				     			<a href="#"><?php _e ('Artigos mais antigos','kmol'); ?></a>
				     		</div>     
				</div>

</article><!-- #post-<?php the_ID(); ?> -->
</div>
</div>

	<div class="topics">
		<div class="grid_3 omega image_blog">
			<div class="image_blog_title">
				Ana Neves
			</div>
			<div class="blog_share">
			<a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/mail_blog.png"/></a>
			<a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/twitter_blog.png"/></a>
			<a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/linkedin_blog.png"/></a>
		</div>
			</div>
		
		<div class="grid_3 omega">
			<div class="marcador_title">
				<?php _e ('Tópicos mais usados','kmol'); ?>
			</div>
			<div class="sidebar_description">
				<p><a href="/">gestão_de_conhecimento</a></p>
				<p><a href="/">ferramentas_sociais</a></p>
				<p><a href="/">tecnologia web2.0</a></p>
				<p><a href="/">cultura_organizacional</a></p>
				<p><a href="/">Brasil caso</a></p>
				<p><a href="/">actores_do_conhecimento</a></p>
			</div>
		</div>

		<div class="grid_3 omega">
			<div class="marcador_title">
				<?php _e ('Últimos comentários','kmol'); ?>
			</div>
			<div class="sidebar_description">
				<p><a href="/">gestão_de_conhecimento</a></p>
				<p><a href="/">ferramentas_sociais</a></p>
				<p><a href="/">tecnologia web2.0</a></p>
				<p><a href="/">cultura_organizacional</a></p>
				<p><a href="/">Brasil caso</a></p>
				<p><a href="/">actores_do_conhecimento</a></p>
			</div>
		</div>
	</div>

		<div class="grid_3 omega banner3">
			Banner3 //
		</div>
		<div class="grid_3 omega banner3">
			Banner3 //
		</div>

		<div class="grid_9 alpha omega banner4">
                Banner4 //
        </div>


        <div class="grid_12 alpha omega marcadores">
                <div class="grid_4 alpha marcador">
                    <h1 class="marcador_title"><?php _e ('Entrevistas','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador">
                    <h1 class="marcador_title"><?php _e ('Casos','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador omega">
                    <h1 class="marcador_title"><?php _e ('Livros','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
        </div>

</div>