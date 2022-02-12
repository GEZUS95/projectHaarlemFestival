class EventOverviewPage extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });
    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
            <h1>Event overview! 222222</h1>
        `;
    }

    disconnectedCallback() {

    }

    static get observedAttributes() { return [""]; }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            console.log(newValue);
        }
    }
}

export default EventOverviewPage;