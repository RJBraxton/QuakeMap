<!DOCTYPE html>
<html ng-app="myApp">
<head>
  <meta charset="utf-8">
  <title>AngularJS + D3.js</title>
  <script src="//cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.1/angular.min.js"></script>
  <script src="http://fgnass.github.io/spin.js/spin.min.js"></script>
  <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="./assets/css/bootstrap.css" rel="stylesheet">


</head>
<body>
  <div ng-controller="AppCtrl">
    <div  id="loading" style="position:fixed;top:50%;left:50%;"></div>
    <div ng-show="loading" style="position:absolute;height:100%; width:100%; background:rgba(0,0,0,0.2);"></div>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span10 well">
          <!-- Here's where our visualization will go -->
          <table class="table table-striped table-bordered">
            <tr>
              <th>Location</th>
              <th>ID</th>
              <th>Sources</th>
              <th>Mag</th>
              <th>Depth</th>
            </tr>
            <tr ng-repeat="i in mainInfo">
              <td>{{i.properties.place}}</td>
              <td>{{i.id}}</td>
              <td>{{i.properties.sources}}</td>
              <td>{{i.properties.mag}} ({{i.properties.type}})</td>
              <td>{{i.geometry.coordinates[2]}}m</td>
            </tr>
          </table>
        </div>
        <div class="span2 well">
          Really just making sure this works
        </div>
      </div>
    </div>
  </div>


  <script>
  var opts = {
  lines: 17, // The number of lines to draw
  length: 40, // The length of each line
  width: 2, // The line thickness
  radius: 60, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
  speed: 1.2, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: true, // Whether to render a shadow
  hwaccel: true, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};

var spinner = new Spinner().spin();
document.getElementById('loading').appendChild(spinner.el);


app = angular.module("myApp", []);

app.controller('AppCtrl', function ($scope,$http) {
  $scope.loading = true;

<<<<<<< HEAD
  var url = "http://www.corsproxy.com/earthquake.usgs.gov/fdsnws/event/1/query?starttime=NOW-7days&orderby=magnitude&format=geojson";
=======
  var url = "http://www.corsproxy.com/comcat.cr.usgs.gov/fdsnws/event/1/query?starttime=NOW-7days&orderby=magnitude&format=geojson";
>>>>>>> 551392bab2046ba16d58b21451c1f0cec8fdbc3b
  $scope.mainInfo = null;
  $http.get(url).success(function(data) {
    $scope.mainInfo = data.features;
    console.log($scope.mainInfo);
    spinner.spin(false);
    $scope.loading = false;
    
  });
});

app.filter('orderObjectBy', function(){
 return function(input, attribute) {
  if (!angular.isObject(input)) return input;

  var array = [];
  for(var objectKey in input) {
    array.push(input[objectKey]);
  }

  array.sort(function(a, b){
    a = parseInt(a[attribute]);
    b = parseInt(b[attribute]);
    return a - b;
  });
  return array;
}
});

app.directive('ghVisualization', function () {
    // constants
    var margin = 20,
    width = 500,
    height = 100 - .5 - margin;
    //constants
    return {
      restrict: 'E',
      link: function (scope, element, attr) {
        // set up initial svg object
        vis = d3.selectAll(element)
        .append("svg")
        .attr("width", width)
        .attr("height", height + margin + 100)

        vis.selectAll().data(scope.d1).enter()
        .append("circle")
        .attr("r", 6)
        .attr("cx", function(d,i){return 60*i;})
        .attr("cy", function(d){return d.v;});

        scope.$watch(attr.ghBind, function(value){
          vis.selectAll("circle").data(value)
          .attr("cy", function(d){return d.v;});
        }
        , true);
      }
    }});

</script>

</body>
</html>