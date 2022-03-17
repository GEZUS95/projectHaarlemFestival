import CreateItemModal from "./CreateItemModal";

class UpdateItemModal extends CreateItemModal {
    constructor() {
        super();

        this._$update = true;
    }

    async connectedCallback(){
        this._$performers = await this.queryGet(this.baseURL + "/admin/item/performers")
        this._$locations = await this.queryGet(this.baseURL + "/admin/item/locations")

        window.addEventListener("modal-update-item", this.initForm.bind(this));
    }

    async initForm(e){
        let url = this.baseURL +"/admin/item/single/"+ e.detail;
        this._$program_id = e.detail;

        const resFormData = await this.queryGet(url)
        console.log(resFormData);
        this.renderContent();

        this.updateModalTitle("Update Performer");
    }

    handleUpdateBtnClick(){
        const formData = this.returnFormData()

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                // this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL + "/admin/item/save", true);
        xhr.send(formData);
    }

    handleDeleteBtnClick(){
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                // this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL + "/admin/item/save", true);
        xhr.send(formData);
    }

    static get observedAttributes() {
        return [""];
    }
}

export default UpdateItemModal;
