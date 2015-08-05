/**
 * Created by Marko on 27.3.2015.
 */
var userCtrl = angular.module('userCtrl', []);

userCtrl.controller('userController', ['$scope', 'Article', function (scope, Article) {

    scope.login = function (credentials) {

        Article.token(credentials)
            .success(function (data) {
                var token = data.access_token;
                //console.log("Success: New token created: " + data.access_token);
                Article.setCookies(token)
                    .success(function () {
                        //console.log("Success: New cookie token set!");
                    })
            });

    };


}]);