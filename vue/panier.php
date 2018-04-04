<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Film Pour Tous</title>
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
		<div id="container" class="container"> 
			
		<!-- ============================================== HEADER ============================================== -->	
			<?php
			include('headerVue.php');
			?>

		<!------------------------------MENU-------------------------------->
			
			
			
			<div id="panier" class="col-md-10 show">
				<div class="col-md-10 center"><br/>
				<h4><a href="../index.php" id="myBtn2" ><span class="glyphicon glyphicon-circle-arrow-left">Retour</span></a></h4>
				
				<h2>Votre Panier</h2><br/><br/>
					<table class="table table-striped table-hover table-users">
						<thead>
							<tr>   					
								<!--th>ID</th-->
								<th>Titre</th>
								<th>Réalisateur</th>
								<th>Catégorie</th>
								<th>Pochette</th>
								<th>Nombre</th>
								<th>Prix</th>								
								<th></th>
							</tr>
							<?php							
								require_once("../dal/requetteFilm.php");	
								require_once("../model/film.php");
								require_once("../BD/param.php");
								require("../BD/connexion.inc.php");

								if (isset($_COOKIE['id_list'])) {
									$id_string = $_COOKIE['id_list'];
									$film = unserialize($id_string);
								} else {
									$film = array();
								}	
								
//								var_dump($film);

							    (float)$total = 0;
								for($i=0; $i<sizeof($film); $i++) {
									$total += $film[$i][5];
									$p = $i+1;
								   //echo "<tr ><td>".$p."</td>";
								   echo "<tr><td>".$film[$i][1]."</td>";
								   echo "<td>".$film[$i][2]."</td>";
								   echo "<td>".$film[$i][3]."</td>";
								   echo "<td><img src='../images/".$film[$i][4]."' width=30 height=40></td>";
								   echo "<td><input id='inputP' type='text' value='1' size='1'></td>";
								   echo "<td>".$film[$i][5]."</td>";								   
								   echo "<td><a class='glyphicon glyphicon-trash' href='../gestionFilm/deleteAuPanier.php?id=".$film[$i][0]."'></a></td></tr>";
								}
								
								   echo "<tr><td></td><td></td><td></td><td></td>";
								   echo "<td>Total</td>";
								   echo "<td>$total (CAD)</td><td></td></tr>";
							?>
							
						</thead>
						<tbody id="tb"></tbody>
					</table>
				</div>
			</div>	

			<div id="menu" class="col-md-2 hide">
				<h4>Paiement</h4>
				  <ul id="categorieMenu" class="nav nav-pills nav-stacked">
						
				  </ul>
	        </div>
			
	        <footer id="footer" class="copyright  col-md-12">
			      <p>© 2018 - Maisonneuve</p>
	        </footer> 
		</div>		
	</body>
</html>