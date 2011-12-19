<?php
	echo $this->element('SearchBar');

	$this->Helpers->load('Js');
	
	foreach ($products as $product){
		echo '<div>';
		echo $this->Html->image('/WebShop/img/'.$product['Product']['picture'], array('style' => "float: left", "width" => "200px"));
		echo '<h2>';
		
		//echo $this->Html->link($product['Product']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Product']['id']));
		echo $this->Js->link($product['Product']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Product']['id']), array('update' => '#web_shop_content'));
		
		echo '</h2>';
		echo '<p>'.$product['Product']['price'];
		echo ' '.$product['Product']['currency'].'</p>';
		echo $this->element('ShortText', array( 'text' => $product['Product']['description'], 'productID' => $product['Product']['id']));
		echo '</div>';
		echo '<br style="clear:left">';
	}
?>