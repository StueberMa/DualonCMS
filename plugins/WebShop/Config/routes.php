<?php
	Router::connect('/:plugin/:action/*', array('plugin' => 'WebShop', 'controller' => 'WebShopController'));