<?php

$english = array(
	'quickshop:product_category:add' => 'Add Category',
	'quickshop:store:identifier' => "Store identifier",
	'quickshop:store:identifier:helptext' => "This will determine the url to your store: eg. if your store identifier is 'bobsburgers' your store will be located at %sstore/bobsburgers
	  Use alpha-numeric characters, hyphens/underscores, no spaces or special characters.  You cannot use an identifier that is already in use by another store.",
	'quickshop:groups:tags' => 'Keywords (comma separated)',
	'quickshop:groups:tags:helptext' => "Enter a comma separated list of words that describe your store and the type of products you sell",
    'quickshop:subtotal' => "Subtotal",
    'quickshop:total' => "Total",
    'qs:admin:title:' => "Store Administration",
    'quickshop:manage:taxes' => "Manage Taxes",
    'qs:admin:title:taxes' => "Manage Taxes",
    'qs:error:generic:permissions' => 'Invalid permissions',
    'qs:error:generic:entity:save' => "There was an issue saving to the database",
	
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
	'quickshop:product:edit' => "Edit Product",
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
    'quickshop:group:admin' => "Store Admin",
    'quickshop:view:orders' => "View Orders",
    'quickshop:product:label:categories' => "Categories",
    
    //
    'qs:theme' => 'Theme',
    'qs:add:to:cart' => 'Add to Cart',
    'qs:invalid:guid' => "Invalid ID",
    'qs:cart:item:added' => "Product has been added to your cart",
    'qs:cart:item:exists' => "In Cart: Checkout now!",
    'qs:view:cart' => "View Cart",
    'qs:view:cart:help' => "Check over your order.  When you are ready to proceed, continue to checkout",
    'qs:proceed:to:checkout' => "Proceed to checkout",
    'qs:cart:no:products' => "There are no products in your shopping cart",
    'qs:cart:update' => "Update Cart",
    'qs:qty' => "qty",
    'qs:remove:empty:cart' => "Your cart has no more items, please continue shopping",
    'qs:quantity:numeric' => "Quantities must be a numeric value",
    
    
    // ADMIN
    'qs:admin:landing' => "Administration: here you can control the behavior of your store.  Use the links to the right to access various settings.",
    'qs:admin:edit' => "Edit Store",
    
    // Taxes
    'qs:admin:taxes:add' => "Add Tax",
    'qs:admin:title:taxes/add' => "Add Tax",
    'qs:admin:title:taxes/edit' => "Edit Tax",
    'qs:taxes:none' => 'No taxes created for this store',
    'qs:tax:label:admin:title' => "Name",
    'qs:tax:help:title' => 'The common name of the tax, eg. GST, or Enviro-Fee',
    'qs:tax:label:description' => "Description",
    'qs:tax:help:description' => "A short description to appear on orders - registration numbers if applicable eg. #123456789-RT001",
    'qs:tax:label:taxtype' => "Type of Tax",
    'qs:tax:help:taxtype' => "How the tax should be calculated.  eg. Flat taxes are simple static charges of a set price per applicable product.  Percentage taxes are dependent on the sale price of the product.",
    'qs:tax:option:taxtype:flat' => "Flat tax",
    'qs:tax:option:taxtype:percentage' => "Percentage tax",
    'qs:tax:label:rate' => "Tax Rate",
    'qs:tax:help:rate' => "Enter a numerical value - set amount to be added for a flat tax (eg. A bottle deposit of \$0.20 you would enter 0.20), or a percentage amount for a percentage tax (eg. for GST of 5% you should enter the value '5')",
    'qs:tax:label:all_products' => "Apply this tax to all existing products",
    'qs:tax:help:all_products' => "If this box is checked, this tax will be applied to all existing products.  If left unchecked no assignments for this tax will change, tax can be assigned to a product on an individual basis by editing the product.",
	'qs:tax:label:default_tax' => "Make this tax default",
    'qs:tax:help:default_tax' => "If checked, when creating a new product this tax will automatically be selected.  The tax can be unselected at the time of product creation/editing.  Check this box if the tax applies to the majority of products in your store.",
    'qs:tax:error:required_fields' => "Title, Description, and Rate are required fields",
    'qs:tax:edit:success' => "Tax information successfully saved",
    'qs:tax:all_products:success' => "Tax has been added to all existing products",
    'qs:tax:error:rate_numeric' => "Tax rate must be a numeric value",
    'qs:tax:delete:error' => "There was a problem deleting the tax",
    'qs:tax:delete:success' => "Tax successfully deleted",
);

add_translation('en', $english);