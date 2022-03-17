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
    }

    connectedCallback(){
        window.addEventListener("modal-update-event", this.initForm.bind(this));
    }

    async initForm(e){
        let url = this.queryUrlReplaceId(this._$query_url, e.detail);

        const resFormData = await this.setFormData(url, "event")
        console.log(resFormData);
        this.renderContent();

        this.updateModalTitle("Update Program");

        this.watchFieldsOnChange();
    }

    handleUpdateBtnClick(){
        let formData = this.createFormData(this._$formData)
        formData.append("token", this._$token)

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {

                // this._$formData = this.clearFormData(this._$formData)
                // this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL, true);
        xhr.send();
    }

    handleDeleteBtnClick(){
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {

                // this._$formData = this.clearFormData(this._$formData)
                // this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL, true);
        xhr.send();
    }

    static get observedAttributes() {
        return [];
    }
}

export default CreateProgramModal;
