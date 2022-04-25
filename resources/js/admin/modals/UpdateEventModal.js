import CreateEventModal from "./CreateEventModal";

class UpdateEventModal extends CreateEventModal {
    constructor() {
        super();

        this._$query_url = '';
        this._$delete_url = '';
        this._$update = true;
        this._$formData = {
            title: '',
            total_price_event: '',
            description: '',
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
        let img;
        if(resFormData["event"].images[0])
            img = this.setImageAttribute(resFormData["event"].images[0]["file_location"],".placeholder-image")
        else img = this.setImageAttribute("https://via.placeholder.com/150",".placeholder-image")

        this.updateModalTitle("Update Event");
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

export default UpdateEventModal;