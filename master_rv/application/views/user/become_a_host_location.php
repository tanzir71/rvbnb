
<script src="<?php echo base_url() ?>assets/js/jquery.geocomplete.js"></script>


<?php include_once'widget.php'; ?>

<div class="home-directory">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="innerWrapper clearfix stepsPage">
                    <div class="row progress-wizard" style="border-bottom:0;">
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">User Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">Location Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_location" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step disabled">
                            <div class="text-center progress-wizard-stepnum">Host Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_info" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step disabled">
                            <div class="text-center progress-wizard-stepnum">Review</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_review" class="progress-wizard-dot"></a>
                        </div>
                    </div>
                    <form class="row" method="POST" action="<?php echo base_url(); ?>user/host_step_two">
                        

                        <div class="col-xs-12">
                            <div class="page-header">
                                <h4>Host Location Information <code><span class="required_m">*</span>required</code></h4> 
                            </div>
                        </div>

                        <div class="form-group col-sm-12 col-xs-12">
                          <code>Note: Select location on map to automatically fill-up fields.</code>
                          <div id="map_canvas" style="height: 400px"></div>
                        </div>

                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Country</label> <span class="required_m">*</span>
                            <input type="hidden" name="host_id" value="<?php echo $host_data->id; ?>">
                            <input class="form-control" name="country" type="text" id="countries" value="<?php echo $host_data->country; ?>"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>State</label> <span class="required_m">*</span>
                            <input class="form-control" name="state" type="text" id="search_state" value="<?php echo $host_data->state; ?>"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>City</label> <span class="required_m">*</span>
                            <input class="form-control" name="city" type="text" id="search_city" value="<?php echo $host_data->city; ?>"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>County/Borough</label> <span class="badge">optional</span>
                            <input class="form-control" name="borough" type="text" id="search_borough" value="<?php echo $host_data->borough; ?>"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Street Location</label> <span class="required_m">*</span>
                            <input class="form-control" name="street" type="text" id="street" value="<?php echo $host_data->location; ?>" required="1">
                            <input name="location" type="hidden" name="location" id="address" value="<?php echo $host_data->location; ?>">
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>ZIP</label> <span class="required_m">*</span>
                            <input class="form-control" name="zip" id="zip" value="<?php echo $host_data->zip; ?>" type="number"> 
                        </div>

                        <input type="hidden" name="lat" id="lat" size="10" value="<?php echo $host_data->lat ?>">
                        <input type="hidden" name="lng" id="lng" size="10" value="<?php echo $host_data->lng ?>">

                        


                        <div class="col-xs-12">
                            <div class="well well-lg clearfix">
                                <ul class="pagers">
                                    <li class="previous pull-left"><a href="<?php echo base_url(); ?>user/profile" class="hideContent btn btn-default">Back</a></li>
                                   <li class="next pull-right"><button type="submit" style="margin-left: 10px" class="btn btn-default">Update &amp; Continue</button></li>


                                    <li class="previous pull-right"><a href="<?php echo base_url(); ?>user/become_a_host_info" class="btn btn-default">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="text" id="search_map" placeholder="search area" class="form-control">
<script src="http://maps.googleapis.com/maps/api/js??key=AIzaSyCKf3D0CKv98W_EGTk5QfKANDh0CZuAlNc&amp;libraries=places"></script>
<script>
    var map;
    var geocoder;

      function initAutocomplete_sohel() {
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
          center: {lat: 36.1848607, lng: -95.9798563},
          zoom: 4,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.

        var input = document.getElementById('search_map');


        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location,
              zoom: 18
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        }); //end of auto search



        geocoder = new google.maps.Geocoder();
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });

        var marker;
        function placeMarker(location) {
            if(marker){ //on vérifie si le marqueur existe
                marker.setPosition(location); //on change sa position
            }else{
                marker = new google.maps.Marker({ //on créé le marqueur
                    position: location, 
                    map: map
                });
            }
            document.getElementById('lat').value=location.lat();
            document.getElementById('lng').value=location.lng();
            getAddress(location);
        }

        function getAddress(latLng) {
          geocoder.geocode( {'latLng': latLng},
          function(results, status) {
              if(status == google.maps.GeocoderStatus.OK) {
                if(results[0]) {
                  document.getElementById("address").value = results[0].formatted_address;

                  var get_address = results[0].formatted_address;

                  var explode = get_address.split(",");

                  var get_street = explode[0]; //street
                  var get_city = explode[1]; //city
                  var state_city = explode[2];
                  var get_country = explode[3]; //country

                  var state_city_explode = state_city.split(" ");

                  var get_state = state_city_explode[1]; //state
                  var get_zip = state_city_explode[2]; //zip


                  $("#countries").val(get_country);
                  $("#search_state").val(get_state);
                  $("#search_city").val(get_city);
                  $("#zip").val(get_zip);
                  $("#street").val(get_street);
                  //alert(get_zip);
                }
                else {
                  document.getElementById("address").value = "No results";
                }
              }
              else {
                document.getElementById("address").value = status;
              }
            });
        }//end 

      }
      google.maps.event.addDomListener(window, 'load', initAutocomplete_sohel);




    </script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKf3D0CKv98W_EGTk5QfKANDh0CZuAlNc&amp;libraries=places&callback=initMap" async defer></script>