<?php
/**
 *
 * @package WordPress
 * @subpackage Klasik
 * @since Klasik 1.0
 */

get_header(); ?>

    <div class="klasik-portfolio">
		<?php 
        if (have_posts()) : 
                    $x = 0;
                    $cols = klasik_get_pfcol();
        ?>
            <div class="row">
                <?php
                while (have_posts()) : the_post(); 
                
                $custom = get_post_custom($post->ID);
                
                $x++;
                
                if($cols==1){
                    $colclass = "twelve columns";
                }elseif($cols==2){
                    $colclass = "one_half columns";
                }elseif($cols==3){
                    $colclass = "one_third columns";
                }elseif($cols==4){	
                    $colclass = "one_fourth columns";
                }elseif($cols==5){
                    $colclass = "one_fifth columns";
                }elseif($cols==6){
                    $colclass = "one_sixth columns";
                }
                
                if($x%$cols==0){
                    $omega = "omega";
                }elseif($x%$cols==1){
                    $omega = "alpha";
                }else{
                    $omega = "";
                }
    
                echo klasik_portfolio_box($colclass.' '.$omega);
    
                endwhile;
                ?>
            </div>
        <?php	
        endif;
        ?>
      	<div class="clear"></div><!-- clear float --> 
   	</div>
    
<div class="clear"></div><!-- clear float --> 
              
<?php get_footer(); ?>