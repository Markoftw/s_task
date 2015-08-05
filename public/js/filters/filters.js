/**
 * Created by Marko on 27.3.2015.
 */
var filtServ = angular.module('filterService', []);

filtServ.filter('replaceSize', function(){
    return function(input) {
        return input.replace("##WIDTH##x##HEIGHT##", "237x237");
    }
});
filtServ.filter('getLastTitle', function(){
    return function(input) {
        return input.split("/").pop();
    }
});