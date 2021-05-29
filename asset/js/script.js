

console.group('Profile');
 // leaflet Map 
function init() {

    const parcThabor = {
        lat : 48.89141,
        lng : 2.43780
    }

    const zoomLevel = 16;

    const map = L.map("mapid").setView([parcThabor.lat, parcThabor.lng], zoomLevel);

    const mainLayer  = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 19,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoiamVmZmVyc29uNDQiLCJhIjoiY2twMzFxY3Z2MDA2MDJ3bHIwMnVwcm40NCJ9.ctfgJTxkntwoYjjEmBakpg',
    });

    mainLayer.addTo(map);
     // Icon Map

    var PaulIcon = L.icon({
        iconUrl: 'asset/img/favicon_marker2-01.png',
        iconSize:     [55, 52], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [-31, -68], // point of the icon which will correspond to marker's location
    });

    L.marker([48.89141, 2.43780], {icon: PaulIcon}).addTo(map);

}
     // Compteur Map 


const counters = document.querySelectorAll('.counter');


counters.forEach(counter => {
	
	counter.innerText = '0';
	
	const updateCounter = () => {
		const target = +counter.getAttribute('data-target');
		const c = +counter.innerText;
		
		if( c < target) {
			counter.innerText = c +1;
            setTimeout(updateCounter, 50)
		} else {
			counter.innerText = target;
		}
	};
	
	updateCounter();


    window.addEventListener("scroll", function(){
        var nav = document.querySelector("nav");
        nav.classList.toggle("sticky", window.scrollY > 10);
    })

    /*const cursor = document.querySelector('.cursor');

    document.addEventListener('mousemove', e => {
        cursor.setAttribute('style', 'top:' + (e.pageY - 6 ) + "px; left:"+(e.pageX - 6) + "px")
    })*/

    //menu burger
    const hamburger = document.getElementById('hamburger');
    const closeBurger = document.getElementById('close');
    const navUL = document.getElementById('nav-ul');

    hamburger.addEventListener('click', () => {
        closeBurger.classList.toggleClass('navOpen');
    });

});





