<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

	</div><!-- #main .site-main -->
<div class="full_width_footer">
	<footer id="colophon" class="site-footer container_12" role="contentinfo">
		<div class="grid_3 alpha">
				<h1 class="footer_title">Subscrever</h1>
				<div class="social alignleft"><?php dynamic_sidebar('Social_Widget'); ?></div>
                <div class="subscribe_footer">
                <input type="text" id="subscribe_footer_box" placeholder="mail..."/>
                <input type="submit" id="subscribe_footer_submit" value="Newsletter"/>
         		</div>
         </div>
         <div class="grid_3">
         	<h1 class="footer_title"><?php _e('Contribuir')?></h1>
		<?php 
			$towrite = get_page_by_path('escrever');
			 
		?>
         	<h2 class="footer_subtitle"><a href="<?php echo get_permalink($towrite->ID);?>"><?php _e('Escrever','kmol');?></a></h2>
         	<h2 class="footer_subtitle"><a href="/">Livro de Visitas</a></h2>
         </div>
         <div class="grid_3">
         	<h1 class="footer_title">Apoiar</h1>

         	<h2 class="footer_subtitle"><a href="/">Patrocinar</a></h2>
         	<h2 class="footer_subtitle"><a href="/">Anunciar</a></h2>
         </div>
         <div class="grid_3 omega">
         	<h1 class="footer_title">Sobre</h1>

         	<h2 class="footer_subtitle"><a href="/">O Portal</a></h2>
         	<div class="footer_contact">
         	<h2 class="footer_subtitle"><a href="/">Contactar</a></h2>
         	<h2 class="footer_link"><a href="mailto:marketing@kmol.online.pt">marketing@kmol.online.pt</a></h2>
         	</div>
         	<h2 class="footer_subtitle"><a href="/">Créditos</a></h2>
         </div>
         <div class="grid_12 copyright alpha omega"><center>
         	<p>Copyright &copy; 2012 knowman | <?php _e('Todos os direitos reservados','kmol');?></p>
         </center></div>
	</footer><!-- #colophon .site-footer -->
</div>

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>