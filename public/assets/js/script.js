import { DomainsSlider } from "./components/DomainsSlider.js";
import { GallerySlider } from "./components/GallerySlider.js";
import { NavMenu } from "./components/NavMenu.js";
new NavMenu('.menu-toggle');
new DomainsSlider('.domains', '.domain', '.domains__title button');
let sliders = document.querySelectorAll('.gallery--slider');
sliders.forEach((slider) => {
    if (!(slider instanceof HTMLElement))
        return;
    new GallerySlider(slider);
});
