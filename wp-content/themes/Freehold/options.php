<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
		
	$options = array();
		
	$options[] = array("name" => "Basic",
						"type" => "heading");

	$options[] = array( "name" => "Phone Number",
						"desc" => "",
						"id" => "phone_number",
						"std" => "(800) 536-3532",
						"type" => "text");

	$options[] = array( "name" => "Email Address",
						"desc" => "",
						"id" => "email_address",
						"std" => "no-reply@progressionstudios.com",
						"type" => "text");
	
	$options[] = array( "name" => "Copyright",
						"desc" => "Choose your copyright text here.",
						"id" => "copyright",
						"std" => '&copy; 2012 All Rights Reserved. Designed by <a href="http://progressionstudios.com/" target="_blank">Progression Studios</a>.',
						"type" => "textarea");


	$options[] = array( "name" => "Footer Widgets",
						"desc" => "Do you want to enable or disable the footer widgets? If enabled, add your widgets under Appearance > Widgets.",
						"id" => "footer_widgets",
						"std" => "yes",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Enable', 'no' => 'Disable'));

	$options[] = array( "name" => "Number of Footer Columns",
						"desc" => "Choose how many columns you want to display in the footer.",
						"id" => "footer_cols",
						"std" => "4",
						"type" => "select",
						"class" => "mini",
						"options" => array(1 => 1, 2 => 2, 3 => 3, 4 => 4));	



	$options[] = array( "name" => "Move sidebar right or left",
						"desc" => "By default your Sidebar will be on the left.",
						"id" => "right_sidebar",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Right', 'no' => 'Left'));


	$options[] = array( "name" => "Remove Sidebar from Portfolio Post Page?",
						"desc" => "Choose to have a full width portfolio post or portfolio post with sidebar",
						"id" => "port_single",
						"std" => "yes",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));


	$options[] = array( "name" => "Remove Sidebar from Homepage?",
						"desc" => "Choose to have a full width Homepage or one with a sidebar.",
						"id" => "homepage_full_width",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));


	$options[] = array("name" => "Real Estate",
						"type" => "heading");



	$options[] = array( "name" => "Homepage Listings All Listings or Homepage Listings",
						"desc" => "Choose to display All Listings OR only listings from the 'Homepage' Property Type on the homepage",
						"id" => "homepage_all_type",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Homepage Listings', 'no' => 'All Listings'));


	$options[] = array( "name" => "View Listing Text on Property Listings",
						"desc" => "Choose the view more text for property listings.",
						"id" => "view_listing_button",
						"std" => "View Listing",
						"type" => "text");



	$options[] = array( "name" => "Choose a currency",
						"desc" => "Choose your currency for the site",
						"id" => "currency_text_opt",
						"std" => "$",
						"type" => "text");

	$options[] = array( "name" => "Upload Currency Background Image",
						"desc" => "Use the upload button to upload a new currency icon.  This displays in the search fields only.  We include a template for this in the files..",
						"id" => "currency_image",
						"std" => "",
						"type" => "upload");


	$options[] = array( "name" => "Remove map from the search results?",
						"desc" => "Choose to remove or display the map on the search results pages",
						"id" => "map_search",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));

	$options[] = array( "name" => "Zoom on Map in Search Results",
						"desc" => "Choose a zoom for the map 1-15 on the search results page.  Leave blank to auto-zoom.",
						"id" => "map_zoom",
						"std" => "12",
						"type" => "text");


	$options[] = array( "name" => "Remove map from the property single?",
						"desc" => "Choose to remove or display the map on the property post page in the sidebar.",
						"id" => "map_search_sidebar",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));


	$options[] = array( "name" => "Zoom on Map in Sidebar",
						"desc" => "Choose a zoom for the map on the search results page.  Leave blank to auto-zoom.",
						"id" => "map_zoom_sidebar",
						"std" => "15",
						"type" => "text");




	$options[] = array( "name" => "Choose Map Icon",
						"desc" => "Use the upload button to upload a new map icon.  Recommend: <a href='http://mapicons.nicolasmollet.com' target='_blank'>http://mapicons.nicolasmollet.com</a>",
						"id" => "map_icon",
						"std" => get_template_directory_uri() . "/images/home.png",
						"type" => "upload");						

	$options[] = array( "name" => "Remove Sidebar from Property Listing?",
						"desc" => "Choose to have a full width Property Listing or one with a sidebar.",
						"id" => "property_single_sidebar",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));




	$options[] = array( "name" => "Search Keyword Text in Header",
						"desc" => "Choose the keyword text in the header search",
						"id" => "search_keyword",
						"std" => "Enter an address, zip code or city...",
						"type" => "text");



	$options[] = array( "name" => "Search Keyword Text in Sidebar",
						"desc" => "Choose the keyword text in the sidebar search",
						"id" => "search_keyword_sidebar",
						"std" => "Enter a address...",
						"type" => "text");





	$options[] = array( "name" => "Beds Text",
						"desc" => "Choose the text for Beds in the  search areas",
						"id" => "beds_text",
						"std" => "Beds",
						"type" => "text");

	$options[] = array( "name" => "Baths Text",
						"desc" => "Choose your text for baths in the search areas",
						"id" => "baths_text",
						"std" => "Baths",
						"type" => "text");


	$options[] = array( "name" => "Beds Short Text",
						"desc" => "Choose the text for Beds in the  search areas and on all property listings",
						"id" => "beds_text_short",
						"std" => "bd",
						"type" => "text");

	$options[] = array( "name" => "Baths Short Text",
						"desc" => "Choose your text for baths in the  search areas and on all property listings",
						"id" => "baths_text_short",
						"std" => "ba",
						"type" => "text");


	$options[] = array( "name" => "Bedrooms Long Text",
						"desc" => "Choose the text for Bedrooms on property single sidebar",
						"id" => "bedrooms_text",
						"std" => "Bedrooms",
						"type" => "text");

	$options[] = array( "name" => "Baths Short Text",
						"desc" => "Choose the text for Bathrooms on property single sidebar",
						"id" => "bathrooms_text",
						"std" => "Bathrooms",
						"type" => "text");
						

	$options[] = array( "name" => "Square Feet Text",
						"desc" => "Choose your Square Feet Text.  Displays in the search bar header/sidebar.",
						"id" => "square_feet_text",
						"std" => "Square Feet",
						"type" => "text");


	$options[] = array( "name" => "SqFt Text",
						"desc" => "Choose your SqFt Text.  Displays in the search bar and on all property listings.",
						"id" => "square_feet_text_small",
						"std" => "sqft",
						"type" => "text");

	$options[] = array( "name" => "Property Type Text",
						"desc" => "Choose the text 'Property Type' in the search",
						"id" => "property_type_text",
						"std" => "Property Type",
						"type" => "text");


	$options[] = array( "name" => "Property Status Text",
						"desc" => "Choose the text 'Property Status' in the search",
						"id" => "property_status_text",
						"std" => "Property Status",
						"type" => "text");


	$options[] = array( "name" => "Choose City Text",
						"desc" => "Choose the text 'Choose City' in the search",
						"id" => "city_text",
						"std" => "Choose City",
						"type" => "text");						
						

	$options[] = array( "name" => "State Text",
						"desc" => "Choose the text 'State' in the search",
						"id" => "state_text",
						"std" => "State",
						"type" => "text");

	$options[] = array( "name" => "Zip Code Text",
						"desc" => "Choose the text 'Zip' in the search",
						"id" => "zip_text",
						"std" => "Zip",
						"type" => "text");


	$options[] = array( "name" => "Search Results Text",
						"desc" => "Choose the text 'Search Results' in the search heading",
						"id" => "search_results_text",
						"std" => "Search Results",
						"type" => "text");


	$options[] = array( "name" => "Advanced Search Text",
						"desc" => "Choose the text 'Advanced Search' in the search heading",
						"id" => "advanced_search_text",
						"std" => "Advanced Search",
						"type" => "text");

	$options[] = array( "name" => "Location &amp; Information Text",
						"desc" => "Choose the text 'Location &amp; Information Text' in the search heading",
						"id" => "location_info_text",
						"std" => "Location &amp; Information",
						"type" => "text");


	$options[] = array( "name" => "No Result Results Title",
						"desc" => "Choose the text that displays when no search results are found",
						"id" => "search_results_none_title",
						"std" => "No properties were found which match your search criteria.",
						"type" => "text");


	$options[] = array( "name" => "No Result Results Content",
						"desc" => "Choose the text that displays when no search results are found",
						"id" => "search_results_none_content",
						"std" => "Try broadening your search to find more results.",
						"type" => "text");

	$options[] = array("name" => "Blog",
						"type" => "heading");


	$options[] = array( "name" => "Blog Tagline",
						"desc" => "Choose the Page Title for your blog pages",
						"id" => "blog_tagline",
						"std" => "Our Blog",
						"type" => "text");

	



	$options[] = array( "name" => "Blog View More Post Text",
						"desc" => "Choose the view more post text for blog index pages.",
						"id" => "blog_button_more",
						"std" => "Continue reading &rarr;",
						"type" => "text");
	


	$options[] = array( "name" => "Remove Sidebar from Blog?",
						"desc" => "Choose to have a full width blog or blog with sidebar.",
						"id" => "fw_blog",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));



	$options[] = array( "name" => "Remove Sidebar from Blog Posts?",
						"desc" => "Choose to have a full width blog post or blog post with sidebar.",
						"id" => "fw_single",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Yes', 'no' => 'No'));




	



	
	


	$options[] = array("name" => "Social",
						"type" => "heading");
						


	$options[] = array( "name" => "RSS Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "rss_link_header",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Facebook Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "facebook_link_header",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Twitter Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "twitter_link_header",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Skype Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "skype_link_header",
						"std" => "",
						"type" => "text");


	$options[] = array( "name" => "Vimeo Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "vimeo_link_header",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "LinkedIn Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "linkedin_link_header",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Dribbble Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "dribbble_link_header",
						"std" => "",
						"type" => "text");
												

	$options[] = array( "name" => "Forrst Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "forrst_link_header",
						"std" => "",
						"type" => "text");
												
	$options[] = array( "name" => "Flickr Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "flickr_link_header",
						"std" => "",
						"type" => "text");


	$options[] = array( "name" => "Google Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "google_link_header",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Youtube Link (Header)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "youtube_link_header",
						"std" => "",
						"type" => "text");
						
							
												
	$options[] = array( "name" => "RSS Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "rss_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Facebook Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "facebook_link",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Twitter Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "twitter_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Skype Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "skype_link",
						"std" => "",
						"type" => "text");


	$options[] = array( "name" => "Vimeo Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "vimeo_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "LinkedIn Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "linkedin_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Dribbble Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "dribbble_link",
						"std" => "",
						"type" => "text");
												

	$options[] = array( "name" => "Forrst Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "forrst_link",
						"std" => "",
						"type" => "text");
												
	$options[] = array( "name" => "Flickr Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "flickr_link",
						"std" => "",
						"type" => "text");


	$options[] = array( "name" => "Google Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "google_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Youtube Link (Widget)",
						"desc" => "Social Icon will display/hide automatically in the header and social icon widget.",
						"id" => "youtube_link",
						"std" => "",
						"type" => "text");

						
	
						
																		
	



	


	$options[] = array("name" => "Appearance",
						"type" => "heading");

	
	$options[] = array( "name" => "Logo",
						"desc" => "Use the upload button to upload your site's logo and then click 'Use this image'. Note: <strong>Your logo will be reduced to 50% of it's original size</strong>. This is so your logo displays well on Retina enabled devices.",
						"id" => "logo",
						"std" => get_template_directory_uri() . "/images/logo.png",
						"type" => "upload");



	$options[] = array( "name" => "Logo Width",
						"desc" => "Set your logo Width.  This is to fix logo resizing issues Internet Explorer.",
						"id" => "logo_width",
						"std" => "144px",
						"type" => "text");


						
	$options[] = array( "name" => "Display Retina Logo?",
						"desc" => "By default your logo will be resized to 50%.  Disable if you don't want your logo resized.",
						"id" => "retina_logo",
						"std" => "no",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Disable', 'no' => 'Enable'));						
						
	$options[] = array( "name" => "Favicon",
						"desc" => "Use the upload button to upload your favicon (bookmark icon) and then click '<strong>Use this image</strong>'.",
						"id" => "favicon",
						"std" => "",
						"type" => "upload");


	$options[] = array( "name" => "Adjust Navigation Top Padding",
						"desc" => "Add or remove the Padding to move the navigation higher or lower.  Note:  Use your logo height (Transparent PNG) to adjust the height of the main navigation area.  This settings just repositions the navigation.",
						"id" => "navigation_padding",
						"std" => "18px",
						"type" => "text");


						
	$options[] = array( "name" => "Navigation, H1-H2 Fonts, and Footer Headings",
						"desc" => "Choose a Main Navigation Font.  Default - PT Sans",
						"id" => "navigation_font",
						"std" => "PT Sans",
						"type" => "text");


	$options[] = array( "name" => "Heading H3-H6 and Buttons Font",
						"desc" => "Choose H3-H6 and buttons font.  Default - Open Sans",
						"id" => "submenu_font",
						"std" => "Open Sans",
						"type" => "text");



	$options[] = array( "name" => "Featured Address Font",
						"desc" => "Choose a secondary address font.  Default - Times New Roman",
						"id" => "secondary_address",
						"std" => "Times New Roman",
						"type" => "text");

	$options[] = array( "name" => "Secondary Address Font",
						"desc" => "Choose featured address font.  Default - Georgia",
						"id" => "featured_address",
						"std" => "Georgia",
						"type" => "text");


	

						

	$options[] = array("name" => "Tools",
						"type" => "heading");
	
	$options[] = array( "name" => "Homepage Title",
						"desc" => "Enter a title for the homepage, leave blank if you want to use an auto generated one.",
						"id" => "home_title",
						"std" => "",
						"type" => "text");


	
						
						
	$options[] = array( "name" => "Homepage Meta Description",
						"desc" => "Enter a description for the homepage, about 140 characters.",
						"id" => "home_meta",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Tracking Code",
						"desc" => "Paste your tracking code here e.g. Google Analytics etc... without script tags",
						"id" => "tracking_code",
						"std" => "",
						"type" => "textarea"); 
	

	$options[] = array( "name" => "404 Error Message Heading",
						"desc" => "Enter your custom 404 error heading.",
						"id" => "404_error",
						"std" => "404 Page Not Found",
						"type" => "textarea"); 

	$options[] = array( "name" => "404 Error Message Text",
						"desc" => "Enter your custom 404 error message.",
						"id" => "404_error_text",
						"std" => "The page you are looking is not available. You can customize this text in the Theme Options Panel",
						"type" => "textarea");
	
	$options[] = array( "name" => "Custom CSS",
						"desc" => "Paste your custom css here... without script tags",
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Custom Javascript",
						"desc" => "Paste your custom JavaScript code here... without script tags",
						"id" => "custom_js",
						"std" => "",
						"type" => "textarea"); 

	$options[] = array("name" => "Slider",
						"type" => "heading");




	$options[] = array( "name" => "Homepage Featured Slider Image Size",
						"desc" => "Default Image Size - 1120x356 pixels : Retina Image Size 2240x712 pixels (200% larger image that is scaled to fit) Note: Both images will display the same size.  The Retina Image Size is used for pixel-dense displays like iPads and Macbook Pros with Retina displays.  The downside is a larger file-size for those images and you will need to upload an image large enough.",
						"id" => "slider_retina_disabled",
						"std" => "yes",
						"type" => "select",
						"class" => "mini",
						"options" => array('yes' => 'Default Image Size', 'no' => 'Retina Image Size'));
						

	
	$options[] = array( "name" => "Homepage: Animation",
						"desc" => "Choose your slider animation between fade and slide.",
						"id" => "animation",
						"std" => "fade",
						"type" => "select",
						"class" => "mini",
						"options" => array('fade' => 'Fade', 'slide' => 'Slide'));

	$options[] = array( "name" => "Homepage: Slide Direction",
						"desc" => "If your animation is slide, choose if you want a vertical or horizontal slide direction.",
						"id" => "slide_direction",
						"std" => "horizontal",
						"type" => "select",
						"class" => "mini",
						"options" => array('horizontal' => 'Horizontal', 'vertical' => 'Vertical'));

	$options[] = array( "name" => "Homepage: Auto Play",
						"desc" => "Choose to have your slide show autoplay or not.",
						"id" => "autoplay",
						"std" => "true",
						"type" => "select",
						"class" => "mini",
						"options" => array('true' => 'On', 'false' => 'Off'));

	$options[] = array( "name" => "Homepage: Autoplay Speed",
						"desc" => "Choose how long each slide will show (in milliseconds)",
						"id" => "transition",
						"std" => "7000",
						"class" => "mini",
						"type" => "text");

	$options[] = array( "name" => "Homepage: Next / Previous Buttons",
						"desc" => "Choose to turn the next/previous buttons on or off. (If on, they only show on hover via javascript in the /js/script.js file)",
						"id" => "nextprev",
						"std" => "true",
						"type" => "select",
						"class" => "mini",
						"options" => array('true' => 'On', 'false' => 'Off'));


	$options[] = array( "name" => "Homepage: Thumbnail Navigation Buttons",
						"desc" => "Choose to display the navigation bullets on the bottom left of the slideshow.",
						"id" => "controllingnavigation",
						"std" => "true",
						"type" => "select",
						"class" => "mini",
						"options" => array('true' => 'On', 'false' => 'Off'));


	$options[] = array( "name" => "Real Estate/Portfolio: Animation",
						"desc" => "Choose your slider animation between fade and slide.",
						"id" => "animation_real_estate",
						"std" => "fade",
						"type" => "select",
						"class" => "mini",
						"options" => array('fade' => 'Fade', 'slide' => 'Slide'));


	$options[] = array( "name" => "Real Estate/Portfolio: Auto Play",
						"desc" => "Choose to have your slide show autoplay or not.",
						"id" => "autoplay_real_estate",
						"std" => "false",
						"type" => "select",
						"class" => "mini",
						"options" => array('true' => 'On', 'false' => 'Off'));


	$options[] = array( "name" => "Real Estate/Portfolio: Autoplay Speed",
						"desc" => "Choose how long each slide will show (in milliseconds)",
						"id" => "transition_real_estate",
						"std" => "7000",
						"class" => "mini",
						"type" => "text");

	return $options;
}