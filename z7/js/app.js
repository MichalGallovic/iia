(function() {
    var map, directionsDisplay,directionsService;
    google.maps.event.addDomListener(window, 'load', initialize);

    $('#compute-route').click(function() {
        getJSON("addresses.json").then(function(response) {

            var promises = response.map(function(address, index) {
                var fullAddress = address.town + " " + address.street;
                return geocodeAddress(fullAddress);
            });

            RSVP.all(promises).then(function(addresses) {
                var origin = addresses[0].geometry.location;
                var destination = addresses[addresses.length-1].geometry.location;
                var waypoints = addresses.slice(1,addresses.length-1).map(function(elm) {
                    return {
                        location: elm.geometry.location,
                        stopover: true
                    };
                });
                var request = {
                    origin: origin,
                    destination: destination,
                    waypoints: waypoints,
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                calculateRoute(request).then(function (route) {
                    setUIforRoute(route);
                })
            }).catch(function(err) {
                console.log(err);
            });

        }, function(error) {
            console.log(error);
        });
    });



    function setUIforRoute(route) {
        $('#route-info').empty();
        var fulldist = 0;
        route.legs.forEach(function(elm, index) {
            if(index == route.legs.length -1) {
                fulldist += elm.distance.value;
                var p = $("<p/>");
                p.text(elm.start_address);
                var dist = $("<p/>", {
                    class: "text-center space-sm",
                    text: elm.distance.text
                });
                dist.appendTo(p);
                p.appendTo($('#route-info'));

                var p = $("<p/>");
                p.text(elm.end_address);
                p.appendTo($('#route-info'));
            } else {
                fulldist += elm.distance.value;
                var p = $("<p/>");
                p.text(elm.start_address);
                var dist = $("<p/>", {
                    class: "text-center space-sm",
                    text: elm.distance.text
                });
                dist.appendTo(p);
                p.appendTo($('#route-info'));
            }
        });
        $("<hr>").appendTo($('#route-info'));
        $("<h4/>",{
            class: "text-center",
            text: "Spolu: "+fulldist/1000+" km"
        }).appendTo($('#route-info'));
    }

    function initialize() {
        var mapOptions = {
            center: { lat: -34.397, lng: 150.644},
            zoom: 8,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT
            },
            panControl: true,
            panControlOptions: {
                position: google.maps.ControlPosition.RIGHT
            }
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
        map.setCenter({lat:48.736277,lng:19.146192});
        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(map);

        getJSON("addresses.json").then(function(response) {

            response.forEach(function(address) {
                var fullAddress = address.town + " " + address.street;
                placeMarker(fullAddress);
            });
        });
    }

    function calculateRoute(request) {
        var promise = new RSVP.Promise(function(resolve, reject) {
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    resolve(route);
                }
            });
        });
        return promise;
    }

    function placeMarker(address) {
        geocodeAddress(address).then(function(response) {
            var marker = new google.maps.Marker({
                map: map,
                position: response.geometry.location
            });
        });
    }

    function geocodeAddress(address) {

        var promise = new RSVP.Promise(function(resolve, reject) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode( {
                'address':address
            }, function(results, status) {
                if(status == google.maps.GeocoderStatus.OK) {
                    var response = results[0];
                    resolve(response);
                }

            });
        });

        return promise;
    }

    function getJSON(url) {
        var promise = new RSVP.Promise(function(resolve, reject) {
            $.ajax({
                type: "GET",
                url: url
            }).done(function(response) {
                resolve(response);
            }).fail(function(error) {
                reject(error);
            });
        });

        return promise;
    }
})();
