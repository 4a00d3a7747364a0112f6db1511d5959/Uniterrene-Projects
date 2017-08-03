<?php
class Stackexchange_Magento52274_Model_Observer
{

     public function AssignNewletter(Varien_Event_Observer $observer) {
		 
		$isSubscribe = Mage::app()->getRequest()->getParam('is_subscribed');
            $event = $observer->getEvent();
            $order = $event->getOrder();
        $Quote =$event->getQuote();
        
      

        if (Mage::app()->getFrontController()->getRequest()->getParam('is_subscribed')){
        $status = Mage::getModel('newsletter/subscriber')->subscribe($Quote->getBillingAddress()->getEmail());
        
       }
   }

}
