<?php

$english = array(
	'quickshop:product_category:add' => 'Add Category',
	'quickshop:store:identifier' => "Store identifier",
	'quickshop:store:identifier:helptext' => "This will determine the url to your store: eg. if your store identifier is 'bobsburgers' your store will be located at %sstore/bobsburgers
	  Use alpha-numeric characters, hyphens/underscores, no spaces or special characters.  You cannot use an identifier that is already in use by another store.",
	'quickshop:groups:tags' => 'Keywords (comma separated)',
	'quickshop:groups:tags:helptext' => "Enter a comma separated list of words that describe your store and the type of products you sell",
	
	// groups
	'groups:access:group' => 'Nobody (Hidden)',
	
	// Errors
	'quickshop:error:identifier:char' => "Invalid character(s) in identifier",
	'quickshop:error:identifier:unique' => "Identifier is already taken, please choose another",
	
	// Edit product category
	'quickshop:category:add' => "Add Category",
	'quickshop:category:edit' => "Edit Category: %s",
	'quickshop:product_categories:title' => "Product Categories",
	'quickshop:product_category:label:title' => "Category Name",
	'quickshop:product_category:top_level' => "Top Level Category",
	'quickshop:product_category:error:invalid' => "Invalid category",
	'quickshop:product_category:error:invalid:container' => "Invalid container",
	'quickshop:product_category:add:success' => "Category has been created",
	'quickshop:product_category:edit:success' => "Category has been updated",
	'quickshop:category:parent:title' => "Place category in",
	'quickshop:product_category:error:container_circle' => "Cannot move a category below itself",
	
	'quickshop:category:title' => "Category: %s",
	'quickshop:product_category:no_results' => "No products were found in this category",

);

add_translation('en', $english);