var _a;
export { Panels };
class Panels {
    #node;
    #panels;
    #section;
    static controller = new AbortController();
    constructor(nodeSelector) {
        this.#node = document.querySelector(nodeSelector);
        this.#section = document.querySelector('.panels__section');
        this.#panels = this.#node?.querySelectorAll('.panel') || null;
        this.#init();
    }
    #init() {
        if (this.#panels === null)
            throw new Error('this.panels is null');
        _a.controller = new AbortController();
        this.#panels?.forEach((panel) => {
            panel.addEventListener('click', this.#openPanel.bind(this), { 'signal': _a.controller.signal });
        });
    }
    #openPanel(ev) {
        if (!(ev instanceof MouseEvent))
            throw new Error('this.openPanel can nly be used with event instances of MouseEvent');
        if (!(ev.currentTarget instanceof HTMLElement))
            throw new Error('ev.currentTarget is not an instance of HTMLElement');
        if (this.#section === null)
            throw new Error('this.#section is null');
        let panel = ev.currentTarget;
        panel.classList.add('active');
        const sectionStyle = window.getComputedStyle(this.#section);
        const panelStyle = window.getComputedStyle(panel);
        const background = panelStyle.getPropertyValue('--background');
        const animationDurationInMs = Number(sectionStyle.animationDuration.split(',')[0].replace('s', '')) * 1000;
        console.log(animationDurationInMs);
        setTimeout(() => {
            if (this.#panels === null)
                throw new Error('this.#panels is null');
            this.#section?.style.setProperty('--background', background);
            panel.classList.add('open');
            const panelIndex = Array.from(this.#panels).indexOf(panel);
            for (let i = 0; i < this.#panels.length; i++) {
                if (i === panelIndex)
                    continue;
                this.#panels[i].classList.toggle('d-none');
                this.#panels[i].classList.remove('active');
            }
            _a.controller.abort();
        }, animationDurationInMs);
    }
}
_a = Panels;
