
var latitude;
var longitude;

//permission
if (!navigator.geolocation) {
    status.textContent = 'Geolocation is not supported by your browser!';
}
else {
    //register a handler function that will be called automatically each time the position of the user's device changes. 
    navigator.geolocation.watchPosition(function (position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
        //call move marker method with the new latitude and longitude
        moveMarker(longitude, latitude);
        console.log("Current user location: [" + latitude + "] [" + longitude + "]");
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.response);
            }
        };
        xhttp.open('GET', 'updateLocation.php?lat=' + latitude + '& lng=' + longitude, true);
        xhttp.send();

    },
        function (error) {
            if (error.code == error.PERMISSION_DENIED) {
                //console.log("location permission denied!");
                alert("Permission denied!");
            }
        }
    );
    //move the user marker to the new latitude and longitude
    function moveMarker(lng, lat) {
        vectorLayer.removeFeatures(loggedInUserMarker);
        loggedInUserMarker = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point(lng, lat).transform(fromProjection, toProjection),
            { description: 'This is your location' },
            {
                externalGraphic: 'images/map-pin.png',
                graphicHeight: 30,
                graphicWidth: 30,
                graphicXOffset: -12,
                graphicYOffset: -25
            }
        );
        vectorLayer.addFeatures(loggedInUserMarker);
        position = new OpenLayers.LonLat(longitude, latitude).transform(fromProjection, toProjection);
        map.setCenter(position);
    }
}