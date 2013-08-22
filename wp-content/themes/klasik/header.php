<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Klasik
 * @since Klasik 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php klasik_document_title(); ?></title>
<?php $bodyclass = "klasikt"; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" id="templateurl" href="<?php echo get_template_directory_uri(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php 
	$disableResponsive = klasik_get_option( 'klasik_disable_responsive' ,'');
	if($disableResponsive!='1'){
?>
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	}
?>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php

/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */
wp_head();
?>
</head>

<body <?php body_class($bodyclass); ?>>

<?php $disableSlider = klasik_get_option( 'klasik_disable_slider' ,'');?>
<div id="bodychild">
	<div id="outercontainer">
    
        <!-- HEADER -->
        <div id="outerheader">
        	<div id="headercontainer">
                <div class="container">
                    <header id="top">
                        <div class="row">
                        
                            <div id="logo" class="four columns"><?php klasik_logo();?></div>
                            <section id="navigation" class="eight columns">
                                <nav id="nav-wrap">
                                    <?php wp_nav_menu( array(
                                      'container'       => 'ul', 
                                      'menu_class'      => 'sf-menu',
                                      'menu_id'         => 'topnav', 
                                      'depth'           => 0,
                                      'sort_column'    => 'menu_order',
                                      'fallback_cb'     => 'nav_page_fallback',
                                      'theme_location' => 'mainmenu' 
                                      )); 
                                    ?>
                                </nav><!-- nav -->	
                                <div class="clear"></div>
                            </section>
                            <div class="clear"></div>
                            
                        </div>
                        <div class="clear"></div>
                    </header>
                </div>
                <div class="clear"></div>
            </div>
            <!-- Main Search -->
            <div id="main-search-form">
                <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="searcharea">
                        <input type="text" name="s" id="s" value="<?php _e('Ketik Kata Kunci...','klasik');?>" onfocus="if (this.value == '<?php _e('Ketik Kata Kunci...','klasik');?>')this.value = '';" onblur="if (this.value == '')this.value = '<?php _e('Ketik Kata Kunci...','klasik');?>';" />
                        <input type="submit" class="searchbutton" value="Cari" />
                    </div>
                </form>
            </div>

            <!-- End of Main search -->
		</div>
        <!-- END HEADER -->



		<!-- AFTERHEADER -->
        <?php

		$def_enableslider = ( klasik_get_option('klasik_enable_slider')=="1" && is_front_page() )? true : false;

		$custom = klasik_get_customdata();
        $cf_enableslider = (isset($custom["klasik_enable_slider"][0]))? $custom["klasik_enable_slider"][0] : $def_enableslider;

        if($cf_enableslider){

			get_template_part( 'slider');
			$outermainclass = "";
        }else{
			$outermainclass = "inner";
        ?>

        <div><?php
             if( is_home()|| is_front_page()){
                 echo do_shortcode("[soliloquy id=455]");
             }
            ?>
        </div>
        <div id="outerafterheader">
        	<div class="container">
            	<div class="row">
                
                    <div id="afterheader" class="twelve columns">
                    <?php
                        get_template_part( 'title');

                        $custom = klasik_get_customdata();
                        $cf_desc = (isset($custom["klasik_page_desc"][0]))? $custom["klasik_page_desc"][0] : "";
                        
                        if($cf_desc){
                            echo '<span class="pagedesc">'.$cf_desc.'</span>';
                        }
                    ?>
                    </div>

                </div>
            </div>
        </div>
        <?php
		}
		?>
        <!-- END AFTERHEADER -->



        <!-- MAIN CONTENT -->
        <div id="outermain" class="<?php echo $outermainclass; ?>">
        	<div id="maincontainer">
                <div class="container">
                    <div class="row">
                    <?php 
                    $sidebarposition = klasik_get_option( 'klasik_sidebar_position' ,'two-col-right'); 
                    
                    $custom_fields = klasik_get_customdata();
                    
                    $pagelayout = $sidebarposition;
                    
                    if(isset( $custom_fields['klasik_layout'][0] ) && $custom_fields['klasik_layout'][0]!='default'){
                        $pagelayout = $custom_fields['klasik_layout'][0];
                    }
                    
                    if($pagelayout!='one-col'){
                        $mcontentclass = "hassidebar";
                        if($pagelayout=="two-col-left"){
                            $mcontentclass .= " mborderright";
                        }else{
                            $mcontentclass .= " mborderleft";
                        }
                    }else{
                        $mcontentclass = "twelve columns";
                    }
                    ?>
                    <section id="maincontent" class="<?php echo $mcontentclass; ?>">
                        
                        <?php if($pagelayout!='one-col'){ ?>
                        
                        <section id="content" class="eight columns <?php if($pagelayout=="two-col-left"){echo "positionleft";}else{echo "positionright";}?>">
                            <div class="main">
                        
                        <?php } ?>