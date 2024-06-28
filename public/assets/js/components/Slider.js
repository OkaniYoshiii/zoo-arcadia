export { Slider };
class Slider {
    translateValue = 0;
    element;
    slides;
    buttons;
    activeSlide;
    constructor(sliderSelector, slidesSelector, sliderButtonsSelector) {
        this.element = document.querySelector(sliderSelector);
        this.slides = Array.from(document.querySelectorAll(slidesSelector));
        this.buttons = Array.from(document.querySelectorAll(sliderButtonsSelector));
        this.activeSlide = this.slides[0];
        this.init();
    }
    init() {
        if (this.buttons === null)
            return;
        this.buttons.forEach((btn) => { btn.addEventListener('click', this.translate.bind(this)); });
    }
}
