<?php

class QScategory extends ElggObject {

	/**
	 * Set subtype to product.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "product_category";
	}
    
    public function getURL() {
        $group = $this->getGroup();
        return elgg_get_site_url() . "groups/{$group->identifier}/category/{$this->guid}/" . elgg_get_friendly_title($this->title);
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

    public function hasProduct($product) {
        if (!elgg_instanceof($product, 'object', 'product')) {
            return false;
        }
        
        return check_entity_relationship($product->guid, QUICKSHOP_CATEGORY_RELATIONSHIP, $this->guid);
    }
    
    public function set_breadcrumbs() {
        // get all parent categories up to the group
        $group = $this->getGroup();
        
        elgg_push_breadcrumb($group->name, $group->getURL());
  
        $parents = array();
        while ($parent = get_entity($category->container_guid)) {
            if ($parent->guid == $group->guid) {
                break;
            }
	
            $parents[] = $parent;
            $category = $parent;
        }
  
        $parents = array_reverse($parents);
  
        foreach ($parents as $parent) {
            elgg_push_breadcrumb($parent->title, $parent->getURL());
        }
    }

}