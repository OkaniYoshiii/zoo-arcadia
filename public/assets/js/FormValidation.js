export { FormValidation };
class FormValidation {
    #form;
    #fields;
    #errors = {};
    constructor(form) {
        this.#checkArguments(arguments);
        this.#form = form;
        this.#fields = this.#form.elements;
        this.#init();
    }
    #init() {
        this.#addErrorOutputs();
        this.#form.addEventListener('submit', this.#validateForm.bind(this));
    }
    #addErrorOutputs() {
        Array.from(this.#fields).forEach((field) => {
            const paragraph = document.createElement('p');
            paragraph.classList.add('form__error-output');
            field.insertAdjacentElement('afterend', paragraph);
        });
    }
    #validateForm(ev) {
        ev.preventDefault();
        this.#errors = {};
        const formData = new FormData(this.#form);
        for (const [key, value] of formData) {
            const field = this.#fields.namedItem(key);
            const isRequired = (element) => element instanceof HTMLInputElement || element instanceof HTMLTextAreaElement && element.required === true;
            if (isRequired(field) && field !== null) {
                if (this.#isEmpty(value))
                    this.#errors[key] = 'Ce champ est obligatoire, veuillez le remplir correctement';
            }
            if (key === 'password') {
                if (this.#isEmpty(value))
                    this.#errors.password = 'Le mot de passe ne doit pas être vide.';
            }
            if (key === 'email') {
                if (this.#isEmpty(value))
                    this.#errors.email = 'L\'email ne doit pas être vide.';
                if (!this.#isValidEmail(value))
                    this.#errors.email = 'L\'email doit commencer par une suite de caractères, puis un arobase, une autre suite de caractères et une extension (.com par exemple).';
            }
        }
        (Object.keys(this.#errors).length > 0) ? this.#showErrors() : this.#form.submit();
    }
    #isValidEmail(emailValue) {
        const regExp = /^[A-Za-z\-\.]+@[A-Za-z\-]+\.[A-Za-z]{2,6}$/;
        return regExp.test(emailValue.toString());
    }
    #isEmpty(value) {
        return value === '';
    }
    #checkArguments(args) {
        const form = args[0];
        if (form === null)
            throw new Error('Argument form doesn\'t correspond to any form in the DOM.');
        if (!(form instanceof HTMLFormElement))
            throw new Error('Argument form doesn\'t correspond to any form in the DOM.');
    }
    #resetErrorOutputs() {
        Array.from(this.#fields).forEach(field => {
            field.classList.remove('error');
            if (field.nextElementSibling == null)
                return;
            field.nextElementSibling.classList.remove('error');
            field.nextElementSibling.textContent = '';
        });
    }
    #showErrors() {
        this.#resetErrorOutputs();
        for (const fieldName in this.#errors) {
            const field = this.#fields.namedItem(fieldName);
            if (field instanceof HTMLElement && field.nextElementSibling?.classList.contains('form__error-output')) {
                field.nextElementSibling.textContent = this.#errors[fieldName];
                field.nextElementSibling.classList.add('error');
                field.classList.add('error');
            }
        }
    }
}
