<!-- Web-Shop product detail view -->
<?php 
	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//CREATE product details
	echo '<h1>'.$product['Product']['name'].'</h1>';
	echo $this->Html->image('/WebShop/img/'.$product['Product']['picture'], array('style' => "float: left", "width" => "400px"));
	echo $product['Product']['description'];
	echo $this->Html->image('/WebShop/img/Cart-Add-32.png', array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'add', $product['Product']['id'])));
?>