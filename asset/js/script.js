

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





