<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php if(is_front_page() && of_get_option('home_title')): ?>
	<title><?php echo of_get_option('home_title'); ?></title>
	<?php else: ?>
	<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>
	<?php endif; ?>
	<?php if(is_front_page() && of_get_option('home_meta')): ?>
    <meta name="description" content="<?php echo of_get_option('home_meta'); ?>" /> 
	<?php endif; ?>
	<meta name="viewport" content="width=device-width">
	<?php if(of_get_option('favicon')): ?>
	<link href="<?php echo of_get_option('favicon'); ?>" rel="shortcut icon" /> 
	<?php endif; ?>

	<meta name="viewport" content="width=device-width">
	


	<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
	<?php wp_head(); ?>

	<?php echo '<style type="text/css">'; ?>
		nav {padding-top:<?php echo of_get_option('navigation_padding', '18px'); ?>; }
	.lt-ie8 #logo img, .lt-ie8 #logo {max-width:<?php echo of_get_option('logo_width', '144px'); ?>;}	
	<?php if(of_get_option('retina_logo', 'no') == 'yes'): ?>body #logo img {max-width:100%; height: auto;} .lt-ie9 body #logo {max-width:100%; }<?php endif; ?>
	<?php if(of_get_option('right_sidebar', 'no') == 'yes'): ?>#container-sidebar {float:left;} #sidebar { float:right;}<?php endif; ?>
	<?php if(of_get_option('custom_css')): ?><?php echo of_get_option('custom_css'); ?><?php endif; ?>
	nav, h1, h2, footer h3, footer h4, footer h5, footer h6 {font-family: '<?php echo of_get_option('navigation_font', 'PT Sans'); ?>', sans-serif; }
	input.submit, input.submit-advanced, .featured-price, h3, h4, h5, h6, .listings-address-widget, .page-count, .pagination, .button, .property-information-address, .property-information-price, #child-pages li a {font-family: '<?php echo of_get_option('submenu_font', 'Open Sans'); ?>', sans-serif; font-weight:600;}
	.featured-address-number {font-family: <?php echo of_get_option('featured_address', 'Georgia'); ?>, serif;}
	.featured-address-city, .listings-street-widget, .post-data, .share-section, .property-information-location, .property-highlight, .property-status, .share-section-listing span.share-text {font-family:"<?php echo of_get_option('secondary_address', 'Times New Roman'); ?>", Georgia, serif; }
	
	<?php if(of_get_option('currency_image')): ?>
	input#price-min, input#price-max {background-image:url(<?php echo of_get_option('currency_image', get_template_directory_uri() . '/images/dollar-sign.png'); ?>);}
	<?php endif; ?>
	
	<?php echo '</style>'; ?>
	
	<?php if(of_get_option('custom_js')): ?>
	<?php echo '<script type="text/javascript">'; ?>
	<?php echo of_get_option('custom_js'); ?>
	<?php echo '</script>'; ?>
	<?php endif; ?>
