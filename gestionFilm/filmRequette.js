 $(function(){
	 
	 /////////// login /////////////////////////////
			 $("#loginF").validate({
				// Specify validation rules
				rules: {
				  courrielLogin: {
				    required: true,
					email: true
					},
				  motdepasseLogin: {
				    required: true,
					minlength:6
					}
				},
				// Specify validation error messages
				messages: {
				  courrielLogin: {
					required: "Entrer votre courriel!",
					email: "Entrer un courriel valide!!"
				   },
				  motdepasseLogin: {
					required: "Entrer mot de passe!",
					minlength: "Mot de passe doit contenir au moins 6 lettres!"
				   }
				},
				// submit handler
				submitHandler: function(form) {   
					$.ajax({
						url: "gestionUtilisateur/authentification.php",
						type: 'POST',
						data: $(form).serialize(),
						success: function (data) {
							var result = JSON.parse(data);	

							if(result[0] == true) {
								//alert("OK");
								$user=result[1];
								$role=result[2];
								$("#gestion").addClass("show").removeClass("hide");
								$("#gestionFilm").addClass("show").removeClass("hide");
								$("#login").addClass("hide").removeClass("show");
								alert("aaa");
								updateGestionFilm();
								//alert("bbb");								
							}else{
								alert("No");
							}
						},
					});						
				}
			});
	 
	 /////////// create new user and save in database /////////////////////////////
			 $("#inscriptionF").validate({
				// Specify validation rules
				rules: {
				  nomInscri: "required",
				  prenomInscri: "required",
				  courrielInscri: {
				    required: true,
					email: true
					},
				  adresseInscri: "required",
				  motdepasseInscri: {
				    required: true,
					minlength:6
					},
				  motdepasseConfirm: {
				    required: true,
					minlength:6,
					equalTo: "#motdepasseInscri"
					}
				},
				// Specify validation error messages
				messages: {
				  nomInscri: "Entrer le titre du film!",
				  prenomInscri: "Entrer le realisateur du film!",
				  courrielInscri: "Entrer un courriel valide!",
				  adresseInscri: "Entrer l'adresse!",
				  motdepasseInscri: {
					required: "Entrer un mot de passe!",
					minlength: "Mot de passe doit contenir au moins 6 lettres!"
				   },
				  motdepasseConfirm: {
					required: "Entrer mot de passe!",
					minlength: "Mot de passe doit contenir au moins 6 lettres!",
					equalTo: "Mots de paase n'accordent pas!"
				   }
				},
				// submit handler
				submitHandler: function(form) {  
					//alert("aaa");	
					$.ajax({	
						url: "gestionUtilisateur/ajouterUser.php",	
						type: 'POST',	
						data: $(form).serialize(),	
						success: function (data) {	
							alert(data)	
						},	
					});							
				}
			});	

/////////// create new film and save in database /////////////////////////////
			 $("#nouveauF").validate({
				// Specify validation rules
				rules: {
				  titre: "required",
				  realisateur: "required",
				  categorie: "required",
				  duree: "required",
				  prix: "required",
				  //pochette: "required",
				},
				// Specify validation error messages
				messages: {
				  titre: "Entrer le titre du film!",
				  realisateur: "Entrer le realisateur du film!",
				  categorie: "Choisir la categorie du film!",
				  duree: "Entrer la duree du film!",
				  prix: "Entrer le prix du film!",
				  //pochette: "Choisir la pochette du film!",
				},
				// submit handler				
				submitHandler: function(form) {   
					if ($("#idd").val()=="0") {	
						//var url = "gestionFilm/ajouterFilm.php";
						var url = "gestionFilm/filmRequette.php";
						var op = "ajouterFilm";
					} else {	
						var url = "gestionFilm/miseajourFilm.php";
						var op = "updateFilm";
					}		
					alert(url);	
					var formData = new FormData(form);
					formData.append('op', op);
					$.ajax({	
						url: url,	
						type: 'POST',	
						data: formData,	
						success: function (data) {
							alert(data);
							updateGestionFilm();							
							$("#gestion").addClass("show").removeClass("hide");			
							$("#gestionFilm").addClass("show").removeClass("hide");									
							$("#nouveauFilm").addClass("hide").removeClass("show");		
							$("input:text").val("");	
							$("input:file").val("");	
							$("#idd").attr("value", "0");	
						},	
						cache: false,	
						contentType: false,	
						processData: false	
					});								
				}	
			});

//////////// Modifier Film  ///////////////////////////////////////////////////
			$(document).on("click", "a.modifier", function() {
				alert(this.id);
				var idd = this.id.toString();
				$.getJSON("gestionFilm/rechercheParId.php", { id: this.id }, function(data) {
					alert(data);
					$("#titre_nouveau").addClass("hide").removeClass("show");
					$("#titre_modification").addClass("show").removeClass("hide");
					$("#nouveauFilm").addClass("show").removeClass("hide");
					$("#gestionFilm").addClass("hide").removeClass("show");

					$("#titre").attr("value", data[1]);
					$("#realisateur").attr("value", data[2]);
					$("#categorie").val(data[3].toString());
					$("#duree").attr("value", data[4]);
					$("#prix").attr("value", data[5]);
					$("#idd").attr("value", idd);
				});			
			});
			
			//////////// Delete Film  ///////////////////////////////////////////////////
			$(document).on("click", "a.supprimer", function() {
				$.getJSON("gestionFilm/supprimerFilm.php", { id: this.id }, function(data) {
					alert(data);
					updateGestionFilm();
					$("#gestion").addClass("show").removeClass("hide");		
					$("#gestionFilm").addClass("show").removeClass("hide");			
				});			
			});			
 })
 
 //////////////// Set category data  ///////////////////////////////////////
			function setCategorie() {
				$.getJSON('gestionFilm/lireCategorie.php', function(data) {
					$("#categorieMenu").empty();
					$("select#categorie").empty();
					$("#categorieMenu").append("<li id='item0' class='active'><a href='#'  class='menuItem' id='0'>Tous les films</a></li>");
					$.each(data, function(index, item) {
						$("#categorieMenu").append("<li id='item" + (index+1) + "' class=''><a href='#' class='menuItem' id='" + (index+1) + "'>" + item + "</a></li>");
						$("select#categorie").append("<option value='" + (index+1) + "'>"  + item +  "</option>");
						//$('<option>').val(index).text(item).appendTo('#select#categorie');
					});
				});	
			}
			
			//////////// film form generator /////////////////
			function updateGestionFilm() {
				alert("bbb");
			    $('#tb').empty();
				//var formData = new FormData(); 
				//formData.append('op','lire');
				$.getJSON('gestionFilm/filmRequette.php', {op: 'lire'}, function(data) {
					alert("ccc");
					alert(data);
					$.each(data, function (index) {							
						$('#tb').append("<tr ><td>" + (index+1) + "</td><td>" + data[index][1] + "</td><td>" + data[index][2] + 						
						           "</td><td>" + data[index][3] + "</td><td>" + data[index][4] + "</td><td>" + data[index][5] + 						
								   "</td><td><img src='images/" + data[index][6] + 						
								   "' width=30 height=40></td><td><a id='" + data[index][0] + 						
								   "' class='btn mini blue-stripe modifier' href='#'>Modifier</a></td><td><a id='" + data[index][0] + 						
								   "' class='btn mini blue-stripe supprimer' href='#'>Suppimer</a></td></tr>");										
					})						
				});									
			}
			
			//////////// affichage des cartes du film  ///////////////////////////////////
			function afficherFilm(url, nb) {
				$('#films').empty();
				$.getJSON(url, {id: nb}, function(data) {
					$.each(data, function (index) {
						var view = {
							titre: data[index][1],
							realisateur: data[index][2],
							prix: data[index][5],
							pochette: data[index][6]
						};
						var template = document.getElementById('templateCard').innerHTML;
						var output = Mustache.render(template, view);
						$('#films').append(output);				
					})
				});	
			}			