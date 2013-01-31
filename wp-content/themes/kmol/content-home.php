<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>






<!-- End Register Area -->
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
        <li><a href="#popular"><?php _e('Mais Populares','kmol');?></a></li>
    </ul>


    <div id="recent">
   	 <div class="principal">
    
    <?php 
	   $cat =  get_option('blog');
 	   $args = array(
 	   				'posts_per_page' => 3,
 	   				'cat' => $cat,
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
	 	  		 <div class="news_title"><a href="<?php the_permalink();?>"><?php the_title();?></a>
	 	  		 	<span class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></span>
	 	  		 </div>
	 	  		 <span class="tag_marcador">
	 	  			<?php $cats = wp_get_post_categories($post->ID);
	 	  					foreach ($cats as $cat)
	 	  					{
	 	  						$c = get_category($cat);
	 	  						echo '<a href="'.get_category_link( $cat ).'">'.$c->name."</a>";
	 	  					}
	 	  			?>
	 	  		 </span>	
	 	  		 
	 	  		 <span class="clear"></span>
	 	  		 
	 	  		 
	 	  		 
	 	  	 	<?php
	 	 	  	if(has_post_thumbnail()){
	 	  	 	?>
	 	   		<div class="image_principal">
	 	   			<?php the_post_thumbnail('medium');?>
	 	  		</div>
	 	 	  <?php } ?>
	 	  	 <div class="news_excerpt"><?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore');?> </div>
	 	   </div> <!-- .news_principal -->
	 	   
	 	   <?php
 	   }	else{
 	   // second and third post
 	   if($i==2) {?><div class="grid_8 alpha"><?php }?>
 	  				 <div class="sublayer grid_4 alpha">
 	  					 <h1 class="sublayer_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
 	  					 <span class="tag_marcador">
			 	  			<?php $cats = wp_get_post_categories($post->ID);
			 	  					foreach ($cats as $cat)
			 	  					{
			 	  						$c = get_category($cat);
			 	  						echo '<a href="'.get_category_link( $cat ).'">'.$c->name."</a>";
			 	  					}
			 	  			?>
	 	  		 		</span>		<span class="clear"></span>
 	  					 <div class="sublayer_meta news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div>
 	   					
 	   				</div>
 	   
 	   <?php }
 	   $i++;
 	   endwhile; endif;
    	?>
    	<?php if($i>1){?>	</div> <?php }?> <!-- grid_8 -->
    		
       </div> <!-- .principal -->
    </div> <!-- recent -->
    
    <div id="popular">    
        <div class="principal">       
                    <?php 
                   // $cat =  get_option('blog');
                    $pp = new WordpressPopularPosts();
                    $popular = array();
                    if(isset($pp))
 	                   $popular = $pp->get_popular_posts(array('range' => 'all','order_by' => 'comments','post_type' => 'post', 'limit'=>3),true);
				
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
                                 <div class="news_title"><a href="<?php the_permalink();?>"><?php the_title();?></a>
                                    <span class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php _e('Por ','kmol'); echo get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></span>
                                 </div>
				                 <span class="tag_marcador">
					 	  			<?php $cats = wp_get_post_categories($post->ID);
					 	  					foreach ($cats as $cat)
					 	  					{
					 	  						$c = get_category($cat);
					 	  						echo '<a href="'.get_category_link( $cat ).'">'.$c->name."</a>";
					 	  					}
					 	  			?>
	 	  						 </span>	
                                 <span class="clear"></span>
                    			<?php
                    			if(has_post_thumbnail()){
                    			?>
                    				<div class="image_principal">
                    				<?php the_post_thumbnail('medium');?>
                    				</div>
                    			<?php } ?>
                    			<p class="news_excerpt"><?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore');?> </p>
                    			</div> <!-- .news_principal -->
                    		
                    			<?php
                    		}	
                    		else{
                    			// second and third post
                    			if($i==2) {?><div class="grid_8 alpha"><?php }?>
                    				<div class="sublayer grid_4 alpha">
                    					<h1 class="sublayer_title"><a href="<?php the_permalink();?>"><?php echo the_title();?></a></h1>
                    					<span class="tag_marcador">
							 	  			<?php $cats = wp_get_post_categories($post->ID);
							 	  					foreach ($cats as $cat)
							 	  					{
							 	  						$c = get_category($cat);
							 	  						echo '<a href="'.get_category_link( $cat ).'">'.$c->name."</a>";
							 	  					}
							 	  			?>
	 	  							 	</span>	<span class="clear"></span>
                    					<div class="sublayer_meta news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( $post->post_author ) );?>"><?php _e('Por '); echo get_the_author_meta('display_name',$post->post_author);?></a>, <?php kmol_posted_on();?></div>
                    				
                    				</div>
                    		<?php }
                    		$i++;
                    	}//enf foreach
                    	?>
                    	<?php if($i>1){?>	</div> <?php }?> <!-- grid_8 -->
                    	<?php 
                   }?>
                                        
        	  </div><!-- .principal -->
		</div> <!-- #popular -->
	</div><!-- tabs -->
  
