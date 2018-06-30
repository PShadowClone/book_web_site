{{--<script>--}}
{{--const NEAREST_LIBRARIES = '{{route('web.library.nearest.locations')}}'--}}


{{--// Try HTML5 geolocation.--}}
{{--function handleLocationError(browserHasGeolocation, infoWindow, pos) {--}}
{{--infoWindow.setPosition(pos);--}}
{{--infoWindow.setContent(browserHasGeolocation ?--}}
{{--'Error: The Geolocation service failed.' :--}}
{{--'Error: Your browser doesn\'t support geolocation.');--}}
{{--infoWindow.open(map);--}}
{{--}--}}

{{--function initMap() {--}}
{{--map = new google.maps.Map(document.getElementById('map'), {--}}
{{--center: {lat: -34.397, lng: 150.644},--}}
{{--zoom: 6--}}
{{--});--}}
{{--infoWindow = new google.maps.InfoWindow;--}}

{{--// Try HTML5 geolocation.--}}
{{--if (navigator.geolocation) {--}}
{{--navigator.geolocation.getCurrentPosition(function (position) {--}}
{{--var pos = {--}}
{{--lat: position.coords.latitude,--}}
{{--lng: position.coords.longitude--}}
{{--};--}}
{{--console.log(pos)--}}

{{--infoWindow.setPosition(pos);--}}
{{--infoWindow.setContent('Location found.');--}}
{{--infoWindow.open(map);--}}
{{--map.setCenter(pos);--}}
{{--var current_location = {--}}
{{--lat: '{{LOCATION_LAT}}',--}}
{{--long: '{{LOCATION_LONG}}'--}}
{{--}--}}
{{--sendAjax(NEAREST_LIBRARIES, JSON.stringify(pos), GET, function (response) {--}}
{{--console.log(response)--}}
{{--if (response.status == 200) {--}}
{{--var locations = prepareLocations(response.data)--}}
{{--// Add some markers to the map.--}}
{{--// Note: The code uses the JavaScript Array.prototype.map() method to--}}
{{--// create an array of markers based on a given "locations" array.--}}
{{--// The map() method here has nothing to do with the Google Maps API.--}}
{{--var markers = locations.map(function (location, i) {--}}
{{--return new google.maps.Marker({--}}
{{--position: location,--}}
{{--label: labels[i % labels.length]--}}
{{--});--}}
{{--});--}}

{{--} else {--}}
{{--error('خطأ', response.message);--}}

{{--}--}}
{{--});--}}


{{--}, function () {--}}
{{--handleLocationError(true, infoWindow, map.getCenter());--}}
{{--});--}}
{{--} else {--}}
{{--// Browser doesn't support Geolocation--}}
{{--handleLocationError(false, infoWindow, map.getCenter());--}}
{{--}--}}

{{--}--}}

{{--function prepareLocations(locations) {--}}
{{--var preparedLocations = []--}}
{{--$.each(locations, function (key, value) {--}}
{{--preparedLocations.push({--}}
{{--lat: value.latitude,--}}
{{--lng: value.longitude--}}
{{--})--}}
{{--})--}}
{{--return preparedLocations;--}}

{{--}--}}
{{--</script>--}}
{{--<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">--}}
{{--</script>--}}
{{--<script async defer--}}
{{--src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&language={{app()->getLocale()}}&callback=initMap">--}}
{{--</script>--}}


<script>
    const NEAREST_LIBRARIES = '{{route('web.library.nearest.locations')}}'
    var map, infoWindow;

    function prepareLocations(locations) {
        var preparedLocations = []
        $.each(locations, function (key, value) {

            preparedLocations.push({
                lat: parseFloat(value.latitude),
                lng: parseFloat(value.longitude),
                title : value.name

            })
        })
        return preparedLocations;

    }

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: parseFloat('{{LOCATION_LAT}}'), lng: parseFloat('{{LOCATION_LONG}}')}
        });
        infoWindow = new google.maps.InfoWindow;
        // const marker = new google.maps.Marker({ map, position: initialPosition });

        var pos = {
            lat: parseFloat('{{LOCATION_LAT}}'),
            long: parseFloat('{{LOCATION_LONG}}')
        };
        checkGeolocationBrowserSupporting();


    }

    function checkGeolocationBrowserSupporting() {
        // Try HTML5 geolocation.

        console.log(navigator.geolocation)
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {

                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                console.log(pos)

                infoWindow.setPosition(pos);
                infoWindow.setContent('@lang('lang.web.current_location')');
                infoWindow.open(map);
                map.setCenter(pos);
                setMarkersAccoringToCurrentLocation(pos);
            }, function (failure) {
                if (failure.message.indexOf("Only secure origins are allowed") == 0) {
                    console.log("Only secure origins are allowed")
                }
                // error('خطأ', response.message);

                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // error('خطأ', response.message);

            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        {{--var pos = {--}}
        {{--lat: parseFloat('{{LOCATION_LAT}}'),--}}
        {{--long: parseFloat('{{LOCATION_LONG}}')--}}
        {{--};--}}

    }

    function setMarkersAccoringToCurrentLocation(pos) {
        sendAjax(NEAREST_LIBRARIES, JSON.stringify(pos), GET, function (response) {
            console.log(response)
            if (response.status == 200) {
                var locations = prepareLocations(response.data)

                // Create an array of alphabetical characters used to label the markers.
                var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                console.clear()
                console.log(locations)
                // Add some markers to the map.
                // Note: The code uses the JavaScript Array.prototype.map() method to
                // create an array of markers based on a given "locations" array.
                // The map() method here has nothing to do with the Google Maps API.
                var markers = locations.map(function (location, i) {
                    console.log(location)
                    return new google.maps.Marker({
                        position: location,
                        label: location.title
                    });
                });

                // Add a marker clusterer to manage the markers.
                var markerCluster = new MarkerClusterer(map, markers,
                    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

            } else {
                error('خطأ', response.message);

            }
        });

    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&language={{app()->getLocale()}}&callback=initMap">
</script>