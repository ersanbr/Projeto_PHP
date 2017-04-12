$(document).ready(function() {

    $("#listaUsuario").click(function() {                

        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaUsuario.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response);
                console.log($("#responsecontainer").html(response)); 
            }
        });
    });
    $("#listaCategoria").click(function() {                

        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaCategoria.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
    });
    $("#listaCursos").click(function() {                

        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaCursos.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
    });
    $("#listaContatos").click(function() {                

        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaContatos.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
    });
});