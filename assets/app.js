/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/app.scss';
import '/node_modules/jquery';


//Set timeout message success 

$("document").ready(function(){
    setTimeout(function(){
        $("div.alert").slideUp(700);
    }, 3000 ); // 3 secs
});

//Navigation menu 


$(document).ready(function () {
    $(".btn-menu").click(function () {
      $(".container-nav-list").toggleClass("active");
    });
    $("ul li").click(function () {
      $(this).siblings().removeClass("active");
      $(this).toggleClass("active");
    });
  });

//Recherche dans le tableau potentiel client

$(function(){
    var path = $('#path').attr('data-path');

        //Récupération de la valeur du champ de saisie
        $("#motCle").keyup(function(){
            $(this).val()
        
        //Filtrage par rapport à ce qu'il y a en base
        $.get(path, {filtre:$(this).val()}, function(data, status){
        "Data: " + data
        "Status: " + status

            //Condition pour l'affichage des données
            if(status == 'success'){
                $('#tableClient').html(data);
            }

        })
    });
})
