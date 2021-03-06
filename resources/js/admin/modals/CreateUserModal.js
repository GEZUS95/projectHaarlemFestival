import BaseModal from "./BaseModal";

class CreateUsersModal extends BaseModal {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
        this._$roles_url = null;
        this._$roles = [];
        this._$formData = {
            name: '',
            email: '',
            password: '',
            role_id: '',
        };
    }

    style(){
        return `
        <style>      
        </style>
       `;
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
                    <label class="label">Password:</label>
                    <input class="input" name="password" value="${this._$formData.password}">
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

    async connectedCallback(){
        this._$roles = await this.queryGet(this._$roles_url);

        window.addEventListener("modal-create-user", this.initForm.bind(this));
    }

    async initForm(){
        this.renderContent();

        this.updateModalTitle("Create User");

        this.watchFieldsOnChange();
    }

    handleCreateBtnClick(e){
        const select = this.shadowRoot.querySelector("#roles");
        this._$formData.role_id = select.value;
        let formData = this.createFormData(this._$formData)
        formData.append("token", this._$token)

        this.sendRequestForPaginator(this._$url, this, formData);
    }

    static get observedAttributes() {
        return ["url", "token", "roles_url"];
    }
}

export default CreateUsersModal;
