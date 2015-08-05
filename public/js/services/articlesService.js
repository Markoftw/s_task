/**
 * Created by Marko on 27.3.2015.
 */
angular.module('articlesService', [])

    .factory('Article', ['$http', function(http) {

        return {
            /**
             * Get OAuth2.0 access token
             * @returns {*}
             */
            token : function(credentials) {
                return http({
                    method: 'POST',
                    url: '/oauth/access_token',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded; charset=utf-8' },
                    data: $.param({
                        'grant_type' : 'password',
                        'client_id' : 'NNhYYhR1P4V5ADWU',
                        'client_secret' : 'jdI2Hu5KQ2uCuBu8pImdFjgXDyP5hO7e',
                        'username' : credentials.email,
                        'password' : credentials.password
                    })
                });
            },
            /**
             * Save article to users favorites
             * @param articleData
             * @param token
             * @returns {*}
             */
            save : function(articleData, token) {
                return http({
                    method: 'POST',
                    url: 'api/articles',
                    headers: { 'Authorization' : 'Bearer ' + token },
                    data: articleData
                });
            },
            /**
             * Show favorite articles for user
             * @param token
             * @returns {*}
             */
            show : function(token) {
                return http({
                    method: 'GET',
                    url: 'api/articles',
                    //cache: true,
                    headers: { 'Authorization' : 'Bearer ' + token, 'Content-Type' : 'application/x-www-form-urlencoded; charset=utf-8' }
                });
            },
            /**
             * Remove articles from users favorites
             * @param id
             * @param token
             * @returns {*}
             */
            destroy : function(id, token) {
                return http({
                    method: 'DELETE',
                    url: 'api/articles/' + id,
                    headers: { 'Authorization' : 'Bearer ' + token }
                });
            },
            /**
             * Set cookie
             * @param token
             * @returns {*}
             */
            setCookies : function(token) {
                return http({
                    method: 'POST',
                    url: '/oauth/setToken/' + token,
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded; charset=utf-8' }
                });
            },
            /**
             * Get cookie
             * @returns {*}
             */
            getCookies : function() {
                return http({
                    method: 'GET',
                    url: 'oauth/getToken',
                    cache: false,
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded; charset=utf-8' }
                });
            }
        }

    }]);