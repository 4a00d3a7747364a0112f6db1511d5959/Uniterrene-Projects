<?php
$mageFilename = 'app/Mage.php';
	require_once $mageFilename;
	//Mage::setIsDeveloperMode(true);
	ini_set('display_errors', 1);
	umask(0);
	Mage::app('admin');
	$storeId = Mage::app()->getStore()->getId();
	Mage::app()->getStore($storeId);
	
	
	$collection = Mage::getResourceModel('catalog/product_collection');
	$j=1;
	$media = Mage::getModel('catalog/product_attribute_media_api'); 
	foreach($collection as $product) 
	{
			$pro_id = $product->getId();
			$_product = Mage::getModel('catalog/product')->load($pro_id);
			$sku =  $_product->getSku();
			
			
		
			$dirname = Mage::getBaseDir() . DS . 'product_images/'.$sku.'/';
			echo "<br/>";  
			$images = glob($dirname."*.jpg");
			
			$j=1;
			foreach($images as $image) 
			{
				$dirname = Mage::getBaseDir() . DS . 'product_images/'.$sku.'/';
				if($image !='')
				{
				//echo $image;
				$sourceArr= explode('/', $image);
					$countSourceArr=count($sourceArr);
					$destFilename =$sourceArr[$countSourceArr-1];
					
					$image_path = "http://www.uniterreneprojects.com/dev/fabcollection/product_images/".$sku."/".$destFilename;
					$import = $dirname.$destFilename;
					if($destFilename =="1.jpg")
					{
						$newImage = array(
							'file' => array(
							'content' => base64_encode($import),
							'mime' => 'image/jpeg',
							'name' => basename($import),
							),
							'label' => '', // change this. 
							'position' => '',
							'types' => array('small_image','thumbnail','image'),
							'exclude' => 0,
							); 
							$media->create($sku, $newImage); 
					}
					else
					{
						$newImage2 = array(
							'file' => array(
							'content' => base64_encode($import),
							'mime' => 'image/jpeg',
							'name' => basename($import),
							),
							'exclude' => 0,
							); 
						$media->create($sku, $newImage2); 
					}
					
						
						
					

					
						

					
					if($j==2)
					{
						exit();
					}
					echo $sku;
					$j++;
				}
					
			}
			
	}
	
	
	
	
	
	
	

?>
