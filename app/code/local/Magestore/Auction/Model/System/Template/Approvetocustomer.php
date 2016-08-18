<?php

class Magestore_Auction_Model_System_Template_Approvetocustomer
{
    public function toOptionArray()
    {
        if(!$collection = Mage::registry('config_system_email_template')) {
            $collection = Mage::getResourceModel('core/email_template_collection')
                ->load();

            Mage::register('config_system_email_template', $collection);
        }

        $options = $collection->toOptionArray();
        
        array_unshift(
            $options,
            array(
                'value'=> 'magestore_auction_approve_tocustomer',
                'label' => 'Approve notice to customer (Default)'
            )
        );		
		
		return $options;
    }
}