<?php

class Magestore_Affiliateplus_Model_Mysql4_Account_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected $_store_id = null;
    protected $_addedTable = array();
	
	public function setStoreId($value){
		$this->_store_id = $value;
		return $this;
	}
	
	public function getStoreId(){
		return $this->_store_id;
	}
	
    public function _construct(){
        parent::_construct();
        $this->_init('affiliateplus/account');
    }
    
    protected function _afterLoad(){
    	parent::_afterLoad();
    	if ($storeId = $this->getStoreId())
    	foreach ($this->_items as $item){
    		$item->setStoreId($storeId)->loadStoreValue();
    	}
    	return $this;
    }
    
    public function addFieldToFilter($field, $condition=null) {
        if ($storeId = $this->getStoreId()) {
            $model = Mage::getSingleton($this->getModelName());
            $attributes = array_merge(
                    $model->getStoreAttributes(),
                    $model->getBalanceAttributes()
                );
            if (in_array($field, $attributes)) {
                if (!in_array($field, $this->_addedTable)) {
                    $this->getSelect()
                        ->joinLeft(array($field => $this->getTable('affiliateplus/account_value')),
                            "main_table.account_id = $field.account_id" .
                            " AND $field.store_id = $storeId" .
                            " AND $field.attribute_code = '$field'",
                            array()
                        );
                    $this->_addedTable[] = $field;
                }
                return parent::addFieldToFilter("IF($field.value_id IS NULL, main_table.$field, $field.value)", $condition);
            }
        }
        return parent::addFieldToFilter($field, $condition);
    }
}
