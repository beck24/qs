<?php

class QSproduct extends ElggObject {

	/**
	 * Set subtype to product.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "product";
	}

	/**
	 * Can a user comment on this product?
	 *
	 * @see ElggObject::canComment()
	 *
	 * @param int $user_guid User guid (default is logged in user)
	 * @return bool
	 * @since 1.8.0
	 */
	public function canComment($user_guid = 0) {
		$result = parent::canComment($user_guid);
		if ($result == false) {
			return $result;
		}

		if ($this->comments_on == 'Off') {
			return false;
		}
		
		return true;
	}

    public function getURL() {
        $group = $this->getGroup();
        return elgg_get_site_url() . "groups/{$group->identifier}/product/{$this->guid}/" . elgg_get_friendly_title($this->title);
    }
    
    public function getMenu() {
        return elgg_view_menu('entity', array(
            'entity' => $this,
            'handler' => 'product',
            'class' => 'elgg-menu-hz'
        ));
    }
    
    public function addToCartLink() {
        
        // if already in the cart, return a view cart link
        $group = $this->getGroup();
        $cart = quickshop_get_cart($group);
        
        $text = elgg_echo('qs:add:to:cart');
        $href = 'action/addtocart?guid=' . $this->guid;
        $action = true;
        $class = 'add-to-cart';
        
        if ($cart && $cart->hasItem($this)) {
            $text = elgg_echo('qs:cart:item:exists');
            $href = $cart->getCheckoutURL();
            $action = false;
        }
        
        return elgg_view('output/url', array(
            'text' => $text,
            'href' => $href,
            'is_action' => $action,
            'class' => $class
        ));
    }
    
    public function getGroup() {
        return $this->getContainerEntity();
    }
}