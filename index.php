<!DOCTYPE html>
<html lang="en">
<body onload='mapWorld(); table();'> <!-- ; loadModal();' -->
  <?php include 'header.php'; ?>
  <script src="earthquakes.js" type="text/javascript"></script>
  
  

<<<<<<< HEAD
  <div class="container-fluid">
   <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <div class="btn-group">
          <button class="main btn btn-success" type="button" onclick='mainButton()'>Start</button>  
          <button type="button" id="animbtn" class="animbtn  btn" data-toggle="button" onclick='animToggle()'>
            Animation: <strong><text class="anim">On</text></strong>
          </button>
          <button class="btn btn-danger" onclick="removeQuakes()"><i class="icon-stop"></i></button>
        </div>          
        <hr class="style-cloud"/>

        <div>
          Show the
          <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_limit">10</text> <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a onclick="limit=1; d3.select('#t_limit').text(limit)">1</a></li>
              <li><a onclick="limit=5; d3.select('#t_limit').text(limit)">5</a></li>
              <li><a onclick="limit=10; d3.select('#t_limit').text(limit)">10</a></li>
              <li><a onclick="limit=25; d3.select('#t_limit').text(limit)">25</a></li>
              <li><a onclick="limit=50; d3.select('#t_limit').text(limit)">50</a></li>
              <li><a onclick="limit=100; d3.select('#t_limit').text(limit)">100</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_sort">biggest</text> <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a onclick="sortBy='magnitude'; d3.select('#t_sort').text('biggest')">Biggest</a></li>
              <li><a onclick="sortBy='time'; d3.select('#t_sort').text('most recent')">Most Recent</a></li>
            </ul>
          </div>

          earthquakes from the past
          <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_time">week</text> <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a onclick="days=1; d3.select('#t_time').text('day')">Day</a></li>
              <li><a onclick="days=2; d3.select('#t_time').text('2 days')">2 Days</a></li>
              <li><a onclick="days=3; d3.select('#t_time').text('3 days')">3 Days</a></li>
              <li><a onclick="days=7; d3.select('#t_time').text('week')">Week</a></li>
              <li><a onclick="days=31; d3.select('#t_time').text('month')">Month</a></li>
              <li><a onclick="days=365; d3.select('#t_time').text('year')">Year</a></li>

            </ul>
          </div>.
          <br>(
          <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_mag">M4.5+</text> <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a onclick="minMag=-1.0; maxMag=10; d3.select('#t_mag').text('All Magnitudes')">All Quakes</a></li>
              <li><a onclick="minMag=-1.0; maxMag=2.5; d3.select('#t_mag').text('Micrquakes Only')">Microquakes(M-1.0-2.5)</a></li>
              <li><a onclick="minMag=2.5; maxMag=4.5; d3.select('#t_mag').text('Small Quakes Only')">Small Quakes (M2.5-4.5)</a></li>
              <li><a onclick="minMag=4.5; maxMag=10; d3.select('#t_mag').text('M4.5+')">M4.5+</a></li>
              <li><a onclick="minMag=6.5; maxMag=10; d3.select('#t_mag').text('M6.5+')">M6.5+</a></li>
            </ul>
          </div>)
        </div>
      </div>
    </div>

    <div class="span9">
     <div class="well">
      <button class="btn btn-inverse disabled pull-left"><text class="total">-</text></button>
      <center>
        <font size="4"><a class="s_url"><text class="s_mag" ></text><text class="s_location"></text><text class="s_time"></text></a></font>
      </center>



      <div style="position:relative">
        <center> 
          <svg id="map"
          viewBox="0 0 960 500"
          preserveAspectRatio=" xMidyMid slice"
          ></svg> </center></div>
          <p class="text-center">
            <text id="updated"></text>
          </p>
        </div><!-- /Well -->
      </div><!--/span9-->
    </div><!--/Container-->
  </div>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="well">
          <h1><center>Recent Significant Earthquakes</center></h1>
          <table class="table" id="table">
            <thead>
              <tr>
                <th>Time</th>
                <th>Location</th>
                <th>Magnitude</th>
              </tr>
            </thead>
            <tbody id="tablebody">

            </tbody>
          </table>
        </div>


      </div>
    </div>



    <hr class="style-motif"/>

  <div class="row-fluid">
    <div class="well">
      <h4 class="modal-title" id="myModalLabel"><center>Instructions</center></h4>
          <div class="modal-body">
            QuakeMap is an earthquake visualization tool, allowing people to view earthquakes over the past year. It uses data from the <a href="http://www.usgs.gov/">USGS</a>, which updates every ~15 minutes.</p>
            <p>With the prompt menu along the left side, you may select what range of recent earthquakes to view. Details may be found below.
             <br> <h4>Magnitude</h4>
             <p> Each earthquake on the map is represented by a radiating circle. The color of the circle indicates the range in the magnitude of the event. 
             <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="green" stroke-width="0.75" /> </circle></svg> M2.0-M4.5 (Green)</p>
             <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="blue" stroke-width="0.75" /> </circle></svg> M4.5-M7.5 (Blue)</p>
              <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="orange" stroke-width="0.75" /> </circle></svg> M7.0-M8.5 (Orange)</p>
              <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="red" stroke-width="0.75" /> </circle></svg> M8.5+ (Red)</p>
            </p>
            <h4>Depth</h4>
            <p>The speed of the circle's animation indicates the depth - slowly radiating circles occur deep below the surface (500km+), and fast ones being shallow. Individual quakes can be clicked to display detailed information, and the map can also be zoomed/panned.</p>
            <p>From the menu along the top of the page, QuakeMap can be switched between Basic and Extended Mode. Extended Mode allows for searches to specify exact dates, magnitude and depth ranges, and location (latitudinal + longitudinal range). Below the visualization in Extended Mode, there is a chart that plots all results based on time and depth, which can help with tracking patterns and aftershocks between earthquakes that occur small areas.</p>
          </div>
    </div>
  </div>

    <footer>
      <p>&copy; <a href="http://richardbraxton.org/bio/">Richard Braxton</a> 2013
        <text class="pull-right">Sponsored by the <a href="http://www.smu.edu/engagedlearning">SMU Engaged Learning Grant</a> & Marr Research Fellowship</text></p>
        <p><h6>Created with <a href="http://angularjs.org/">Angular.js</a>, <a href="http://d3js.org/">D3.js</a>, <a href="http://momentjs.com/">Moment.js</a>, and <a href="http://getbootstrap.com/2.3.2/">Twitter Bootstrap</a></h6></p>
      </footer>

    </div><!--/.fluid-container-->
            
            

