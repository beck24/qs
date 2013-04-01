
elgg.provide('elgg.quickshop');

elgg.quickshop.init = function() {
  elgg.quickshop.category_tree();
  
  elgg.quickshop.product_fieldset();
  
  elgg.quickshop.fieldset_next();
}

/*
  handles the toggle of the categories tree
*/
elgg.quickshop.category_tree = function() {
  $('.quickshop-category-tree').live('click', function(e) {
	e.preventDefault();
	
	var child = $(this).siblings('ul.product_categories_menu').eq(0);
	
	child.slideToggle();
  });
}


/*
  handles the toggle of the edit product form
*/
elgg.quickshop.product_fieldset = function() {
  $('.quickshop-fieldset-toggle').live('click', function(e) {
	e.preventDefault();
	
	var target = $(this).attr('data-toggle');
	
	$('.quickshop-toggle-target:not(".'+target+'")').slideUp();
	
	$('.'+target).slideToggle();
  });
}


elgg.quickshop.fieldset_next = function() {
  $('.quickshop-fieldset-next').live('click', function(e) {
	e.preventDefault();
	
	var parent_fieldset = $(this).parents('fieldset').eq(0);
	var target = parent_fieldset.next('fieldset').children('div.quickshop-toggle-target').eq(0);
	
	$('.quickshop-toggle-target').slideUp();
	target.slideToggle();
  });
}

elgg.register_hook_handler('init','system', elgg.quickshop.init);