quakemap.factory('q', function($rootScope, $http, $interval){
	return {
		generate: function($rootScope, $scope){
			$scope.remove();
			var query = '';
			for (var property in $scope.settings) {
				if ($scope.settings[property]) {
					var query = query + "&" + property + "=" + $scope.settings[property];
				}
			}
			$http({method: 'GET', url: ("http://www.corsproxy.com/comcat.cr.usgs.gov/fdsnws/event/1/query?" + query + "&format=geojson")})	
			.success(function(data){
				$scope.data = [];
				for (i=0; i<data.features.length;i++){
					$scope.data.push(
<<<<<<< HEAD
<<<<<<< HEAD
						[data.features[i].properties.time, data.features[i].properties.mag, data.features[i].geometry.coordinates[2]]
=======
						[data.features[i].properties.time, data.features[i].properties.mag]
>>>>>>> parent of 38e8a8b... Flot-tooltips added
=======
						[data.features[i].properties.time, data.features[i].properties.mag]
>>>>>>> parent of 38e8a8b... Flot-tooltips added
						);
				};
				$scope.errorCheck(true);
				$scope.window.lastUpdated = "Last updated at " + moment().format("hh:mma");
				$scope.window.count = data.metadata.count;
				$scope.urls.csv = "http://comcat.cr.usgs.gov/fdsnws/event/1/query?" + query + "&format=csv";
				$scope.urls.geojson = "http://comcat.cr.usgs.gov/fdsnws/event/1/query?" + query + "&format=geojson";
				$scope.urls.kml = "http://comcat.cr.usgs.gov/fdsnws/event/1/query?" + query + "&format=kml";
				$scope.urls.xml = "http://comcat.cr.usgs.gov/fdsnws/event/1/query?" + query + "&format=xml";
				quakes = d3.select("#map").append("g")
				.attr("class", "quakes") 
				.selectAll(".quake")
				.data(data.features)
				.enter().append("g")
				.attr("class", "quake")
				.attr("transform", function(d) {return "translate(" + $rootScope.projection(d.geometry.coordinates)[0] + "," + $rootScope.projection(d.geometry.coordinates)[1] + ")";});
				quakes.append("circle")
				.attr("class","quakeStatic")
				.attr("r", 1.5)
				.style("stroke", function(d) {return colorMagScale(d.properties.mag);})          
				.style("stroke-width", 0.75)
				.on("click",  function(d){
					$scope.click(d);
				});
				d3.selectAll(".quakes").attr("transform", "translate(" + $rootScope.oT + ")scale(" + $rootScope.oS + ")");
				below4 = quakes.filter(function(d){ return d.properties.mag > 4.0;});
				$scope.quakesBelow4 = below4;
				if($scope.animation){ //If animation is turned off, don't let it start again
					$scope.setInterval(below4);
				};

			})
				.error(function(){
					$scope.errorCheck(false);
				}
				);
		},
		remove: function($scope){
			$('.error').remove();
			$(".quake").remove(); //Delete all quakes
			for (var property in $scope.window) {
				if ($scope.window[property]) {
					$scope.window[property] = '';
				}
			};
			$scope.window.count = '-';
			$scope.window.lastUpdated = '-';
		}
	};
});

quakemap.directive('chart', [function() {
  return {
    restrict: 'E',
    link: function(scope, elem, attrs) {
    	var scale = d3.scale.linear().domain([2.0,4.5,7.5,8.5]).range(["green","blue", "orange","red"])
    	var foo = scope[attrs.ngModel];
<<<<<<< HEAD
<<<<<<< HEAD
    	var opts = {
    		xaxis: {mode: 'time', autoscaleMargin: 0.05, minTickSize: [1, "day"]},
    		yaxis: {},
    		grid: {
    			hoverable: true,
    			show: true
    		},
    		points: {
    			show: true,
    			radius: 10,
    			fill: true
    		},
    		tooltip: true,
    		tooltipOpts: {
					content: function(label, xval, yval, depth, flotItem){ return "M" + yval + ", " + depth.toString() + "km";},
					shifts: {
						x: -60,
						y: 25
					}
				}
    	};
=======
    	var opts = {xaxis: {mode: 'time', minTickSize: [1, "day"]}, yaxis: {}, points: { show: true, radius: 10, fill: true }};
>>>>>>> parent of 38e8a8b... Flot-tooltips added
=======
    	var opts = {xaxis: {mode: 'time', minTickSize: [1, "day"]}, yaxis: {}, points: { show: true, radius: 10, fill: true }};
>>>>>>> parent of 38e8a8b... Flot-tooltips added

    	var chart = $.plot(elem, [[0,0],[1,1]], opts);


        scope.$watch("data", function(v){
                    chart.setData([v]);
                    chart.setupGrid();
                    chart.draw();
                });

    }
  };
}]);	