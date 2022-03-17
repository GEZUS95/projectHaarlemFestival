import BaseModal from "./BaseModal";

class CreateItemModal extends BaseModal {
    constructor() {
        super();

        this._$roles_url = null;
        this._$performers  = [];
        this._$locations  = [];
        this._$formData = {
            price: '',
            end_time: '',
            start_time: '',
        };
    }

    style(){
        return `
        <style>      
        </style>
       `;
    }

    content(){
        this._$performers = this.generateArrFromResponse(this._$performers);
        this._$locations = this.generateArrFromResponse(this._$locations);

        return `
            <div class="form">
                <div class="form-control">
                    <label class="label" for="start_time">Start Time:</label>
                    <input class="input" id="start_time" type="datetime-local" name="start_time">
                </div>
                
                <div class="form-control">
                    <label class="label" for="end_time">End Time:</label>
                    <input class="input" id="end_time" type="datetime-local" name="end_time">
                </div>
                
                <div class="form-control">
                    <label class="label" for="price">Price:</label>
                    <input class="input" id="price" name="price">
                </div>
                
                <div class="form-control">
                    <label class="label">Performer:</label>
                    <select class="input" name="performers" id="performers">
                        <option value="">Select Performer</option>
                        ${this._$performers.map((performer) => {
                            return `<option value="${performer.id}">${performer.name}</option>`;
                        }).join('')}
                    </select>
                </div>
                
                <div class="form-control">
                    <label class="label">Special Guest:</label>
                    <select class="input" name="special_guest" id="special_guest">
                        <option value="">Select Special Guest</option>
                        ${this._$performers.map((performer) => {
                            return `<option value="${performer.id}">${performer.name}</option>`;
                        }).join('')}
                    </select>
                </div>
                
                <div class="form-control">
                    <label class="label">Location:</label>
                    <select class="input" name="locations" id="locations">
                        <option value="">Select Location</option>
                        ${this._$locations.map((location) => {
                            return `<option value="${location.id}">${location.name}</option>`;
                         }).join('')}
                    </select>
                </div>
            </div>
        `
    }

    async connectedCallback(){
        this._$performers = await this.queryGet(this.baseURL + "/admin/item/performers")
        this._$locations = await this.queryGet(this.baseURL + "/admin/item/locations")

        window.addEventListener("modal-create-item", this.initForm.bind(this));
    }

    async initForm(e){
        this.renderContent();

        this._$program_id = e.detail;
        this.updateModalTitle("Create Program Item");

        this.watchFieldsOnChange();
    }

    setDate(date){
        return new Date(date).toUTCString();
    }

    getFormData(){
        const performers = this.shadowRoot.querySelector("#performers");
        const special_guest = this.shadowRoot.querySelector("#special_guest");
        const locations = this.shadowRoot.querySelector("#locations");
        const start_time = this.shadowRoot.querySelector("#start_time");
        const end_time = this.shadowRoot.querySelector("#end_time");
        const price = this.shadowRoot.querySelector("#price");

        let formData = new FormData();
        formData.append("start_time", this.setDate(start_time.value));
        formData.append("end_time", this.setDate(end_time.value));
        formData.append("price", price.value);
        formData.append("token", this.getToken());
        formData.append("performer_id", performers.value);
        formData.append("special_guest_id", special_guest.value);
        formData.append("location_id", locations.value);
        formData.append("program_id", this._$program_id)

        return formData
    }

    resetFormData(){
        this.shadowRoot.querySelector("#performers").value = null;
        this.shadowRoot.querySelector("#special_guest").value = null;
        this.shadowRoot.querySelector("#locations").value = null;
        this.shadowRoot.querySelector("#start_time").value = null;
        this.shadowRoot.querySelector("#end_time").value = null;
        this.shadowRoot.querySelector("#price").value = null;
    }

    handleCreateBtnClick(e){
        const formData = this.getFormData()

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                this.resetFormData();
                this.closeForm();
            }
        }

        xhr.open('POST', this.baseURL + "/admin/item/save", true);
        xhr.send(formData);
    }

    static get observedAttributes() {
        return [];
    }
}

export default CreateItemModal;
