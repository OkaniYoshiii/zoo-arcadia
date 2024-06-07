export { Dialog };
class Dialog {
    #element;
    #openBtn;
    #closeBtn;
    constructor(element, openBtn) {
        this.#element = element;
        this.#openBtn = openBtn;
        this.#closeBtn = this.#element?.querySelector('.toggle');
        this.#init();
    }
    #init() {
        this.#openBtn?.addEventListener('click', this.#toggleDialog.bind(this));
        this.#element?.addEventListener('click', this.#toggleDialog.bind(this));
    }
    #toggleDialog(ev) {
        if (ev.currentTarget === this.#openBtn)
            this.#element?.showModal();
        if (ev.target === this.#closeBtn)
            this.#element?.close();
        if (ev.target === this.#element)
            this.#element?.close();
    }
}
