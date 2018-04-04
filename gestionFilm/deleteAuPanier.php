<?php							
								
	$id=$_GET['id'];					
    
	if (isset($_COOKIE['id_list'])) {							
		$id_string = $_COOKIE['id_list'];							
		$film = unserialize($id_string);							
	} 

	for($i=0; $i<sizeof($film); $i++) {
		if ($film[$i][0]==$id) {
			unset($film[$i]);
		}
	}
	
	$film = array_values($film);
	$id_array = serialize($film);
	setcookie('id_list', $id_array, time()+36000, '/');
	
	header("Location: ../vue/panier.php");


?>	