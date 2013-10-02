var scrumboardApp = angular.module('scrumboardApp', []);
scrumboardApp.factory('StickyNotes', function () {
    var StickyNotes = {};
    
    StickyNotes.data = [
        {
            title: "Title1",
            text: "Lorum Ipsum"
        },
        {
            title: "Title2",
            text: "Lorum Ipsum"
        },
        {
            title: "Title3",
            text: "Lorum Ipsum"
        },
        {
            title: "Title4",
            text: "Lorum Ipsum"
        },
        {
            title: "Title5",
            text: "Lorum Ipsum"
        },
        {
            title: "Title6",
            text: "Lorum Ipsum"
        },
        {
            title: "Title7",
            text: "Lorum Ipsum"
        },
        {
            title: "Title8",
            text: "Lorum Ipsum"
        },
        {
            title: "Title9",
            text: "Lorum Ipsum"
        },
        {
            title: "Title10",
            text: "Lorum Ipsum"
        },
        {
            title: "Title11",
            text: "Lorum Ipsum"
        }
    ]; 
    return StickyNotes;
});

function overviewCtrl($scope, StickyNotes) {
    $scope.notes = StickyNotes;
}