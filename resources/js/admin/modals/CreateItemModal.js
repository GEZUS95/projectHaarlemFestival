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
                    <input class="input" type="datetime-local" name="start_time">
                </div>
                
                <div class="form-control">
                    <label class="label" for="end_time">End Time:</label>
                    <input class="input" type="datetime-local" name="end_time">
                </div>
                
                <div class="form-control">
                    <label class="label" for="price">Price:</label>
                    <input class="input" name="price">
                </div>
                
                <div class="form-control">
                    <label class="label">Performer:</label>
                    <select class="input" name="performers" id="performers">
                        <option value="null">Select Performer</option>
                        ${this._$performers.map((performer) => {
                            return `<option value="${performer.id}">${performer.name}</option>`;
                        }).join('')}
                    </select>
                </div>
                
                <div class="form-control">
                    <label class="label">Special Guest:</label>
                    <select class="input" name="special_guest" id="special_guest">
                        <option value="null">Select Special Guest</option>
                        ${this._$performers.map((performer) => {
                            return `<option value="${performer.id}">${performer.name}</option>`;
                        }).join('')}
                    </select>
                </div>
                
                <div class="form-control">
                    <label class="label">Location:</label>
                    <select class="input" name="locations" id="locations">
                        <option value="null">Select Location</option>
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

        this._$program_id = e.detail.id

        this.updateModalTitle("Create Program Item");

        this.watchFieldsOnChange();
    }

    handleCreateBtnClick(e){
        const performers = this.shadowRoot.querySelector("#performers");
        const special_guest = this.shadowRoot.querySelector("#special_guest");
        const locations = this.shadowRoot.querySelector("#locations");

        let formData = this.createFormData(this._$formData)
        formData.append("token", this._$crsfToken);
        formData.append("performers", performers.value);
        formData.append("special_guest", special_guest.value);
        formData.append("locations", locations.value);
        formData.append("program_id", this._$program_id)

        this.sendRequestForPaginator(this.baseURL + "/admin/item/save", this, formData);
    }

    static get observedAttributes() {
        return [];
    }
}

export default CreateItemModal;
