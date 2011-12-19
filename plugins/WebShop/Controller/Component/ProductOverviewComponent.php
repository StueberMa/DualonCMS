<?php

class ProductOverviewComponent extends Component {
	
	
	public function getData($controller, $params)
	{
		$controller->loadModel("Products");
		$products = $controller->Products->find('all', array('limit'=>$params['NumberOfEntries'],'order' => array('created' => 'desc')));
		if ($products != null) {
			return $products;
		} else {
			return __('no products');
		}
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Actions which don't require authorization
		$this->Auth->allow('*');
	}
	
}