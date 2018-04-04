<?php

function enregistre($user) {
	require_once("../BD/connexion.inc.php");
	$hash = password_hash($user->getMdp(), PASSWORD_DEFAULT);	
	
	$requette="INSERT INTO users VALUES(0,?,?,?,?,?, ?)";
	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($user->getNom(),$user->getPreom(),$user->getCourriel(),$hash,$user->getAdresse(),$user->getRole()));
	$lastId = $connexion->lastInsertId();
	unset($connexion);
	unset($stmt);
	
	return "Utilisateur ".$lastId." bien enregistre";
}

function lireTous() {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT * FROM users";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->nom, $ligne->prenom, $ligne->courriel, $ligne->adresse, $ligne->role];
		 }
	 }catch (Exception $e){
		echo "Probleme pour lire tous les films";
	 }finally {
		unset($connexion);
		unset($stmt);
		return $array;
	 }
}

function rechercheParId($id) {
	require_once("../BD/connexion.inc.php");
	$requette="SELECT * FROM bdfilms where id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	$film = new Film($ligne->id,$ligne->titre, $ligne->realisateur, $ligne->categorie, $ligne->duree, $ligne->prix, $ligne->pochette);

	unset($connexion);
	unset($stmt);
	return json_encode($film);
}

function updateParId($user) {
	require_once("../BD/connexion.inc.php");
	$requette="UPDATE users set nom=?,prenom=?,courriel=?,adresse=?, WHERE id=?";;

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($user->getNom(),$user->getPreom(),$user->getCourriel(),$user->getAdresse(), $id));

	unset($connexion);
	unset($stmt);
}

function supprimerParId($id) {
	require_once("../BD/connexion.inc.php");
	$requette="DELETE FROM users WHERE id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));

	unset($connexion);
	unset($stmt);
}

function authentification($courriel, $mdp) {
	require_once("../BD/connexion.inc.php");
	$requette="SELECT mdp, role FROM users where courriel=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($courriel));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	$hash = $ligne->mdp;
	$role = $ligne->role;
    $reussite = password_verify($mdp, $hash);

	unset($connexion);
	unset($stmt);
	if ($reussite) {
		$array = array(true, $courriel, $role);
		return $array;
	} else {
		$array = array(false);
		return $array;
	}
}

?>