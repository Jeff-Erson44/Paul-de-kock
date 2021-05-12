'use strict';
const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');


    burger.addEventListener('click', () => {
        //Apparition nav
        nav.classList.toggle('nav-active');

        //Animation des liens
        navLinks.forEach((link, indexclean) => {
            if (link.style.animation) {
                link.style.animation = '';
            } else {
                link.style.animation = 'navLinkFade 0.5s ease forwards ${indexclean / 7 + 0.3}s'
            }
        });

        // Animation du burger
        burger.classList.toggle('toggle');
    });
}

navSlide();