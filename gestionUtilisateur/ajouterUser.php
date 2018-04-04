<?php
	require_once("../dal/requetteUtilisateur.php");
	require_once("../model/utilisateur.php");
//	if (isset($_POST['nomInscri'])) {
		$nom=$_POST['nomInscri'];
//	}
	if (isset($_POST['prenomInscri'])) {
		$prenom=$_POST['prenomInscri'];
	}
	if (isset($_POST['adresseInscri'])) {
		$adresse=$_POST['adresseInscri'];
	}
	if (isset($_POST['courrielInscri'])) {
		$courriel=$_POST['courrielInscri'];
	}
	if (isset($_POST['motdepasseInscri'])) {
		$mdp=$_POST['motdepasseInscri'];
	}

	$user = new Utilisateur(0, $nom, $prenom, $courriel, $mdp, $adresse, 1);

	$aa = enregistre($user);
		
	echo "$aa";
	

	


?>