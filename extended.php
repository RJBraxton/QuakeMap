<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="http://zizhujy.com/Scripts/flot/navigationControl/jquery.flot.navigationControl.js"></script>
<body ng-app="quakemap" > <!-- ; loadModal();' -->
  <?php include 'header.php'; ?>

  
  

  <div class="container-fluid" ng-controller="Settings">
   <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <div class="btn-group" ng-switch on="animation">
          <button class="main btn btn-success" type="button" ng-click="generate()">Start</button>  
          <button  class="btn" ng-switch-when="true" ng-click="animationButton(animation)">
            Animation: <strong><text class="anim">On</text></strong>
          </button>
          <button  class="btn btn-inverse" ng-switch-when="false" ng-click="animationButton(animation)">
            Animation: <strong><text class="anim">Off</text></strong>
          </button>
          <button class="btn btn-danger" ng-click="remove()"><i class="icon-stop"></i></button>
        </div>   
        <br/>
        <button class="btn btn-info" data-toggle="modal" data-target="#helpModal">Help</button>         
        <hr class="style-cloud"/> 
        <div id="content">

          <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            <li><a href="#download" data-toggle="tab">Download</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="settings" >
              <input type="radio" ng-model="settings.orderby" value="magnitude">Largest </input>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" ng-model="settings.orderby" value="time">Most Recent </input>
              <br> 
            <br>Limit: <input class="input-mini" ng-model="settings.limit"></input>
            <br>Date Range (YYYY-MM-DD)
            <br> <input class="input-small" maxlength="10" ng-model="settings.starttime"></input> - <input class="input-small" maxlength="10" ng-model="settings.endtime"></input>  
            <br>Magnitude Range (M)
            <br> <input class="input-mini" maxlength="3" ng-model="settings.minmagnitude"></input> - <input class="input-mini" maxlength="3" ng-model="settings.maxmagnitude"></input>  
            <br>Depth Range (km)
            <br> <input class="input-mini" ng-model="settings.mindepth"></input> - <input class="input-mini"  ng-model="settings.maxdepth"></input>  
            <br>Latitude/Longitude (Square)
            <br> N: <input class="input-mini" ng-model="settings.maxlatitude"></input> S: <input class="input-mini" ng-model="settings.minlatitude"></input>
            <br> E: <input class="input-mini" ng-model="settings.maxlongitude"></input> W: <input class="input-mini" ng-model="settings.minlongitude"></input>
          </div>
          <div class="tab-pane" id="download">
          For further examination, raw data may be downloaded from USGS servers in the following formats:
            <ul>
            <li><a ng-href="{{urls.csv}}">CSV</a></li>
            <li><a ng-href="{{urls.geojson}}">GeoJSON</a></li>
            <li><a ng-href="{{urls.kml}}">KML</a></li>
            <li><a ng-href="{{urls.xml}}">XML</a></li>
          </ul>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="span9">
 <div class="well">
  <button class="btn btn-inverse disabled pull-left">{{window.count}}</button>
  <center>
    <a ng-href="{{window.url}}"><text ng-style="window.color">
    <font size="4">{{window.top}}</font>
  </text>
  </a>
  </center>
  <div>
    <center> 
      <div class="errorlog"> </div> 
      <svg id="map"width="960" height="500"
      viewBox="0 0 960 500"
      preserveAspectRatio="xMidYMid slice"></svg> </center></div>
      <div class="pull-left">
{{$root.coors}}
      </div>
      <center>
        {{window.lastUpdated}}
      </center>
    </div><!-- /Well -->
  </div><!--/span9-->
</div><!--/Container-->

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12 well">
    	<chart ng-model="data"></chart>
    </div>
  </div>
  <hr class="style-motif"/>

  <footer>
    <p>&copy; <a href="http://richardbraxton.org/bio/">Richard Braxton</a> 2013 
      <text class="pull-right">Sponsored by the <a href="http://www.smu.edu/engagedlearning">SMU Engaged Learning Grant</a> & Marr Research Fellowship</text></p>
      <p><h6>Created with <a href="http://angularjs.org/">Angular.js</a>, <a href="http://d3js.org/">D3.js</a>, <a href="http://momentjs.com/">Moment.js</a>, and <a href="http://getbootstrap.com/2.3.2/">Twitter Bootstrap</a></h6></p>
    </footer>

  </div><!--/.fluid-container-->

  <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><center>Help</center></h4>
      </div>
      <div class="modal-body">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QuakeMap Extended is a more 'full-bodied' variation of the original QuakeMap web application. With it, it is possible to visually navigate the USGS earthquake database to locate seismic activity within a very specific depth/magnitude/time frame. The analysis graph at the bottom also allows for tracking of trends in earthquake depth and magnitude.
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The menu on the left allows you to specify the details of your query. Pressing the Start button will map them, using the original QuakeMap scales to denote depth and magnitude.
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Magnitue is designated by color. <font color="#404096">M2.0</font>, <font color="#529DB7">M4.5</font>, <font color="#7DB874">M6.0</font>, <font color="#E39C37">M7.0</font>, and <font color="#D92120">M8.5</font>.
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Depth is shown with the speed of the radiating circles. Slower animations indicate earthquakes that occur at great depths, while faster ones indicate shallow depths.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-43225832-2', 'quake-map.com');
    ga('send', 'pageview');
    jQuery(document).ready(function ($) {
      $('#tabs').tab();
    });
    </script>
  </body>
  </html>	