<script>
    function initMap() {
        var uluru = {lat: parseFloat('{{LOCATION_LAT}}'), lng: parseFloat('{{LOCATION_LONG}}')};
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

<script>
    /*
    *
    *         change cities according to chosen area
    *
    * */
    $('#area').change(function(){
        var id = $(this).val();
        $('#city > option').each(function(key , value){
            var option = $(this);
            var option_area = option.data('area');
            if(option_area != id && option.val() != '-1'){
                option.hide();
            }else{
                option.show();
            }
        })
        $('#city').selectpicker('refresh');
    })
    /*
  *
  *         change quarters according to chosen city
  *
  * */
    $('#city').change(function(){
        var id = $(this).val();
        $('#quarter > option').each(function(key , value){
            var option = $(this);
            var option_city = option.data('city');
            if(option_city != id && option.val() != '-1'){
                option.hide();
            }else{
                option.show();
            }
        })
        $('#quarter').selectpicker('refresh');
    })
</script>
<script>
    $('#cancel').click(function () {
        window.location = '{{route('library.show')}}';
    })
</script>
<script>

    // form validation
    $("#library").validate({
        rules: {
            name: {
                required: true,
                number: false,
            },
            phone: {
                required: true,
                number: true,
            },
            mobile: {
                required: true,
                number: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,

            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            address:{
                required:true
            },
            quarter:{
                required:true,
                min:1
            },
            inst_profit_rate:{
                required:true,
                min:1,
                max:100
            }
        },
        messages: {
            name: {
                required: "@lang('library.name_required')",
                number: "@lang('library.name_string')",


            },
            password: {
                required: "@lang('library.password_required')",
                minlength: "@lang('library.password_min')"
            },
            confirm_password: {
                required: "@lang('library.confirm_password_required')",
                equalTo : "@lang('library.confirm_password_required')"

            },
            email: {
                required: "@lang('library.email_required')",
                email: "@lang('library.email_email')"
            },
            phone:{
                required:"@lang('library.phone_required')",
                number:"@lang('library.phone_number')",
            },
            mobile:{
                required:"@lang('library.mobile_required')",
                number:"@lang('library.mobile_number')",
            },
            address:{
                required:"@lang('library.address_required')",
            },
            quarter:{
                required:"@lang('library.quarter_required')",
                min:"@lang('library.quarter_required')",
            },
            inst_profit_rate:{
                required:"@lang('library.inst_profit_rate_required')",
                min:"@lang('library.inst_profit_rate_min')",
                max:"@lang('library.inst_profit_rate_max')"
            }

        }
    });
</script>
