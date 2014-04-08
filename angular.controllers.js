quakemap.controller('Settings', function($rootScope, $scope, $interval, q){
	//Animation things
	$scope.animation = false;
	$scope.animationButton = function(bool){
		if(bool){ //If is on
			$interval.cancel($scope.interval);
			$scope.animation = false;
		}
		else { //If animation is currently off
			$scope.setInterval($scope.quakesBelow4);
			$scope.animation = true;
		}
	};
	$scope.quakesBelow4;
	$scope.interval;
	$scope.setInterval = function(below4){
		$scope.interval = $interval(function(d){
					below4
					.append("circle")
					.attr("class","quakeAnim")
					.attr("r", 0)
					.style("stroke", function(d) {return colorMagScale(d.properties.mag);  })          
					.style("stroke-width", 2)
					.on("click",  function(d){
						$scope.click(d);})
					.transition()
					.ease("circle")
					.duration(function(d) { return frequency(d.geometry.coordinates[2]); })
					.attr("r", function(d) { return radius(d.properties.mag); }) //Umm hello where is this shit
					.style("stroke-opacity", 0)
					.style("stroke-width", 0)
					.remove();
				}, 1000);
	};

//SETTINGS
	$scope.settings = {
		'endtime': moment().format("YYYY-MM-DD"),
		'limit': 20,
		'maxdepth': '',
		'maxlatitude': '',
		'maxlongitude': '',
		'maxmagnitude': '',
		'mindepth': '',
		'minlatitude': '',
		'minlongitude': '',
		'minmagnitude': '',
		'orderby': 'magnitude',
		'starttime': moment().subtract('days', 7).format("YYYY-MM-DD")
	};
	$scope.window = {
		'color': '',
		'coordinates': '',
		'count': '-',
		'depth': '',
		'id': '',
		'lastUpdated': '-',
		'magnitude': '',
		'top': '',
		'url': ''
	};
	$scope.urls ={
		'csv': '',
		'geojson': '',
		'kml': '',
		'xml': ''
	};

	$scope.data =[];


	//Quakemapping Functions
	$scope.generate = function () {
		var b = q.generate($rootScope, $scope);
		return b;
	};
	$scope.remove = function(){
		return q.remove($scope);
	};
	$scope.click = function(d){
		$scope.$apply(function(){
			$scope.window.top = "M" + d.properties.mag + " (" + d.geometry.coordinates[2] + "km) - " + moment(+d.properties.time).calendar() + ", " + d.properties.place;
			$scope.window.color = {color: $scope.colorScale(d.properties.mag)};
		});
	};
	$scope.errorCheck = function(){
		d3.selectAll('.error').remove();
		var errorlog = [];
		//Every debugging possibility on the face of the earth
					if (isNaN($scope.settings.limit) == true) {	
						errorlog.push("The limit value is not a whole number.");
					}	
					if (moment.isMoment(moment($scope.settings.starttime)) == false) { 
						errorlog.push("The first date value is not formatted properly.");
					}
					if (moment.isMoment(moment($scope.settings.endtime)) == false) { 
						errorlog.push("The second date value is not formatted properly.");
					}
					if (isNaN($scope.settings.minmagnitude) == true) {
						errorlog.push("The minimum magnitude value is not formatted properly.");
					}
					if (isNaN($scope.settings.maxmagnitude) == true) {
						errorlog.push("The maximum magnitude value is not formatted properly.");
					}
					if (isNaN($scope.settings.maxmagnitude) == false && isNaN($scope.settings.minmagnitude) == false && parseFloat($scope.settings.maxmagnitude) < parseFloat($scope.settings.minmagnitude)) {
						errorlog.push("The minimum magnitude is greater than the maximum.");
					}
					if (isNaN($scope.settings.mindepth) == true) {
						errorlog.push("The minimum depth value is not formatted properly.");
					}
					if (isNaN($scope.settings.maxdepth) == true) {
						errorlog.push("The maximum depth value is not formatted properly.");	
					}
					if (isNaN($scope.settings.maxdepth) == false && isNaN($scope.settings.maxdepth) == false && parseFloat($scope.settings.maxdepth) < parseFloat($scope.settings.mindepth)) {
						errorlog.push("The minimum depth is greater than the maximum.");
					}
					if (isNaN($scope.settings.maxlatitude) == true) {
						errorlog.push("The North latitude is not formatted properly.")
					}
					if (isNaN($scope.settings.minlatitude) == true) {
						errorlog.push("The South latitude is not formatted properly.")
					}
					if (isNaN($scope.settings.maxlatitude) == false && isNaN($scope.settings.minlatitude) == false && parseFloat($scope.settings.maxlatitude) < parseFloat($scope.settings.minlatitude)) {
						errorlog.push("The North latitude is smaller than the South latitude.");	
					}
					if (isNaN($scope.settings.maxlongitude) == true) {
						errorlog.push("The East longitude is not formatted properly.")
					}
					if (isNaN($scope.settings.minlongitude) == true) {
						errorlog.push("The West longitude is not formatted properly.")
					}
					if (isNaN($scope.settings.maxlongitude) == false && isNaN($scope.settings.minlongitude) == false && parseFloat($scope.settings.maxlongitude) < parseFloat($scope.settings.minlongitude)) {
						errorlog.push("The East latitude is smaller than the West latitude.");	
					}

					if (errorlog.length > 0) {
						for (i=0;( i <errorlog.length); i++){
							d3.select('.errorlog').append('div').attr("class", "error alert alert-danger").text(errorlog[i]);
						};
					}
					else if (bool = false){
						errorlog.push("The USGS server or your internet connection may be down or updating.");
						d3.select('.errorlog').append('div').attr("class", "error alert alert-danger").text(errorlog);
					} ;
	};
	$scope.colorScale = d3.scale.linear().domain([2.0,4.5,7.5,8.5]).range(["green","blue", "orange","red"]);
})