
import CreateLocationModal from "./CreateLocationModal";

class UpdateLocationModal extends CreateLocationModal {
    constructor() {
        super();

        this._$query_url = '';
        this._$delete_url = '';
        this._$update = true;
        this._$formData = {
            name: '',
            city: '',
            address: '',
            stage: '',
            color: '',
            seats: '',
        };
    }

    connectedCallback(){
        window.addEventListener("modal-update-location", this.initForm.bind(this));
    }

    async initForm(e){
        let url = this.queryUrlReplaceId(this._$query_url, e.detail);

        const resFormData = await this.setFormData(url, "location")
        this.renderContent();
        const img = this.setImageAttribute(resFormData["location"].images[0]["file_location"],".placeholder-image")

        this.updateModalTitle("Update Performer");
        this.updateImageOnChange(img)

        this.watchFieldsOnChange();
    }

    handleUpdateBtnClick(){
        const image = this.shadowRoot.querySelector('input[type="file"]').files[0];

        let formData = this.createFormData(this._$formData)
        formData.append("file", image)
        formData.append("token", this._$token)

        let url = this.queryUrlReplaceId(this._$url, this._$formData.id);

        this.sendRequestForPaginator(url, this, formData);
    }

    handleDeleteBtnClick(){
        let url = this.queryUrlReplaceId(this._$delete_url, this._$formData.id);

        this.sendRequestForPaginator(url, this);
    }

    static get observedAttributes() {
        return ["url", "token", "query_url", "delete_url"];
    }
}

export default UpdateLocationModal;