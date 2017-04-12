// create the module and name it scotchApp
var ProjetoApp = angular.module('Projeto', [ 'ngRoute' ]);

// configure our routes
ProjetoApp.config(function($routeProvider) {
	$routeProvider

	// route for the home page
	.when('/home', {
		templateUrl : 'home.html',
		controller : 'mainController'
	})

	// route for the cliente page
	.when('/listaUsuarios', {
		templateUrl : 'listaUsuarios.php',
		controller : 'UsuarioController'
	})

	// route for the plano page
	.when('/listaCategorias', {
		templateUrl : 'listaCategorias.php',
		controller : 'CategoriaController'
	})
	// route for the usuario page
	.when('/listaCursos', {
		templateUrl : 'listaCursos.php',
		controller : 'CursosController'
	})
	.when('/listaContatos', {
		templateUrl : 'listaContatos.php',
		controller : 'ContatoController'
	})
});
ProjetoApp.controller('mainController', function($scope) {
	// create a message to display in our view
	$scope.message = 'Painel Inicial';

});
ProjetoApp.controller('UsuarioController', function($scope, $http) {
	$.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaUsuarios.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
});
ProjetoApp.controller('CategoriaController', function($scope, $http) {
	$.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaCategorias.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
});
ProjetoApp.controller('CursosController', function($scope, $http) {
	$.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaCursos.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
});
ProjetoApp.controller('ContatoController', function($scope, $http) {
	$.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "listaContatos.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
});