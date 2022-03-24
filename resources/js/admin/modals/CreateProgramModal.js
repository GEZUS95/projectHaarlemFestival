import BaseModal from "./BaseModal";

class CreateProgramModal extends BaseModal {
    constructor() {
        super();

        this._$url = null;
        this._$formData = {
            title: '',
            total_price_program: '',
            start_time: null,
            end_time: null,
            color: '#ffffff',
            event_id: null,
        };

        this._$time = new Date();
    }

    style(){
        return `
        <style>
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
        window.addEventListener("init-create-program-modal", this.initForm.bind(this));
    }

    async initForm(e){
        let startTime = e.detail.startTime;
        startTime.setTime(startTime.getTime() + (60*60*1000));
        let endTime = e.detail.endTime;
        endTime.setTime(endTime.getTime() + (60*60*1000));

        this._$formData.start_time = startTime;
        this._$formData.end_time = endTime;
        this._$formData.event_id = e.detail.eventId;
        this._$time = startTime;
        console.log(this._$formData.start_time )
        this.renderContent();
        this.updateModalTitle("Create Program");
        this.watchFieldsOnChange();
    }

    handleCancelBtnClick() {
        super.handleCancelBtnClick();
        window.dispatchEvent(new CustomEvent('force-refresh', {detail: new Date(this._$time)}))
    }

    setDate(date){
        let time = new Date(date)
        time.setTime(time.getTime() - (60*60*1000));
        return new Date(time).toUTCString();
    }

    handleCreateBtnClick(e){
        this._$formData.start_time = this.setDate(this._$formData.start_time)
        this._$formData.end_time = this.setDate(this._$formData.end_time)

        if(!this.formDataIsFilled(this._$formData))
            return;

        let formData = this.createFormData(this._$formData)

        this.query(this._$url, formData, "POST").then(data => {
            if(data.Error)
                return;

            window.dispatchEvent(new CustomEvent('force-refresh', {detail: this._$formData.start_time}))
            super.closeForm();
        });

    }

    static get observedAttributes() {
        return ["url"];
    }
}

export default CreateProgramModal;
