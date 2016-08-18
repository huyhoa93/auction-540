<?php

class Magestore_Auction_Model_Deposit extends Mage_Core_Model_Abstract
{
	const XML_PATH_SALES_EMAIL_IDENTITY = "trans_email/ident_sales";
	const XML_PATH_APPROVE_TO_CUSTOMER = "auction/emails/approve_to_customer_email_template";
	
	public function _construct()
    {
        parent::_construct();
        $this->_init('auction/deposit');
    }
	
	public function emailApproveToCustomer() {
            
            $storeID = $this->getStoreId();
            $translate = Mage::getSingleton('core/translate');
            $translate->setTranslateInline(false);

            $template = Mage::getStoreConfig(self::XML_PATH_APPROVE_TO_CUSTOMER, $storeID);
		
            $sendTo = array(
                array(
                    'name' => $this->getCustomerName(),
                    'email' => $this->getCustomerEmail(),
                )
            );
            $mailTemplate = Mage::getModel('core/email_template');
			
            foreach ($sendTo as $recipient) {
                $mailTemplate->setDesignConfig(array('area' => 'frontend', 'store' => $storeID))
                        ->sendTransactional(
                                $template, Mage::getStoreConfig(self::XML_PATH_SALES_EMAIL_IDENTITY, $storeID), $recipient['email'], $recipient['name'], array(
                            'deposit' => $this
                                )
                );
            }

            $translate->setTranslateInline(true);
        
        return $this;
    }
}