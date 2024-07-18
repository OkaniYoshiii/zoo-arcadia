"use strict";
const actionButtons = document.querySelectorAll('button[data-action]');
actionButtons.forEach((button) => {
    if (!(button instanceof HTMLButtonElement))
        return;
    const action = button.getAttribute('data-action');
    if (action !== null) {
        switch (action) {
            case 'add-breed':
                button.addEventListener('click', () => {
                    deleteInput(button, 'breed_id');
                    addInput(button, 'breed_name');
                }, { once: true });
                break;
            default:
                throw new Error(`data-action attribute on ${button} need to be either \'add-breed\' or \'add-habitat\'`);
                break;
        }
    }
});
function addInput(button, inputName) {
    const input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.classList.add('form-input__input');
    input.setAttribute('name', inputName);
    button.insertAdjacentElement('beforebegin', input);
}
function deleteInput(button, inputName) {
    const parent = button.parentElement;
    if (parent !== null) {
        const selectInput = parent.querySelector(`select[name=${inputName}`);
        if (selectInput !== null)
            selectInput.remove();
    }
}
