/**
 * Created by Marko on 27.3.2015.
 */
var articleCtrl = angular.module('favCtrl', []);

articleCtrl.controller('favoritesController', ['$scope', '$http', 'Article', function (scope, http, Article) {

    /**
     * Check for token cookie, then show favorites for use, otherwise login
     */
    Article.getCookies()
        .success(function (data) {
            if(data.access_token != false) {
                var token = data.access_token;
                Article.show(token)
                    .success(function (data) {
                        scope.favorites = data;
                        //console.log(data);
                    })
            } else {
                console.log("No token found");

                //redirect to login
            }
        });

    /**
     * Remove article from favorites
     * @type {boolean}
     */

    scope.isRemoved = false;
    scope.remFromFav = function (favorite) {
        console.log("ID:" + favorite.id +" Section: " + favorite.section + " Title: " + favorite.title + " Image: " + favorite.image);
        var favData = favorite.id;

        Article.getCookies()
            .success(function (data) {
                var token = data.access_token;
                Article.destroy(favData, token)
                    .success(function (data) {
                        //console.log(data);
                    })
            });

        this.isRemoved = true;

    };


    /* tests */

    /**
     * Get token button
     */
    scope.getToken = function () {

        Article.getCookies()
            .success(function (data) {
                console.log("Success: Current token: " + data.access_token);
                if (data.access_token == false) {
                    Article.token()
                        .success(function (data) {
                            console.log("Success: New token created: " + data.access_token);
                            Article.setCookies(data.access_token)
                                .success(function (data) {
                                    console.log("Success: New cookie token set!");
                                })
                        })
                }
            })
    };
    scope.getArticles = function () {

        Article.getCookies()
            .success(function (data) {
                var token = data.access_token;
                Article.show(token)
                    .success(function (data) {
                        scope.favotites = data;
                        console.log(data);
                    })
            });



    };

}]);

/*var now = new Date(),
 expire = new Date(now.getTime()+ 5*60000);
 console.log(expire);

 if(localStorageService.cookie.isSupported) {
 console.log("yes");
 function submit(key, val) {
 return localStorageService.cookie.set(key, val, 1);
 }

 submit('cookieName', 'cookieValue');
 }*/

//cookies.put('access_token', 'test');
//cookies.put('access_token', 'test', { 'expires' : expire });