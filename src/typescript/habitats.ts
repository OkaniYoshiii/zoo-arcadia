import { Panels } from "./Panels";
import { Dialog }  from "./Dialog";
import { Filter } from "./Filter";

new Panels('.panels');

const dialogs = document.querySelectorAll('.animal__dialog') as NodeListOf<HTMLDialogElement> ;
const btns = document.querySelectorAll('.animal__btn') as NodeListOf<HTMLButtonElement>;

for (let i = 0; i < dialogs.length; i++) {
    new Dialog(dialogs[i], btns[i]);
}

document.querySelectorAll('[aria-controls]').forEach((element) => {
    const controlledElementId = element.getAttribute('aria-controls');
    const controlledElement = (controlledElementId) ? document.getElementById(controlledElementId) : null;
    if(element instanceof HTMLButtonElement && controlledElement instanceof HTMLDialogElement) {
        new Dialog(controlledElement, element);
    }
})

new Filter(document.querySelectorAll('#panel-savane .species__controls > .button'));
new Filter(document.querySelectorAll('#panel-jungle .species__controls > .button'));
new Filter(document.querySelectorAll('#panel-marais .species__controls > .button'));