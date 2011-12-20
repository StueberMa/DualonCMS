<?php
/**
 * WebShop App-Controller.
 *
 * @author Maximilian Stueber and Patrick Zamzow
 */
class WebShopController extends AppController {
	
	//Attributes
	var $helpers = array('Js' => array('Jquery'), 'Html');
	var $components = array('RequestHandler');
	var $autoRender = false;
	
	//Paginating
	public $paginate = array(
		        'limit' => 10,
		        'order' => array(
		        'Product.id' => 'asc'
    )
	);
	
	
   /**
	* Create new products.
	*/
	function create(){
		
		//LOAD model
		$this->loadModel('Product');
	
		/* file */
		$file = $this->request->data['Document']['submittedfile'];
		$file_path = "";
		$file_name = str_replace(' ', '_', $file['name']);
		$upload_error = false;
			
		//CHECK filetype
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
			
		foreach($permitted as $type) {
			if($type == $file['type']) {
				$upload_error = true;
				break;
			}
		}
	
		//CHECK filename
		if(file_exists($file_path.'/'.$file_name)) {
			//GET time
			ini_set('date.timezone', 'Europe/London');
			$now = date('Y-m-d-His');
	
			//NEW file-name
			$file_name = $file_name.$now;
		}
			
		//MOVE file
		if(!$upload_error){
			move_uploaded_file($file['tmp_name'], $file_path.$file_name);
		}
	
		//SAVE on db
		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash('Your post has been saved.');
					
				/*##### CHANGE ########*/
				$products = $this->Product->find('all');
				$this->redirect(array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $products[sizeof($products) - 1]['Product']['id']));
			}
		}
	}
	
	
   /**
	* Product-Search.
	*/
	function search(){
		if (!empty($this->data)) {
			//LOAD model
			$this->loadModel('Product');
			
			//SEARCH for products using MySQL fulltext search
			$params = array('conditions' => array('MATCH(Product.name,Product.description) AGAINST("'.$this->data['Search']['Suche'].'" IN BOOLEAN MODE)'));
    		
			//SET results for view
			$data = $this->paginate('Product');
			$this->set('products', $this->Product->find('all', $params));
    		
    		$this->render('search');
		}
	}

   /**
	* Dislays product details.
	*/
	function view($id=null) {
		//LOAD model
		$this->loadModel('Product');
		
		//find req. product
		$product = $this->Product->findById($id);
		
		//SET results for view
		$this->set('product', $product);
		
		$this->render('view');
	}
	
	
   /**
	* Displays all the products of shopping cart.
	*/
	function cart() {
		//LOAD model
		$this->loadModel('Product');
		
		//GET all IDs (+ amount) from session
		$productIDs = $this->Session->read('products');
		
		$products = array();
		
		//COLLECT data
		foreach ((!isset($products)) ? array() : $productIDs as $productID) {
			$product = $this->Product->findById($productID['id'], array('fields' => 'Product.id, Product.name, Product.price, Product.picture'));
			$product['count'] = $productID['count'];
			array_push($products, $product);
		}
		
		//SET results
		$this->set('products', $products);
		
		$this->render('cart');
	}
	
   /**
	* Adds product to shopping cart.
	*/
	function add($id=null) {
		
		//Attributes
		$productID = array();
		$results = false;
		
		//GET all IDs (+ amount) from session
		$productIDs = $this->Session->read('products');
		
		//CHECK existing products in cart
		for($i = 0; $i < count($productIDs); $i++){
			if ($productIDs[$i]['id'] == $id){
				$productIDs[$i]['count'] = $productIDs[$i]['count'] + 1;
				$results = true;
				break;
			}
		}
		
		//ADD if new
		if(!$results){
			$productID['id'] = $id;
			$productID['count'] = 1;
		
			if ($productIDs == null) {
				$productIDs[0] = $productID;
			} else {
				array_push($productIDs, $productID);
			}
		}
		
		//WRITE to SESSION
		$this->Session->write('products', $productIDs);
		
		//REDIRECT to product page
		$this->redirect(array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $id));
	}
	
   /**
	* Removes product from shopping cart.
	*/
	function remove($id=null) {
		//GET all IDs (+ amount) from session
		$productIDs = $this->Session->read('products');
	
		//REMOVE prod. from cart
		for($i = 0; $i < count($productIDs); $i++){
			if ($productIDs[$i]['id'] == $id){
				$productIDs[$i]['count'] = $productIDs[$i]['count'] - 1;
				break;
			}
		}
	
		//WRITE to SESSION
		$this->Session->write('products', $productIDs);
	
		//REDIRECT to product page
		$this->redirect(array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $id));
	
	}
	
	
   /**
	* BeforeFilter.
	*/
	public function beforeFilter() {
		parent::beforeFilter();
	
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
}