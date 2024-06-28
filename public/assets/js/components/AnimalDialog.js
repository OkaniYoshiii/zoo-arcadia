var _a;
import { Dialog } from "./Dialog";
export { AnimalDialog };
class AnimalDialog extends Dialog {
    static #animalsData = { animals: {} };
    #animalId;
    constructor(element, openBtn) {
        super(element, openBtn);
        super.init();
        this.#init();
    }
    #init() {
        if (super.element !== null) {
            super.element.addEventListener('click', this.#registerViews.bind(this));
        }
        const animalId = super.element?.dataset.animalId;
        if (animalId === undefined)
            return;
        this.#animalId = Number(animalId);
        _a.#animalsData.animals[this.#animalId] = 0;
    }
    #registerViews() {
        _a.#animalsData.animals[this.#animalId]++;
    }
    static get animalData() {
        return _a.#animalsData;
    }
}
_a = AnimalDialog;
