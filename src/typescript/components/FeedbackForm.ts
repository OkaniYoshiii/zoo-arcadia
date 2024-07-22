export { FeedbackForm };

type Feedback = { 'username' : string, 'content' : string, 'date' : any, 'isValidated' : boolean };

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
        const formData = new FormData(this.#element);
        const csrfInput = document.querySelector('[name="csrf_token"]');
        if(csrfInput === null || !(csrfInput instanceof HTMLInputElement)) return;
        const csrfToken = csrfInput.value;
        formData.append('csrf_token', csrfToken);
        await this.#sendFormData(formData);
    }

    async #sendFormData(formData : FormData) {
        const response = await fetch(this.#element.action, { 'method' : 'POST', 'body' : formData });
        const data = await response.json();

        this.#updateFeedbacks();
    }

    #updateFeedbacks() {
        const p = document.createElement('p');

        p.textContent = 'Votre avis a bien été envoyé et devra être validé par un de nos agents avant publication.';
        p.classList.add('fw-bold');

        this.#element.insertAdjacentElement('beforebegin', p);
        this.#element.remove();
    }
}