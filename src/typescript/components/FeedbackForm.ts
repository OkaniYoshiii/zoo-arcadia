export { FeedbackForm };

type Feedback = { 'username' : string, 'content' : string, 'date' : any, 'isValidated' : boolean };

class FeedbackForm {
    #element : HTMLFormElement;

    constructor(element : HTMLElement|null) {
        if(element === null) throw new Error('FeedbackForm constructor parameter \'element\' expects an instance of HTLMFormElement. Received \'null\'')
        if(!(element instanceof HTMLFormElement)) throw new TypeError(`${element} need to be an instance of HTMLFormElement. ${Object.getPrototypeOf(element)}`);
        this.#element = element;
        this.#init();
    }

    #init() {
        this.#element.addEventListener('submit', this.#handleFormSubmission.bind(this));
    }

    async #handleFormSubmission(ev : SubmitEvent) {
        ev.preventDefault();

        await this.#sendFormData(new FormData(this.#element));
    }

    async #sendFormData(formData : FormData) {
        const response = await fetch(this.#element.action, { 'method' : 'POST', 'body' : formData });
        const data = await response.json();

        console.log(data);

        this.#updateFeedbacks(data);
    }

    #updateFeedbacks(feedbacks : Feedback[]) {
        // const feedbacksElement = document.querySelectorAll('.feedback');
        // const feedbacksWrapperElement = document.querySelector('.feedbacks');
        // if(feedbacksElement === null) return;
        // const feedbacksElementClone = feedbacksWrapperElement?.cloneNode(false);

        // feedbacks.forEach((feedback : Feedback) => {
        //     const div = document.createElement('div');

        //     const paragraphs : HTMLParagraphElement[] = [];
    
        //     // Premier paragraphe
        //     const paragraph1 = document.createElement('p');
        //     const span1 = document.createElement('span');
    
        //     paragraph1.textContent = feedback.date;
        //     span1.classList.add('fw-bold', 'color-primary');
        //     span1.textContent = 'Publié par : '
        //     paragraph1.insertAdjacentElement('afterbegin', span1);
    
        //     paragraphs.push(paragraph1);
    
        //     // Deuxième paragraphe
        //     const paragraph2 = document.createElement('p');
        //     const span2 = document.createElement('span');
    
        //     paragraph2.textContent = feedback.username;
        //     span2.classList.add('fw-bold', 'color-primary');
        //     span2.textContent = 'Par : '
        //     paragraph2.insertAdjacentElement('afterbegin', span2);
    
        //     paragraphs.push(paragraph2);
    
        //     // Troisième paragraphe
        //     const paragraph3 = document.createElement('p');
    
        //     paragraph3.textContent = feedback.content;
    
        //     paragraphs.push(paragraph3);
    
        //     // Regroupement dans la div
        //     for (let i = 0; i < paragraphs.length; i++) {
        //         div.appendChild(paragraphs[i]);
        //     }
    
        //     // Ajout dans le DOM
        //     const hr = document.createElement('hr');
    
        //     feedbacksElementClone?.appendChild(hr);
        //     feedbacksElementClone?.appendChild(div);
        // })
        
        // feedbacksElement?.remove();

        const p = document.createElement('p');

        p.textContent = 'Votre avis a bien été envoyé et devra être validé par un de nos agents avant publication.';
        p.classList.add('fw-bold');

        this.#element.insertAdjacentElement('beforebegin', p);
        this.#element.remove();
    }
}