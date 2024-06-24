export { Paginator };
export { PageDataType };

type PageDataType = { 'maxPerPage' : number, 'isLastPage' : boolean, 'content' : object[] };

class Paginator {
    #previousPageBtn : HTMLButtonElement;
    #nextPageBtn : HTMLButtonElement;
    #url : string;

    #pageNum : number = 1;

    #pageData : PageDataType;

    constructor(previousPageBtn : Element|null, nextPageBtn : Element|null, url : string) {
        if(previousPageBtn === null) throw new TypeError(`Argument previousPageBtn of ${Paginator.name} constructor expect an instance of HTMLButtonElement. Received null`)
        if(!(previousPageBtn instanceof HTMLButtonElement)) throw new TypeError('Argument previousPageBtn of FeedbacksPaginator constructor expect an instance of HTMLButtonElement. Received ' + Object.getPrototypeOf(previousPageBtn))
        this.#previousPageBtn = previousPageBtn;

        if(previousPageBtn === null) throw new TypeError(`Argument nextPageBtn of ${Paginator.name} constructor expect an instance of HTMLButtonElement. Received null`)
        if(!(nextPageBtn instanceof HTMLButtonElement)) throw new TypeError('Argument nextPageBtn of FeedbacksPaginator constructor expect an instance of HTMLButtonElement. Received ' + Object.getPrototypeOf(nextPageBtn))
        this.#nextPageBtn = nextPageBtn;

        this.#url = url;
        
        this.#init();
    }

    async #init() {
        this.#pageData = await this.#fetchPageData();

        this.#previousPageBtn.addEventListener('click', this.#changePage.bind(this));
        this.#nextPageBtn.addEventListener('click', this.#changePage.bind(this));
    }

    async #changePage(ev : MouseEvent) {
        if(ev.currentTarget === null) return;
        const pageDataLoadedEvent = new Event('pageDataLoaded');

        if(ev.currentTarget === this.#previousPageBtn && this.#pageNum > 1) {
            this.#pageNum--;
            this.#pageData = await this.#fetchPageData()

            this.#previousPageBtn.dispatchEvent(pageDataLoadedEvent);
        }

        if(ev.currentTarget === this.#nextPageBtn && !this.#pageData.isLastPage) {
            this.#pageNum++
            this.#pageData = await this.#fetchPageData()

            this.#nextPageBtn.dispatchEvent(pageDataLoadedEvent);
        }
    }

    async #fetchPageData() {
        const response = await fetch(`${this.#url}?page=${this.#pageNum}`, {'method' : 'GET'});
        return await response.json();
    }

    getPageData() : Promise<PageDataType>|PageDataType {
        return (this.#pageData) ? this.#pageData : new Promise(this.#waitForPageData.bind(this));
    }

    #waitForPageData(resolve : any) {
        if (this.#pageData) {
            resolve(this.#pageData);
        } else {
            setTimeout(this.#waitForPageData.bind(this, resolve), 50);
        }
    }
}