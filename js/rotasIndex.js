// create the module and name it scotchApp
var ProjetoIndexApp = angular.module('ProjetoIndex', [ 'ngRoute' ]);

// configure our routes
ProjetoIndexApp.config(function($routeProvider) {
	$routeProvider

	// route for the home page
	.when('/home', {
		templateUrl : 'home.html',
		controller : 'mainController'
	})
	// route for the sobre page
	.when('/sobre', {
		templateUrl : 'sobre.html',
		controller : 'sobreController'
	})
	// route for the contato page
	.when('/contato', {
		templateUrl : 'contato.php',
		controller : 'contatoController'
	})
	// route for the cursos page
	.when('/listaCursos', {
		templateUrl : 'listaCursosIndex.php',
		controller : 'CursosController'
	})
	.otherwise({redirectTo : '/home'})
});
ProjetoIndexApp.controller('mainController', function($scope) {
	// create a message to display in our view
	//$scope.message = 'Painel Inicial';
});
ProjetoIndexApp.controller('sobreController', function($scope, $http) {
	$.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "sobre.html",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
    });
});
ProjetoIndexApp.controller('contatoController', function($scope, $http) {
	$.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "contato.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            }
        });
});
ProjetoIndexApp.controller('CursosController', function($scope, $http) {
	$("li").click(function() {
        console.log(this.id);
        $.ajax({    //create an ajax request to load_page.php
            type: "POST",
            url: "listaCursosIndex.php",
            data: {
            	id: this.id
            },           
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response);		
            }
        });
	});
});