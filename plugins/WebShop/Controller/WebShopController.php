<?php

class WebShopController extends AppController {
	
	var $helpers = array('Js' => array('Jquery'), 'Html');
	var $components = array('RequestHandler');
	var $autoRender = false;
	
	
	function search(){
		if (!empty($this->data)) {
			$this->loadModel('Product');
			
			$params = array('conditions' => array('MATCH(Product.name,Product.description) AGAINST("'.$this->data['Search']['Suche'].'" IN BOOLEAN MODE)'));
    		$this->set('products', $this->Product->find('all', $params));
    		
    		$this->render('search');
		}
	}
	
	function view($id=null) {
		$this->loadModel('Product');
		
		$product = $this->Product->findById($id);
		$this->set('product', $product);
		
		$this->render('view');
	}
	
	function cart() {
		$productIDs = $this->Session->read('products');
		
		$this->loadModel('Product');
		$products = array();
		foreach ($productIDs as $productID) {
			$product = $this->Product->findById($productID['id'], array('fields' => 'Product.name'));
			$product['count'] = $productID['count'];
			array_push($products, $product);
		}
		$this->set('products', $products);
		
		$this->render('cart');
	}
	
	function add($id=null) {
		$productIDs = $this->Session->read('products');
		$positon = array();
		$results = false;

		//CHECK existing products in cart
		for($i = 0; $i <= $productIDs; $i++){
			if ($productIDs[$i]['id'] == $id){
				$productIDs[$i]['count'] = $productIDs[$i]['count'] + 1;
				$results = true;
				break;
			}
		}
		
		//ADD if new
		if(!$results){
			$positon['id'] = $id;
			$positon['count'] = 1;
			
			if ($productIDs == null) {
				$productIDs[0] = $positon;
			} else {	
				array_push($productIDs, $positon);
			}
		}
			

		$this->Session->write('products', $productIDs);
		$this->redirect(array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $id));
	}

	public function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}

