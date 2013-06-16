<?php

add_subtype('object','product_category');

if (get_subtype_id('object', 'product')) {
	update_subtype('object', 'product', 'QSproduct');
} else {
	add_subtype('object', 'product', 'QSproduct');
}

if (get_subtype_id('object', 'product_category')) {
	update_subtype('object', 'product_category', 'QScategory');
} else {
	add_subtype('object', 'product', 'QScategory');
}

if (get_subtype_id('object', 'qscart')) {
	update_subtype('object', 'qscart', 'QScart');
} else {
	add_subtype('object', 'qscart', 'QScart');
}