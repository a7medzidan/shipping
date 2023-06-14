<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('orders.update',$order->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="trader_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">التاجر</span>
            </label>
            <!--end::Label-->
            <select class="form-control" name="trader_id" id="trader_id">
                <option selected disabled>اختر التاجر</option>
                @foreach($traders as $trader)
                    <option @if($order->trader_id == $trader->id) selected  @endif value="{{$trader->id}}">{{$trader->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="province_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">المحافظة</span>
            </label>
            <!--end::Label-->
            <select class="form-control" name="province_id" id="province_id">
                <option selected disabled>اختر المحافظة</option>
                @foreach($provinces as $province)
                    <option @if($order->province_id==$province->id) selected  @endif value="{{$province->id}}">{{$province->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="customer_name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">اسم العميل</span>
            </label>
            <!--end::Label-->
            <input type="text" id="customer_name" name="customer_name" class="form-control" value="{{$order->customer_name}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="customer_phone" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">هاتف العميل</span>
            </label>
            <!--end::Label-->
            <input type="number" id="customer_phone" name="customer_phone" class="form-control" value="{{$order->customer_phone}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="delivery_time" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> وقت التسليم</span>
            </label>
            <!--end::Label-->
            <input type="datetime-local" id="delivery_time" name="delivery_time" class="form-control" value="{{$order->delivery_time}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="shipment_pieces_number" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> عدد القطع داخل الشحنة</span>
            </label>
            <!--end::Label-->
            <input type="number" min="1" id="shipment_pieces_number" name="shipment_pieces_number" class="form-control" value="{{$order->shipment_pieces_number}}">
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="shipment_value" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">    قيمة الشحنة</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" id="shipment_value" name="shipment_value" class="form-control" value="{{$order->shipment_value}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="delivery_value" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">    قيمة التوصيل</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" id="delivery_value" name="delivery_value" class="form-control" value="{{$order->delivery_value}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="delivery_ratio" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">     نسبة المندوب</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" max="100" id="delivery_ratio" name="delivery_ratio" class="form-control" value="{{$order->delivery_ratio}}">
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="customer_address" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">عنوان العميل</span>
            </label>
            <textarea  name="customer_address" id="customer_address" rows="5" class="form-control"
                       placeholder=" اكتب هنا ">{{$order->customer_address}}</textarea>
        </div>

        <div class="map">

            <input type="hidden" value="{{$order->latitude}}" name="latitude" id="latitude">
            <input type="hidden" value="{{$order->longitude}}" name="longitude" id="longitude">
            <div class="col-md-12 ps-lg-10">
                <!--begin::Map-->
                <input type="text"  value="{{$order->address}}" name="address" id="pac-input">
                <div id="map" style="height: 400px;width: 100%;"></div>
            </div>

            <script>
                $("#pac-input").focusin(function () {
                    // $(this).val('');
                });


                function initAutocomplete() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: {{$order->latitude??23.8859}}, lng: {{$order->longitude??45.0792}},
                            zoom: 13,
                            mapTypeId: 'roadmap'
                        }});
                    // move pin and current location
                    infoWindow = new google.maps.InfoWindow;
                    geocoder = new google.maps.Geocoder();
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            var pos = {

                                lat: {{$order->latitude??23.8859}},
                                lng: {{$order->longitude??45.0792}}
                            };
                            map.setCenter(pos);
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(pos),
                                map: map,
                                title: '{{trans('admin.Your current location')}}'
                            });
                            markers.push(marker);
                            marker.addListener('click', function () {
                                geocodeLatLng(geocoder, map, infoWindow, marker);
                            });
                            // to get current position address on load
                            google.maps.event.trigger(marker, 'click');
                        }, function () {
                            handleLocationError(true, infoWindow, map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        console.log('Browser does not support Geolocation');
                        handleLocationError(false, infoWindow, map.getCenter());
                    }
                    var geocoder = new google.maps.Geocoder();
                    google.maps.event.addListener(map, 'click', function (event) {
                        SelectedLatLng = event.latLng;
                        geocoder.geocode({
                            'latLng': event.latLng
                        }, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    deleteMarkers();
                                    addMarkerRunTime(event.latLng);
                                    SelectedLocation = results[0].formatted_address;
                                    console.log(results[0].formatted_address);
                                    splitLatLng(String(event.latLng));
                                    $("#pac-input").val(results[0].formatted_address);
                                }
                            }
                        });
                    });

                    function geocodeLatLng(geocoder, map, infowindow, markerCurrent) {
                        var latlng = {
                            lat: markerCurrent.position.lat(),
                            lng: markerCurrent.position.lng()
                        };
                        /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                        $('#latitude').val(markerCurrent.position.lat());
                        $('#longitude').val(markerCurrent.position.lng());
                        geocoder.geocode({'location': latlng}, function (results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    map.setZoom(8);
                                    var marker = new google.maps.Marker({
                                        position: latlng,
                                        map: map
                                    });
                                    markers.push(marker);
                                    infowindow.setContent(results[0].formatted_address);
                                    SelectedLocation = results[0].formatted_address;
                                    $("#pac-input").val(results[0].formatted_address);
                                    infowindow.open(map, marker);
                                } else {
                                    window.alert('No results found');
                                }
                            } else {
                                window.alert('Geocoder failed due to: ' + status);
                            }
                        });
                        SelectedLatLng = (markerCurrent.position.lat(), markerCurrent.position.lng());
                    }

                    function addMarkerRunTime(location) {
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map
                        });
                        markers.push(marker);
                    }

                    function setMapOnAll(map) {
                        for (var i = 0; i < markers.length; i++) {
                            markers[i].setMap(map);
                        }
                    }

                    function clearMarkers() {
                        setMapOnAll(null);
                    }

                    function deleteMarkers() {
                        clearMarkers();
                        markers = [];
                    }

                    // Create the search box and link it to the UI element.
                    var input = document.getElementById('pac-input');
                    // $("#pac-input").val("أبحث هنا ");
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener('bounds_changed', function () {
                        searchBox.setBounds(map.getBounds());
                    });
                    var markers = [];
                    // Listen for the event fired when the user selects a prediction and retrieve
                    // more details for that place.
                    searchBox.addListener('places_changed', function () {
                        var places = searchBox.getPlaces();
                        if (places.length == 0) {
                            return;
                        }
                        // Clear out the old markers.
                        markers.forEach(function (marker) {
                            marker.setMap(null);
                        });
                        markers = [];
                        // For each place, get the icon, name and location.
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function (place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }
                            var icon = {
                                url: place.icon,
                                size: new google.maps.Size(100, 100),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                            };
                            // Create a marker for each place.
                            markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                            }));
                            $('#latitude').val(place.geometry.location.lat());
                            $('#longitude').val(place.geometry.location.lng());
                            if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        map.fitBounds(bounds);
                    });
                }

                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map);
                }

                function splitLatLng(latLng) {
                    var newString = latLng.substring(0, latLng.length - 1);
                    var newString2 = newString.substring(1);
                    var trainindIdArray = newString2.split(',');
                    var lat = trainindIdArray[0];
                    var Lng = trainindIdArray[1];
                    $("#latitude").val(lat);
                    $("#longitude").val(Lng);
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK34ZyoH4758BkVP05-GxKP0dSmBi4yTo&libraries=places&callback=initAutocomplete&language=ar&region=EG
async defer"></script>
        </div>




        <button id="addDetails" class="btn btn-primary">اضافة  تفاصيل</button>



    </div>


    <div class="row g-4" id="details-container">

        @foreach(\App\Models\OrderDetails::where('order_id',$order->id)->get() as $details)

            <div id="{{$details->id}}" class="d-flex justify-content-between">

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="product_name-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">اسم المنتج</span>
                    </label>
                    <!--end::Label-->
                    <input id="product_name-{{$details->id}}" required type="text" class="form-control form-control-solid" placeholder=" " name="product_name[]" value="{{$details->product_name}}"/>
                </div>


                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="count-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> الكمية</span>
                    </label>
                    <!--end::Label-->
                    <input id="count-{{$details->id}}" required type="number" class="form-control form-control-solid" placeholder=" " name="count[]" value="{{$details->count}}"/>
                </div>


                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="weight-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> الوزن </span>
                    </label>
                    <!--end::Label-->
                    <input id="weight-{{$details->id}}" required type="number" class="form-control form-control-solid" placeholder=" " name="weight[]" value="{{$details->weight}}"/>
                </div>






                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="details-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> التفاصيل</span>
                    </label>
                    <!--end::Label-->
                    <input id="details-{{$details->id}}" required type="text" class="form-control form-control-solid" placeholder=" " name="details[]" value="{{$details->details}}"/>
                </div>




                <div style="cursor: pointer" data-id="{{$details->id}}" class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2 mt-2 deleteRow">

                    x

                </div>

            </div>



        @endforeach

    </div>
</form>
