<?php
	$word_limit = 30;
	$txt_cnt = str_word_count($text);
	$short_text = '';
	
	if ($txt_cnt <= $word_limit){
		echo '<p>'.$text.'</p>';
	}else{
		$words = split(' ', $text);
	
		for($i = 0; $i < $word_limit; $i++){
			$short_text = $short_text.$words[$i].' ';
		}
		
		echo '<p>'.$short_text.'... ';
		echo $this->Js->link('mehr', array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'view', $productID), array('update' => '#web_shop_content'));
		echo '</p>';
	}
