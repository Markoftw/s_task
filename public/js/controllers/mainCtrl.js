/**
 * Created by Marko on 27.3.2015.
 */
var mainCtrl = angular.module('mainCtrl', []);

mainCtrl.controller('mainController', ['$scope', '$http', '$filter', 'Article', function (scope, http, filter, Article){
    /**
     * Get 20 latest articles (cached)
     */
    http.get('http://api.kme.si/v1/articles?resource_id=22&order=desc&limit=20', { cache: true }).success(function(data) {
        scope.clanki = data.data.list;
    });

    /**
     * Add article to favorites
     * @type {boolean}
     */
    scope.isDisabled = false;
    scope.addToFavs = function (clanek) {
        var fil = filter('uppercase');
        var fil2 = filter('getLastSection');
        console.log("Section: " + fil2(fil(clanek.section_name)).trim() + " Title: " + clanek.title + " Image: " + filter('replaceSize')(clanek.image));
        var articleData = {
            'section' : fil2(fil(clanek.section_name)).trim(),
            'title' : clanek.title,
            'image' : filter('replaceSize')(clanek.image)
        }

        Article.getCookies()
            .success(function (data) {
                var token = data.access_token;
                Article.save(articleData, token)
                    .success(function (data) {
                        //console.log(data);
                    })
                    .error(function (data) {
                        //console.log(data);
                    });
            });


        //this.class_name = 'red';
        //scope.activeBtn = index;
        //this.b.state = !this.b.state;
        this.isDisabled = true;

    };


}]);
/**
 * Replace image size filter
 */
mainCtrl.filter('replaceSize', function(){
    return function(input) {
        return input.replace("##WIDTH##x##HEIGHT##", "237x237");
    }
});
/**
 * Get last article section
 */
mainCtrl.filter('getLastSection', function(){
    return function(input) {
        return input.split("/").pop();
    }
});



/*function get_data() {
    //var t = $(this).prev("b[class^='title']").text();
    //var s = $(this).prevUntil("span[class^='label-section']").first().prev().text().trim();
    //var i = $(this).prevUntil("img[class^='image-src']").text();
    //var i = $(this).prevUntil("img[class^='image-src']").getAttribute('src');
    //var i = $(this).prevUntil("img[class^='image-src']").first().prev().text().trim();

    console.log("Title: " +   + " Section: " +  + " Image: " + i);
}*/