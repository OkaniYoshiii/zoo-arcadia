import { Dialog } from "./Dialog";
export { AnimalDialog };

class AnimalDialog extends Dialog {
    static #animalsData : { animals : { [key : number] : number } } = { animals : {}};
    #animalId : number;

    constructor(element : HTMLDialogElement, openBtn : HTMLButtonElement) {
        super(element, openBtn);
        super.init();
        this.#init()
    }

    #init() {
        if(super.element !== null) {
            super.element.addEventListener('click', this.#registerViews.bind(this));
        }

        const animalId = super.element?.dataset.animalId;
        if(animalId === undefined) return;
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