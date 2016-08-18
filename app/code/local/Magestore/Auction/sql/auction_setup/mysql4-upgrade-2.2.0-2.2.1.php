<?php
$installer = $this;

$installer->startSetup();

$installer->run("

    ALTER TABLE {$this->getTable('auction_product')} 
        ADD `deposit` decimal(12,4) NOT NULL default '0.000';
	
	DROP TABLE IF EXISTS {$this->getTable('auction_deposit')};
	
	CREATE TABLE {$this->getTable('auction_deposit')}  (
	  `auctiondeposit_id` int(11) NOT NULL auto_increment,
	  `productauction_id` int(11) NOT NULL default '0',
	  `product_id` int(11) NOT NULL default '0',
	  `product_name` varchar(255) NOT NULL default '',
	  `customer_id` int(11) NOT NULL default '0',
	  `customer_name` varchar(255) NOT NULL default '',
	  `customer_email` varchar(255) NOT NULL default '',
	  `customer_phone` varchar(50) default NULL,
	  `customer_address` text default NULL,    
	  `deposit` decimal(12,4) NOT NULL default '0.000',  
	  `status` tinyint(1) default '1',
	  `store_id` smallint(5) unsigned NOT NULL,
	  INDEX(`store_id`),
      FOREIGN KEY (`store_id`) REFERENCES {$this->getTable('core/store')} (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE, 
	  FOREIGN KEY ( `productauction_id` ) REFERENCES {$this->getTable('auction_product')} ( `productauction_id` ) ON DELETE CASCADE ON UPDATE CASCADE,
	  PRIMARY KEY  (`auctiondeposit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;
 ");
// $product = Mage::getModel('catalog/product');

    // $product->setSku("ABC123");
    // $product->setName("Type 7 Widget");
    // $product->setDescription("This widget will give you years of trouble-free widgeting.");
    // $product->setShortDescription("High-end widget.");
    // $product->setPrice(0);
    // $product->setTypeId('simple');
    // $product->setAttributeSetId(1); // need to look this up
    // //$product->setCategoryIds("20,24"); // need to look these up
    // $product->setWeight(1.0);
    // $product->setTaxClassId(2); // taxable goods
    // $product->setVisibility(4); // catalog, search
    // $product->setStatus(1); // enabled

    // // assign product to the default website
    // $product->setWebsiteIds(array(1));

    // $product->save(); 


$installer->endSetup(); 