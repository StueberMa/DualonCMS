<?php
	$this->Helpers->load('Js');

	echo '<div id="web_shop_content">';

	echo $this->element('SearchBar');
	
	if (isset($data)) {
		foreach ($data as $product){
			echo '<div>';
			echo $this->Js->link(
				$this->Html->image('/WebShop/img/'.$product['Products']['picture'], array('style' => "float: left", "width" => "200px")),
				array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Products']['id']), array('update' => '#web_shop_content', 'escape' => False)
			);
			
			echo $this->Js->link($product['Products']['name'], array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $product['Products']['id']), array('update' => '#web_shop_content'));
			
			echo '<p>'.$product['Products']['price'];
			echo ' '.$product['Products']['currency'].'</p>';
			echo $this->element('ShortText', array( 'text' => $product['Products']['description'], 'productID' => $product['Products']['id']));
			echo '</div>';
			echo '<br style="clear:left">';
		}
	}
	
	echo '</div>';
?>