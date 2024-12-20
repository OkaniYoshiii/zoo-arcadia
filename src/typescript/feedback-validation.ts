import { Paginator } from "./components/Paginator.js";
import { PageDataType } from "./components/Paginator.js";

type FeedbackDataType = {
    'maxPerPage' : number,
    'isLastPage' : boolean,
    'content' : {
        '_id' : {
            '$oid' : number,
        },
        'username' : string,
        'content' : string,
        'date' : string,
        'is_validated' : boolean
    }[]
};
const previousPageBtn = document.querySelector(".feedback-paginator button[data-type='paginator'][data-action='previous']");
const nextPageBtn = document.querySelector(".feedback-paginator button[data-type='paginator'][data-action='next']");

const paginator = new Paginator(previousPageBtn,nextPageBtn,'/api/feedbacks');

let pageData = paginator.getPageData();
if(pageData instanceof Promise) pageData.then((data : PageDataType) => {
    updateFeedbacks(data);
});

if(previousPageBtn !== null) {
    previousPageBtn.addEventListener("pageDataLoaded",(e) => {
        pageData = paginator.getPageData();
        if(pageData instanceof Promise) return;

        updateFeedbacks(pageData);
    }, false,);
}

if(nextPageBtn !== null) {
    nextPageBtn.addEventListener("pageDataLoaded",(e) => {
        pageData = paginator.getPageData();
        if(pageData instanceof Promise) return;
        
        updateFeedbacks(pageData);
    }, false,);
}



function updateFeedbacks(data : PageDataType) {
    const feedbackTemplate = document.getElementById('feedback-template');
    const feedbacksWrapper = document.querySelector('.feedbacks');

    if(feedbackTemplate === null) return;
    if(!(feedbackTemplate instanceof HTMLTemplateElement)) return;
    if(feedbacksWrapper === null) return;

    feedbacksWrapper.innerHTML = '';
    if(!isFeedback(data)) return;
    data.content.forEach((feedback) => {
        const clone = feedbackTemplate.content.cloneNode(true);
        if(!(clone instanceof DocumentFragment)) return;
    
        const feedbackDateOutput = clone.querySelector('[data-property="date"]')
        if(feedbackDateOutput) {
            feedbackDateOutput.textContent = feedback.date;
        }
    
        const feedbackUsernameOutput = clone.querySelector('[data-property="username"]')
        if(feedbackUsernameOutput) {
            feedbackUsernameOutput.textContent = feedback.username;
        }
    
        const feedbackContentOutput = clone.querySelector('[data-property="content"]')
        if(feedbackContentOutput) {
            feedbackContentOutput.textContent = feedback.content;
        }

        const feedbackValidationInputs = clone.querySelectorAll('.form-input__input[type="radio"][name="isValidated"]');
        feedbackValidationInputs.forEach((validationInput) => {
            if(validationInput instanceof HTMLInputElement && validationInput.value === String(feedback.is_validated)) {
                validationInput.checked = true;
            }
        })

        const feedbackIdInput = clone.querySelector('input[type="hidden"][name="feedbackId"]');
        if(feedbackIdInput instanceof HTMLInputElement) {
            feedbackIdInput.value = String(feedback._id.$oid);
        }
    
        feedbacksWrapper.appendChild(clone);
    })
}

function isFeedback(pageData : PageDataType) : pageData is FeedbackDataType {
    return pageData.content.every((value) => {
        return  value.hasOwnProperty('date') &&
                value.hasOwnProperty('username') &&
                value.hasOwnProperty('content') && 
                value.hasOwnProperty('_id') &&
                value.hasOwnProperty('is_validated');
    })
}