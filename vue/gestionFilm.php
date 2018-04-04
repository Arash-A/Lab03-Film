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
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
		<script src="../js/jquery.youtubepopup.min.js"></script>
		<script src="../js/film.js"></script>
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
			
			
			<div id="gestionFilm" class="col-md-10 show">
				<div class="col-md-10 center">
					<h3><a href="generationFilm.php?id=0"><span class="glyphicon glyphicon-plus-sign">Nouveau</span></a></h3>
					<table class="table table-striped table-hover table-users">
						<thead>
							<tr>   					
								<th>ID</th>
								<th>Titre</th>
								<th>Réalisateur</th>
								<th>Catégorie</th>
								<th>Durée</th>
								<th>Prix</th>
								<th>Pochette</th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<?php							
								require_once("../dal/requetteFilm.php");	
								require_once("../model/film.php");
								require_once("../BD/param.php");
								require("../BD/connexion.inc.php");
								
								if (isset($_GET['id'])) {
									$id = $_GET['id'];
								}else {
									$id = 0;
								}

								if ($id!=0) {
									supprimerParId($id);
									require("../BD/connexion.inc.php");
								}
								
								$film = lireTous();
							    //var_dump($film);
								for($i=0; $i<sizeof($film); $i++) {
									$p = $i+1;
								   echo "<tr ><td>".$p."</td>";
								   echo "<td>".$film[$i][1]."</td>";
								   echo "<td>".$film[$i][2]."</td>";
						           echo "<td>".$film[$i][3]."</td>";
								   echo "<td>".$film[$i][4]."</td>";
								   echo "<td>".$film[$i][5]."</td>";
								   echo "<td><img src='../images/".$film[$i][6]."' width=30 height=40></td>";
								   
								   echo "<td><a class='youtube glyphicon glyphicon-facetime-video' href='".$film[$i][7]."' title='voir la bande-annonce'></a></td>";
								   //echo "<td><a class='btn mini blue-stripe modifier' href='generationFilm.php?id=".$film[$i][0]."'>Modifier</a></td>";
								   echo "<td><a class='glyphicon glyphicon-pencil' href='generationFilm.php?id=".$film[$i][0]."' title='modifier'></a></td>";
								   //echo "<td><a class='btn mini blue-stripe supprimer' href='gestionFilm.php?id=".$film[$i][0]."'>Suppimer</a></td>";
								   echo "<td><a class='glyphicon glyphicon-trash' href='gestionFilm.php?id=".$film[$i][0]."' title='supprimer'></a></td>";								   
								   
								   //if($film[$i][8]==1) {
									//   echo "<td><a class='btn mini blue-stripe'><span style='color:black'>Publié</span></a></td></tr>";
								   //} else {
								   //    echo "<td><a class='btn mini blue-stripe publier' href='../gestionFilm/publierFilm.php?id=".$film[$i][0]."'>Publier</a></td></tr>";
								   //}
								   
								   if($film[$i][8]==1) {
									   echo "<td><a class='glyphicon glyphicon-eye-open' href='../gestionFilm/publierFilm.php?id=".$film[$i][0]."&publier=".$film[$i][8]."' title='cacher ce film'></a></td></tr>";
								   } else {
								       echo "<td><a class='glyphicon glyphicon-eye-close' href='../gestionFilm/publierFilm.php?id=".$film[$i][0]."&publier=".$film[$i][8]."' title='publier ce film'></a></td></tr>";
								   }
								}
							?>
							
						</thead>
						<tbody id="tb"></tbody>
					</table>
				</div>
			</div>					
				<h4><a href="../index.php" id="myBtn2" ><span class="glyphicon glyphicon-circle-arrow-left">Retour</span></a></h4>
	        <footer id="footer" class="copyright  col-md-12">
			      <p>© 2018 - Maisonneuve</p>
	        </footer> 
		</div>		
	</body>
		<script type="text/javascript">
			$(function () {
				$("a.youtube").YouTubePopup({ autoplay: 1 });
			});
		</script>
</html>