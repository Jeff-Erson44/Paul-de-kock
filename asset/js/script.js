

console.group('Profile');

function init() {
    
    const parcThabor = {
        lat : 48.89141,
        lng : 2.43780
    }

    const zoomLevel = 16;

    const map = L.map("mapid").setView([parcThabor.lat, parcThabor.lng], zoomLevel);

    const mainLayer  = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoiamVmZmVyc29uNDQiLCJhIjoiY2twMzFxY3Z2MDA2MDJ3bHIwMnVwcm40NCJ9.ctfgJTxkntwoYjjEmBakpg'
    });

    mainLayer.addTo(map);

    var PaulIcon = L.icon({
        iconUrl: 'asset/img/icon.png',
        
    
        iconSize:     [80, 52], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([48.89141, 2.43780], {icon: PaulIcon}).addTo(map);


}



