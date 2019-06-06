
$(document).ready(function() {

    function calculateDistance(from, to) {
        // alert(2);
        var directionsService = new google.maps.DirectionsService();
        var request = {
            origin: from,
            destination: to,
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC
        };
        // alert(3);
        if (typeof(drivingLine) !== 'undefined') drivingLine.setMap(null);
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                // alert(1);
                var totalKM = (response.routes[0].legs[0].distance.value / 1000);
                var miles = Math.round(totalKM * 1 * 10) / 10;
                // alert(distanceText);
                $('input[name=distance]').val(miles);
            }

            else {

                $('input[name=distance]').val(null);

            }

        });
    }

    numb3.onmouseover = function() {
        var pointA = null;
        var pointB = null;
        if($('input[name=whereFirst]').val() && $('input[name=whenceFirst]').val() ){
            pointA = $('input[name=whereFirst]').val();
            pointB = $('input[name=whenceFirst]').val()
        }else if($('input[name=whereSecond]').val() && $('input[name=whenceSecond]').val()){
            pointA = $('input[name=whereSecond]').val();
            pointB = $('input[name=whenceSecond]').val()
        }
        calculateDistance(
            pointA,
            pointB
        );
    };

    // $('.huy').blur(function(){
    //     calculateDistance(
    //         $('input[name=where1]').val(),
    //         $('input[name=whence1]').val()
    //     );
    // });


});

