export { Panels } ;  

class Panels {
    #element : HTMLElement|null;
    #panels : NodeListOf<HTMLElement>|null;

    #controls : NodeListOf<HTMLButtonElement> | null;

    constructor(elementSelector : string) {
        this.#element = document.querySelector(elementSelector);
        this.#panels = document.querySelectorAll('.panel') || null;
        this.#controls = document.querySelectorAll('.panels__control') || null;
        this.#init();
    }
    
    #init() {
        if(this.#controls === null) throw new Error('this.#controls is null');

        this.#controls.forEach((control) => {
            control.addEventListener('click', this.#openPanel.bind(this));
        });
    }

    #openPanel(ev : Event) {
        if(!(ev instanceof MouseEvent)) throw new Error('this.openPanel can only be used with with click Events');
        if(!(ev.currentTarget instanceof HTMLButtonElement)) throw new Error('ev.currentTarget is not an HTMLButtonElement');
        if(this.#element === null) throw new Error('this.#element is null');

        const control = ev.currentTarget;
        let panel = document.querySelector(`#${control.getAttribute('aria-controls')}`) as HTMLElement|null;
        panel?.classList.add('active');

        const background = window.getComputedStyle(control).getPropertyValue('--background');
        this.#element?.style.setProperty('--background', background);

        if(this.#panels === null) throw new Error('this.#panels is null');
        if(panel === null) throw new Error('panel is null');
        
        const panelIndex = Array.from(this.#panels).indexOf(panel);
        for (let i = 0; i < this.#panels.length; i++) {
            (i === panelIndex) ? this.#panels[i].classList.remove('d-none') : this.#panels[i].classList.add('d-none');
        }
    }
}