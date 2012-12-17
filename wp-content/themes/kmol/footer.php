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
		<div class="grid_3 alpha footer-left">
				<h1 class="footer_title">Subscrever</h1>
				<div class="social alignleft"><?php dynamic_sidebar('Social_Widget'); ?></div>
               
                <?php
                    $widgetdata=array (
                    		'title' => '',
                    		'instruction' => '',
                    		'lists' =>
                    		array (
                    				0 => '1',
                    		),
                    		'lists_name' =>
                    		array (
                    				1 => 'A minha primeira lista',
                    		),
                    		'autoregister' => 'not_auto_register',
                    		'labelswithin' => 'labels_within',
                    		'customfields' =>
                    		array (
                    				'email' =>
                    				array (
                    						'label' => '',
                    						'placeholder'=> 'e-mail'
                    				),
                    		),
                    		'submit' => 'Newsletter',
                    		'success' => 'Veja na sua caixa de correio como confirmar a subscrição.',
                    		'widget_id' => 'wysija-3-php',
                    );
                    $widgetNL=new WYSIJA_NL_Widget(1);
                    $subscriptionForm= $widgetNL->widget($widgetdata,$widgetdata);
                    echo $subscriptionForm;
                    
                    
                    ?> 
         </div>
        
         <div class="grid_3">
         	<h1 class="footer_title"><?php _e('Contribuir')?></h1>
		<?php 
			$towrite = get_page_by_path(__('publicar','kmol'));
			$reviews = get_page_by_path(__('livro-de-visitas','kmol'));
			
			$sponsor = get_page_by_path(__('patrocinar','kmol'));
			$adds = get_page_by_path(__('anunciar','kmol'));
			
			$kmol = get_page_by_path(__('sobre','kmol'));
			 
		?>
         	<h2 class="footer_subtitle"><a href="<?php echo get_permalink($towrite->ID);?>"><?php _e('Escrever','kmol');?></a></h2>
         	<h2 class="footer_subtitle"><a href="<?php echo get_permalink($reviews->ID);?>"><?php _e('Livro de Visitas','kmol');?></a></h2>
         </div>
         <div class="grid_3">
         	<h1 class="footer_title"><?php _e('Apoiar','kmol');?></h1>

         	<h2 class="footer_subtitle"><a href="<?php echo get_permalink($sponsor->ID);?>"><?php _e('Patrocinar','kmol');?></a></h2>
         	<h2 class="footer_subtitle"><a href="<?php echo get_permalink($adds->ID);?>"><?php _e('Anunciar','kmol');?></a></h2>
         </div>
         <div class="grid_3 omega">
         	<h1 class="footer_title"><?php _e('Sobre','kmol');?></h1>

         	<h2 class="footer_subtitle"><a href="<?php echo get_permalink($kmol->ID);?>"><?php _e('O Portal');?></a></h2>
         	<div class="footer_contact"><br/>
         	<h2 class="footer_subtitle"><?php _e('Contactar','kmol');?></h2>
         	<h2 class="footer_link"><a href="mailto:marketing@kmol.online.pt">marketing@kmol.online.pt</a></h2>
         	</div>
         </div>
         <div class="grid_12 copyright alpha omega"><center>
         	<p>Copyright &copy; 2012 knowman | <?php _e('Todos os direitos reservados','kmol');?></p>
         </center>
         </div>
	</footer><!-- #colophon .site-footer -->
</div>

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>