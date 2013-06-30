<?php

class QScart extends ElggObject {

	/**
	 * Set subtype to qscart.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "qscart";
	}

    public function getURL() {
        $group = $this->getGroup();
        return elgg_get_site_url() . "groups/{$group->identifier}/order/{$this->guid}";
    }
    
    public function getGroup() {
        return $this->getContainerEntity();
    }
    
    public function addItem($product) {
        add_entity_relationship($product->guid, 'order_item', $this->guid);
    }
    
    public function removeItem($product) {
        remove_entity_relationship($product->guid, 'order_item', $this->guid);
    }
    
    public function hasItem($product) {
        return check_entity_relationship($product->guid, 'order_item', $this->guid);
    }
    
    public function getItems() {
        return elgg_get_entities_from_relationship(array(
            'type' => 'object',
            'subtype' => 'product',
            'container_guid' => $this->container_guid,
            'relationship' => 'order_item',
            'relationship_guid' => $this->guid,
            'inverse_relationship' => true,
            'limit' => false
        ));
    }
    
    public function getCheckoutURL() {
        $group = $this->getGroup();
        
        return elgg_get_site_url() . "groups/{$group->identifier}/cart";
    }
    
    public function getCheckoutLink() {
        
        return elgg_view('output/url', array(
            'text' => elgg_echo('qs:view:cart'),
            'href' => $this->getCheckoutURL(),
            'is_trusted' => true
        ));
    }
    
    public function getSubtotal() {
        $items = $this->getItems();
        
        $subtotal = 0;
        foreach ($items as $product) {
            $quantity = $this->getQuantity($product);
            $subtotal += $product->sell_price * $quantity;
        }
        
        return elgg_trigger_plugin_hook('qscart', 'subtotal', array('cart' => $this), $subtotal);
    }
    
    public function getTax() {
        $return = array();
        $group = $this->getGroup();
        $products = $this->getItems();
        
        $taxes = quickshop_get_group_taxes($group);
        
        foreach ($taxes as $tax) {
            // iterate through the products and see if tax applies to this product
            $return[$tax->guid] = 0;
            
            foreach ($products as $product) {
                if ($tax->isTaxable($product)) {
                    // calculate tax
                    $quantity = $this->getQuantity($product);
                    $return[$tax->guid] += $tax->getTaxAmount($product, $quantity);
                }
            }
        }
        
        array_walk($return, 'quickshop_format_monetary_value');
        
        $params = array(
            'cart' => $this,
            'group' => $group
        );
        
        return elgg_trigger_plugin_hook('qscart', 'tax', $params, $return);
    }
    
    
    public function getTaxTotal() {
        $taxes = $this->getTax();
        $total = 0;
        
        foreach ($taxes as $description => $subtotal) {
            $total += $subtotal;
        }
        
        return quickshop_format_monetary_value($total);
    }
    
    
    public function getTotal() {
        $total = $this->getSubtotal();
        $total += $this->getTaxTotal();
        
        return $total;
    }
    
    public function getQuantity($product) {
        $attr = 'quantity_' . $product->guid;
        return $this->$attr ? $this->$attr : 1;
    }
}