<!-- Final das Tabs -->        



<!-- Separador com números de redes sociais -->
		<?php 
			$users = count(get_users(array('role'         => 'subscriber' )));
			$nfacebook = count_facebook_followers();
			$nnewsletter = count_newsletter_followers();
		?>
	
                <div class="counters grid_4 omega">
                    <div class="phrase">
                        <p><?php _e('Ajude-nos a chegar aos','kmol');?></p><h3><?php _e('1000 gostos!','kmol');?></h3></div>
               
                    <div class="numbers">
                        <div class="counters_container" title="<?php _e('Clique para se registar');?>">
                        <a target="_blank" class="first_container">
                          <input id="twitter" class="knob countersingle numbers_margin twitter " data-displayInput="true" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly="true" title="<?php echo $users;?>" value="<?php echo $users;?>" data-maxvalue="<?php echo $users;?>">
                        </a>
                        	<center><span><h1><?php echo $users;?></h1><h2><?php _e('perfis','kmol');?></h2></span></center>
                        </div>
                        <div class="counters_container" title="<?php _e('Clique para fazer Like');?>">
                        <a target="_blank" href="http://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FportalKMOL&send=false&layout=standard&width=450&show_faces=false&font&colorscheme=light&action=like&height=35&appId=259428177513896">
                          <input id="facebook" class="knob countersingle numbers_margin facebook" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly="true" value="<?php echo $nfacebook;?>" data-maxvalue="<?php echo $nfacebook;?>">
                        </a>
                        <center><span><h1><?php echo $nfacebook;?></h1><h2><?php _e('gostos','kmol');?></h2></span></center>
                        </div>
                        <div class="counters_container">
                          <input id="rss" class="knob countersingle rss" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly="true" value="<?php echo $nnewsletter;?>" data-maxvalue="<?php echo $nnewsletter;?>">
                 		       <center><span><h1><?php echo $nnewsletter;?></h1><h2><?php _e('subscritores','kmol');?></h2></span></center>
                  	  </div>
                  </div>
                    <div class="subscribe_home">
                    <?php
                    $widgetdata=array (
                    		'title' => '',
                    		'instruction' => '',
                    		'lists' =>
                    		array (
                    				0 => '1',
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
                    		'submit' => __('Subscrever!','kmol'),
                    		'success' => __('Veja na sua caixa de correio como confirmar a subscrição.','kmol'),
                    		'widget_id' => 'wysija-2-php',
                    );
                    $widgetNL= new WYSIJA_NL_Widget(1); 
                    $subscriptionForm= $widgetNL->widget($widgetdata,$widgetdata);
                    echo $subscriptionForm;
                    
                    
                    ?> 
                    </div>
                </div>
                <span class="triangle"></span>
                
</div> <!-- .container_highlight -->
</div><!-- background_home -->
<!-- Final do Separador -->



    <div class="container_12 boxes">
        <div class="grid_8 alpha marcadores">
            <div class="grid_8 alpha">
               
               <!-- Entrevistas -->
               <?php 
               
               $interviews_cat =  get_option('interviews'); 
               $args = array(
               		'posts_per_page' => 1,
               		'post_status' => 'publish',
               		'cat' => $interviews_cat
               );
               
               $page = get_page_by_title(__('Entrevistas'));
               
               /* query posts array */
               $query = new WP_Query( $args  );
               if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
               ?>
	                <div class="grid_4 alpha marcador">
	                    <a href="<?php echo $page->guid;?>"><h1 class="marcador_title home-section-title"><?php _e('Entrevistas','kmol'); ?></h1></a>
	                    <div class="marcador_short">
                        <div class="marcador_subtitle_container">
                      <h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                      
                      
                      <?php get_the_author_?>
                      
                    <div class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php echo "Por ".get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div></div>
	                    <?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail');?>
	                    <div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_small', 'new_excerpt_more');?></div>
	                    </div>
	                </div>
               <?php endwhile; endif;?>
                
                <?php 
              	   $cat =  get_option('cases'); 
	              	 $args = array(
	               		'posts_per_page' => 1,
	               		'post_status' => 'publish',
	               		'cat' => $cat
	               	);
	              	 
	              	 $page = get_page_by_title(__('Casos'));
	              	 
              	 	/* query posts array */
              		 $query = new WP_Query( $args  );
              		 if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
              		 ?>
		                <div class="grid_4 omega marcador">
		                    <a href="<?php echo $page->guid;?>"><h1 class="marcador_title"><?php _e ('Casos','kmol'); ?></h1></a>
		                    <div class="marcador_short">
                          <div class="marcador_subtitle_container">
                        <h2 class="marcador_subtitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                      <div class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php echo "Por ".get_the_author_meta('display_name');?></a>, <?php kmol_posted_on();?></div></div>
		                   <?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail');?>
		                    <div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_small', 'new_excerpt_more');?></div>
		                    </div>
		                </div>
                 <?php endwhile; endif;?>
                
            </div>
            
	<!-- BANNER 1  -->
            <div class="grid_8 alpha">
                <div class="grid_4 alpha banner1">
                    <?php 
                    	$img_url = get_option('banner1');
                    	if(isset($img_url)  && $img_url!=''){
                    ?>
	                    <img src="<?php echo $img_url;?>" width="300" height="251"/>
	                <?php } else {echo "Banner 1//";}?>
                </div>
                
                
                
	<!-- BOOKS  -->
                <?php 
              	   $cat =  get_option('books'); 
	              	 $args = array(
	               		'posts_per_page' => 1,
	               		'post_status' => 'publish',
	               		'cat' => $cat
	               	);
	              	
	              	 $page = get_page_by_title(__('Livros'));
	              	 
              	 	/* query posts array */
              		 $query = new WP_Query( $args  );
              		 if($query->have_posts()): while ($query->have_posts()) : $query->the_post();
              	?>
                <div class="grid_4 omega marcador">
                    <a href="<?php echo $page->guid;?>"><h1 class="marcador_title"><?php _e ('Livros','kmol'); ?></h1></a>
                    <div class="marcador_short">
                    <div class="marcador_subtitle_container">
                    <h2 class="marcador_subtitle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                  <div class="news_meta"><a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) );?>"><?php echo "Por ".get_the_author_meta('display_name');?>, <?php kmol_posted_on();?></a></div></div>
                    <?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail');?>
                    <div class="marcador_description"><?php wpe_excerpt('wpe_excerptlength_small', 'new_excerpt_more');?></div>
                    </div>
                </div>
	          <?php endwhile; endif;?>
            </div>
	
	<!-- BANNER 2  -->
            <div class="grid_8 alpha omega banner2">
                  <?php 
                    	$img_url = get_option('banner2');
                    	if(isset($img_url) && $img_url!=''){
                    ?>
	                    <img src="<?php echo $img_url;?>" width="620" height="100"/>
	                <?php } else {echo "Banner 2//";}?>
            </div>


        </div>
        
        <div class="grid_4 omega social_timelines">
           
            <div class="twitter_timeline">
				<a class="twitter-timeline" href="https://twitter.com/ananeves"
data-widget-id="276306569430437888"><?php _e('Tweets por @ananeves','kmol');?></a>
<script>!function(d,s,id){var
js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
           
            <div class="facebook_home">
            	<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FportalKMOL&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe>
            </div>

        </div> <!-- social_timelines -->
        
        
        
        <?php 
        //EVENTS AREA
       
        ?>
        
         <div class="grid_4 omega">
			<div id="secondary" class="widget-area" role="complementary">
				<aside id="recent-posts-3" class="widget grid_4 omega widget_recent_entries">		
				<div class="widget-title marcador_title"><?php _e('Próximos Eventos','kmol');?></div>
				<div class="sidebar_description">		
				<ul>
        
        <?php 
		
        $page = get_page_by_title(__('Eventos'));
        
        
        $cat = get_option('events');
		$args = array(
			'posts_per_page' =>3,
			'cat' => $cat,
			'post_status' => 'publish',
			'gdsr_sort' => 'rating',
			'nopaging' => 0,
			'gdsr_order' => 'desc'
				
		);
		/* query posts array */
		$query = new WP_Query( $args  );
		if($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
		  <div class="event-container">
			<div class="event-title">
				<a href="<?php echo $page->guid.' /#'.get_the_ID();?>" title="<?php echo the_title();?>"><?php echo the_title();?></a>
			</div>
	    
        	<li>
       		<?php //get date
				$value = get_post_meta($post->ID,'event_dates',true);
				$country = get_post_meta($post->ID,'event_country',true);
				if(isset($value) && $value != '')
				{
					//echo '<li class="event-detail-home">';
						echo '<span class="event-value">'.$value.'</span>';
						echo '<span class="event-value">, '.$country.'</span>';
					//echo '</li>';
				}
			?>
			
			</li>
			</div>
		<?php  endwhile; endif;?>
        		</ul>
				<a class="alignright" href="<?php echo $page->guid;?>">ver todos os eventos&rarr;</a>	
				</div>
			
				</aside>	
				
				
			</div><!-- #secondary .widget-area -->
		</div>
    	</div> <!-- .container_12 -->

<?php setup_postdata($temp);?>
