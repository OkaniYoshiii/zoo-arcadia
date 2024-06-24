import { Dialog } from "./components/Dialog";

const dialogs = document.querySelectorAll('.dialog') as NodeListOf<HTMLDialogElement>;
const btns = document.querySelectorAll('.dialog-btn') as NodeListOf<HTMLButtonElement>;

for (let i = 0; i < dialogs.length; i++) {
    new Dialog(dialogs[i], btns[i]);
}