export { Dialog };
class Dialog {
    _element;
    #openBtn;
    #closeBtn;
    constructor(openBtn) {
        if (!(openBtn instanceof HTMLButtonElement))
            throw new Error('Argument 1 (openBtn) must be an instanceof HTMLButtonElement. Received : ' + Object.getPrototypeOf(openBtn));
        this.#openBtn = openBtn;
        const dialogId = this.#openBtn.getAttribute('data-dialog-id');
        if (!dialogId)
            throw new Error('openBtn must have a data-dialog-id attribute. This attribute should reference the id of the dialog you want to open.');
        const dialog = document.getElementById(dialogId);
        if (!dialog)
            throw new Error(`No element found with id ${dialogId}. Change data-dialog-id on your button to match an existing element.`);
        if (!(dialog instanceof HTMLDialogElement))
            throw new Error(`Element with id of ${dialogId} is not an instance of HTMLDialogElement.`);
        this._element = dialog;
        this.init();
    }
    init() {
        this.#closeBtn = document.createElement('button');
        this.#closeBtn.classList.add('dialog__toggle', 'button--active');
        this.#closeBtn.textContent = 'Fermer';
        const dialogContent = this._element.querySelector('.dialog__content');
        const hasForm = (this._element.querySelector('form')) ? true : false;
        if (!dialogContent)
            throw new Error('Dialog must have a dialog__content element inside of it.');
        if (!hasForm) {
            dialogContent.appendChild(this.#closeBtn);
            this.#closeBtn.addEventListener('click', this.#toggleDialog.bind(this));
        }
        this.#openBtn.addEventListener('click', this.#toggleDialog.bind(this));
        this._element.addEventListener('click', this.#toggleDialog.bind(this));
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
