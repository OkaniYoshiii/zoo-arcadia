import { DomainsSlider } from "./DomainsSlider";
import { GallerySlider } from "./GallerySlider";
import { NavMenu } from "./NavMenu";
new NavMenu('.menu-toggle');
new DomainsSlider('.domains', '.domain', '.domains__title button');
let sliders = document.querySelectorAll('.gallery--slider');
sliders.forEach((slider) => {
    if (!(slider instanceof HTMLElement))
        return;
    new GallerySlider(slider);
});
