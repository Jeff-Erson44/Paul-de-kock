

console.group('Profile');
// Compteur  


const counters = document.querySelectorAll('.counter');


counters.forEach(counter => {
	
	counter.innerText = '0';
	
	const updateCounter = () => {
		const target = +counter.getAttribute('data-target');
		const c = +counter.innerText;
		
		if( c < target) {
			counter.innerText = c + 1;
            setTimeout(updateCounter, 100)
		} else {
			counter.innerText = target;
		}
	};
	
	updateCounter();


// Sticky navbar

    window.addEventListener("scroll", function(){
        var nav = document.querySelector("nav");
        nav.classList.toggle("sticky", window.scrollY > 10 );
    })

});

var widthLimit = 450;
function toggle_visibility(){
	var a = document.getElementById("about-navigation");
	var b = document.getElementById("presta-navigation")

	var windowWidth = window.innerWidth;
	if(windowWidth <= widthLimit){
		a.setAttribute("href", "#quisommesnous_mobile");
		b.setAttribute("href", "#prestations_mobile");
	}else{
		a.setAttribute("href", "#quisommesnous");
		b.setAttribute("href", "#prestations");
    }
}
toggle_visibility();




