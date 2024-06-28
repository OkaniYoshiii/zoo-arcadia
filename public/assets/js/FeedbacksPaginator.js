export { FeedbacksPaginator };
class FeedbacksPaginator {
    #previousPageBtn;
    #nextPageBtn;
    constructor(previousPageBtn, nextPageBtn) {
        if (!(previousPageBtn instanceof HTMLButtonElement))
            throw new Error('Argument previousPageBtn of FeedbacksPaginator constructor methods expect an instance of HTMLButtonElement. Received ' + Object.getPrototypeOf(previousPageBtn));
        this.#previousPageBtn = previousPageBtn;
        if (!(nextPageBtn instanceof HTMLButtonElement))
            throw new Error('Argument nextPageBtn of FeedbacksPaginator constructor methods expect an instance of HTMLButtonElement. Received ' + Object.getPrototypeOf(nextPageBtn));
        this.#nextPageBtn = nextPageBtn;
        this.#init();
    }
    #init() {
        this.#previousPageBtn.addEventListener('click', this.#changePage.bind(this));
        this.#nextPageBtn.addEventListener('click', this.#changePage.bind(this));
    }
    #changePage(ev) {
    }
}
