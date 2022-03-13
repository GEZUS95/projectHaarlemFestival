import BaseModal from "./BaseModal";

class CreateRolesModal extends BaseModal {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
        this._$perms = null;
        this._$formData = {
            name: '',
            permissions: '',
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
                
                <div class="form-control-multi-select">
                    <multi-select 
                        id="multi-select"
                        title="Select Permissions"
                        items="${this._$perms}"
                    ></multi-select>
                </div>
            </div>
        `
    }

    generateArrFromPerms(perms){
        if(Array.isArray(perms)) return perms;

        const data = JSON.parse(perms);
        let tmpArr = [];
        for(const key in data)
            if (data.hasOwnProperty(key))
                tmpArr.push(data[key]);

        return tmpArr
    }

    connectedCallback(){
        const _this = this;
        if(this._$perms == null)
            return;

        this._$perms = this.generateArrFromPerms(this._$perms);

        window.addEventListener("modal-create-roles", this.initForm.bind(this));
    }

    async initForm(){
        this.renderContent();

        this.updateModalTitle("Create Role");

        this.watchFieldsOnChange();
    }

    handleCreateBtnClick(e){
        const multiSelect = this.shadowRoot.querySelector("#multi-select");
        this._$formData.permissions = multiSelect.value;
        let formData = this.createFormData(this._$formData)
        formData.append("token", this._$token)

        this.sendRequestForPaginator(this._$url, this, formData);
    }

    static get observedAttributes() {
        return ["url", "token", "perms"];
    }
}

export default CreateRolesModal;
