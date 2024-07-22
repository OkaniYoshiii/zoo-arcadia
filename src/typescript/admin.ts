import { Dialog } from "./components/Dialog.js";

const btns = document.querySelectorAll('.dialog-btn');

if(btns) {
    btns.forEach((btn) => { new Dialog(btn); })
}