angular.module('mainCtrl', [])

    // コメントサービスをコントローラーに挿入する
    .controller('mainController', function($scope, $http, Comment) {

        // コメントフォームのデータを保持するオブジェクト
        $scope.commentData = {};

        // ロードアイコンの表示
        $scope.loading = true;

        // すべてのコメントを取得して、 $scope.comments にわたす
        Comment.get()
            .success(function(data) {
                $scope.comments = data;
                $scope.loading = false;
            });

        // 送信データのコントローラー
        $scope.submitComment = function() {
            $scope.loading = true;

            // コメントを保存する。
            Comment.save($scope.commentData)
                .success(function(data) {
                    // 成功した場合、コメントリストをリフレッシュする
                    Comment.get()
                        .success(function(getData) {
                            $scope.comments = getData;
                            $scope.loading = false;
                        });

                })
                .error(function(data) {
                    console.log(data);
                });
        };

        // コメント削除のコントローラー
        $scope.deleteComment = function(id) {
            $scope.loading = true;

            Comment.destroy(id)
                .success(function(data) {

                    // 成功した場合、コメントリストをリフレッシュする
                    Comment.get()
                        .success(function(getData) {
                            $scope.comments = getData;
                            $scope.loading = false;
                        });
                });
        };

    });