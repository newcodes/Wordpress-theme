/**
 * Created by Titar on 25.07.2017.
 */
function initMap() {
    var element = document.getElementById('map');
    var options = {
        zoom: 12,
        center: {lat: 50.437718, lng: 30.381696}
    };

    var myMap = new google.maps.Map(element, options);

    var markers = [
        {
            coordinates: {lat: 50.438127, lng: 30.357415},
            image: {
                url: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Push-Pin-2-Chartreuse-icon.png',
                scaledSize: new google.maps.Size(48, 48)
            },
            info: '<h5 style="color: #2c3e50;">Салон "Меблі для Вашого Дому" </h5>'
        },
        {
            coordinates: {lat: 50.440282, lng: 30.407704},
            image: {
                url: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Push-Pin-2-Chartreuse-icon.png',
                scaledSize: new google.maps.Size(48, 48)
            },
            info: '<h5 style="color: #2c3e50;">Шоу-room при производстве МДВД™</h5>'
        }
    ];

    for(var i = 0; i < markers.length; i++) {
        addMarker(markers[i]);
    }

    function addMarker(properties) {
        var marker = new google.maps.Marker({
            position: properties.coordinates,
            map: myMap
        });

        if(properties.image) {
            marker.setIcon({
                url: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Push-Pin-2-Chartreuse-icon.png',
                scaledSize: new google.maps.Size(48, 48)
            });
        }

        if(properties.info) {
            var InfoWindow = new google.maps.InfoWindow({
                content: properties.info
            });

            marker.addListener('click',function(){
                InfoWindow.open(myMap, marker);
            })
        }
    }
}