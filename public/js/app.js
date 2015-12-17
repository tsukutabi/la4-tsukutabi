var commentApp = angular.module('commentApp', ['mainCtrl', 'commentService']);


/*app configuration added here*/
commentApp.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
