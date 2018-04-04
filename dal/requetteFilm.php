<?php

function enregistre($film) {
	require_once("../BD/connexion.inc.php");		
	$requette="INSERT INTO tabfilms VALUES(0,?,?,?,?,?,?,?,?)";
	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($film->getTitre(),$film->getRealisateur(),$film->getCategorie(),$film->getDuree(),$film->getPrix(),$film->getPochette(), $film->getVideo_link(), $film->getPublier()));
	$lastId = $connexion->lastInsertId();
	unset($connexion);
	unset($stmt);
	
	return "Film ".$lastId." bien enregistre";
}

function lireTous() {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette FROM tabfilms t, categorie c where t.categorie=c.id";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette];
		 }
	 }catch (Exception $e){
		echo "Probleme pour lire tous les films";
	 }finally {
		unset($connexion);
		unset($stmt);
		return $array;
	 }
}

function lireParCategorie($categorieId) {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette FROM tabfilms t, categorie c where t.categorie=c.id and t.categorie=?";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute(array($categorieId));
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette];
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
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette FROM tabfilms t, categorie c where t.categorie=c.id and t.id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	$film = [$ligne->id,$ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette];
	unset($connexion);
	unset($stmt);
	return $film;
}

function update($film) {
	require_once("../BD/connexion.inc.php");
	$requette="UPDATE tabfilms set titre=?,realisateur=?,categorie=?,duree=?,prix=?,pochette=? WHERE id=?";;

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($film->getTitre(),$film->getRealisateur(),$film->getCategorie(),$film->getDuree(),$film->getPrix(),$film->getPochette(),$film->getId()));

	unset($connexion);
	unset($stmt);
	
	return "<br><b>LE FILM : ".$film->getId()." A ETE MODIFIE</b>";
}

function supprimerParId($id) {
	require_once("../BD/connexion.inc.php");
	$requette="DELETE FROM tabfilms WHERE id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));

	unset($connexion);
	unset($stmt);
	return "<br><b>LE FILM : ".$id." A ETE SUPPRIMEE</b>";
}

function lireCategorie() {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT * FROM categorie";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = $ligne->nom;
		 }
	 }catch (Exception $e){
		echo "Probleme pour lire tous les catéories";
	 }finally {
		unset($connexion);
		unset($stmt);
		return $array;
	 }
}

?>