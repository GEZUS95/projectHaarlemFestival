import BaseComponent from "../../BaseComponent";

class BaseForm extends BaseComponent {
    constructor() {
        super();

        this._$title = "Untitled"
        this._$update = false;
    }

    style(){
        return `
            <style>
            
            </style>
        `
    }

    content(){
        return `
        
        `
    }

    renderContent(){
        this.shadowRoot.innerHTML = `
            <style>
                :host {
                    height: 100%;
                }
            
                .container {
                    height: 100%;
                    background-color: #BAC8CF;
                    display: flex;
                    flex-direction: column;
                }
                
                .btn {
                    color: #ffffff;
                    font-size: 24px;
                    cursor: pointer;
                    padding: 8px;
                    line-height: 1.5;
                    border-radius: 0.3rem;
                    user-select: none;
                    border: 1px solid transparent;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                    width: 170px;
                    height: 30px;
                    margin: 0 10px;
                }
                
                .btn-create {
                    background-color: #007BFF;
                }
                
                .btn-update {
                    background-color: #007BFF;
                }
                
                .btn-cancel {
                    background-color: #6C757D;
                }
                
                .btn-delete {
                    background-color: #D22222;
                }
                
                .footer {
                    margin-top: auto;
                    margin-bottom: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                }
            </style>
            ${this.style()}

            
            <div class="container">
                    ${this.content()}
                    
                <div class="footer">
                    ${this._$update === true ?
                        `<div class="btn btn-update">Update</div>
                        <div class="btn btn-cancel">Cancel</div>
                        <div class="btn btn-delete">Delete</div>`
                    :
                        `<div class="btn btn-create">Create</div>
                        <div class="btn btn-cancel">Cancel</div>`
                    }
                </div>
            </div>
        `;


        const btnCreate = this.shadowRoot.querySelector(".btn-create");
        const btnUpdate = this.shadowRoot.querySelector(".btn-update");
        const btnDelete = this.shadowRoot.querySelector(".btn-delete");
        const btnCancel = this.shadowRoot.querySelector(".btn-cancel");

        if(btnCreate) btnCreate.addEventListener("click", this.handleCreateBtnClick.bind(this));
        if(btnUpdate) btnUpdate.addEventListener("click", this.handleUpdateBtnClick.bind(this));
        if(btnDelete) btnDelete.addEventListener("click", this.handleDeleteBtnClick.bind(this));
        if(btnCancel) btnCancel.addEventListener("click", this.handleCancelBtnClick.bind(this));
    }

    handleCreateBtnClick(){

    }

    handleUpdateBtnClick(){

    }

    handleCancelBtnClick(){
        this.closeForm();
    }

    closeForm(){
        this.shadowRoot.innerHTML = '';
    }

    handleDeleteBtnClick(){

    }

    disconnectedCallback() {

    }

    static get observedAttributes() {

    }

    attributeChangedCallback(name, oldValue, newValue) {

    }
}

export default BaseForm;
