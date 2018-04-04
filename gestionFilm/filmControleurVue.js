 $(function(){
		
		    /////////////////// read all films and display  //////////////////////////////		
			afficherFilm('gestionFilm/lire.php', '0');
			setCategorie();
			
			

			////////////// choose category ////////////////////////////////////////////////
			$(document).on("click", "a.menuItem", function() {
					var n = "item" + this.id.toString();
					$("li").removeClass("active");
					$("li#" + n).addClass("active");
					alert(this.id);
					if (this.id == 0) {
						afficherFilm('gestionFilm/lire.php', '0');
					} else {
						afficherFilm('gestionFilm/lireFilmParCategorie.php', this.id);
					}
			});			
			
			
			///////////// click connexion button and display login page ///////////////////
			
			
			
			
			
			
			//////////// Select "Gestion de Film"  //////////////////////////////////////
			$(document).on("click", "a.menuGestionFilm", function() {
				alert("gestion film");
				$("#liGestionFilm").addClass("active");
				$("#liGestionMembre").removeClass("active");
				$("#gestionFilm").addClass("show").removeClass("hide");		
			});
			
			//////////// Select "Gestion de Membre"  //////////////////////////////////////
			$(document).on("click", "a.menuGestionMembre", function() {
				alert("gestion membre");
				$("#liGestionFilm").removeClass("active");
				$("#liGestionMembre").addClass("active");
				$("#gestionFilm").addClass("hide").removeClass("show");		
			});

			//////////// Cancel New Film or Modification Film ///////////////////////////////////////////////////
			$("#btnCancelFilm").on("click", function() {
				//alert(this.id);
				$("input:text").val("");				
				$("input:file").val("");
				$("#gestionFilm").addClass("show").removeClass("hide");	
				$("#nouveauFilm").addClass("hide").removeClass("show");									
			});
						
			//////////// New Film  ///////////////////////////////////////////////////
			$(document).on("click", "a.btnNouveauFilm", function() {
				//alert(this.id);
				$("#titre_modification").addClass("hide").removeClass("show");
				$("#titre_nouveau").addClass("show").removeClass("hide");
				$("#gestionFilm").addClass("hide").removeClass("show");	
				$("#nouveauFilm").addClass("show").removeClass("hide");				
			});
			
			
			/////////// click inscription button and display inscription page ///////////////
			

			
			
 })			
			
		
		
		
		 