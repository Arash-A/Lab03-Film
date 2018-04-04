<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Filmania</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrapValidator.css">
		<link rel="stylesheet" type="text/css" href="../css/films.css">
		<script src="../js/jquery-1.10.2.min.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../js/jquery.validate.js"></script>
		<script src="../js/film.js"></script>
		<script src="../js/mustache.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script>
		function annonce(){
			alert("votre liste de film va être mise à jour, SVP cliquez sur [publié] dans la liste de gestion pour mettre ce film en mode publié");
		}
		</script>
	</head>
	<body>
		<!-- ============================================== HEADER ============================================== -->	
			<?php
			include('headerVue.php');
			?>

	 <!------------------------------MENU-------------------------------->
		<div id="container" class="container"> 
			
			<div  id="nouveauFilm" class="show"> 
						 <?php
						    if (isset($_GET['id'])) {
								$id = $_GET['id'];
							}else {
								$id = 0;
							}
							require_once("../dal/requetteFilm.php");	
							require_once("../model/film.php");
							require_once("../BD/param.php");
							
							$film = array();
							if ($id==0) {
								$film = null;
								$titre = "Nouveau Film";
							} else {
								require("../BD/connexion.inc.php");
								$film = rechercheParId($id);
								$titre = "Modifier Film";								
							}
						?>
				<form id="nouveauF" action="../gestionFilm/ajouterFilm.php" method="POST"  enctype="multipart/form-data" onsubmit="annonce();">
					<fieldset>
							<legend id="titre_nouveau" class='show'><?php echo"$titre";?></legend>
				  <div class="form-group">
					<label for="titre">Titre</label>
					<input type="text" class="form-control" id="titre" name="titre" value="<?php echo"$film[1]"?>" aria-describedby="emailHelp" placeholder="titre du film" required>
				  </div>
				  <div class="form-group">
					<label for="realisateur">Réalisateur</label>
					<input type="text" class="form-control" id="realisateur" name="realisateur" value="<?php echo"$film[2]"?>" placeholder="réalisateur du film" required>
				  </div>
				  <div class="form-group">
					<label for="categorie">Catégorie</label><br/>
					<select id="categorie" name="categorie">
					    <?php
							require("../BD/connexion.inc.php");
							$categorie = lireCategorie();
							
							for($i=0; $i<sizeof($categorie); $i++) {	
								$p=$i+1;
								if ($p==$film[3]) {
									echo "<option selected='selected' value='$p'>$categorie[$i]</option>"; 
								} else {
									echo "<option value='$p'>$categorie[$i]</option>"; 
								}
							}								
						?>
					</select><br/><br/>
					<p>Trouve pas une bonne categorie?<a href='generationCategorie.php?id=<?php echo"$id"?>'>ajouter une nouvelle catégorie</a></p>
				  </div>
				  <div class="form-group">
					<label for="duree">Durée</label>
					<input type="text" class="form-control" id="duree" name="duree" value="<?php echo"$film[4]"?>" placeholder="durée du film" required>
				  </div>
				  <div class="form-group">
					<label for="prix">Prix</label>
					<input type="text" class="form-control" id="prix" name="prix" value="<?php echo"$film[5]"?>" placeholder="prix du film" required>
				  </div>
				  <div class="form-group">
					<label for="pochette">Pochette</label>
					<input type="file" class="form-control" id="pochette" name="pochette" value="<?php echo"$film[6]"?>" placeholder="téléverser une pochette">
				  </div>
				  <div class="form-group">
					<label for="prix">Vidéo hyperlien</label>
					<input type="text" class="form-control" id="video" name="video" value="<?php echo"$film[7]"?>" placeholder="http://..." required>
				  </div>
				  <input type="hidden" id="idd" name="idd" value="<?php echo"$id"?>">
				  <button type="submit" id="btnNouveauFilm" class="btn btn-primary">Submit</button>
				  <button type="button" id="btnCancelFilm" class="btn btn-primary" onClick="document.location.href='gestionFilm.php'">Annulé</button>
				  </fieldset>
				</form>	
			</div>
			
				
	        <footer id="footer" class="copyright  col-md-12">
			      <p>© 2018 - Maisonneuve</p>
	        </footer> 
		</div>		
	</body>
</html>