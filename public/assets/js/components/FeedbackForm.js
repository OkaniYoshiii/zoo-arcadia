export { FeedbackForm };
class FeedbackForm {
    #element;
    constructor(element) {
        if (element === null)
            throw new Error('FeedbackForm constructor parameter \'element\' expects an instance of HTLMFormElement. Received \'null\'');
        if (!(element instanceof HTMLFormElement))
            throw new TypeError(`${element} need to be an instance of HTMLFormElement. ${Object.getPrototypeOf(element)}`);
        this.#element = element;
        this.#init();
    }
    #init() {
        this.#element.addEventListener('submit', this.#handleFormSubmission.bind(this));
    }
    async #handleFormSubmission(ev) {
        ev.preventDefault();
        await this.#sendFormData(new FormData(this.#element));
    }
    async #sendFormData(formData) {
        const response = await fetch(this.#element.action, { 'method': 'POST', 'body': formData });
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
