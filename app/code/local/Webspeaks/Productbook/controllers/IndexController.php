<?php
class Webspeaks_Productbook_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		echo $this->getLayout()->createBlock('productbook/productbook')->setTemplate('productbook/productbook.phtml')->toHtml();  
    }
	
    /**
     * Add items to cart
     */
	public function addtocartAction()
	{
		$block = 'Webspeaks_Productbook_Block_Productbook';
		try{
			$result = array();
			$productId = (int) $this->getRequest()->getParam('product');
			$qty = (int) $this->getRequest()->getParam('qty');
			if (!$productId) {
				$result['status'] = 'error';
				$result['message'] =  'Invalid product.';
				echo json_encode($result);
				exit;
			}
		 
			$product = Mage::getSingleton('catalog/product')->load($productId);
			$res = $block::addToCart($product, $qty);
			echo json_encode($res);
		} catch (Exception $e) {
			$result['status'] = 'error';
			$result['message'] =  $e->getMessage();
			echo json_encode($result);
		}
	}
}