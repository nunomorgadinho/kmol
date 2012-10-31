<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package kmol
 * @since kmol 1.0
 */
?>
<div class="background_home">

<!-- Início das Tabs -->

    <div class="container_highlight container_12">
        <div id="tabs" class="grid_8 highlight alpha">
    <ul>
        <li><a href="#tabs-1">Recentes no Blog</a></li>
        <li><a href="#tabs-2">Populares no Blog</a></li>
    </ul>
    <div id="tabs-1">

        <div class="principal">
            <div class="news_principal">
                <p class="news_title">UPoint<span class="news_meta">por Ana Neves, 30 ago</span></p>
                <span class="clear"></span>
                <div class="image_principal"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/img_news_principal.png"/></div>
                <p class="news_excerpt">Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin 
                mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean 
                tempor ullamcorper leo. </p>
            </div>

            <div class="grid_8 alpha">
                <div class="sublayer grid_4 alpha">
                    <p class="sublayer_title">Influenciando comportamentos</p>
                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                </div>

                <div class="sublayer grid_4 omega">
                    <p class="sublayer_title">Influenciando comportamentos</p>
                    <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                </div>
            </div>   
        </div>
    

    </div>
    <div id="tabs-2">
        
        <div class="principal">
                    <div class="news_principal">
                        <p class="news_title">RIC<span class="news_meta">por Ana Neves, 30 ago</span></p>
                        <span class="clear"></span>
                        <div class="image_principal"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/img_news_principal2.jpg"/></div>
                        <p class="news_excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu nisi nibh, at convallis turpis. 
                            Maecenas consectetur facilisis suscipit. Donec consectetur sagittis nibh, sit amet blandit mi scelerisque eget. 
                            Sed at faucibus.
                        </div>

                    <div class="grid_8 alpha">
                        <div class="sublayer grid_4 alpha">
                            <p class="sublayer_title">Quatro pontos sobre ferramentas sociais para a organização</p>
                            <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                        </div>

                        <div class="sublayer grid_4 omega">
                            <p class="sublayer_title">Influenciando comportamentos</p>
                            <div class="sublayer_meta news_meta">por João Neves, 25 Out</div>
                        </div>
                    </div>   
                </div>

        </div>
        </div>
  
<!-- Final das Tabs -->        



<!-- Separador com números de redes sociais -->

                <div class="counters grid_4 omega">
                    <div class="phrase">
                        <p>Ajude-nos a chegar aos</p><h3>1.000 gostos!</h3></div>
                    <!-- <div class="phrase">
                <p>Faltam 50 para chegar a</p><h3>2.500 seguidores!</h3></div> -->
                    <div class="numbers">
                        <input id="twitter" class="knob countersingle numbers_margin" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly=true value="22">
                        <input id="facebook" class="knob countersingle numbers_margin" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly=true value="42">
                        <input id="rss" class="knob countersingle" data-fgColor="#6c9ebb" data-thickness=".3" data-readOnly=true value="60">
                    </div>
                    <div class="subscribe_home">
                        <input type="text" id="subscribe_home_box" placeholder="mail..."/>
                        <input type="submit" id="subscribe_home_submit" value="subscribe"/>
                    </div>
                </div>
                <span class="triangle"></span>
                </div>
<!-- Final do Separador -->

</div>

    <div class="container_12 boxes">
        <div class="grid_8 alpha marcadores">
            <div class="grid_8 alpha">
                <div class="grid_4 alpha marcador">
                    <h1 class="marcador_title">Entrevistas</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
                <div class="grid_4 omega marcador">
                    <h1 class="marcador_title">Casos</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
            </div>

            <div class="grid_8 alpha">
                <div class="grid_4 alpha banner1">
                    Banner //
                </div>
                <div class="grid_4 omega marcador">
                    <h1 class="marcador_title">Livros</h1>
                    <div class="marcador_short">
                    <img class="marcador_img" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/paul_corney.jpg">
                    <h2 class="marcador_subtitle">Paul Corney</h2>
                    <p class="marcador_description">Entrevistámos Paul Corney, managing partner da Sparknow.</p>
                    </div>
                </div>
            </div>

            <div class="grid_8 alpha omega banner2">
                Banner2 //
            </div>


        </div>
        <div class="grid_4 omega social_timelines">
            <div class="twitter_timeline">
            <a class="twitter-timeline" href="https://twitter.com/ananeves" data-widget-id="263314596876652544">Tweets by @ananeves</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
            <div class="facebook_home">
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FportalKMOL&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe>
            </div>

        </div>
    </div>


