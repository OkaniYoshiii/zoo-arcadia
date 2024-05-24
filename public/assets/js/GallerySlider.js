// import { Slider } from "./Slider";
export { GallerySlider };

class GallerySlider {
    translateValue = 0;

    constructor(slider) {
        this.element = slider;
        this.slides = Array.from(this.element.querySelectorAll('.gallery__slide'));
        this.buttons = Array.from(this.element.querySelectorAll('.gallery__controls > input'));
        this.init();
    }

    init() {
        this.buttons.forEach((btn) => { btn.addEventListener('click', this.translate.bind(this))})
    }

    translate(ev) {
        let btnIndex = this.buttons.indexOf(ev.target);

        this.slides.forEach((slide) => { slide.style.translate = `${100 * btnIndex * -1}% 0`});
    }
}