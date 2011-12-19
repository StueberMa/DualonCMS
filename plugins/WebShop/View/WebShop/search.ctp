<!-- Web-Shop Search View -->
<?php
	//LOAD js
	$this->Helpers->load('Js');	

	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//TITLE
	echo '<h2>Suchergebnisse</h2>';
	
	//CREATE search results
	echo '<div id="results">';
	echo count($products).' Suchergebniss(e)';
	echo '</div>';
	
	//CREATE serch catalog
	echo '<ol>';
	foreach ((isset($products)) ? : $products as $product){
		echo '<li>';
		echo $this->Html->image('/WebShop/img/'.$product['Product']['picture'], array('style' => "float: left", "width" => "200px"));
		
		echo '<h2>';
		//echo $this->Html->link($product['Product']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Product']['id']));
		echo $this->Js->link($product['Product']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Product']['id']), array('update' => '#web_shop_content'));
		echo '</h2>';
		
		echo '<p>'.$product['Product']['price'];
		echo ' '.$product['Product']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $product['Product']['description'], 'productID' => $product['Product']['id']));
		echo '<br style="clear:left">';
		echo '</li>';
	}
	echo '</ol>';
	
	//Paginator
	echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
	echo $this->Paginator->numbers(array('first' => 2, 'last' => 2));
	echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
	echo $this->Paginator->counter();
?>