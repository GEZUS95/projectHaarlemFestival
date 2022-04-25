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
                
                .form-control {
                    padding: 15px 10px;
                    width: 50%;
                    display: flex;
                    box-sizing: border-box;
                    flex-direction: column;
                }
                
                .form-control-multi-select {
                    padding: 15px 10px;
                    width: 100%;
                    display: flex;
                    box-sizing: border-box;
                    flex-direction: column;
                }
                
                .form-image {
                    box-sizing: border-box;
                    padding: 10px;
                    width: 100%;
                    display: flex;
                    flex-direction: row;
                }
                         
                .image-label {
                    background-color: #ffffff;
                    width: 50%;
                    height: 200px;
                }
                
                .image-cloud {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-right: 20px;
                } 
                
                .image-cloud-svg {
                    height: 200px;
                    width: 200px;
                }
                
                .form-control-textarea {
                    box-sizing: border-box;
                    padding: 15px 10px;
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                }
                
                .textarea-input {
                    box-sizing: border-box;
                    background-color: #BAC8CF;
                    width: 100%;
                    max-height: 100px;
                    min-height: 100px;
                    color: #37474F;
                    font-size: 21px;
                }
            
            </style>
            ${this.style()}

            
            <div class="container">
                <div class="nav">
                    <div class="nav-title">${this._$title}</div>
                    <div></div>
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

    updateData(e){
        const el = e.path[0];
        this._$formData[el.name] = el.value;
    }

    handleCreateBtnClick(){

    }

    handleUpdateBtnClick(){

    }

    handleDeleteBtnClick(){

    }

    handleCancelBtnClick(){
        this._$formData = this.clearFormData(this._$formData)
        this.closeForm();
    }

    closeForm(){
        this.shadowRoot.innerHTML = '';
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

    formDataIsFilled(data){
        let passed = true;
        for (const key in data) {

            if (!data.hasOwnProperty(key))
                return false;

            const el = this.shadowRoot.querySelector(`input[name="${key}"]`);

            if(!data[key]) {
                passed = false;
                el.classList.add("failed")
            }
        }

        return passed;
    }

    createFormData(data){
        let formData = new FormData();
        for (const key in data) {
            if (!data.hasOwnProperty(key))
                return;
            formData.append(key, data[key])
        }
        return formData;
    }

    clearFormData(data){
        for (const key in data) {

            if (!data.hasOwnProperty(key))
                return;
            data[key] = '';
        }
        return data;
    }

    sendRequestForPaginator(url, _this = this, sendData = null){
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent('paginator-force-reload', {detail: true}))
                _this._$formData = _this.clearFormData(_this._$formData)
                _this.closeForm();
            }
        }

        xhr.open('POST', url, true);
        xhr.send(sendData);
    }

    queryUrlReplaceId(url, id){
        url = url.replace('{', '');
        url = url.replace('}', '');
        return url.replace('id', id);
    }

    async setFormData(url, type){
        const resFormData = await this.queryGet(url);

        for (const key in resFormData[type]) {
            if (!resFormData[type].hasOwnProperty(key) && this._$formData.hasOwnProperty(key))
                return;
            this._$formData[key] = resFormData[type][key]
        }

        return resFormData;
    }

    setImageAttribute(file_location, selector){
        const imgUrl = location.protocol + '//' + location.host + '/images/' + file_location;
        const img = this.shadowRoot.querySelector(selector);
        img.src = imgUrl;
        return img;
    }

    updateImageOnChange(img){
        this.shadowRoot.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                img.onload = () => {
                    URL.revokeObjectURL(img.src);
                }
                img.src = URL.createObjectURL(this.files[0]);
            }
        });
    }

    handleImageObjectUrl(e){
        const el = e.path[0]
        if (!(el.files && el.files[0])) return;

        const img = this.shadowRoot.querySelector('.placeholder-image');

        img.onload = () => URL.revokeObjectURL(img.src);
        img.src = URL.createObjectURL(el.files[0]);
    }

    watchFieldsOnChange(){
        const elements = this.shadowRoot.querySelectorAll(".input, .textarea-input");
        Array.from(elements).forEach((element) => {
            element.addEventListener('change', this.updateData.bind(this) );
        });
    }
}

export default BaseModel;
