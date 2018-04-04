<?php

function enregistre($film) {
	global $connexion;		
	$requette="INSERT INTO tabfilms VALUES(0,?,?,?,?,?,?,?,?)";
	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($film->getTitre(),$film->getRealisateur(),$film->getCategorie(),$film->getDuree(),$film->getPrix(),$film->getPochette(), $film->getVideo_link(), $film->getPublier()));
	$lastId = $connexion->lastInsertId();
	unset($connexion);
	unset($stmt);
	
	return "Film ".$lastId." bien enregistre";
}

function lireTous() {
	global $connexion;
	$array = array();
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette, t.video_link, t.publier FROM tabfilms t, categorie c where t.categorie=c.id";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette, $ligne->video_link, $ligne->publier];
		 $a=$ligne->titre;
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
	global $connexion;
	$array = array();
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette, t.video_link, t.publier FROM tabfilms t, categorie c where t.categorie=c.id and t.categorie=?";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute(array($categorieId));
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette, $ligne->video_link, $ligne->publier];
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
	global $connexion;
	$requette="SELECT * FROM tabfilms where id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	$film = [$ligne->id,$ligne->titre, $ligne->realisateur, $ligne->categorie, $ligne->duree, $ligne->prix, $ligne->pochette, $ligne->video_link, $ligne->publier];
	unset($connexion);
	unset($stmt);
	return $film;
}

function update($film) {
	global $connexion;
	$requette="UPDATE tabfilms set titre=?,realisateur=?,categorie=?,duree=?,prix=?,pochette=?,video_link=?,publier=? WHERE id=?";;

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($film->getTitre(),$film->getRealisateur(),$film->getCategorie(),$film->getDuree(),$film->getPrix(),$film->getPochette(),$film->getVideo_link(),$film->getPublier(), $film->getId()));

	unset($connexion);
	unset($stmt);
	
	return "<br><b>LE FILM : ".$film->getId()." A ETE MODIFIE</b>";
}

function publier($id, $val) {
	global $connexion;
	$requette="UPDATE tabfilms set publier=? WHERE id=?";;

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($val,$id));

	unset($connexion);
	unset($stmt);
	
	return "<br><b>LE FILM : ".$id." A ETE PUBLIE</b>";
}
function supprimerParId($id) {
	global $connexion;
	$requette="DELETE FROM tabfilms WHERE id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));

	unset($connexion);
	unset($stmt);
	return "<br><b>LE FILM : ".$id." A ETE SUPPRIMEE</b>";
}

function lireCategorie() {
	global $connexion;
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

function insererCategorie($categorie) {
	global $connexion;
	$array = array();
	$requette="INSERT INTO categorie VALUES(0, ?)";
	
	$stmt = $connexion->prepare($requette);	
	$stmt->execute(array($categorie));	
    
	unset($connexion);	
	unset($stmt);	
	return "Catégorie ".$lastId." bien enregistre";	

}

?>