angular.module('components', [])
    .directive('stickyNote', function() {
        return {
            restrict: 'E',
            templateUrl: 'snippets/stickyNote.html'
        } 
     });
     
var scrumboardApp = angular.module('scrumboardApp', ['components']);     
scrumboardApp.factory('StickyNotes', function($http) {
    var StickyNotes = $http.get('/api/v1/stories').success(function(response) {
       return response;
    });
    
    var factory = {};
    
    factory.getNotes = function() {
        return StickyNotes;
    };
    
    return factory;
});

function overviewCtrl($scope, StickyNotes) {
    $scope.notes = StickyNotes.getNotes();
}