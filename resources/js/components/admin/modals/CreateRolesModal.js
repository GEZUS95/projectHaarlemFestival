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
            .form-control {
                margin-right: 30px;
                margin-bottom: 30px;
                width: 45%;
                display: flex;
                flex-direction: column;
            }
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
                    <label class="label">Name:</label>
                    <select name="cars" id="cars" multiple>
                           ${this._$perms.map((perm) => {
                                return `<option value="volvo">${perm}</option>`;
                           }).join('')}
                    </select>
                </div>
               
            </div>
        `


    }

    connectedCallback(){
        const _this = this;
        if(this._$perms == null)
            return;

        const data = JSON.parse(this._$perms);
        let tmpArr = [];
        for(const key in data)
            if (data.hasOwnProperty(key))
                tmpArr.push(data[key]);

        this._$perms = tmpArr;

        window.addEventListener("modal-create-roles", (() => {
            _this.renderContent();

            _this.updateModalTitle("Create Roles");

            const elements = _this.shadowRoot.querySelectorAll(".input");
            Array.from(elements).forEach(function(element) {
                element.addEventListener('change', _this.updateData.bind(_this) );
            });
        }));
    }

    handleCreateBtnClick(e){
        let formData = this.createFormData(this._$formData)
        formData.append("token", this._$token)

        this.sendRequestForPaginator(this._$url, this, formData);
    }

    static get observedAttributes() {
        return ["url", "token", "perms"];
    }
}

export default CreateRolesModal;
