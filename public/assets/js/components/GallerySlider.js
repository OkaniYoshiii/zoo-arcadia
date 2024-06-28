export { GallerySlider };
class GallerySlider {
    translateValue = 0;
    element;
    slides;
    buttons;
    constructor(slider) {
        this.element = slider;
        this.slides = Array.from(this.element.querySelectorAll('.gallery__slide'));
        this.buttons = Array.from(this.element.querySelectorAll('.gallery__controls > input'));
        this.init();
    }
    init() {
        if (this.buttons === null)
            return;
        this.buttons.forEach((btn) => { btn.addEventListener('click', this.translate.bind(this)); });
    }
    translate(ev) {
        if (this.buttons === null)
            return;
        if (this.slides === null)
            return;
        if (!(ev.target instanceof HTMLElement))
            return;
        let btnIndex = this.buttons.indexOf(ev.target);
        this.slides.forEach((slide) => { slide.style.translate = `${100 * btnIndex * -1}% 0`; });
    }
}
