<?php
  /**
   * Todo: categories
   */

  $product = $vars['entity'];
  $dropdown = '<span class="elgg-icon elgg-icon-hover-menu"></span>';
?>

<fieldset>
<?php
  echo elgg_view('output/url', array(
	  'text' => elgg_echo('quickshop:product:fieldset:general_info') . $dropdown,
	  'href' => '#',
	  'class' => 'quickshop-fieldset-toggle quickshop-fieldset-header',
	  'data-toggle' => 'quickshop-general-info'
  ));
  
  echo elgg_view('output/longtext', array(
	  'value' => elgg_echo('quickshop:product:general_info:helptext'),
	  'class' => 'elgg-subtext'
  ));
?>
  
  <div class="quickshop-general-info quickshop-toggle-target">
	<?php
	  //
	  //  TITLE
	  $value = elgg_get_sticky_value('quickshop_product', 'title');
	  if (!$value) {
		$value = $product ? $product->title : '';
	  }
	  echo '<label class="required">' . elgg_echo('quickshop:product:label:title') . '</label>';
	  echo elgg_view('input/text', array(
		  'name' => 'title',
		  'value' => $value
	  ));
	  
	  
	  //
	  // DESCRIPTION
	  $value = elgg_get_sticky_value('quickshop_product', 'description');
	  if (!$value) {
		$value = $product ? $product->description : '';
	  }
	  echo '<label>' . elgg_echo('quickshop:product:label:description') . '</label>';
	  echo elgg_view('input/longtext', array(
		  'name' => 'description',
		  'value' => $value
	  ));
	  
	  
	  //
	  //  TAGS
	  $value = elgg_get_sticky_value('quickshop_product', 'tags');
	  if (!$value) {
		$value = $product ? $product->tags : '';
	  }
	  echo '<label>' . elgg_echo('quickshop:product:label:tags') . '</label>';
	  echo elgg_view('input/text', array(
		  'name' => 'title',
		  'value' => $value
	  ));
	  
	  echo '<br><br>';
	  echo elgg_view('output/url', array(
		 'text' => elgg_echo('next'),
		  'href' => '#',
		  'class' => 'quickshop-fieldset-next elgg-button elgg-button-action',
	  ));
	?>
  </div>
</fieldset>


<fieldset>
  <?php
  echo elgg_view('output/url', array(
	  'text' => elgg_echo('quickshop:product:fieldset:images') . $dropdown,
	  'href' => '#',
	  'class' => 'quickshop-fieldset-toggle quickshop-fieldset-header',
	  'data-toggle' => 'quickshop-product-images'
  ));
  
  echo elgg_view('output/longtext', array(
	  'value' => elgg_echo('quickshop:product:images:helptext'),
	  'class' => 'elgg-subtext'
  ));
?>
  
  <div class="quickshop-product-images quickshop-toggle-target hidden">
	<label><?php echo elgg_echo('quickshop:product:label:images'); ?></label>
	<div class="quickshop-product-image-upload">
	  <?php echo elgg_view('input/file', array('name' => 'image')); ?>
	</div>
	
	<?php
	echo '<br><br>';
	  echo elgg_view('output/url', array(
		 'text' => elgg_echo('next'),
		  'href' => '#',
		  'class' => 'quickshop-fieldset-next elgg-button elgg-button-action',
	  ));
	?>
  </div>
</fieldset>


<fieldset>
  <?php
  echo elgg_view('output/url', array(
	  'text' => elgg_echo('quickshop:product:fieldset:pricing') . $dropdown,
	  'href' => '#',
	  'class' => 'quickshop-fieldset-toggle quickshop-fieldset-header',
	  'data-toggle' => 'quickshop-product-pricing'
  ));
  
  echo elgg_view('output/longtext', array(
	  'value' => elgg_echo('quickshop:product:pricing:helptext'),
	  'class' => 'elgg-subtext'
  ));
?>
  <div class="quickshop-product-pricing quickshop-toggle-target hidden">
	Pricing stuff
  
  <?php
	echo '<br><br>';
	  echo elgg_view('output/url', array(
		 'text' => elgg_echo('next'),
		  'href' => '#',
		  'class' => 'quickshop-fieldset-next elgg-button elgg-button-action',
	  ));
	?>
  </div>
</fieldset>


<fieldset>
  <?php
  echo elgg_view('output/url', array(
	  'text' => elgg_echo('quickshop:product:fieldset:shipping') . $dropdown,
	  'href' => '#',
	  'class' => 'quickshop-fieldset-toggle quickshop-fieldset-header',
	  'data-toggle' => 'quickshop-product-shipping'
  ));
  
  echo elgg_view('output/longtext', array(
	  'value' => elgg_echo('quickshop:product:shipping:helptext'),
	  'class' => 'elgg-subtext'
  ));
?>
  <div class="quickshop-product-shipping quickshop-toggle-target hidden">
	Shipping stuff
  
  <?php
	echo '<br><br>';
	  echo elgg_view('output/url', array(
		 'text' => elgg_echo('next'),
		  'href' => '#',
		  'class' => 'quickshop-fieldset-next elgg-button elgg-button-action',
	  ));
	?>
  </div>
</fieldset>


<?php 
  // a view for other plugins to extend to add to the form
  echo elgg_view('quickshop/product/extension');

  echo elgg_view('input/submit', array('value' => elgg_echo('submit')));
?>