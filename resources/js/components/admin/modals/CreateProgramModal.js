import BaseModal from "./BaseModal";

class CreateProgramModal extends BaseModal {
    constructor() {
        super();

        this._$url = null;
        this._$formData = {
            title: "Untitled",
            total_price_program: '',
            start_time: null,
            end_time: null,
            color: '',
            event_id: null,
        };

        window.addEventListener("init-create-program-modal", ((e) => {
            //parse it to current local date time for amsterdam! who doesnt love timezones and utc dates :D
            let startTime = e.detail.startTime;
            startTime.setTime(startTime.getTime() + (60*60*1000));
            let endTime = e.detail.endTime;
            endTime.setTime(endTime.getTime() + (60*60*1000));

            this._$formData.start_time = startTime;
            this._$formData.end_time = endTime;
            this._$formData.event_id = e.detail.eventId;

            this.renderContent()

            const elements = this.shadowRoot.querySelectorAll(".form-input");
            const this_ = this
            Array.from(elements).forEach(function(element) {
                element.addEventListener('change', this_.updateData.bind(this_) );
            });
        }));
    }

    style(){
        return `
            
        `
    }

    content(){
        return `
            <div>
                <input class="form-input" required name="title" value="${this._$formData.title}">
                <input class="form-input" required name="total_price_program" value="${this._$formData.total_price_program}">
                <input class="form-input" required type="datetime-local" name="start_time" value="${this._$formData.start_time.toISOString().slice(0,16)}">
                <input class="form-input" required type="datetime-local" name="end_time" value="${this._$formData.end_time.toISOString().slice(0,16)}">
                <input class="form-input" required type="color" name="color" value="${this._$formData.color}">
            </div>
        `
    }

    connectedCallback(){

    }

    updateData(e){
        console.log(this, e.path[0].value)

        this._$formData[e.path[0].name] = e.path[0].value;
        this.updateModalTitle(this._$formData.title);
    }

    handleCreateBtnClick(e){
        console.log(e)

        let startTime = new Date(this._$formData.start_time)
        startTime.setTime(startTime.getTime() - (60*60*1000));
        this._$formData.start_time = startTime;

        let endTime = new Date(this._$formData.end_time)
        endTime.setTime(endTime.getTime() - (60*60*1000));
        this._$formData.end_time = endTime;



    }

    async postFormData(url = '', data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });

        return response.json();
    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["url"];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this._$url = newValue;
        }
    }
}

export default CreateProgramModal;
