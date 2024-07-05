import { Dialog } from "./Dialog";
export { AnimalDialog };

class AnimalDialog extends Dialog {
    static #animalsData : { animals : { [key : number] : number } } = { animals : {}};
    #animalId : number;

    constructor(openBtn : Element) {
        super(openBtn);
        this.#init()
    }

    #init() {
        super.element.addEventListener('click', this.#registerViews.bind(this));

        const animalId = super.element.dataset.animalId;
        if(animalId === undefined) throw new Error('Dialog element must have a data-animal-id attribute. This attribute value must be the id of the animal.');
        this.#animalId = Number(animalId);

        AnimalDialog.#animalsData.animals[this.#animalId] = 0;
    }

    #registerViews() {
        AnimalDialog.#animalsData.animals[this.#animalId]++;
    }

    static get animalData() {
        return AnimalDialog.#animalsData;
    }
}