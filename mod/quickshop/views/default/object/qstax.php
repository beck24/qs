<?php

// structure should mirror object/qstax/header

$tax = $vars['entity'];
$group = $tax->getGroup();

$tax_actions = elgg_view('output/url', array(
    'text' => '<span class="elgg-icon elgg-icon-settings-alt"></span>',
    'href' => $group->getURL() . '/admin/taxes/edit?guid=' . $tax->guid
));

$tax_actions .= elgg_view('output/confirmlink', array(
    'text' => '<span class="elgg-icon elgg-icon-delete"></span>',
    'href' => 'action/qstax/delete?guid=' . $tax->guid
));

?>

<div class="tax-list-wrapper clearfix">
    <div class="tax-name">
        <strong><?php echo $tax->title; ?></strong>
    </div>
    <div class="tax-description">
        <?php echo $tax->description; ?>
    </div>
    <div class="tax-type">
        <?php echo elgg_echo('qs:tax:option:taxtype:' . $tax->taxtype); ?>
    </div>
    <div class="tax-rate">
        <?php echo $tax->displayRate(); ?>
    </div>
    <div class="tax-actions">
        <?php echo $tax_actions; ?>
    </div>
</div>