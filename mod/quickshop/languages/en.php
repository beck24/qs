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
	'quickshop:category:delete:confirm' => "Deleting a category will delete all subcategories.  Products in these categories will no longer be in the categories but will otherwise be unaffected.  There is no undo! Are you sure you want to delete the category?",
	'quickshop:product_category:sm:deleted' => "Category has been deleted",
	'quickshop:category:allproducts' => 'All Products',
	
	'quickshop:category:title' => "Category: %s",
	'quickshop:product_category:no_results' => "No products were found in this category",
	
	// Products
	'quickshop:product:add' => "Add Product",
	'groups/product:add' => "Add Product",
	'quickshop:product:fieldset:general_info' => "About the Product",
	'quickshop:product:general_info:helptext' => "Set the basic information for your product",
	'quickshop:product:label:title' => "Product Name",
	'quickshop:product:label:description' => "Product Description",
	'quickshop:product:label:tags' => "Keywords (comma separated)",
	'quickshop:product:fieldset:images' => "Images",
	'quickshop:product:images:helptext' => "Upload and manage images of the product",
	'quickshop:product:label:images' => "Upload Image",
	'quickshop:product:fieldset:shipping' => "Shipping",
	'quickshop:product:shipping:helptext' => "Set item shipping values or download options",
	'quickshop:product:fieldset:pricing' => "Pricing",
	'quickshop:product:pricing:helptext' => "Set the list price, sale price, etc.",
	'quickshop:product:pricing:price' => "Sell Price",
	'quickshop:product:error:sell_price' => "Invalid sell price, please use numeric values only in the format ###.##",
	'quickshop:product:error:notitle' => "You must enter a name for the product, all fields with a red asterix are required",
	'quickshop:product:error:invalid:product' => "Invalid product",
	'quickshop:product:error:save' => "There was a problem saving the product",
	'quickshop:product:noresults' => "No products available",
	
);

add_translation('en', $english);