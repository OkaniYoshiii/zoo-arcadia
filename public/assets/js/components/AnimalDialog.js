var _a;
import { Dialog } from "./Dialog";
export { AnimalDialog };
class AnimalDialog extends Dialog {
    static #animalsData = { animals: {} };
    #animalId;
    constructor(openBtn) {
        super(openBtn);
        this.#init();
    }
    #init() {
        super.element.addEventListener('click', this.#registerViews.bind(this));
        const animalId = super.element.dataset.animalId;
        if (animalId === undefined)
            throw new Error('Dialog element must have a data-animal-id attribute. This attribute value must be the id of the animal.');
        this.#animalId = Number(animalId);
        _a.#animalsData.animals[this.#animalId] = 0;
    }
    #registerViews() {
        _a.#animalsData.animals[this.#animalId]++;
        console.log(JSON.stringify(_a.animalData));
    }
    static get animalData() {
        return _a.#animalsData;
    }
}
_a = AnimalDialog;
