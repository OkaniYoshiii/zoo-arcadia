import { Panels } from "./components/Panels.js";
import { AnimalDialog }  from "./components/AnimalDialog.js";
import { Filter } from "./components/Filter.js";

new Panels('.panels');

document.querySelectorAll('[data-dialog-id^="animal-dialog-"]').forEach((btn) => { new AnimalDialog(btn) })

new Filter(document.querySelectorAll('#panel-savane .species__controls > .button'));
new Filter(document.querySelectorAll('#panel-jungle .species__controls > .button'));
new Filter(document.querySelectorAll('#panel-marais .species__controls > .button'));

document.addEventListener("visibilitychange", function logData() {
    if (document.visibilityState === "hidden") {
      navigator.sendBeacon(`${window.location.origin}/admin`, JSON.stringify(AnimalDialog.animalData));
    }
});