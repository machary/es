function runisotope(){
	var container = jQuery('#klasik-pf-filterable');
		container.isotope({
			itemSelector : '.item'
		});

	// filter items when filter link is clicked
	jQuery('#filter li').click(function(){
	jQuery('#filter li').removeClass('current');
		jQuery(this).addClass('current');
			var selector = jQuery(this).find('a').attr('data-filter');
			container.isotope({ filter: selector });
		return false;
	}); 
};
jQuery(window).load(function(){
	runisotope();
});

jQuery(window).smartresize(function(){
	runisotope();
});