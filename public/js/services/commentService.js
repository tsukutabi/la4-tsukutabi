// public/js/services/commentService.js

angular.module('commentService', [])

    .factory('Comment', function($http) {
        return {
            // コメントを保存する。
            save : function(commentData) {
                return $http({
                    method: 'POST',
                    url: '/comment',
                    //headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(commentData)
                });
            },

            //todo コメントを編集する
            //edit : function(comment_edit_data){
            //    return $http.edit()
            //}

            // コメントを削除する
            destroy : function(id) {
                return $http.delete('/api/comments/' + id);
            }
        }

    });