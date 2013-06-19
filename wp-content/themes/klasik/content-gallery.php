<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Klasik
 * @since Klasik 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<div class="articlecontainer">
            <div class="entry-gallery">
				<?php
                $custom = get_post_custom($post->ID);
                $cf_thumb = (isset($custom["klasik_thumb"][0]))? $custom["klasik_thumb"][0] : "";
                $cf_lightbox = (isset($custom["klasik_lightbox"][0]))? $custom["klasik_lightbox"][0] : "";
                $cf_externallink = (isset($custom["klasik_link"][0]))? $custom["klasik_link"][0] : "";

                $custom = get_post_custom($post->ID);
				if(!is_search()){
					$cf_thumb = (isset($custom["klasik_thumb"][0]))? $custom["klasik_thumb"][0] : ""; 
					   
					if($cf_thumb!=""){
						$thumb = '<img src='. $cf_thumb .' alt="" class="imgframe"/>';
					}elseif(has_post_thumbnail($post->ID) ){
						$thumb = get_the_post_thumbnail($post->ID, 'thumb-blog', array('class' => 'imgframe'));
					}else{
						$thumb ="";
					}
					
					if($thumb!=""){
						echo '<div class="postimg">';
							echo '<div class="thumbcontainer">';
								echo $thumb;
								echo '<div class="clear"></div>';
							echo '</div>';
						echo '</div>';
					}
				}
				?>
                <h2 class="posttitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'klasik' ), the_title_attribute( 'echo=0' ) ); ?>" data-rel="bookmark"><?php the_title(); ?></a></h2>
                <div class="entry-utility">
                    <div class="date"><?php the_time('F d, Y'); ?></div> 
                    <div class="user"><?php _e('by','klasik'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></div>
                    <div class="tag"> <?php _e('in','klasik'); ?> <?php the_category(', '); ?></div>
                    <div class="clear"></div>  
                </div> 
                
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="more"><?php _e('Continue Reading','klasik'); ?></a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
		<div class="clear"></div>
	</article><!-- end post -->
    
    
