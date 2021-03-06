<?php

/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
 /***************************************
 *         MAGENTO EDITION USAGE NOTICE *
 *****************************************/
/*
 * This package designed for Magento COMMUNITY edition BelVG does not guarantee
 * correct work of this extension on any other Magento edition except Magento
 * COMMUNITY edition. BelVG does not provide extension support in case of
 * incorrect edition usage. /*************************************** DISCLAIMER
 * * ***************************************
 */
/* Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future.
*****************************************************
* @category   Belvg
* @package    Belvg_MultipleWishlist
* @author     Victor Potseluyonok
* @copyright  Copyright (c) 2010 - 2011 BelVG LLC. (http://www.belvg.com)
* @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
*/
class Belvg_MultipleWishlist_Block_Frontend_Wishlist_Customer_Share_Email_Items extends Mage_Wishlist_Block_Share_Email_Items
{
    
    /*
     * public function __construct() { parent::__construct(); if
     * (Mage::helper('multiplewishlist')->isEnabled()) {
     * $this->setTemplate('belvg/multiplewishlist/wishlist/email/items.phtml');
     * } }
     */
    public function getWishlistItems ()
    {
        if (Mage::helper('multiplewishlist')->isEnabled()) {
            $this->_collection = Mage::getSingleton('multiplewishlist/tab')->getWishlistItemCollection(
                    NULL, 
                    Mage::getModel('core/session')->getWishlistActiveTabId());
        }
        
        return parent::getWishlistItems();
    }
}