</head>
<body <?php body_class(''); ?>>
	<header>
		<div class="width-container">
			
			<h1 id="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo of_get_option('logo', get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" /></a></h1>
			
			<nav>
				<?php wp_nav_menu(array('theme_location' => 'main_nav', 'depth' => 4, 'menu_class' => 'sf-menu')); ?>
			</nav>
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->

	</header>

	<div id="search-container">
		<div class="width-container">
			<?php
			$purl = get_post_type_archive_link('property');
			?>
			<form method="get" class="searchform" action="<?php echo $purl; ?>">
				<input type="hidden" name="post_type" value="property" />
				<label for="s" class="assistive-text"><?php _e('Search','progressionstudios'); ?>:</label>
				<input type="text" class="field" name="search_keyword" id="s" placeholder="<?php echo of_get_option('search_keyword', 'Enter an address, zip code or city...'); ?>" />
				<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php _e('Search','progressionstudios'); ?>" />
				
				<div class="clearfix"></div>
				<div id="panel-search">
					
					<div class="header-advanced-pricing">
						<input type="text" class="field" name="price-min" id="price-min" placeholder="<?php _e('Min Price','progressionstudios'); ?>" />
					</div>
					
					<div class="price-range"><?php _e('to','progressionstudios'); ?></div>
					
					<div class="header-advanced-pricing">
						<input type="text" class="field" name="price-max" id="price-max" placeholder="<?php _e('Max Price','progressionstudios'); ?>" />
					</div>
					
					
		
					<div class="hidden-values">
						<select name="city"> 
							<option value="" selected="selected"><?php echo of_get_option('city_text', 'Choose City'); ?></option> 
							<?php foreach($city as $c): ?>
							<option value="<?php echo $c; ?>" <?php if($_GET['city'] == $c): ?>selected="selected"<?php endif; ?>><?php echo $c; ?></option>
							<?php endforeach; ?> 
						</select>
						<select name="state">
							<option value="" selected="selected"><?php echo of_get_option('state_text', 'State'); ?></option>
							<?php foreach($state as $s): ?> 
							<option value="<?php echo $s; ?>" <?php if($_GET['state'] == $s): ?>selected="selected"<?php endif; ?>><?php echo $s; ?></option>
							<?php endforeach; ?> 
						</select>
						<select name="zip"> 
							<option value="" selected="selected"><?php echo of_get_option('zip_text', 'Zip code'); ?></option> 
							<?php foreach($zip as $z): ?> 
							<option value="<?php echo $z; ?>" <?php if($_GET['zip'] == $z): ?>selected="selected"<?php endif; ?>><?php echo $z; ?></option>
							<?php endforeach; ?> 
						</select>
					</div>
					
		
					
					<div class="header-advanced-bedbath">
						<select name="beds"> 
							<option value="" selected="selected"><?php echo of_get_option('beds_text', 'Beds'); ?></option> 
							<option value="1">1+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
							<option value="2">2+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
							<option value="3">3+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
							<option value="4">4+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
							<option value="5">5+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
						</select>
					</div>		
					
					
					<div class="header-advanced-bedbath">
						<select name="baths"> 
							<option value="" selected="selected"><?php echo of_get_option('baths_text', 'Baths'); ?></option> 
							<option value="1">1+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
							<option value="2">2+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
							<option value="3">3+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
							<option value="4">4+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
							<option value="5">5+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
						</select>
					</div>
					
					
					
					<div class="header-prop-typestatus">
						<select name="sqft"> 
							<option value="" selected="selected"><?php echo of_get_option('square_feet_text', 'Square Feet'); ?></option> 
							<option value="250">250+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="500">500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="1000">1000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="1250">1250+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="1500">1500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="2000">2000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="2500">2500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="3000">3000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="3500">3500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
							<option value="4000">4000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
						</select>
					</div>

					<?php
					$ptype = get_terms('property_type');
					if($ptype):
					?>
					<div class="header-prop-typestatus">
						<select name="ptype"> 
							<option value="" selected="selected"><?php echo of_get_option('property_type_text', 'Property Type'); ?></option>
							<?php foreach($ptype as $pt): ?>
							<?php if($pt->name != 'Featured'): ?>
							<?php if($pt->name != 'Homepage'): ?>
							<?php if($pt->name != 'Widget'): ?>
								<?php if($pt->name != 'featured'): ?>
								<?php if($pt->name != 'homepage'): ?>
								<?php if($pt->name != 'widget'): ?>
							<option value="<?php echo $pt->slug; ?>"><?php echo $pt->name; ?></option>
							<?php endif; ?>
							<?php endif; ?>
							<?php endif; ?>
							<?php endif; ?>
							<?php endif; ?>
							<?php endif; ?>

							<?php endforeach; ?>
						</select>
					</div>
					<?php endif; ?>
					
					<div class="header-prop-typestatus hidden-value-tablet">
						<select name="status"> 
							<option value="" selected="selected"><?php echo of_get_option('property_status_text', 'Property Status'); ?></option> 
							<option value="For Rent"><?php _e('For Rent','progressionstudios'); ?></option> 
							<option value="For Sale"><?php _e('For Sale','progressionstudios'); ?></option> 
							<option value="Open House"><?php _e('Open House','progressionstudios'); ?></option> 
							<!--option value="Reduced">Recently Reduced</option--> 
						</select>
					</div>
					
					<a class="more-search-options" href="<?php echo $purl; ?>"><?php _e('More search options','progressionstudios'); ?></a>
			
				</div>
				
			</form>
		</div><!-- close width-container -->
		
		
		
	<div class="clearfix"></div>
	</div><!-- close #search-container -->

	<div class="width-container">
		<a href="#" class="search-drop-down"><?php _e('Search More','progressionstudios'); ?></a>
	</div>