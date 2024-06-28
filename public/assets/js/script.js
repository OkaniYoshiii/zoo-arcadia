import { DomainsSlider } from "./components/DomainsSlider";
import { GallerySlider } from "./components/GallerySlider";
import { NavMenu } from "./components/NavMenu";
new NavMenu('.menu-toggle');
new DomainsSlider('.domains', '.domain', '.domains__title button');
let sliders = document.querySelectorAll('.gallery--slider');
sliders.forEach((slider) => {
    if (!(slider instanceof HTMLElement))
        return;
    new GallerySlider(slider);
});
