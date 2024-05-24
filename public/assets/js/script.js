import { DomainsSlider } from "./DomainsSlider";
import { GallerySlider } from "./GallerySlider";

// HAMBURGER MENU
const PRIMARY_NAV = document.querySelector('.primary-navigation');
const MENU_TOGGLE = document.querySelector('.menu-toggle');

MENU_TOGGLE.addEventListener('click', toggleMenu);

function toggleMenu() {
    let isExpanded = (MENU_TOGGLE.getAttribute('aria-expanded') === 'true') ? true : false;

    (isExpanded) ? MENU_TOGGLE.setAttribute('aria-expanded', 'false') :  MENU_TOGGLE.setAttribute('aria-expanded', 'true');
}


// ZOO DOMAINS SLIDER

new DomainsSlider('.domains', '.domain', '.domains__title button');

// GALLERY SLIDER

document.querySelectorAll('.gallery--slider').forEach((slider) => { new GallerySlider(slider); });