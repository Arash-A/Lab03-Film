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
	</head>
	<body>
		
		<!-- ============================================== HEADER ============================================== -->	
			<?php
			include('headerVue.php');
			?>

	 <!------------------------------MENU-------------------------------->	
			<div id="container" class="container"> 
			
			<div id="gestion" class="col-md-2 show">
				<h4>Gestion</h4>
				  <ul class="nav nav-pills nav-stacked">
					<li id="liGestionFilm" class="active"><a class="menuGestionFilm" href="gestionFilm.php">Gestion de film</a></li>
				  </ul>
	        </div>
			
	        <div id="main" class="col-md-10 hide">
				<div class="hide" id="templateCard"></div>
	        </div>
				<?php
				    if (isset($_GET['id'])) {		
						$id = $_GET['id'];		
					}else {		
						$id = 0;		
					}		
				?>		
			<div  id="nouveauCategorie" class="show"> 
				<form id="nouveauC" action="../gestionFilm/ajouterCategorie.php" method="POST">
					<fieldset>
							<legend class='show'>Nouvelle Catégorie</legend>
				  <div class="form-group">
					<label for="categorie">Nom de Catégorie</label>
					<input type="text" class="form-control" id="categorie" name="categorie" placeholder="nom de catégorie">
				  </div>
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo"$id"?>" placeholder="nom de catégorie">
				  <button type="submit" id="btnNouveauFilm" class="btn btn-primary">Submit</button>
				  <button type="button" id="btnCancelFilm" class="btn btn-primary" onClick="document.location.href='generationFilm.php?id=<?php echo"$id"?>'">Annulé</button>

				  </fieldset>
				</form>	
			</div>
					
	        <footer id="footer" class="copyright  col-md-12">
			      <p>© 2018 - Maisonneuve</p>
	        </footer> 
		</div>		
	</body>
</html>