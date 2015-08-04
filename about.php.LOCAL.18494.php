	
<!DOCTYPE html>
<html lang="en">
<body onload='mapWorld(); table();'> <!-- ; loadModal();' -->
  <?php include 'header.php'; ?>
      <div class="container-fluid">
       <div class="row-fluid">
          <div class="span4 well">
            <legend>QuakeMap</legend>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QuakeMap was created in an effort to combine my two college degree plans of both Geology and Creative Computing. The goal of the visualization is to increase awareness of earthquakes throughout the world and incite interest in our planet. However, it was equally important that the visualization be readable/usable by people who are not seismologists/geologists, and that has hopefully been achieved.
              <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QuakeMap can be used extensively as a teaching tool, or a way to simply monitor seismic activity worldwide at a basic level and large scale.
              <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The visualization was programmed in JavaScript using <a href="http://d3js.org/">D3.js</a>, <a href="http://momentjs.com/">Moment.js</a>, and <a href="http://getbootstrap.com/2.3.2/">Twitter Bootstrap</a> (V2.3.2). The data is gathered from the <a href="http://earthquake.usgs.gov/">USGS Earthquake Hazards Program</a>. The map projection is the Winkel Tripel. 
              <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If you have any questions, feel free to email me!
          </div> <!-- span4 -->
          <div class="span4 well">
            <legend>Richard Braxton (the creator)</legend>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Richard Braxton is a student of Southern Methodist University studying Geology and Creative Computing. In his free time, he is a self-taught organist and enjoys cooking and travel.
            <br><br><b>Contact:</b>
            <br><a href="http://www.braxton.one/">Personal Website</a>
            <br><a href="mailto:richard@braxton.one">Email</a> 
          </div>
      </div><!-- /Row -->
    </div><!--/Container-->

      <div class="container-fluid">
        <hr class="style-motif"/>

        <footer>
          <p>&copy; <a href="http://richardbraxton.org/bio/">Richard Braxton</a> 2013
            <text class="pull-right">Sponsored by the <a href="http://www.smu.edu/engagedlearning">SMU Engaged Learning Grant</a> & Marr Research Fellowship</text></p>
            <p><h6>Created with <a href="http://angularjs.org/">Angular.js</a>, <a href="http://d3js.org/">D3.js</a>, <a href="http://momentjs.com/">Moment.js</a>, and <a href="http://getbootstrap.com/2.3.2/">Twitter Bootstrap</a></h6></p>
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

</script>
  </body>
  </html>