=======
      <div class="container-fluid">
       <div class="row-fluid">
          <div class="span3">
            <div class="well">
              <div class="btn-group">
                <button class="main btn btn-success" type="button" onclick='mainButton()'>Start</button>  
            <button type="button" id="animbtn" class="animbtn  btn" data-toggle="button" onclick='animToggle()'>
              Animation: <strong><text class="anim">On</text></strong>
            </button>
            <button class="btn btn-danger" onclick="removeQuakes()"><i class="icon-stop"></i></button>
          </div>          
          <hr class="style-cloud"/>

              <div>
              Show the
              <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_limit">10</text> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a onclick="limit=1; d3.select('#t_limit').text(limit)">1</a></li>
                  <li><a onclick="limit=5; d3.select('#t_limit').text(limit)">5</a></li>
                  <li><a onclick="limit=10; d3.select('#t_limit').text(limit)">10</a></li>
                  <li><a onclick="limit=25; d3.select('#t_limit').text(limit)">25</a></li>
                  <li><a onclick="limit=50; d3.select('#t_limit').text(limit)">50</a></li>
                  <li><a onclick="limit=100; d3.select('#t_limit').text(limit)">100</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_sort">biggest</text> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a onclick="sortBy='magnitude'; d3.select('#t_sort').text('biggest')">Biggest</a></li>
                  <li><a onclick="sortBy='time'; d3.select('#t_sort').text('most recent')">Most Recent</a></li>
                </ul>
              </div>

              earthquakes from the past
              <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_time">week</text> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a onclick="days=1; d3.select('#t_time').text('day')">Day</a></li>
                  <li><a onclick="days=2; d3.select('#t_time').text('2 days')">2 Days</a></li>
                  <li><a onclick="days=3; d3.select('#t_time').text('3 days')">3 Days</a></li>
                  <li><a onclick="days=7; d3.select('#t_time').text('week')">Week</a></li>
                  <li><a onclick="days=31; d3.select('#t_time').text('month')">Month</a></li>
                  <li><a onclick="days=365; d3.select('#t_time').text('year')">Year</a></li>

                </ul>
              </div>.
              <br>(
              <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><text id="t_mag">M4.5+</text> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a onclick="minMag=-1.0; maxMag=10; d3.select('#t_mag').text('All Magnitudes')">All Quakes</a></li>
                  <li><a onclick="minMag=-1.0; maxMag=2.5; d3.select('#t_mag').text('Micrquakes Only')">Microquakes(M-1.0-2.5)</a></li>
                  <li><a onclick="minMag=2.5; maxMag=4.5; d3.select('#t_mag').text('Small Quakes Only')">Small Quakes (M2.5-4.5)</a></li>
                  <li><a onclick="minMag=4.5; maxMag=10; d3.select('#t_mag').text('M4.5+')">M4.5+</a></li>
                  <li><a onclick="minMag=6.5; maxMag=10; d3.select('#t_mag').text('M6.5+')">M6.5+</a></li>
                </ul>
              </div>)
           </div>
           <hr class="style-cloud"/>
           <button class="btn btn-large btn-info" data-toggle="modal" data-target="#instructions">Instructions</button>         
          </div>
        </div>

        <div class="span9">
         <div class="well">
          <button class="btn btn-inverse disabled pull-left"><text class="total">-</text></button>
          <center>
            <font size="4"><a class="s_url"><text class="s_mag" ></text><text class="s_location"></text><text class="s_time"></text></a></font>
          </center>
          


          <div style="position:relative">
          <center> 
            <svg id="map"
            viewBox="0 0 960 500"
            preserveAspectRatio=" xMidyMid slice"
            ></svg> </center></div>
            <p class="text-center">
              <text id="updated"></text>
            </p>
          </div><!-- /Well -->
        </div><!--/span9-->
      </div><!--/Container-->
    </div>

      <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="well">
            <h1><center>Recent Significant Earthquakes</center></h1>
            <table class="table" id="table">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Location</th>
                  <th>Magnitude</th>
                </tr>
              </thead>
              <tbody id="tablebody">

              </tbody>
            </table>
          </div>

          
        </div>
      </div>



        <hr class="style-motif"/>

        <footer>
          <p>&copy; <a href="http://richardbraxton.org/bio/">Richard Braxton</a> 2013
            <text class="pull-right">Sponsored by the <a href="http://www.smu.edu/engagedlearning">SMU Engaged Learning Grant</a> & Marr Research Fellowship</text></p>
            <p><h6>Created with <a href="http://angularjs.org/">Angular.js</a>, <a href="http://d3js.org/">D3.js</a>, <a href="http://momentjs.com/">Moment.js</a>, and <a href="http://getbootstrap.com/2.3.2/">Twitter Bootstrap</a></h6></p>
          </footer>

        </div><!--/.fluid-container-->
        <div class="modal fade" id="instructions" tabindex="12" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><center>Instructions</center></h4>
      </div>
      <div class="modal-body">
        QuakeMap is an earthquake visualization tool, allowing people to view earthquakes over the past year. It uses data from the <a href="http://www.usgs.gov/">USGS</a>, which updates every ~15 minutes.</p>
                       <p>With the prompt menu along the left side, you may select what range of recent earthquakes to view. Details may be found below.
                       <br> <h4>Magnitude</h4>
                       <p> Each earthquake on the map is represented by a radiating circle. The color of the circle indicates the range in the magnitude of the event. 
                      <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="green" stroke-width="0.75" /> </svg> M2.0-M4.5 (Green)</p>
                      <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="blue" stroke-width="0.75" /> </svg> M4.5-M7.5 (Blue)</p>
                      <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="orange" stroke-width="0.75" /> </svg> M7.0-M8.5 (Orange)</p>
                      <p><svg width="20" height="20"> <circle cx="10" cy="10" r='5' fill="transparent" stroke="red" stroke-width="0.75" /> </svg> M8.5+ (Red)</p>
                       </p>
                      <h4>Depth</h4>
                      <p>The speed of the circle's animation indicates the depth - slowly radiating circles occur deep below the surface (500km+), and fast ones being shallow. Individual quakes can be clicked to display detailed information, and the map can also be zoomed/panned.</p>
                      <p>From the menu along the top of the page, QuakeMap can be switched between Basic and Extended Mode. Extended Mode allows for searches to specify exact dates, magnitude and depth ranges, and location (latitudinal + longitudinal range). Below the visualization in Extended Mode, there is a chart that plots all results based on time and depth, which can help with tracking patterns and aftershocks between earthquakes that occur small areas.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
>>>>>>> 551392bab2046ba16d58b21451c1f0cec8fdbc3b

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery-1.9.1.js"></script>
    <script src="./assets/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
<<<<<<< HEAD
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-43225832-2', 'quake-map.com');
      ga('send', 'pageview');
      $('.dropdown-toggle').dropdown();


    </script>
=======
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43225832-2', 'quake-map.com');
  ga('send', 'pageview');
  $('.dropdown-toggle').dropdown();


</script>
>>>>>>> 551392bab2046ba16d58b21451c1f0cec8fdbc3b
  </body>
  </html>