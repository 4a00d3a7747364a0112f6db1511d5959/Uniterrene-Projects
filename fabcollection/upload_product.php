<?php
    umask(0);
    require 'app/Mage.php'; //include magento libraries
	Mage::app('admin');
	$fp = fopen("magento_product_title.csv", 'r'); 
	$i = 0;
	while(($website=fgetcsv($fp))) 
	{
		if($i!=0)
		{
		
		
		$sku = $website[0];
		
		 
		 
		// echo "--------------------------------------------------------------------";
	//echo "<br/>";
	
	$sDefaultAttributeSetId = Mage::getSingleton('eav/config')
    ->getEntityType(Mage_Catalog_Model_Product::ENTITY)
    ->getDefaultAttributeSetId();
	
    /** Array for simple products start here**/
	$simpleProduct[0]['sku'] = $website[0];
    $simpleProduct[0]['name'] = $website[1];
	$simpleProduct[0]['description'] = $website[4];
    $simpleProduct[0]['short_description'] = $website[4];
    $simpleProduct[0]['weight'] = 1;
	$simpleProduct[0]['msrp']=$website[3];
	$simpleProduct[0]['attribute_set_id'] = $sDefaultAttributeSetId;   //ID of a attribute set named 'default'
    $simpleProduct[0]['type_id'] = Mage_Catalog_Model_Product_Type::TYPE_SIMPLE;
    $simpleProduct[0]['status'] = Mage_Catalog_Model_Product_Status::STATUS_ENABLED;
    $simpleProduct[0]['visibility'] = Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH;
    $simpleProduct[0]['tax_class_id'] = 0;
    $simpleProduct[0]['category_ids'] = array(17); // We are using hard code ID here
    $simpleProduct[0]['stock_data'] = array(
                            'manage_stock' => 1,
                            'is_in_stock' => 1,
                            'qty' => 10,
                            'use_config_manage_stock' => 0
                        );
	
    /** Array for simple products End here**/
	
    $simpleProducts = array();    
	    
    foreach($simpleProduct as $product){ //insert all the simple product loop start
        $sProduct = Mage::getModel('catalog/product');
		$sProduct->setSku($product['sku']);
        $sProduct->setName($product['name']);
		$sProduct->setDescription($product['description']);
        $sProduct->setShortDescription($product['short_description']);
        $sProduct->setWeight($product['weight']);
		$sProduct->setPrice($product['msrp']);
		 $sProduct->setAttributeSetId($product['attribute_set_id']);
        $sProduct->setTypeId($product['type_id'])->setWebsiteIds(array(1))->setStatus($product['status'])->setVisibility($product['visibility'])->setTaxClassId($product['tax_class_id']);
        $sProduct->setCategoryIds($product['category_ids']);
        $categoryIds = $product['category_ids'];
		
		$dateModel = Mage::getSingleton('core/date');
		$sProduct->setNewsFromDate($dateModel->gmtDate());
		 $sProduct->setNewsToDate($dateModel->gmtDate(null, mktime(0,0,0, date('m') + 3, date('d'), date('Y') )));
		
       // $optionId = getOptionId('product_size',$product['size']);
       // $sProduct->setData('product_size',$optionId);
       


    $sProduct->save();  
     /// For Inventory Management
		
		
        $stockItem = Mage::getModel('cataloginventory/stock_item');
        $stockItem->assignProduct($sProduct);
        $stockItem->setData('is_in_stock', 1);
        $stockItem->setData('manage_stock', 1);
		$stockItem->setData('date_added');
        $stockItem->setData('stock_id', 1);
        $stockItem->setData('store_id', 1);
        $stockItem->setData('use_config_manage_stock', 1);
        $stockItem->setData('qty', 100);
    $stockItem->save();

        // we are creating an array with some information which will be used to bind the simple products with the configurable
        array_push(
            $simpleProducts,
            array(
                "id" => $sProduct->getId(),
                "price" => $sProduct->getPrice(),
                "attr_code" => 'size',
                "attr_id" => 143, // I have used the hardcoded attribute id of attribute size, you must change according to your store
                "value" => $optionId,
                "label" => $product['size'],
            )
        );
    }
	 
	 }		
	 
		
	 
	 $i++;
	 if($i == 2)
	 {
		 //exit();
		 
	 }
	}
	
	fclose($fp);


        
       
?>
