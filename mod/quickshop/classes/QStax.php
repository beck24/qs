<?php

class QStax extends ElggObject {

	/**
	 * Set subtype to product.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "qstax";
	}
    
    public function getURL() {
        return elgg_get_site_url();
    }
    
    public function getGroup() {
        $test = $this;
        
        while ($container = $test->getContainerEntity()) {
            if (elgg_instanceof($container, 'group')) {
                return $container;
            }
            
            $test = $container;
        }
        
        return false;
    }

    
    public function getItems($params = array()) {
        
        $defaults = array(
            'type' => 'object',
            'subtype' => 'product',
            'relationship' => QUICKSHOP_TAX_RELATIONSHIP,
            'relationship_guid' => $this->guid,
            'limit' => false
        );
        
        $options = array_merge($defaults, $params);
        
        return elgg_get_entities($options);
    }
    
    public function getTaxAmount($product, $quantity = 1) {
        if (!elgg_instanceof($product, 'object', 'product')) {
            return quickshop_format_monetary_value(0);
        }
        
        switch ($this->taxtype) {
            case 'percentage':
                return ($this->getPercentageTax($product) * $quantity);
                break;
            
            case 'flat':
                return ($this->getFlatTax($product) * $quantity);
                break;
        }
        
        return quickshop_format_monetary_value(0);
    }
    
    public function getPercentageTax($product) {
        if (!elgg_instanceof($product, 'object', 'product')) {
            return quickshop_format_monetary_value(0);
        }
        
        $tax = quickshop_format_monetary_value($product->sell_price * ($this->rate/100));

        $params = array('tax' => $this, 'product' => $product);
        
        return elgg_trigger_plugin_hook('qstax', 'percent', $params, $tax);
    }
    
    public function getFlatTax($product) {        
        $tax = quickshop_format_monetary_value($this->rate);
        
        $params = array('tax' => $this, 'product' => $product);
        
        return elgg_trigger_plugin_hook('qstax', 'percent', $params, $tax);
    }
    
    public function displayRate() {
        $group = $this->getGroup();
        switch ($this->taxtype) {
            case 'flat':
                $prefix = quickshop_get_group_money_symbol($group);
                return $prefix . $this->rate;
                break;
            
            default:
                $suffix = '%';
                return $this->rate . $suffix;
                break;
        }
    }
    
    public function isTaxable($product) {
        return check_entity_relationship($product->guid, QUICKSHOP_TAX_RELATIONSHIP, $this->guid);
    }
}