import { Dialog } from "./components/Dialog";

const btns = document.querySelectorAll('.dialog-btn');

if(btns) {
    btns.forEach((btn) => { new Dialog(btn); })
}