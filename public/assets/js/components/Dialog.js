export { Dialog };
class Dialog {
    _element;
    #openBtn;
    #closeBtn;
    constructor(element, openBtn) {
        this._element = element;
        this.#openBtn = openBtn;
        this.#closeBtn = this._element?.querySelector('.toggle');
        this.init();
    }
    init() {
        this.#openBtn?.addEventListener('click', this.#toggleDialog.bind(this));
        this._element?.addEventListener('click', this.#toggleDialog.bind(this));
    }
    #toggleDialog(ev) {
        if (ev.currentTarget === this.#openBtn)
            this._element?.showModal();
        if (ev.target === this.#closeBtn)
            this._element?.close();
        if (ev.target === this._element)
            this._element?.close();
    }
    get element() {
        return this._element;
    }
    get closeBtn() {
        return this.#closeBtn;
    }
}
