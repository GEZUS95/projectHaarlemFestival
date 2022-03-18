import CreateProgramModal from "./CreateProgramModal";

class UpdateProgramModal extends CreateProgramModal {
    constructor() {
        super();

        this._$update = true;
        this._$programId = null;
    }

    connectedCallback(){
        window.addEventListener("modal-update-program", this.initForm.bind(this));
    }

    async initForm(e){
        this._$programId = e.detail;

        await this.setFormData(this.baseURL + "/admin/program/single/" + e.detail, "program")
        let startTime = new Date(this._$formData.start_time);
        let endTime = new Date(this._$formData.end_time);
        this._$formData.start_time = new Date(startTime.setTime(startTime.getTime() + (60*60*1000)));
        this._$formData.end_time = new Date(endTime.setTime(endTime.getTime() + (60*60*1000)));
        this.renderContent();

        this.updateModalTitle("Update Program");

        this.watchFieldsOnChange();
    }

    handleUpdateBtnClick(){
        this._$formData.start_time = this.setDate(this._$formData.start_time)
        this._$formData.end_time = this.setDate(this._$formData.end_time)

        let formData = this.createFormData(this._$formData)
        formData.append("token", this.getToken());

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent('refresh-program-overview', {detail: this._$program_id}))
                this._$formData = this.clearFormData(this._$formData)
                this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL +"/admin/program/update/"+this._$programId, true);
        xhr.send(formData);
    }

    handleDeleteBtnClick(){
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent("hide-program-overview", {detail : true}))
                window.dispatchEvent(new CustomEvent("show-event-overview", {detail : true}))
                this._$formData = this.clearFormData(this._$formData)
                this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL +"/admin/program/delete/"+this._$programId, true);
        xhr.send();
    }

    handleCancelBtnClick(){
        window.dispatchEvent(new CustomEvent('refresh-program-overview', {detail: this._$program_id}))
        this._$formData = this.clearFormData(this._$formData)
        this.closeForm();
    }

    static get observedAttributes() {
        return [];
    }
}

export default UpdateProgramModal;
