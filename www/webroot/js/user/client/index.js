$(document).ready(function(){
    function initMap() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(50.456458529383056, 30.734375);
        var mapOptions = {
            center: latlng,
            zoom: 8,
            mapTypeControl: false,
            streetViewControl: false,
            styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }

    function drivingRoute(from, to) {
        var request = {
            origin: from,
            destination: to,
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC
        };
        // $('#controls p').removeClass('error');
        // $('#controls p').text('loading');
        if(typeof(drivingLine) !== 'undefined') drivingLine.setMap(null);
        directionsService.route(request, function(response, status){

            if(status == google.maps.DirectionsStatus.OK){
                var totalKM = (response.routes[0].legs[0].distance.value / 1000);
                var miles = Math.round(totalKM * 1 * 10) / 10;
                sessionStorage['distance'] = miles;
                $('input[name=distance]').val(miles);
                // $('#controls p').text(distanceText);

                var marker = new google.maps.Marker({
                    position: from,
                    map: map
                });
                drivingLine = new google.maps.Polyline({
                    path: response.routes[0].overview_path,
                    strokeColor: "#ffac0e",
                    strokeOpacity: .75,
                    strokeWeight: 3
                });
                drivingLine.setMap(map);
                marker.setMap(map);
                codeAddress('whence', 'A');
                codeAddress('where_', 'B');
                map.fitBounds(response.routes[0].bounds);

            }

            else {
                var from = $('#from').val();
                var to = $('#to').val();
                if($.trim(from) && $.trim(to)){
                    $('input[name=distance]').val(null);
                }

                // $('#controls p').addClass('error');
                // $('#controls p').text('cannot load route');
            }

        });
    }

    function getDistance() {
        var distanse = sessionStorage['distance'];
        sessionStorage['distance'] = '';
        return distanse;
    }

    function codeAddress(id, label) {
        var address = document.getElementById(id).value;
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    label: label
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    flag.onclick = function () {
        $('input[name=distance]').val(getDistance());
    };

    // $('input').blur(function(){
    //     drivingRoute(
    //         $('input[name=from]').val(),
    //         $('input[name=to]').val()
    //         // $('input[name=distance]').val(getDistance())
    //     );
    // });



    forward.onmouseover = function() {
        var pointA = null;
        var pointB = null;
        if($('input[name=where_]').val() && $('input[name=whence]').val() ){
            pointA = $('input[name=whence]').val();
            pointB = $('input[name=where_]').val()
        }
        drivingRoute(
            pointA,
            pointB
        );
    };





    var geocoder;
    var map;
    var drivingLine;
    var directionsService = new google.maps.DirectionsService();
    initMap();
    $('input[name=whence]').val('');
    $('input[name=where_]').val('');
    // $('input[name=from]').trigger('blur');

});