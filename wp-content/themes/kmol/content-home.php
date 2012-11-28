<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

<?php 

global $post;
$temp = $post;
?>

<div class="background_home">

<!-- Início das Tabs -->

<div class="container_highlight container_12">
    <div id="tabs" class="grid_8 highlight alpha">
    <ul>
        <li><a href="#recent"><?php _e('Recentes no Blog','kmol');?></a></li>
        <li><a href="#popular"><?php _e('Populares no Blog','kmol');?></a></li>
    </ul>


    <div id="recent">
   	 <div class="principal">
    
    <?php 
 	   $args = array(
 	   				'posts_per_page' => 3,
    				'post_status' => 'publish',
 	   				'gdsr_sort' => 'rating',
 	   				'nopaging' => 0,
		 	   		'post__not_in' => get_option('sticky_posts'),
 	   				'gdsr_order' => 'desc'
 	 		  );
 	   /* query posts array */
 	   $query = new WP_Query( $args  );
 	   
 	   $i=1;
 	   if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
 	  	 if($i==1)
 	   	{
	 	   	//latest post
	 	   	?>
	 	  	 <div class="news_principal">
	 	  		 <p class="news_title"><a href="<?php the_permalink();?>" target="_blank"><?php the_title();?></a>
	 	  		 	<span class="news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></span>
	 	  		 </p><span class="clear"></span>
	 	  	 	<?php
	 	 	  	if(has_post_thumbnail()){
	 	  	 	?>
	 	   		<div class="image_principal">
	 	   			<?php the_post_thumbnail('medium');?>
	 	  		</div>
	 	 	  <?php } ?>
	 	  	 <div class="news_excerpt"><?php the_excerpt();?> </div>
	 	   </div> <!-- .news_principal -->
	 	   
	 	   <?php
 	   }	else{
 	   // second and third post
 	   if($i==2) {?><div class="grid_8 alpha"><?php }?>
 	  				 <div class="sublayer grid_4 alpha">
 	  					 <p class="sublayer_title"><a href="<?php the_permalink();?>" target="_blank"><?php the_title();?></a></p>
 	  					 <div class="sublayer_meta news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></div>
 	   				</div>
 	   
 	   <?php }
 	   $i++;
 	   endwhile; endif;
    	?>
    		</div> <!-- grid_8 -->
    		
       </div> <!-- .principal -->
    </div> <!-- recent -->
    
    <div id="popular">    
        <div class="principal">

      <?php //if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("range=monthly&order_by=views"); ?>
        
                    <?php 
                    
                    $pp = new WordpressPopularPosts();
                    $popular = array();
                    if(isset($pp))
 	                   $popular = $pp->get_popular_posts(array('range' => 'monthly','order_by' => 'views',),true);
				
                    if(!empty($popular))
                    {
                    	$i=1;
                    	foreach ($popular as $ppopular){
                    		$post = get_post($ppopular['id']);
                    		setup_postdata($post);
                    		if($i==1)
                    		{
                    			//latest post
                    			?>
                    			<div class="news_principal">
                    				<p class="news_title"><a href="<?php the_permalink();?>" target="_blank"><?php the_title();?></a>
                    					<span class="news_meta"><?php echo get_the_author_meta('nicename');?>, <?php kmol_posted_on();?></span>
                    				</p><span class="clear"></span>
                    			<?php
                    			if(has_post_thumbnail()){
                    			?>
                    				<div class="image_principal">
                    				<?php the_post_thumbnail('medium');?>
                    				</div>
                    			<?php } ?>
                    			<p class="news_excerpt"><?php the_excerpt();?> </p>
                    			</div> <!-- .news_principal -->
                    		
                    			<?php
                    		}	
                    		else{
                    			// second and third post
                    			if($i==2) {?><div class="grid_8 alpha"><?php }?>
                    				<div class="sublayer grid_4 alpha">
                    					<p class="sublayer_title"><a href="<?php echo $post->guid;?>" target="_blank"><?php echo $post->title;?></a></p>
                    					<div class="sublayer_meta news_meta"><?php echo get_the_author_meta('nicename',$post->post_author);?>, <?php //kmol_posted_on();?></div>
                    				</div>
                    		<?php }?>
                   		<?php if(count($popular) > 1) {?></div><!-- grid_8 --><?php } 
                    		$i++;
                    	}//enf foreach
                    }?>
                                        
        	  </div><!-- .principal -->
		</div> <!-- #popular -->
	</div><!-- tabs -->

  
<!-- Final das Tabs -->        



<!-- Separador com números de redes sociais -->

                <div class="counters grid_4 omega">
                    <div class="phrase">
                        <p>Ajude-nos a chegar aos</p><h3>1.000 gostos!</h3></div>
                    <!-- <div class="phrase">
                <p>Faltam 50 para chegar a</p><h3>2.500 seguidores!</h3></div> -->
                    <div class="numbers">
                        <input id="twitter" class="knob countersingle numbers_margin twitter" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly=true value="22">
                        <input id="facebook" class="knob countersingle numbers_margin facebook" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly=true value="42">
                        <input id="rss" class="knob countersingle rss" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly=true value="60">
                    </div>
                    <div class="subscribe_home">
                        <input type="text" id="subscribe_home_box" placeholder="mail..."/>
                        <input type="submit" id="subscribe_home_submit" value="<?php _e('Subscreva','kmol'); ?>"/>
                    </div>
                </div>
                <span class="triangle"></span>
                
</div> <!-- .container_highlight -->
</div><!-- background_home -->
<!-- Final do Separador -->



    <div class="container_12 boxes">
        <div class="grid_8 alpha marcadores">
            <div class="grid_8 alpha">
                <div class="grid_4 alpha marcador">
                    <h1 class="marcador_title"><?php _e ('Entrevistas','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 omega marcador">
                    <h1 class="marcador_title"><?php _e ('Casos','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
            </div>

            <div class="grid_8 alpha">
                <div class="grid_4 alpha banner1">
                    Banner //
                </div>
                <div class="grid_4 omega marcador">
                    <h1 class="marcador_title"><?php _e ('Livros','kmol'); ?></h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle"><a href="#">Paul Corney</a></h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
            </div>

            <div class="grid_8 alpha omega banner2">
                Banner2 //
            </div>


        </div>
        
     <!--    <div class="grid_4 omega social_timelines">
            <div class="twitter_timeline">
            <a class="twitter-timeline" href="https://twitter.com/ananeves" data-widget-id="263314596876652544">Tweets by @ananeves</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
            <div class="facebook_home">
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FportalKMOL&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe>
            </div>

        </div> -->
    </div>

<?php setup_postdata($temp);?>
