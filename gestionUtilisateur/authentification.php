<?php
	require_once("../dal/requetteUtilisateur.php");
	require_once("../model/utilisateur.php");
	if (isset($_POST['courrielLogin'])) {
		$courriel=$_POST['courrielLogin'];
	}
	if (isset($_POST['motdepasseLogin'])) {
		$mdp=$_POST['motdepasseLogin'];
	}

	//echo "$courriel";
	$user = authentification($courriel, $mdp);

	//$aa = enregistre($user);
		
	echo JSON_Encode($user);
	

	


?>