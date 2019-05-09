<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <title>Gallery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google web fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />


        <!-- The main CSS file -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    </head>

    <body>

        <div id="map"></div>

        
        <!-- JavaScript Includes -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        

	<script>

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: <?=$image['lattitude'];?>, lng: <?=$image['longitude'];?>},
          mapTypeId: 'terrain'
        });

         var contentString = '<div><img style="height:100px;width:150px;" src="<?php echo base_url() ?>uploads/<?php echo $image['image_name']; ?>" /></div>';

         var infowindow = new google.maps.InfoWindow({
			    content: contentString
			  });

        var uluru = {lat: <?=$image['lattitude'];?>, lng: <?=$image['longitude'];?>};
        var marker = new google.maps.Marker({position: uluru, map: map});

        marker.addListener('mouseover', function() {
		    infowindow.open(map, marker);
		});
		marker.addListener('mouseout', function() {
		    infowindow.close();
		});

      
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnSuXiQiqR9-J-4v3Exc95VyPjqCTq4ns&callback=initMap">
    </script>
    </body>
</html>