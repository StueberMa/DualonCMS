<?php
/**
 * 
 * Component for ProductOverview.
 * 
 * @author Patrick Zamzow
 * @version 20.12.2011
 *
 */
class ProductOverviewComponent extends Component {
	
	/**
	 * Method to transfer data from plugin to CMS.
	 */
	public function getData($controller, $params)
	{
		//LOAD model
		$controller->loadModel("Products");
		
		//GET newest products
		$products = $controller->Products->find('all', array('limit'=>$params['NumberOfEntries'],'order' => array('created' => 'desc')));
		
		//RETURN
		if ($products != null) {
			return $products;
		} else {
			return __('no products');
		}
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