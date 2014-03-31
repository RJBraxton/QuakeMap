//GENERAL NECESSITIES
var quakeanim; //Animation interval
var quakes; //Defined at start
var usgsURL; //Definition changes with each run
var animationOn = true; //Animation boolean
var grassOnTheField = false; //Is a visualization running?

//VISUALIZATION VARIABLES
var days = 7;
var sortBy = "magnitude";
var minMag = '4.5';
var maxMag = 10;
var limit = 10;

//ZOOM/PROJECTION
var projection = d3.geo.winkel3();
var oT = [0,0]; //Translate variable
var oS = 1; //Scale Variable

//SCALES
var radius = d3.scale.linear()
.domain([4.0,6.0,7.5,8.5,9.0])
.range([20,30,50,70,100]);

var frequency = d3.scale.linear()
.domain([600, 0])
.range([8500, 2000]);

var colorMagScale = d3.scale.linear()
.domain([2.0,4.5,7.5,8.5])
.range(["green","blue", "orange","red"]);

/*--------------- begin_removeQuakes --------------------------------------------------------------------------------------------------------------*/
function removeQuakes(){
  d3.selectAll(".quakes").remove();
  grassOnTheField = false;  
  clearInterval(quakeanim);
  d3.select(".s_mag")
    .text(' ')
  d3.select(".s_time")
    .text(' ')
  d3.select(".s_location")
    .text(' ')
  d3.select(".s_tsunami")
    .text(' ')
  d3.select(".total")
    .text('-');
  d3.select("#updated")
    .text('-');
  console.log("removequakes has been run");
}
/*--------------- end_removeQuakes --------------------------------------------------------------------------------------------------------------*/

/*--------------- begin_mapWorld --------------------------------------------------------------------------------------------------------------*/
function mapWorld(){
  
  //Defining zooming nonsense
  var zoom = d3.behavior.zoom();
  zoom.scaleExtent([1, 4])
    .on("zoom", redraw);
  function redraw() {
    var t = d3.event.translate;
    var s = d3.event.scale;
    t[0] = Math.min(50 * (s - 1), Math.max(1000 * (1 - s), t[0]));
    t[1] = Math.min(50 * (s - 1), Math.max(500 * (1 - s), t[1]));
    zoom.translate(t);

    svg.attr("transform", "translate(" + t + ")scale(" + s + ")");
    d3.selectAll(".quakes").attr("transform", "translate(" + t + ")scale(-599*" + s + ")");
    oT = t;
    oS = s;
  }

  var path = d3.geo.path()
    .projection(projection);
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
}
/*------------------------- end_mapWorld --------------------------------------------------------------------------------------------------------------*/
/*------------------------- begin_quakeMake --------------------------------------------------------------------------------------------------------------*/
function quakeMake(days,sortBy,minMag,limit){
  removeQuakes();
  console.log('Initiating quakeMake.');  

  if(grassOnTheField){
    console.log("ERROR: quakeMake was run while there was already a visualization in progress.");
  }
  else{
    grassOnTheField = true;
    var svg = d3.select("#map");
    
    //Actual QuakeMapping done here    
    d3.json(("http://www.corsproxy.com/comcat.cr.usgs.gov/fdsnws/event/1/query?starttime=NOW-" + days + " days&minmagnitude=" + minMag + "&maxmagnitude=" + maxMag + "&orderby=" + sortBy + "&limit=" + limit + "&format=geojson"), function(err, data) {
      d3.select("#updated").text("Last updated at " + moment().format("hh:mma"));
      var count = d3.select(".total")
      .text(data.metadata.count);


      quakes = svg.append("g")
      .attr("class", "quakes") 
      .selectAll(".quake")
      .data(data.features.reverse())
      .enter().append("g")
      .attr("class", "quake")
      .attr("transform", function(d) {return "translate(" + projection(d.geometry.coordinates)[0] + "," + projection(d.geometry.coordinates)[1] + ")";});
      quakeAnimate();

quakes.append("circle")
.attr("class","quakeStatic")
.attr("r", 1.5)
.style("stroke", function(d) {return colorMagScale(d.properties.mag);})          
.style("stroke-width", 0.75)
.on("click", function(d){ onClick(d);});

d3.selectAll(".quakes").attr("transform", "translate(" + oT + ")scale(" + oS + ")");

});

}

}
/*------------------------- end_quakeMake --------------------------------------------------------------------------------------------------------------*/

function quakeAnimate(){

  if(animationOn == true){

       quakeanim = setInterval(function() {  
        console.log('interval!');
        quakes.filter(function(d){ return d.properties.mag > 4.0;})
        .append("circle")
        .attr("class","quakeAnim")
        .attr("r", 0)
        .style("stroke", function(d) {return colorMagScale(d.properties.mag);  })          
        .style("stroke-width", 2)
        .on("click", function(d){ onClick(d);})
        .transition()
        .ease("circle")
        .duration(function(d) { return frequency(d.geometry.coordinates[2]); })
        .attr("r", function(d) { return radius(d.properties.mag); })
        .style("stroke-opacity", 0)
        .style("stroke-width", 0)
        .remove();
      }, 1000);
}    
}


function table(){

  
  d3.json("http://www.corsproxy.com/comcat.cr.usgs.gov/fdsnws/event/1/query?starttime=NOW-7days&orderby=magnitude&limit=5&format=geojson", function(err, data) {
    data = data.features;

   data.filter(function(d){ return d.properties.mag > 5.0;})
   .sort(function(a,b){ return d3.descending(a.properties.mag, b.properties.mag);})
   .forEach(function(d) {
    var current = d3.select("#tablebody").append("tr");
    current.append("td").text(moment(+d.properties.time).calendar());
    current.append("td").append("a").text(d.properties.place).attr("href",d.properties.url);
    current.append("td").text(d.properties.mag).style("color",colorMagScale(d.properties.mag));
    return true;
  });

 });

}

function onClick(d){
d3.select(".s_mag")
          .text("M" + d.properties.mag + " (" + d.geometry.coordinates[2] + "km) - ").style("color",colorMagScale(d.properties.mag))
          d3.select(".s_time")
          .text( moment(+d.properties.time).calendar())
          d3.select(".s_location")
          .text(d.properties.place + " - ")
          d3.select(".s_url")
          .attr("href",d.properties.url);
}