import BaseForm from "./BaseForm";

class CreateLocationForm extends BaseForm {
    constructor() {
        super();

        this._$url = null;
        this._$formData = {
            name: '',
            city: '',
            address: '',
            stage: '',
            color: '',
            seats: '',
        };
    }

    style(){
        return `
        <style>
            .failed {
                border: solid red 3px !important;
            }
            
            .label {
                color: #37474F;
                font-size: 21px;
            }
            
            .input {
                box-sizing: border-box;
                background-color: #ffffff;
                width: 100%;
                max-height: 40px;
                min-height: 40px;
                color: #37474F;
                font-size: 21px;
            }
            
            .form-control {
                margin-right: 30px;
                margin-bottom: 30px;
                width: 45%;
                display: flex;
                flex-direction: column;
            }
            
            .form-image {
                width: 100%;
                display: flex;
                flex-direction: row;
            }
            
            .form {
                display: flex;
                flex-wrap: wrap;
                padding: 30px;
            }
            
            .image-label {
                background-color: #ffffff;
                width: 45%;
                height: 320px;
            }
            
            .image-cloud {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 30px; 
                margin-bottom: 30px;
            } 
            
            .image-cloud-svg {
                height: 200px;
                width: 200px;
            }
           
        </style>
       `;
    }

    content(){
        return `
            <div class="form">
                <div class="form-control">
                    <label class="label">Name:</label>
                    <input class="input" name="title" value="${this._$formData.name}">
                </div>
                
                <div class="form-control">
                    <label class="label">City:</label>
                    <input class="input" name="title" value="${this._$formData.city}">
                </div>
                
                <div class="form-control">
                    <label class="label">Address:</label>
                    <input class="input" name="title" value="${this._$formData.address}">
                </div>
                
                <div class="form-control">
                    <label class="label">Stage:</label>
                    <input class="input" name="title" value="${this._$formData.stage}">
                </div>
                
                <div class="form-control">
                    <label class="label">Color:</label>
                    <input class="input" name="title" type="color" value="${this._$formData.color}">
                </div>
                
                <div class="form-control">
                    <label class="label">Seats:</label>
                    <input class="input" name="title" type="number" value="${this._$formData.seats}">
                </div>
                
                <div class="form-image">
                    <label for="file-upload" class="image-label image-cloud"><svg xmlns="http://www.w3.org/2000/svg" class="image-cloud-svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M144 480C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144zM223 263C213.7 272.4 213.7 287.6 223 296.1C232.4 306.3 247.6 306.3 256.1 296.1L296 257.9V392C296 405.3 306.7 416 320 416C333.3 416 344 405.3 344 392V257.9L383 296.1C392.4 306.3 407.6 306.3 416.1 296.1C426.3 287.6 426.3 272.4 416.1 263L336.1 183C327.6 173.7 312.4 173.7 303 183L223 263z"/></svg></label>
                    <img alt="uploaded-image" class="image-label placeholder-image" id="myImg" src="#">
                </div>
                <input style="display: none" id="file-upload" name="title" type='file' value="">
                    
            </div>
        `
    }

    connectedCallback(){
        this.renderContent();

        const _this = this;
        _this.shadowRoot.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const img = _this.shadowRoot.querySelector('.placeholder-image');
                img.onload = () => {
                    URL.revokeObjectURL(img.src);
                }

                img.src = URL.createObjectURL(this.files[0]);
            }
        });
    }

    updateData(e){
        this._$formData[e.path[0].name] = e.path[0].value;
        this.updateModalTitle(this._$formData.title);
    }

    handleCreateBtnClick(e){
        console.log(this.shadowRoot.querySelector('input[type="file"]').files[0])
    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["url"];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this._$url = newValue;
        }
    }
}

export default CreateLocationForm;
