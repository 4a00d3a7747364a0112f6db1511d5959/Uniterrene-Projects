<?php
    umask(0);
    require 'app/Mage.php'; //include magento libraries
	Mage::app('admin');
  
	

 $fs = fopen("inventory-feed.csv", 'r'); 
	$j= 0;
	while(($w=fgetcsv($fs))) 
	{
		if($j!=0)
		{
			
			 $sku = $w[0];
			 
			$qty = $w[1];


	$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
	$id = Mage::getModel('catalog/product')->getIdBySku($sku);
	$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product);
	
	if ($id) {
  $stockItem->setData('qty', $qty);
	$stockItem->save();
	$_product->save();
	echo "stock updated for ".$sku ;
	echo "<br/>";
	}
	


//$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
	//$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product);
//$stockItem->setData('qty', $qty);
	//$stockItem->save();
	//$_product->save();
			 
			 
		}
		$j++;
		
	}
	
	fclose($fs);



?>