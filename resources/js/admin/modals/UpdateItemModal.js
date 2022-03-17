import CreateItemModal from "./CreateItemModal";

class UpdateItemModal extends CreateItemModal {
    constructor() {
        super();

        this._$update = true;
        this._$itemId = null;
    }

    async connectedCallback(){
        this._$performers = await this.queryGet(this.baseURL + "/admin/item/performers")
        this._$locations = await this.queryGet(this.baseURL + "/admin/item/locations")

        window.addEventListener("modal-update-item", this.initForm.bind(this));
    }

    setFormData(data){
        this.shadowRoot.querySelector("#performers").value = data["performer_id"];
        this.shadowRoot.querySelector("#special_guest").value = data["special_guest_id"];
        this.shadowRoot.querySelector("#locations").value = data["location_id"];
        this.shadowRoot.querySelector("#start_time").value = new Date(new Date(data["start_time"]).getTime() + (60*60*1000)).toISOString().slice(0,16);
        this.shadowRoot.querySelector("#end_time").value = new Date(new Date(data["end_time"]).getTime() + (60*60*1000)).toISOString().slice(0,16);
        this.shadowRoot.querySelector("#price").value = data["price"];
    }

    async initForm(e){
        let url = this.baseURL +"/admin/item/single/"+ e.detail["item_id"];
        this._$itemId = e.detail["item_id"];
        this._$program_id = e.detail["program_id"];

        const resFormData = await this.queryGet(url)


        this.renderContent();
        this.setFormData(resFormData);
        this.updateModalTitle("Update Item");
    }

    handleUpdateBtnClick(){
        const formData = this.getFormData()

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent('refresh-program-overview', {detail: this._$program_id}))
                this.clearFormData();
                this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL + "/admin/item/update/" + this._$itemId, true);
        xhr.send(formData);
    }

    handleDeleteBtnClick(){
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent('refresh-program-overview', {detail: this._$program_id}))
                this.clearFormData();
                this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL + "/admin/item/delete/" + this._$itemId, true);
        xhr.send();
    }

    static get observedAttributes() {
        return [""];
    }
}

export default UpdateItemModal;
