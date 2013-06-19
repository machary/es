<?php
//custom meta field
$custom = klasik_get_customdata();
$cf_pagetitle = (isset($custom["page-title"][0]))? $custom["page-title"][0] : "";
$cf_pagedesc = (isset($custom["page-desc"][0]))? $custom["page-desc"][0] : "";


if(is_singular('pdetail') || is_attachment()){

	$titleoutput='<h1 class="pagetitle nodesc">'.get_the_title().'</h1>';
	echo $titleoutput;
	
}elseif(is_single()){

	$titleoutput='<h1 class="pagetitle nodesc">'.get_the_title().'</h1>';
	echo $titleoutput;
	
}elseif(is_archive()){
	echo '<h1 class="pagetitle nodesc">';
	if ( is_day() ) :
	printf( __( 'Daily Archives <span>%s</span>', 'klasik' ), get_the_date() );
	elseif ( is_month() ) :
	printf( __( 'Monthly Archives <span>%s</span>', 'klasik' ), get_the_date('F Y') );
	elseif ( is_year() ) :
	printf( __( 'Yearly Archives <span>%s</span>', 'klasik' ), get_the_date('Y') );
	elseif ( is_author()) :
	printf( __( 'Author Archives %s', 'klasik' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" );
	else :
	printf( __( '%s', 'klasik' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	endif;
	echo '</h1>';
	
}elseif(is_search()){
	echo '<h1 class="pagetitle nodesc">';
	printf( __( 'Search Results for %s', 'klasik' ), '<span>' . get_search_query() . '</span>' );
	echo '</h1>';
	
}elseif(is_404()){
	echo ' <h1 class="pagetitle nodesc">';
	_e( '404 Page', 'klasik' );
	echo '</h1>';
	
}elseif( is_home() ){
	$homeid = get_option('page_for_posts');
	echo '<h1 class="pagetitle nodesc">';
	echo ($homeid)? get_the_title( $homeid ) : __('Latest Posts', 'klasik');
	echo '</h1>';
}else{

 if (have_posts()) : while (have_posts()) : the_post();
 
 	if($cf_pagedesc==""){$addclass="nodesc";}else{$addclass="";}
 
 	//if(!is_front_page()){
		$titleoutput='';
		if($cf_pagetitle == ""){
			$titleoutput.='<h1 class="pagetitle '.$addclass.'">'.get_the_title().'</h1>';
		}else{
			$titleoutput.='<h1 class="pagetitle '.$addclass.'">'.$cf_pagetitle.'</h1>';
		}
		
		echo $titleoutput;
	//}
endwhile; endif; wp_reset_query();

}

?>