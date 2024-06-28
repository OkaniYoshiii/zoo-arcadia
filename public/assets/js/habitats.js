import { Panels } from "./components/Panels";
import { Dialog } from "./components/Dialog";
import { AnimalDialog } from "./components/AnimalDialog";
import { Filter } from "./components/Filter";
new Panels('.panels');
const dialogs = document.querySelectorAll('.animal__dialog');
const btns = document.querySelectorAll('.animal__btn');
const animalDialogs = [];
for (let i = 0; i < dialogs.length; i++) {
    animalDialogs.push(new AnimalDialog(dialogs[i], btns[i]));
}
document.querySelectorAll('[aria-controls]').forEach((element) => {
    const controlledElementId = element.getAttribute('aria-controls');
    const controlledElement = (controlledElementId) ? document.getElementById(controlledElementId) : null;
    if (element instanceof HTMLButtonElement && controlledElement instanceof HTMLDialogElement) {
        new Dialog(controlledElement, element);
    }
});
new Filter(document.querySelectorAll('#panel-savane .species__controls > .button'));
new Filter(document.querySelectorAll('#panel-jungle .species__controls > .button'));
new Filter(document.querySelectorAll('#panel-marais .species__controls > .button'));
document.addEventListener("visibilitychange", function logData() {
    if (document.visibilityState === "hidden") {
        navigator.sendBeacon(`${window.location.origin}/admin`, JSON.stringify(AnimalDialog.animalData));
    }
});
// window.onbeforeunload = () => {
//     navigator.sendBeacon(`${window.location.origin}/admin`, JSON.stringify(AnimalDialog.animalData));
// }
// window.onpagehide = function(event)
// {
//  var fd = new FormData(); 
//  fd.append('animals', JSON.stringify(AnimalDialog.animalData)); 
//  navigator.sendBeacon(`${window.location.origin}/admin`, fd);
//  navigator.sendBeacon(`${window.location.origin}/admin`, JSON.stringify(AnimalDialog.animalData));
// }
// window.onbeforeunload = function(event)
// {
//  var fd = new FormData(); 
//  fd.append('animals', JSON.stringify(AnimalDialog.animalData)); 
//  navigator.sendBeacon(`${window.location.origin}/admin`, fd);
//  navigator.sendBeacon(`${window.location.origin}/admin`, JSON.stringify(AnimalDialog.animalData));
// }
