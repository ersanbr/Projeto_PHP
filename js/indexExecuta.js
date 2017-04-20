$(document).ready(function() {

    $("#listaUsuario").click(function() {                

        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaCursos.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response);
                console.log($("#responsecontainer").html(response)); 
            }
        });
    });
});