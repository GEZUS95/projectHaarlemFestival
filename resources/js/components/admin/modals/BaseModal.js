import BaseComponent from "../../BaseComponent";

class BaseModel extends BaseComponent {
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
                    box-sizing: border-box;
                    position: absolute;
                    z-index: 100;
                    background: rgba(55,71,79,0.5);
                    top: 0;
                    left: 0;
                    height: 100%;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                
                .container {
                    background-color: #ECEFF1;
                    width: 1000px;
                    min-height: 600px;
                    border-radius: 10px;
                    display: flex;
                    flex-direction: column;
                }
                
                .nav {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 10px;
                    height: 80px;
                    background-color: #B0BEC5;
                    border: solid 1px #64660E;
                    border-radius: 10px;
                    box-shadow: 0 4px 12px -5px rgba(0,0,0,0.44);
                }
                
                .nav-title {
                    font-size: 46px;
                    color: #5A5D61;
                    font-weight: bold;
                }
                
                .footer {
                    margin-top: auto;
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                    padding: 10px;
                    height: 80px;
                    background-color: #B0BEC5;
                    border: solid 1px #64660E;
                    border-radius: 10px;
                    box-shadow: 0 4px 12px -5px rgba(0,0,0,0.44);
                }
                
                .btn {
                    color: #ffffff;
                    font-size: 30px;
                    cursor: pointer;
                    padding: 12px;
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
                
                .failed {
                    border: solid red 3px !important;
                }
                
                .label {
                    color: #37474F;
                    font-size: 21px;
                }
                
                .input {
                    box-sizing: border-box;
                    background-color: #BAC8CF;
                    width: 100%;
                    max-height: 40px;
                    min-height: 40px;
                    color: #37474F;
                    font-size: 21px;
                }
                
                .form {
                    display: flex;
                    flex-wrap: wrap;
                    padding: 30px;
                }
            </style>
            ${this.style()}

            
            <div class="container">
                <div class="nav">
                    <div class="nav-title">${this._$title}</div>
                    <div>Cancel Btn</div>
                </div>
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

    updateModalTitle(title){
        const navTitle = this.shadowRoot.querySelector(".nav-title");
        navTitle.innerHTML = title
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
        if (oldValue !== newValue) {
            this["_$"+ name] = newValue;
        }
    }
}

export default BaseModel;
