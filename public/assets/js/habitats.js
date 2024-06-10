import { Panels } from "./Panels";
import { Dialog } from "./Dialog";
import { Filter } from "./Filter";
new Panels('.panels');
const dialogs = document.querySelectorAll('.animal__dialog');
const btns = document.querySelectorAll('.animal__btn');
for (let i = 0; i < dialogs.length; i++) {
    new Dialog(dialogs[i], btns[i]);
}
document.querySelectorAll('[aria-controls]').forEach((element) => {
    const controlledElementId = element.getAttribute('aria-controls');
    const controlledElement = (controlledElementId) ? document.getElementById(controlledElementId) : null;
    if (element instanceof HTMLButtonElement && controlledElement instanceof HTMLDialogElement) {
        new Dialog(controlledElement, element);
    }
});
new Filter(document.querySelectorAll('.species__controls > .button'), true);
