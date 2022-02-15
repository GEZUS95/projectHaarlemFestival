class CreateProgramModal extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this._$url = null;
        this._$formData = {
            title: "Untitled",
            total_price_program: null,
            start_time: null,
            end_time: null,
            color: null,
            event_id: null,
        };

    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
            <div>
                <div>${this._$formData.title}</div>
            
                <div></div>
            </div>
        `;
    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["link"];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this._$url = newValue;
        }
    }
}

export default CreateProgramModal;
