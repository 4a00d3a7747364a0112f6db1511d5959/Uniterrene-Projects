<?php
require_once 'app/Mage.php';
Mage::app('admin');


 
 $path = '/home/uniterrene2015/public_html/dev/mylingeriexo/import/';

$dirs = array();


// directory handle
$dir = dir($path);


while (false !== ($entry = $dir->read())) 
{
    if ($entry != '.' && $entry != '..')
	 {
       if (is_dir($path . '/' .$entry))
	    {
            $dirs[] =$entry; 
        }
    }
}

 foreach($dirs as $sku)
 {
		    $importDir = '/home/uniterrene2015/public_html/dev/mylingeriexo/import/'.$sku;
			
			if (is_dir($importDir))
			{
				  if ($dh = opendir($importDir)){
					while (($file = readdir($dh)) !== false)
					{
					  		 $image=$file ;//image file name
					 		 $media = Mage::getModel('catalog/product_attribute_media_api'); 
 			
							 $product = Mage::getModel('catalog/product');
				 
							 $id = Mage::getModel('catalog/product')->getResource()->getIdBySku($sku);
							 echo "<br>".$id ;
							 $ourProduct = $product->load($id);
							 
							$fileName = $image;
							$path = Mage::getBaseDir().DS;
							
							$path_new = $path.'media/';
							$filePath = $path_new.$fileName;
							 echo "<pre>".$filePath;	
                           
         // $ourProduct->addImageToMediaGallery($filePath, array('image', 'small_image', 'thumbnail'), false, false);

        //$ourProduct->save();
        echo "done ";
         
				

					}
					closedir($dh);
				  }
			}

			
             
           
		
 }// end of for eACH SKU
		 
exit();
die();

/*$importDir = 'http://127.0.0.1/ramya/magento/media/';
*/
$productsData = array('SG-4860-back.jpg');
$media = Mage::getModel('catalog/product_attribute_media_api'); 
$k=0;
foreach($productsData as $fileName){
    $k++;
    $productSKU = 'DR-058-S2';
   $product = Mage::getModel('catalog/product');
 $id = Mage::getModel('catalog/product')->getResource()->getIdBySku('DR-058-S2');

$ourProduct = $product->load($id);
$fileName = "SG-4860-back.jpg";

$path = Mage::getBaseDir().DS;

$path_new = $path.'media/import/';
     echo $filePath = $path_new.$fileName;
    
        echo $filePath;

            $ourProduct->addImageToMediaGallery($filePath, array('image', 'small_image', 'thumbnail'), false, false);

        //$ourProduct->save();
        echo "done ";
    
}
$sk = 'DR-058-S2';
$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sk);
 if ($product->getId() > 0)
    {
		echo $product->getId().'<br>';
		echo $count;
		$count++;
		
	      
     // $positn=1;
      
      
   
      
	  $newImage = array(
            'file' => array(
                'content' => base64_encode($filePath),
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
		
		$media->create($sk, $newImage);         
	      
	   //} //if condition for test
    }


 ?>