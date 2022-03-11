import CreateRolesModal from "./CreateRolesModal";

class UpdateRolesModal extends CreateRolesModal {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
        this._$perms = null;
        this._$selected = null;
        this._$update = true;
        this._$formData = {
            id: null,
            name: '',
            permissions: '',
        };
    }

    content(){
        return `
            <div class="form">
                <div class="form-control">
                    <label class="label">Name:</label>
                    <input class="input" name="name" value="${this._$formData.name}">
                </div>
                
                <div class="form-control">
                    <multi-select 
                        id="multi-select"
                        title="Select Permissions"
                        selected="${this._$selected}"
                        items="${this._$perms}"
                    ></multi-select>
                </div>
            </div>
        `
    }

    connectedCallback(){
        console.log("test")
        window.addEventListener("modal-update-roles", this.initForm.bind(this));
    }

    async initForm(e){
        let url = this.queryUrlReplaceId(this._$query_url, e.detail);

        const resFormData = await this.queryGet(url)
        this._$perms = this.generateArrFromPerms(this._$perms);
        this._$formData.name = resFormData["roles"].name;
        this._$formData.id = resFormData["roles"].id;
        this._$selected = JSON.parse(resFormData["roles"].permissions);
        this.renderContent();

        this.updateModalTitle("Update Performer");

        const elements = this.shadowRoot.querySelectorAll(".input");
        const _this = this;
        Array.from(elements).forEach(function(element) {
            element.addEventListener('change', _this.updateData.bind(_this) );
        });
    }

    handleUpdateBtnClick(){
        const multiSelect = this.shadowRoot.querySelector("#multi-select");
        this._$formData.permissions = multiSelect.value;

        let formData = this.createFormData(this._$formData)
        formData.append("token", this._$token)

        let url = this.queryUrlReplaceId(this._$url, this._$formData.id);
        this.sendRequestForPaginator(url, this, formData);
    }

    handleDeleteBtnClick(){
        let url = this.queryUrlReplaceId(this._$delete_url, this._$formData.id);

        this.sendRequestForPaginator(url, this);
    }

    static get observedAttributes() {
        return ["url", "token", "query_url", "delete_url", "perms"];
    }
}

export default UpdateRolesModal;