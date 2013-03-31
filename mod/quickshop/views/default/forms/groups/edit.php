<?php
/**
 * Group edit form
 * 
 * @package ElggGroups
 */

// only extract these elements.
$name = $membership = $vis = $entity = $identifier = $interests = $description = null;
extract($vars, EXTR_IF_EXISTS);

?>
<div>
	<label><?php echo elgg_echo("groups:icon"); ?></label><br />
	<?php echo elgg_view("input/file", array('name' => 'icon')); ?>
</div>
<div>
	<label><?php echo elgg_echo("groups:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		'name' => 'name',
		'value' => $name
	));
	?>
</div>

<div>
  <label>
	<?php echo elgg_echo('quickshop:store:identifier'); ?>
  </label>
  <?php
  echo elgg_view('input/text', array(
	'name' => 'identifier',
	  'value' => $identifier
  ));
  
  echo elgg_view('output/longtext', array(
	  'value' => elgg_echo('quickshop:store:identifier:helptext', array(elgg_get_site_url())),
	  'class' => 'elgg-subtext'
  ));
  ?>
</div>

<div>
  <label>
	<?php echo elgg_echo('groups:description'); ?>
  </label>
  <?php echo elgg_view('input/longtext', array(
	'name' => 'description',
	  'value' => $description
  ));
  ?>
</div>

<div>
  <label>
	<?php echo elgg_echo('quickshop:groups:tags'); ?>
  </label>
  <?php echo elgg_view('input/tags', array(
	'name' => 'interests',
	  'value' => $interests
  ));
  
  echo elgg_view('output/longtext', array(
	 'value' => elgg_echo('quickshop:groups:tags:helptext'),
	  'class' => 'elgg-subtext'
  ));
  ?>
</div>

<div>
	<label>
		<?php echo elgg_view('input/hidden', array(
			'name' => 'membership',
			'value' => ACCESS_PUBLIC,
		));
		?>
	</label>
</div>
	
<?php

if (elgg_get_plugin_setting('hidden_groups', 'groups') == 'yes') {
	$access_options = array(
		ACCESS_PRIVATE => elgg_echo('groups:access:group'),
		ACCESS_LOGGED_IN => elgg_echo("LOGGED_IN"),
		ACCESS_PUBLIC => elgg_echo("PUBLIC")
	);
?>

<div>
	<label>
			<?php echo elgg_echo('groups:visibility'); ?><br />
			<?php echo elgg_view('input/access', array(
				'name' => 'vis',
				'value' =>  $vis,
				'options_values' => $access_options,
			));
			?>
	</label>
</div>

<?php 	
}

if (isset($vars['entity'])) {
	$entity     = $vars['entity'];
} else {
	$entity = false;
}

?>
<div class="elgg-foot">
<?php

if ($entity) {
	echo elgg_view('input/hidden', array(
		'name' => 'group_guid',
		'value' => $entity->getGUID(),
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

if ($entity) {
	$delete_url = 'action/groups/delete?guid=' . $entity->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('groups:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('groups:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>
