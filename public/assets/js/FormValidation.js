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
        this.#form.addEventListener('submit', this.#validateForm.bind(this));
    }
    #validateForm(ev) {
        ev.preventDefault();
        this.#errors = {};
        const emailRegexp = /^[A-Za-z\-\.]+@[A-Za-z\-]+\.[A-Za-z]{2,6}$/;
        const formData = new FormData(this.#form);
        for (const [key, value] of formData) {
            const field = this.#fields.namedItem(key);
            if (field instanceof HTMLInputElement || field instanceof HTMLTextAreaElement && field !== null && field.required) {
                if (value === '')
                    this.#errors[key] = 'Veuillez remplir correctement les champs obligatoires';
            }
            if (key === 'password') {
                if (value === '') {
                    this.#errors.password = 'Le mot de passe ne doit pas être vide.';
                }
            }
            if (key === 'email') {
                if (value === '')
                    this.#errors.email = 'L\'email ne doit pas être vide.';
                if (!emailRegexp.test(value.toString()))
                    this.#errors.email = 'L\'email doit commencer par une suite de caractères, puis un arobase, une autre suite de caractères et une extension (.com par exemple).';
            }
        }
        (Object.keys(this.#errors).length > 0) ? this.#showErrors() : this.#form.submit();
    }
    #checkArguments(args) {
        const form = args[0];
        if (form === null)
            throw new Error('Argument form doesn\'t correspond to any form in the DOM.');
        if (!(form instanceof HTMLFormElement))
            throw new Error('Argument form doesn\'t correspond to any form in the DOM.');
    }
    #showErrors() {
        const output = document.getElementById('output');
        if (output === null)
            throw new Error('Aucun element HTML ayant un ID output n\'est présent dans le DOM. Impossible d\'afficher les différentes erreurs de validation.');
        // RESET
        Array.from(this.#fields).forEach(field => field.classList.remove('error'));
        output.textContent = '';
        for (const fieldName in this.#errors) {
            const fieldInput = this.#fields.namedItem(fieldName);
            if (fieldInput instanceof HTMLElement)
                fieldInput.classList.add('error');
            output.innerHTML += this.#errors[fieldName] + '<br>';
        }
    }
}
