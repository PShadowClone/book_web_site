<script>
    function initMap() {
        var uluru = {lat: parseFloat('{{$userRequest ? $userRequest->latitude : LOCATION_LAT}}'), lng: parseFloat('{{$userRequest ? $userRequest->longitude : LOCATION_LONG}}')};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });

        google.maps.event.addListener(map, 'click', function(event) {
            //Get the location that the user clicked.
            var clickedLocation = event.latLng;
            //If the marker hasn't been added.
            if(marker === false){
                //Create the marker.
                marker = new google.maps.Marker({
                    position: clickedLocation,
                    map: map,
                    draggable: true //make it draggable
                });
                //Listen for drag events!
                google.maps.event.addListener(marker, 'dragend', function(event){
                    markerLocation();
                });
            } else{
                //Marker has already been added, so just change its location.
                marker.setPosition(clickedLocation);
            }
            //Get the marker's location.
            markerLocation();
        });
        function markerLocation(){
            //Get location.
            var currentLocation = marker.getPosition();
            //Add lat and lng values to a field that we can save.
            document.getElementById('latitude').value = currentLocation.lat(); //latitude
            document.getElementById('longitude').value = currentLocation.lng(); //longitude
        }


    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&language={{app()->getLocale()}}&callback=initMap&">
</script>
