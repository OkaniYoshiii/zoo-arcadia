export { FeedbackForm };

class FeedbackForm {
    #element : HTMLFormElement;

    constructor(element : HTMLElement|null) {
        if(element === null) throw new Error('FeedbackForm constructor parameter \'element\' expects an instance of HTLMFormElement. Received \'null\'')
        if(!(element instanceof HTMLFormElement)) throw new TypeError(`${element} need to be an instance of HTMLFormElement. ${Object.getPrototypeOf(element)}`);
        this.#element = element;
        this.#init();
    }

    #init() {
        this.#element.addEventListener('submit', this.#handleFormSubmission.bind(this));
    }

    async #handleFormSubmission(ev : SubmitEvent) {
        ev.preventDefault();

        await this.#sendFormData(new FormData(this.#element));
    }

    async #sendFormData(formData : FormData) {
        const response = await fetch(this.#element.action, { 'method' : 'POST', 'body' : formData });
        const data = await response.json();
        console.log(data);
    }
}