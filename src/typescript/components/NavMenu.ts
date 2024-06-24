export { NavMenu };

class NavMenu {
    #toggle : HTMLButtonElement|null;

    constructor(toggleSelector : string) {
        this.#toggle = document.querySelector(toggleSelector);
        this.#init();
    }

    #init() {
        this.#toggle?.addEventListener('click', this.#toggleMenu.bind(this));
    }

    #toggleMenu() {
        let isExpanded = (this.#toggle?.getAttribute('aria-expanded') === 'true') ? true : false;

        (isExpanded) ? this.#toggle?.setAttribute('aria-expanded', 'false') : this.#toggle?.setAttribute('aria-expanded', 'true');
    }
}