<!-- Web-Shop Searchbar -->
<div id="websop_searchbar" style="width:100%">   
    <?php    
    	//LOAD js
    	$this->Helpers->load('Js');
    	
    	//CREATE search-fields
    	echo '<div id="webshop_search" style="float:left">';
	    echo $this->Form->create('Search');
	    echo $this->Form->input('Suche', array('div' => false));
	   // echo $this->Form->submit('Los', array(
	   // 	    	'div' => false
	   // ));
	    echo $this->Js->submit('Los', 
	    array(
	    	'url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'search'),
	    	'div' => false,
	    	'update' => '#web_shop_content'
	    ));
	    echo $this->Form->end();
	    echo '</div>';
		
	    //CREATE shopping cart
	    echo '<div id="webshop_cart" style="float:right">';
	    //echo $this->Html->image('/WebShop/img/Cart-32.png', array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'cart')));
	    echo $this->Js->link(
	    	$this->Html->image('/WebShop/img/Cart-32.png'),
	    	array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'cart'), array('update' => '#web_shop_content', 'escape' => False)
	    );
   		echo '</div>';
   		
   		//CLEAR floating
   		echo '<div style="clear:both"></div>';
    ?>
</div>