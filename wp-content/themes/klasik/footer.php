<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Klasik
 * @since Klasik 1.0
 */
 
?>
			
						<?php 
                        $sidebarposition = klasik_get_option( 'klasik_sidebar_position' ,'two-col-right'); 
                
                        $custom_fields = klasik_get_customdata();
                        
                        $pagelayout = $sidebarposition;
                        
                        if(isset( $custom_fields['klasik_layout'][0] ) && $custom_fields['klasik_layout'][0]!='default'){
                            $pagelayout = $custom_fields['klasik_layout'][0];
                        }
                        
                        if($pagelayout!='one-col'){ 
                        ?>
                        
                                <div class="clear"></div>
                            </div><!-- main -->
                        </section><!-- content -->
                        <aside id="sidebar" class="four columns <?php if($pagelayout=="two-col-left"){echo "positionright";}else{echo "positionleft";}?>">
                            <?php get_sidebar();?>  
                        </aside><!-- sidebar -->
                        
                        <?php 
                        } 
                        ?>
                        <div class="clear"></div>
                        </section><!-- END #maincontent -->
                        
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div><!-- END #outermain -->
        <!-- END MAIN CONTENT -->
        
        <!-- FOOTER SIDEBAR -->
        <div id="outerfootersidebar">
        	<div id="footersidebarcontainer">
                <div class="container">
                    <div class="row"> 
                    
                        <footer id="footersidebar">
                            <div id="footcol1"  class="five columns">
                                <div class="widget-area">
                                    <?php 
									$widgetargs = array( 
										'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
										'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
										'before_title' 	=> '<h2 class="widget-title">',
										'after_title' 	=> '</h2>'
									);
									
									if ( ! dynamic_sidebar( 'footer1' ) ){
										$instances = array(
											'title' => __('Tentang Wahana Pendidikan','klasik'),
											'text' => '<p>
											Aplikasi ini dirancang untuk memecahkan permasalahan yang kompleks dengan penalaran pengetahuan yang dimiliki oleh para ahli Transportasi jalan dan menciptakan kondisi transportasi yang ideal di setiap Kota/ Kabupaten seluruh Indonesia.
											</p>'
										);
										the_widget('WP_Widget_Text',$instances, $widgetargs);
									}// end general widget area 
									?>
                                </div>
                            </div>
                            <div id="footcol3"  class="seven columns">
                                 <div class="widget-area">
                                 	<?php 
									if ( ! dynamic_sidebar( 'footer3' ) ){
										
										$instances = array(
											'title' => __('Jawaban Terkini','klasik'),
											'number'=> 5
										);
										the_widget('WP_Widget_Recent_Posts',$instances, $widgetargs);
									}// end general widget area 
									?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </footer>
    
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER SIDEBAR -->
        
        
        <!-- FOOTER -->
        <div id="outerfooter">
        	<div id="footercontainer">
                <div class="container">
                    <div class="row">

                        <div class="twelve columns">
                            <footer id="footer"><?php klasik_footer_text(); ?></footer>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER -->
        
	</div><!-- end outercontainer -->
</div><!-- end bodychild -->


<?php $trackingcode = stripslashes(klasik_get_option('klasik_trackingcode'));?>
<?php if($trackingcode=="false"){?>
<?php }else{?>
<script>
<?php echo $trackingcode; ?>
</script>
<?php } ?>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
