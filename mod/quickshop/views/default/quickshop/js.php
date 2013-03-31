
elgg.provide('elgg.quickshop');

elgg.quickshop.init = function() {
  elgg.quickshop.category_tree();
}

elgg.quickshop.category_tree = function() {
  $('.quickshop-category-tree').live('click', function(e) {
	e.preventDefault();
	
	var child = $(this).siblings('ul.product_categories_menu').eq(0);
	
	child.slideToggle();
  });
}

elgg.register_hook_handler('init','system', elgg.quickshop.init);