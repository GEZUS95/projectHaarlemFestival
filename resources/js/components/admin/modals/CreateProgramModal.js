import BaseModal from "./BaseModal";

class CreateProgramModal extends BaseModal {
    constructor() {
        super();

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

    style(){
        return `
            
        `
    }

    content(){
        return `
            <h1>test</h1>
            <div>
                <input class="classname" name="title" value="${this._$formData.title}">
            </div>
        `
    }

    connectedCallback(){
        this.renderContent()

        const elements = this.shadowRoot.querySelectorAll(".classname");
        console.log(elements);
        const this_ = this
        Array.from(elements).forEach(function(element) {
            element.addEventListener('change', this_.updateData.bind(this_) );
        });
    }

    updateData(e){
        console.log(this, e.path[0].value)

        this._$formData[e.path[0].name] = e.path[0].value;
        this.updateModalTitle(this._$formData.title);
    }

    handleCreateBtnClick(e){
        console.log(e)
        console.log(this._$formData)
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
