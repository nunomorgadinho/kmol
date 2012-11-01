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
				<option value="Autor">filtrar por autor</option>
				<option value="Data" selected>filtrar por data</option>
			</select>
			<div class="general_title alignleft">Artigos</div>
			<div class="news_title title_single">Inteligência Competitiva nas organizações em Portugal</div>
			<div class="image_principal image_single"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/gestao_conhecimento.jpg"/></div>
            <p class="news_excerpt excerpt_single">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu nisi nibh, at convallis turpis. 
                            Maecenas consectetur facilisis suscipit. Donec consectetur sagittis nibh, sit amet blandit mi scelerisque eget. 
                            Sed at faucibus.
            <div class="news_meta meta_single">por Ana Neves, 30 ago<span class="readmore_single">Ler Mais...</span></div>
            <span class="clear"></span>
         	 
<!--   First Row  -->
			<div class="grid_8 alpha">
	         	 <div class="sublayer grid_4 alpha sublayer_single">
	                    <p class="sublayer_title">O Trabalhador da Mudança</p>
	                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
	                    <span class="readmore_single">Ler Mais...</span>
	                </div>

	                <div class="sublayer grid_4 omega sublayer_single">
	                    <p class="sublayer_title">Influenciando comportamentos</p>
	                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
	                    <span class="readmore_single">Ler Mais...</span>
	                </div>
	        </div>
<!--   Second Row  -->
			<div class="grid_8 alpha">
                <div class="sublayer grid_4 alpha sublayer_single">
                	<div class="image_sublayer"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/barometro_inovacao.jpg"/></div>
                    <p class="sublayer_title">O Trabalhador da Mudança</p>
                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                    <span class="readmore_single">Ler Mais...</span>
                </div>

                <div class="sublayer grid_4 omega sublayer_single">
                    <p class="sublayer_title">Influenciando comportamentos</p>
                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                    <span class="readmore_single">Ler Mais...</span>
                </div>
            </div>
<!--   Third Row  -->
			<div class="grid_8 alpha">
                <div class="sublayer grid_4 alpha sublayer_single">
                    <p class="sublayer_title">O Trabalhador da Mudança</p>
                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                    <span class="readmore_single">Ler Mais...</span>
                </div>

                <div class="sublayer grid_4 omega sublayer_single">
                    <p class="sublayer_title">Influenciando comportamentos</p>
                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                    <span class="readmore_single">Ler Mais...</span>
                </div>
           	</div>      

				<div class="grid_8 alpha">
				     		<div class="more_single alignright">
				     			Artigos mais antigos
				     		</div>     
				</div>

</article><!-- #post-<?php the_ID(); ?> -->
</div>
</div>
	<div class="topics">
		<div class="grid_3 omega">
			<div class="marcador_title">
				Tópicos mais usados
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
				Últimos comentários
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
                    <h1 class="marcador_title">Entrevistas</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador">
                    <h1 class="marcador_title">Casos</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 marcador omega">
                    <h1 class="marcador_title">Livros</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
        </div>

</div>