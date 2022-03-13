import CreateRolesModal from "./CreateRolesModal";

class UpdateRolesModal extends CreateRolesModal {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
        this._$perms = null;
        this._$selected = null;
        this._$roles = [];
        this._$update = true;
        this._$roleId = null;
        this._$formData = {
            name: '',
            email: '',
            role_id: '',
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
                    <label class="label">Email:</label>
                    <input class="input" name="email" value="${this._$formData.email}">
                </div>
                
                <div class="form-control">
                    <label class="label">Role:</label>
                    <select class="input" name="roles" id="roles">
                       ${this._$roles.map((role) => {
                            return `<option value="${role.id}">${role.name}</option>`;
                        }).join('')}
                    </select>
                </div>
            </div>
        `
    }

    connectedCallback(){
        console.log("test")
        window.addEventListener("modal-update-user", this.initForm.bind(this));
    }

    async initForm(e){
        let url = this.queryUrlReplaceId(this._$query_url, e.detail);
        this._$roles = await this.queryGet(this._$roles_url);
        const resFormData = await this.setFormData(url, "user")

        this.renderContent();

        const el = this.shadowRoot.querySelector("#roles");
        el.value = resFormData["user"].role_id;

        this.updateModalTitle("Update User");

        this.watchFieldsOnChange();
    }

    handleUpdateBtnClick(){
        const select = this.shadowRoot.querySelector("#roles");
        this._$formData.role_id = select.value;

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
        return ["url", "token", "query_url", "delete_url", "roles_url"];
    }
}

export default UpdateRolesModal;