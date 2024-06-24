export { Slider } ;

abstract class Slider {
    translateValue = 0;

    element : HTMLElement|null;
    slides : HTMLElement[]|null;
    buttons : HTMLElement[]|null
    activeSlide : HTMLElement|null;

    constructor(sliderSelector : string, slidesSelector : string, sliderButtonsSelector : string) {
        this.element = document.querySelector(sliderSelector);
        this.slides = Array.from(document.querySelectorAll(slidesSelector));
        this.buttons = Array.from(document.querySelectorAll(sliderButtonsSelector));
        this.activeSlide = this.slides[0];
        this.init();
    }

    init() {
        if(this.buttons === null) return;

        this.buttons.forEach((btn) => { btn.addEventListener('click', this.translate.bind(this))})
    }

    abstract translate(ev : MouseEvent) : void;
}