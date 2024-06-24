export { Filter };
class Filter {
    #filters;
    #items;
    #allowMultipleSelections;
    #activeFilters;
    constructor(filters, allowMultipleSelections = false) {
        this.#filters = filters;
        this.#items = this.#getItems();
        this.#activeFilters = 1;
        this.#allowMultipleSelections = allowMultipleSelections;
        this.#init();
    }
    #getItems() {
        return Array.from(this.#filters).map((filter) => {
            return this.#getControlledItem(filter);
        });
    }
    #init() {
        this.#filters.forEach((filter) => { filter.addEventListener('click', this.#filterItems.bind(this)); });
    }
    #filterItems(ev) {
        const filterBtn = ev.currentTarget;
        if (filterBtn === null)
            return;
        if (!(filterBtn instanceof HTMLButtonElement))
            throw new Error('Function filterItems can only be used when clicking on HTMLButtonElement instances.');
        const isExpanded = (filterBtn.getAttribute('aria-expanded') === 'true');
        if (this.#allowMultipleSelections) {
            if (this.#activeFilters === 1 && isExpanded)
                return;
            (isExpanded) ? this.#activeFilters-- : this.#activeFilters++;
            filterBtn.setAttribute('aria-expanded', `${!isExpanded}`);
            this.#filters.forEach((filter) => {
                if (filter.getAttribute('aria-expanded') !== 'true') {
                    this.#getControlledItem(filter).classList.add('d-none');
                }
                else {
                    this.#getControlledItem(filter).classList.remove('d-none');
                }
            });
        }
        else {
            this.#filters.forEach((filter) => filter.setAttribute('aria-expanded', 'false'));
            filterBtn.setAttribute('aria-expanded', 'true');
            this.#items.forEach((item) => item.classList.add('d-none'));
            this.#getControlledItem(filterBtn).classList.remove('d-none');
        }
    }
    #getControlledItem(filterBtn) {
        const controlledItemId = filterBtn.getAttribute('aria-controls');
        if (controlledItemId === null)
            throw new Error('Element ' + filterBtn + ' need to have an attribute aria-controls.');
        const controlledItem = document.getElementById(controlledItemId);
        if (controlledItem === null)
            throw new Error('Attribute aria-controls on element ' + +' doesn\'t correspond to any element in the DOM');
        return controlledItem;
    }
}
