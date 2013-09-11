<?php
/**
 * Created by JetBrains PhpStorm.
 * User: masmek
 * Date: 7/25/13
 * Time: 11:17 AM
 * To change this template use File | Settings | File Templates.
 */

function count_post_category($term_name) {
    global $wpdb;
    $temp_id = $wpdb->get_var("SELECT term_id FROM wp_terms WHERE name = '$term_name'" );
    $temp_counter =  $wpdb->get_var("SELECT count FROM wp_term_taxonomy WHERE term_taxonomy_id = $temp_id");
    return $temp_counter;
}
function category_based_function($atts, $content = null) {

    extract(shortcode_atts(array(
        "label" => 'Label',
        "pageid"=>'',
        "cat" => '',
        "class" => '',
        "order"	=>	'date',
        "cols" => '1',
        "showposts" => 3,
        "disablemore" => "yes",
        "moretext" => __('Continue Reading', 'templatesquare'),
        "lengthchar" => 60

    ), $atts));

    $showposts = (!is_numeric($showposts))? 12 : $showposts;
    $longdesc = (!is_numeric($lengthchar))? 70 : $lengthchar;
    $disablemore = ($disablemore=="yes")? true : false;

    $output = "";
    $output .='<div class="recentpost-container six columns">';
    $output .='<h3 style="width:300px;margin-bottom:12px;">'. $label .'</h3>';
    $output .='<div style="min-height:135px;" >';
    global $wp_query;
    $original_query = $wp_query;
    $wp_query = null;

    $args = array(
        "post_type" => "post",
        "orderby" => $order,
        "showposts" => $showposts
    );

    if($cat!=""){
        $args['category_name'] =  $cat;
    }

    $wp_query = new WP_Query( $args );
    global $post;

    if ($wp_query->have_posts()) :

        while ($wp_query->have_posts()) : $wp_query->the_post();

            //$output .='<div class="'.$colclass.' columns '.$omega.'">';
            $output .='<div style="position:relative;">';
            $output .='<div class="item-container">';

            //$postformat = (get_post_format())? get_post_format() : 'default'; //--> see recentposts.php
            $postformat = 'category';

            $output .= call_user_func('recent_content_'.$postformat, $longdesc, $moretext, $disablemore);

            $output.='<div class="clear"></div>';
            $output .='</div>';
            $output .='</div>';

        endwhile;

        $wp_query = null;
        $wp_query = $original_query;
        wp_reset_postdata();

    endif;
    $output.='<div class="clear"></div>';
    $output .='</div>';
    $output.='<div class="clear"></div>';

    //$counter = wp_count_posts('post')->published;
    $pagelink = get_page_link($pageid);
    if(count_post_category($cat)>$showposts){
        $counter = count_post_category($cat) - $showposts;
    }
    else{
        $counter = count_post_category($cat);
    }

    $output .='<a href="'. $pagelink .'" class="cat-based-link"> lihat '.$counter.' jawaban lainnya</a>';
    $output .='</div>';
    return $output;
}

add_shortcode('category-based', 'category_based_function');

function horizontal_line_function(){
    $output ='<hr>';
    return $output;
}
add_shortcode('separator-line', 'horizontal_line_function');

function category_post_page_function($atts, $content = null) {

    extract(shortcode_atts(array(
        "label" => 'Daftar Jawaban',
        "cat" => '',
        "order"	=>	'date',
        "cols" => '1',
        "disablemore" => "yes",
        "lengthchar" => 70

    ), $atts));

    $longdesc = (!is_numeric($lengthchar))? 70 : $lengthchar;
    $counter = count_post_category($cat);
    $output = "";
    $output .='<div class="recentpost-container ten columns">';
    $output .='<h3 style="margin-bottom:14px;">'. $label .' ('.$counter.')</h3>';
    $output .='<div style="min-height:135px;margin-bottom:14px;" >';
    global $wp_query;
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'post',
        'orderby' => $order,
        'posts_per_page' => 10,
        'paged' =>$paged
    );

    if($cat!=""){
        $args['category_name'] =  $cat;
    }


    $wp_query = new WP_Query( $args );

    if ($wp_query->have_posts()) :
        $x = 0;
        while ($wp_query->have_posts()) : $wp_query->the_post();

            $x++;

            $output .='<div style="position:relative;">';
            $output .='<div class="item-container">';
            $postformat = 'category';

            $output .= call_user_func('recent_content_'.$postformat, $longdesc, $moretext, $disablemore);

            $output.='<div class="clear"></div>';
            $output .='</div>';
            $output .='</div>';
        endwhile;


        $total_pages = $wp_query->max_num_pages;
        if($total_pages>1){
            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '?paged=%#%',
                'current' => max(1,get_query_var('paged')),
                'total' => $total_pages,
            ));
        }
    wp_reset_query();

    endif;

    $output.='<div class="clear"></div>';
    $output .='</div>';
    $output.='<div class="clear"></div>';

    return $output;
}
add_shortcode('daftar-jawaban', 'category_post_page_function');

function category_posts_list_function($atts){
    extract(shortcode_atts(array(
        "page-id" => ''
    ), $atts));
    $args = array ( 'category' => ID, 'posts_per_page' => 5);
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) :	setup_postdata($post);

    endforeach;
}

function my_column($atts,$content = null){
    extract(shortcode_atts(array(
        "cols" => 'six'
    ), $atts));

    $output = "";
    $output .='<div class=" '.$cols.' columns">';
    $output .= $content ;
    $output .='</div>';
    return $output;
}
add_shortcode('kolom', 'my_column');

