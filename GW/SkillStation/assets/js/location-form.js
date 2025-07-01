let marker = null;

function renderMap() {
    var map = L.map('map').setView([14.2114, 121.1658], 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    pinLocation(map);
}

function renderEventMap(latitude, longitude, eventName, eventAddress, canPin = null) {
    var map = L.map('leafletMap').setView([latitude, longitude], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Add marker for event location
    marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('<strong>' + eventName + '</strong><br>' + eventAddress)
        .openPopup();

    if (canPin) {
        pinLocation(map);
    }
}
    
function pinLocation(map) {
    map.on('click', function (e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
            .then(response => response.json())
            .then(data => {
                var city = data.address.city || data.address.town || data.address.village || data.address.municipality || "";
                var province = data.address.state || "";

                var address = "";

                if (city && province) {
                    address = city + ", " + province;
                } else if (city) {
                    address = city;
                } else if (province) {
                    address = province;
                }

                if(address) {
                    marker.bindPopup(data.display_name).openPopup();
                    setCoordinates(lat, lng);
                    setEventAddress(address);
                }
            })
            .catch(error => {
                console.error("Error fetching address:", error);
                marker.bindPopup("Unknown Location").openPopup();
                setEventAddress("Unknown Location");
            });
    });
}

function setCoordinates(lat, lng) {
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;
    
    if (document.getElementById('btnCreate')) {
        document.getElementById('btnCreate').classList.remove('disabled');
    }
}

function setEventAddress(address) {
    document.getElementById('eventAddress').value = address;
}