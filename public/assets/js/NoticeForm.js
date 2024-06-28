export { NoticeForm };
class NoticeForm {
    #element;
    constructor(element) {
        if (!(element instanceof HTMLFormElement))
            throw new TypeError('${element} need to be an instance of HTMLFormElement. ${Object.getPrototypeOf(element)}');
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
        const data = response.json();
        console.log(data);
    }
}
