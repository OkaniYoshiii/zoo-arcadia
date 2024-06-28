export { FeedbacksPaginator };
class FeedbacksPaginator {
    #buttons;
    constructor(buttons) {
        this.#buttons = buttons.map((btn, index) => {
            if (!(btn instanceof HTMLButtonElement))
                throw new Error(`Arguments buttons contains an Element which is not on instance of HTMLButtonElement. Reading index ${index}`);
            return btn;
        });
    }
}
