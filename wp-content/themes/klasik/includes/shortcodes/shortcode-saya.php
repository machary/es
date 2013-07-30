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
        "cat" => '',
        "class" => '',
        "order"	=>	'date',
        "cols" => '1',
        "showposts" => 3,
        "disablemore" => "yes",
        "moretext" => __('Continue Reading', 'templatesquare'),
        "lengthchar" => 30

    ), $atts));

    $cols = intval($cols);

    if(!is_numeric($cols) || $cols < 1 || $cols > 6){
        $cols = 4;
    }

    $showposts = (!is_numeric($showposts))? 12 : $showposts;
    $longdesc = (!is_numeric($lengthchar))? 70 : $lengthchar;
    $disablemore = ($disablemore=="yes")? true : false;

    $output = "";
    $output .='<div class="recentpost-container '.$class.'" style="float:left;margin-bottom:10px;width:350px;">';
    $output .='<h3 style="width:300px;">'. $label .'</h3>';
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
        $x = 0;
        while ($wp_query->have_posts()) : $wp_query->the_post();

            $custom = get_post_custom($post->ID);

            $x++;

            if($cols==1){
                $colclass = "one_half";
            }elseif($cols==2){
                $colclass = "one_half";
            }elseif($cols==3){
                $colclass = "one_third";
            }elseif($cols==4){
                $colclass = "one_fourth";
            }elseif($cols==5){
                $colclass = "one_fifth";
            }elseif($cols==6){
                $colclass = "one_sixth";
            }

            if($x%$cols==0){
                $omega = "omega";
            }elseif($x%$cols==1){
                $omega = "alpha";
            }else{
                $omega = "";
            }

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
    $counter = count_post_category($cat);
    $output .='<a href="#" style="padding:5px 10px;background-color:#aeaeae;"> lihat '.$counter.' jawaban lainnya</a>';
    $output .='</div>';
    return $output;
}

add_shortcode('category-based', 'category_based_function');