const actionButtons = document.querySelectorAll('button[data-action]');

actionButtons.forEach((button) => {
    const action = button.getAttribute('data-action');
    if(action !== null) {
        switch (action) {
            case 'add-breed':
                button.addEventListener('click', (ev) => { addInput(ev, 'breed_name'); }, { once : true });
                break;
            case 'add-habitat':
                button.addEventListener('click', (ev) => { addInput(ev, 'habitat_name'); }, { once : true });
                break;
        
            default:
                throw new Error(`data-action attribute on ${button} need to be either \'add-breed\' or \'add-habitat\'`);
                break;
        }
    }
})

function addInput(ev : Event, inputName : string) {
    const button = ev.target;

    if(button instanceof HTMLButtonElement) {
        const input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.classList.add('form-input__input');
        input.setAttribute('name', inputName);
        button.insertAdjacentElement('beforebegin', input);
    }
}