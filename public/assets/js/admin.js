import { Dialog } from "./Dialog";
const dialogs = document.querySelectorAll('.dialog');
const btns = document.querySelectorAll('.dialog-btn');
for (let i = 0; i < dialogs.length; i++) {
    new Dialog(dialogs[i], btns[i]);
}
