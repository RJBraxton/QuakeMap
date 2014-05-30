/**
*  Module
*	The main module for quakemap
* Description
*/
var quakemap = angular.module('quakemap', []);

quakemap.run(function($rootScope){

	if (bowser.msie) {
  d3.select('#map').attr('height','700');
}
else{
 d3.select('#map').attr('height','100%'); 
 d3.select('#map').attr('width','100%');
}
	
		//ZOOM/PROJECTION
		$rootScope.projection = d3.geo.winkel3();
	var oT = [0,0]; //Translate variable
	var oS = 1; //Scale Variable
	  //Defining zooming nonsense
	  var zoom = d3.behavior.zoom();
	  zoom.scaleExtent([1, 10])
	  .on("zoom", redraw);

	  function redraw() {
	  	var t = d3.event.translate;
	  	var s = d3.event.scale;
	  	t[0] = Math.min(50 * (s - 1), Math.max(1000 * (1 - s), t[0]));
	  	t[1] = Math.min(50 * (s - 1), Math.max(500 * (1 - s), t[1]));
	  	zoom.translate(t);

	  	svg.attr("transform", "translate(" + t + ")scale(" + s + ")");
	  	d3.selectAll(".quakes").attr("transform", "translate(" + t + ") scale(" + s + ")");
	  	$rootScope.oT = t;
	  	$rootScope.oS = s;
	  }

	  var path = d3.geo.path()
	  .projection($rootScope.projection);
	  var graticule = d3.geo.graticule();
	  var svg = d3.select("#map")
		  .append("svg")
		  .call(zoom)
		  .append("g");
	  svg.append("defs").append("path")
		  .attr("class","map")
		  .datum({type: "Sphere"})
		  .attr("id", "sphere")
		  .attr("d", path);
	  svg.append("use")
		  .attr("class", "stroke")
		  .attr("xlink:href", "#sphere");
	  svg.append("path")
		  .datum(graticule.outline)
		  .attr("class", "water")
		  .attr("d", path);
	  svg.append("g")
		  .attr("class", "graticule")
		  .selectAll("path")
		  .data(graticule.lines)
		  .enter().append("path")
		  .attr("d", path);
	  svg.on('click', function(){
	  	var tcoors = $rootScope.projection.invert(d3.mouse(this)).reverse()
	  	tcoors[0] = parseFloat(tcoors[0].toFixed(3));
	  	tcoors[1] = parseFloat(tcoors[1].toFixed(3));
	  	$rootScope.$apply($rootScope.coors = tcoors);
	  	console.log($rootScope.coors);
	  })

	  d3.json("world-110m.json", function(error, world) {
	    //Mapping the earf
	    svg.insert("path", ".graticule")
	    .datum(topojson.object(world, world.objects.land))
	    .attr("class", "land")
	    .attr("d", path);
	    svg.insert("path", ".graticule")
	    .datum(topojson.mesh(world, world.objects.countries, function(a, b) { return a.id !== b.id; }))
	    .attr("class", "borders")
	    .attr("d", path);
	});
	  d3.json('tectonics.json', function(err, data) {
	    //Mapping the tectonic plate borders
	    svg.insert("path", ".graticule")
	    .datum(topojson.object(data, data.objects.tec))
	    .attr("class", "tectonic")
	    .attr("d", path);
	});		
});