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
            color: '#ffffff',
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

            const elements = this.shadowRoot.querySelectorAll(".input");
            const this_ = this
            Array.from(elements).forEach(function(element) {
                element.addEventListener('change', this_.updateData.bind(this_) );
            });
        }));
    }

    style(){
        return `
        <style>
            .failed {
                border: solid red 3px !important;
            }
            
            .label {
                color: #37474F;
                font-size: 21px;
            }
            
            .input {
                box-sizing: border-box;
                background-color: #BAC8CF;
                width: 100%;
                max-height: 40px;
                min-height: 40px;
                color: #37474F;
                font-size: 21px;
            }
            
            .form-control {
                width: 30%;
                margin: 15px;
                display: flex;
                flex-direction: column;
            }
            
            .form {
                display: flex;
                flex-wrap: wrap;
                padding: 30px;
            }
        </style>
       `;
    }

    content(){
        return `
            <div class="form">
                <div class="form-control">
                    <label class="label" for="title">Program Title:</label>
                    <input class="input" name="title" value="${this._$formData.title}">
                </div>
                <div class="form-control">
                    <label class="label" for="total_price_program">Program Price:</label>
                    <input class="input" name="total_price_program" value="${this._$formData.total_price_program}">
                </div>
                <div class="form-control">
                    <label class="label" for="start_time">Program Start Time:</label>
                    <input class="input" type="datetime-local" name="start_time" value="${this._$formData.start_time.toISOString().slice(0,16)}">
                </div>
                <div class="form-control">
                    <label class="label" for="end_time">Program End Time:</label>
                    <input class="input" type="datetime-local" name="end_time" value="${this._$formData.end_time.toISOString().slice(0,16)}">
                </div>
                <div class="form-control">
                    <label class="label" for="color">Program Color:</label>
                    <input class="input" type="color" name="color" value="${this._$formData.color}">
                </div>
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
        let startTime = new Date(this._$formData.start_time)
        startTime.setTime(startTime.getTime() - (60*60*1000));
        this._$formData.start_time = new Date(startTime).toUTCString();

        let endTime = new Date(this._$formData.end_time)
        endTime.setTime(endTime.getTime() - (60*60*1000));
        this._$formData.end_time = new Date(endTime).toUTCString();

        if(!this.formDataIsFilled(this._$formData))
            return;

        let formData = new FormData();
        const data = this._$formData;
        for (const key in data) {
            if (!data.hasOwnProperty(key))
                return;
            formData.append(key, data[key])
        }

        this.query(this._$url, formData, "POST").then(data => {
            console.log(data);
        });

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
