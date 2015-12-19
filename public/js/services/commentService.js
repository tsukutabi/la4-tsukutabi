angular.module('commentService', [])

    .factory('Comment', function($http) {

        return {
            // すべてのコメントを取得する
            get : function() {
                return $http.get('/test');
            },

            // コメントを保存する。
            save : function(commentData) {
                return $http({
                    method: 'POST',
                    url: '/test',
                    //headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(commentData)
                });
            },

            edit : function (commentData) {
                return $http({
                    method: 'POST',
                    url: 'edit/comment',
                    data: $.param(commentData)
                });
            },

            // コメントを削除する
            destroy : function(id) {
                return $http.delete('/api/comments/' + id);
            }
        }

    });