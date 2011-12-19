<!-- Web-Shop Shopping Cart View -->
<?php
	//INTEGRATE searchbar
	echo $this->element('SearchBar');
	
	//CREATE cart
	echo '<h1>Einkaufswagen</h1>';
	echo '<table style="width:100%">';
	echo '<tr>';
	echo '<th colspan="2">Artikel</th><th>Preis</th><th colspan="2">Menge</th>';
	echo '</tr>';
	
	//GET all products
	foreach ((!isset($products)) ? array() : $products as $product){
		echo '<tr>';
		echo '<td>'.$this->Html->image('/WebShop/img/'.$product['Product']['picture'], array('style' => "float: left", "width" => "100px")).'</td>';
		echo '<td>'.$this->Html->link($product['Product']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Product']['id'])).'</td>';
		echo '<td>'.$product['Product']['price'].'</td>';
		echo '<td>'.$product['count'].'</td>';
		echo '<td>'.$this->Html->image('/WebShop/img/Add.png', array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'add', $product['Product']['id']), 'style' => "float: left", "width" => "20px")).$this->Html->image('/WebShop/img/Minus.png',array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'remove', $product['Product']['id']), 'style' => "float: left", "width" => "20px")).'</td>';
		echo '</tr>';
	}
	
	//WRITE info if no products in cart
	if(isset($products)){
		echo '<tr>';
		echo '<td colspan="5">Keine Elemente in Ihrem Einkaufswagen.</td>';
		echo '</tr>';
	}
	
	
	echo '</table>';