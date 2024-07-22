import { Slider } from "./Slider.js";
export { DomainsSlider };
class DomainsSlider extends Slider {
    translate(ev) {
        let btn = ev.target;
        if (this.element == null)
            return;
        if (this.slides == null)
            return;
        if (this.buttons == null)
            return;
        if (this.activeSlide == null)
            return;
        if (this.activeSlide === this.slides[0] && btn === this.buttons[0]) {
            this.activeSlide = this.slides[this.slides.length - 1];
            this.element.style.translate = `${(this.slides.length - 1) * 100 * (-1)}% 0`;
            this.translateValue = (this.slides.length - 1) * 100 * (-1);
            return;
        }
        if (this.activeSlide === this.slides[this.slides.length - 1] && btn === this.buttons[1]) {
            this.activeSlide = this.slides[0];
            this.element.style.translate = '0';
            this.translateValue = 0;
            return;
        }
        if (btn === this.buttons[1]) {
            this.activeSlide = this.slides[this.slides.indexOf(this.activeSlide) + 1];
            this.element.style.translate = `${this.translateValue - 100}% 0`;
            this.translateValue = this.translateValue - 100;
        }
        if (btn === this.buttons[0]) {
            this.activeSlide = this.slides[this.slides.indexOf(this.activeSlide) - 1];
            this.element.style.translate = `${this.translateValue + 100}% 0`;
            this.translateValue = this.translateValue + 100;
        }
    }
}
