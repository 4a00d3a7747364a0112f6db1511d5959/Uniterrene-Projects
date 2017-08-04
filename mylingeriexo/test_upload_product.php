<?php
    umask(0);
    require 'app/Mage.php'; //include magento libraries
	Mage::app('admin');
	$fp = fopen("product-feed.csv", 'r'); 
	$i = 0;
	while(($website=fgetcsv($fp))) 
	{
		 if($i!=0)
		 {
			$image1 = $website[10];
			$image2 = $website[11];
			$image3 = $website[12];
			$image4 = $website[13];
			$image5 = $website[14];
			$image6 = $website[15];
			
			$sku = $website[0];
			
			
			mkdir('import/'.$sku,0777,true);
			define('DIRECTORY2', '/home/uniterrene2015/public_html/dev/mylingeriexo/import/'.$sku);
			$dir = "/home/uniterrene2015/public_html/dev/mylingeriexo/import/".$sku;
			$filename1= end(explode('/',$image1));
			$filename2= end(explode('/',$image2));
			$filename3= end(explode('/',$image3));
			$filename4= end(explode('/',$image4));
			$filename5= end(explode('/',$image5));
			$filename6= end(explode('/',$image6));
		
	        //image downloads
			file_put_contents($dir.$filename1, file_get_contents($image1));
			file_put_contents($dir.$filename2, file_get_contents($image2));
			file_put_contents($dir.$filename3, file_get_contents($image3));
			file_put_contents($dir.$filename4, file_get_contents($image4));
			file_put_contents($dir.$filename5, file_get_contents($image5));
			file_put_contents($dir.$filename6, file_get_contents($image6));

            //image uploads
			$path = Mage::getBaseDir().DS;

			$path_new = $path.'media/import/'.$sku.'/';
			$image1_upload = $path_new.$filename1;
			$image2_upload = $path_new.$filename2;
			$image3_upload = $path_new.$filename3;
			$image4_upload = $path_new.$filename4;
			$image5_upload = $path_new.$filename5;
			$image6_upload = $path_new.$filename6;
			
			$productsData = array($image1_upload,$image2_upload,$image3_upload,$image4_upload,$image5_upload,$image6_upload);
		    /* echo"<pre>";
			 print_r($productsData);*/
			 
			
			foreach($productsData as $filename)
			{
				print_r($filename);

				$media = Mage::getModel('catalog/product_attribute_media_api'); 
			 	$product = Mage::getModel('catalog/product');
$id = Mage::getModel('catalog/product')->getResource()->getIdBySku($sku);
				
				//$ourProduct = $product->load($id);
				echo $id;
				//$ourProduct->addImageToMediaGallery($filename, array('image', 'small_image', 'thumbnail'), false, false);
				
				$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
				
				
			}
			  /* if ($product->getId() > 0)
				{
					echo $product->getId().'<br>';
					echo $count;
					$count++;
				 // $positn=1;
				  $newImage = array(
						'file' => array(
							'content' => base64_encode($path_new),
							'mime' => 'image/jpeg',
							'name' => basename($v),
							),
						'label' => '', // change this. 
						'position' => '',
						'types' => array('small_image','thumbnail','image'),
						'exclude' => 0,
					); 
					   
					
					print_r($newImage);
					echo "</br>";
					
					$media->create($sku, $newImage);         
					  
				   //} //if condition for test
				}*/
				
				
		 }
		 $i++;
		 if($i==50)
		 {
			 exit();
		 }
		 
	}



?>