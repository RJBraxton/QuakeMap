<!DOCTYPE html>
<html lang="en">
<body onload='mapWorld(); table();'> <!-- ; loadModal();' -->
  <?php include 'header.php'; ?>
  <script src="earthquakes.js" type="text/javascript"></script>
  
  

      <div class="container-fluid">
       <div class="row-fluid">
          <!-- <div class="span2 well">
            <center>Scale</center>
            <p>
              <svg>
                <rect x="0" y="0" width="20" height="20" fill="green" onmouseover="this.call(bootstrap.tooltip().placement('right')) "/>
                <rect x="30" y="0" width="20" height="20" fill="blue"/>
                <rect x="60" y="0" width="20" height="20" fill="purple"/>
                <rect x="90" y="0" width="20" height="20" fill="orange"/>
                <rect x="120" y="0" width="20" height="20" fill="red"/>
              </svg>
              <a href="#" rel="tooltip" data-toggle="tooltip" title="" data-original-title="Default tooltip">you probably</a>

            </p>

          </div> -->
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

  <div class="accordion">
                <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#Instructions">
                      <strong>Instructions</strong>
                    </a>
                  </div>
                  <div id="Instructions" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                      <p>
                       QuakeMap is an earthquake visualization tool, allowing people to view earthquakes over the past year. It uses data from the <a href="http://www.usgs.gov/">USGS</a>, which updates every ~15 minutes.</p>
                       <p>With the prompt above, you may select what range of recent earthquakes to view. Details may be found in the menus below.
                       </p>
                      </p>
                    </div>
                  </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#two">
                      <strong>Magnitude</strong>
                    </a>
                  </div>
                  <div id="two" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                      <p>Magnitude is a number calculated to measure the relative size of an earthquake. Magnitude is calculated by seismographs across the globe, measuring the strength of waves as they travel away from their epicenter. Magnitude is shown by color and circle size:</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Green">M2.0+</font>: Slightly felt by some. No chance of damage.</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Blue">M4.5+</font>: Felt by most within range. Shaking of some objects, small potential for damage to poorly-constructed buildings.</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#805380">M6.0+</font>: Strong shaking, felt up to hundreds of miles away. Poorly-constructed buildings may collapse.</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Orange">M7.5+</font>: Damage to/collapse of most buildings; earthquake-resistent structures will also take heavy damage.</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Red">M8.5+</font>: High potential for certain destruction - permanent changes to the topography are made as a result. Populated areas near the epicenter are almost completely eliminated, death tolls are 1,000 at the very least.</p>
                      <p>
                        <i>The above descriptions are approximate.</i>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#three">
                      <strong>Depth</strong>
                    </a>
                  </div>
                  <div id="three" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner">
                      <p>Earthquakes may occur at many different depths within the earth - shallow earthquakes tend to be stronger than deep ones, as the shock waves are closer to the surface. Depth is shown by speed - deep earthquakes pulse slowly, while shallow ones pulse quickly.</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="span9">
         <div class="well">
          <button class="btn btn-inverse disabled pull-left"><text class="total">-</text></button>
          <center>
            <font size="4"><a class="s_url"><text class="s_mag" ></text><text class="s_location"></text><text class="s_time"></text></a></font>
          </center>
          


          <div>
          <center> 
            <svg id="map"width="960" height="500"
            viewBox="0 0 960 500"
            preserveAspectRatio="xMidYMid slice"></svg> </center></div>
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
            <p><h6>Created with <a href="http://d3js.org/">D3.js</a>, <a href="http://momentjs.com/">Moment.js</a>, and <a href="http://getbootstrap.com/2.3.2/">Twitter Bootstrap</a></h6></p>
          </footer>

        </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery-1.9.1.js"></script>
    <script src="./assets/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43225832-2', 'quake-map.com');
  ga('send', 'pageview');
  $('.dropdown-toggle').dropdown();


</script>
  </body>
  </html>