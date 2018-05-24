<?php
session_start();
if(!isset($_SESSION['Username']))
{
  header("Location: loginform.php");
  exit;
}
?>

    <!DOCTYPE html>
  <html>
    <head>
      <style>
        #map {
          width: 100%;
          height: 650px;
          background-color: grey;
        }
      </style>
    </head>
    <body>
      <!-- <h3>My Google Maps Demo</h3> -->
      <center>
      <div style="position:absolute;float:right;top:50px;right:50px;z-index:100">
        <a href="logout.php"><button>LogOut</button></a>
      </div>
      <div id="map"></div>
      <script
  			  src="https://code.jquery.com/jquery-3.3.1.min.js"
  			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
      <script>
        <?php
          include 'connect.inc.php';
          $result = mysql_query("SELECT `lat`, `lng` FROM `loc_table` WHERE 1");
          $data =[];
          for($i=0;$row=mysql_fetch_array($result);$i++)
          {
            $data[$i]['lat']=$row['lat'];
            $data[$i]['lng']=$row['lng'];
          }
         ?>
        var geoArr = <?php echo json_encode($data);?>;

        for(var i=0;i<geoArr.length;i++)
        {
          //console.log(parseFloat(geoArr[i]['lat']));
          geoArr[i].lat = parseFloat(geoArr[i].lat);
          geoArr[i].lng = parseFloat(geoArr[i].lng);
        }
        //console.log(geoArr);
        //var geoArr = [{lat: 17.445388, lng: 78.348230},{lat: 17.4458, lng: 78.4}]
        var markers = [];
        var map;
        var marker;
        function initMap() {
          var tester = {lat: 17.445388, lng: 78.348230};
          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: tester
          });
          google.maps.event.addListener(map,'click',function(event) {
              console.log('test');
              placeMarker(event.latLng,true);
          });
  	      for(var i=0;i < geoArr.length;i++){
            console.log({lat:geoArr[i].lat,lng:geoArr[i].lng});
            placeMarker(new google.maps.LatLng(geoArr[i].lat, geoArr[i].lng),false);
  	      }
        }

        function placeMarker(location,insert) {
          console.log("lat:"+location.lat)
    	      var  marker = new google.maps.Marker({
    		     position: location,
    		     map: map
           });
           if(insert)
           {
             $.ajax({
               url: "./insert.php",
               method: 'POST',
               data:{lat:location.lat(),lng:location.lng()}
              }).done(function(resp) {
                alert('Location saved successfully!');
              });
           }
        }
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_hczzkDef_TYPjloz-fPRel6mkIfDhqo&callback=initMap">
      </script>
      </center>
    </body>
  </html>
