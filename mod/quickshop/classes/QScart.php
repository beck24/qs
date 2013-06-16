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
}