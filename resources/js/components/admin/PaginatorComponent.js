import BaseComponent from "../BaseComponent";

class PaginatorComponent extends BaseComponent {
    constructor() {
        super();

        this._$url = null;
    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
            <h1>Paginator!</h1>
        `
    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["url"];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this._$url = newValue;
            this.queryGet(this._$url).then(res => {
                console.log(res);
            });
        }
    }
}

export default PaginatorComponent;
