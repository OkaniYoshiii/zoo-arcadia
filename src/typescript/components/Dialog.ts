export { Dialog };

class Dialog {
    _element : HTMLDialogElement | null;
    #openBtn : HTMLButtonElement | null;
    #closeBtn : HTMLButtonElement | null;

    constructor(element : HTMLDialogElement, openBtn : HTMLButtonElement) {
        this._element = element;
        this.#openBtn = openBtn;
        this.#closeBtn = this._element?.querySelector('.toggle');
        this.init();
    }

    init() {
        this.#openBtn?.addEventListener('click', this.#toggleDialog.bind(this));
        this._element?.addEventListener('click', this.#toggleDialog.bind(this));
    }

    #toggleDialog(ev : MouseEvent) {
        if(ev.currentTarget === this.#openBtn) this._element?.showModal();
        
        if(ev.target === this.#closeBtn) this._element?.close();
        if(ev.target === this._element) this._element?.close();
    }

    get element() {
        return this._element;
    }

    get closeBtn() {
        return this.#closeBtn;
    }
}