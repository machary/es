<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Klasik
 * @since Klasik 1.0
 */
?>
	<article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
    	<div class="articlecontainer">
            <div class="entry-video">
                <?php
                $custom = get_post_custom($post->ID);
                $pregvid = preg_match_all('/(\<video.*\<\/video\>)/is', get_the_content(), $videos);
                $pregobj = preg_match_all('/(\<object.*\<\/object\>)/is', get_the_content(), $objects);
                $pregemb = preg_match_all('/(\<embed.*\<\/embed\>)/is', get_the_content(), $embeds);
                $pregifr = preg_match_all('/(\<iframe.*\<\/iframe\>)/is', get_the_content(), $iframes);
                $video = isset($videos[1][0])? $videos[1][0] : "";
				$object = isset($objects[1][0])? $objects[1][0] : "";
				$embed = isset($embeds[1][0])? $embeds[1][0] : "";
				$iframe = isset($iframes[1][0])? $iframes[1][0]: "";
                $media = "";
                
                if(!empty($video)){
                    $media = $video;
                }elseif(!empty($object)){
                    $media = $object;
                }elseif(!empty($embed)){
                    $media = $embed;
                }elseif(!empty($iframe)){
                    $media = $iframe;
                }
                
                if(!empty($media)){
                    echo '<div class="mediacontainer">'.$media.'</div>';
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
    
    
