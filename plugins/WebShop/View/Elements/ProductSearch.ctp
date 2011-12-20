<div id="websop_searchbar" style="width:100%">
	<form name="websop_search" action="" method="post">
    	<input type="text" name="webshop_search_data" />
        <input value="Los" type="submit" name="search"/>
    </form>
    
    <img src="images/cart.png" />
</div>

<?php
	
	$max_prod = 10;
	$prod_count = sizeof($data);
	$pages = ceil($prod_count / $max_prod);
	
	//GET current page
	if(isset($_GET['page'])){
		$cur_page = $_GET['page'];
	}else {
		$cur_page = 1;
	}
	
	 $prod_end = $cur_page * $max_prod - 1;
	 $prod_start =  $prod_end - $max_prod;
	 
	 //print("<pre>");
	 //print_r($data);die;
	
	//CREATE html-code for porduct range
	for($i = $prod_start; $i < $prod_end && $prod_count < $i; $i++){		
		echo '<img src="'.$data[$i]['Products']['picture'].'" style="float: left" />';
		echo '<div>';
		echo '<h2>'.$data[$i]['Products']['name'].'</h2>';
		echo '<p>'.$data[$i]['Products']['description'].'</p>';
		echo '</div>';
	}
	
	//CREATE footer
	if ($prod_count > $max_prod) {
		
		echo '<div id="websop_footer" style="width:100%">';
		
		//Zurück button
		if($cur_page != 1){
			echo '<a href="">Zurück</a>  ';
		}
		
		//Pages
		for($i = 1; $i <= $pages; $i++){
			echo '<a href="">'.$i.'</a>  ';
		}
		
		//Weiter button
		if($cur_page == $pages){
			echo '<a href="">Weiter</a>';
		}
		
		echo '</div>';
		
	}
?>