$(function(){


  $('#connexionBtn').on("click", function(){
    toutHide();
    $('#login').addClass("show").removeClass("hide");
  })
  
  $('#inscriptionBtn').on("click", function(){
    toutHide();
    $('#inscription').addClass("show").removeClass("hide");
  })
  
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

               submitHandler: function(form) {  
                connUsager();
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
               submitHandler: function(form) {  
                enregUsager();
              }

           });	
  /***** Ajax loader gif *******/
/*    $(document).ajaxStart(function() {
      $("#fadeAj").css("display", "block");
      $("#modalAj").css("display", "block");
    });
    $(document).ajaxComplete(function() {
        $("#modalAj").css("display", "none");
        $("#fadeAj").css("display", "none");
    }); */
    /*****Fin  Ajax loader gif *******/
})