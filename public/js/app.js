var clankiApp = angular.module('clankiApp', ['ngRoute', 'ngCookies', 'ngAnimate', 'mainCtrl', 'filterService', 'favCtrl', 'articlesService', 'userCtrl']);

/**
 * Route list
 */

clankiApp.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/home', {
            templateUrl: 'templates/articles.html',
            controller: 'mainController'
        }).
        when('/test', {
            templateUrl: 'templates/test.html',
            controller: 'favoritesController'
        }).
        when('/favs', {
            templateUrl: 'templates/favorites.html',
            controller: 'favoritesController'
        }).
        otherwise({
            redirectTo: '/home'
        });
}]);
