import BaseModal from "./BaseModal";

class CreatePerformerModal extends BaseModal {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
        this._$formData = {
            name: '',
            description: '',
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
            
            .form-image {
                width: 100%;
                display: flex;
                flex-direction: row;
            }
                     
            .image-label {
                background-color: #ffffff;
                width: 45%;
                height: 200px;
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
            
            .form-control-textarea {
                margin-right: 30px;
                margin-bottom: 30px;
                width: 100%;
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
                
                <div class="form-image">
                    <label for="file-upload" class="image-label image-cloud"><svg xmlns="http://www.w3.org/2000/svg" class="image-cloud-svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M144 480C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144zM223 263C213.7 272.4 213.7 287.6 223 296.1C232.4 306.3 247.6 306.3 256.1 296.1L296 257.9V392C296 405.3 306.7 416 320 416C333.3 416 344 405.3 344 392V257.9L383 296.1C392.4 306.3 407.6 306.3 416.1 296.1C426.3 287.6 426.3 272.4 416.1 263L336.1 183C327.6 173.7 312.4 173.7 303 183L223 263z"/></svg></label>
                    <img alt="uploaded-image" class="image-label placeholder-image" id="myImg" src="#">
                </div>
                <input style="display: none" id="file-upload" name="image" type='file' value="">
                    
                <div class="form-control-textarea">
                    <label class="label">Description:</label>
                    <textarea class="input" style="min-height: 100px; max-height: 100px" name="description">${this._$formData.description}</textarea>
                </div>
            </div>
        `
    }

    connectedCallback(){
        window.addEventListener("modal-create-performer", this.initForm.bind(this));
    }

    initForm(e){
        this.renderContent();

        this.updateModalTitle("Create Performer");
        this.shadowRoot.querySelector('input[type="file"]').addEventListener('change', this.handleImageObjectUrl.bind(this));

        const elements = this.shadowRoot.querySelectorAll(".input");
        Array.from(elements).forEach((element) => {
            element.addEventListener('change', this.updateData.bind(this) );
        });
    }



    handleCreateBtnClick(e){
        const image = this.shadowRoot.querySelector('input[type="file"]').files[0];

        let formData = this.createFormData(this._$formData)
        formData.append("file", image)
        formData.append("token", this._$token)

        this.sendRequestForPaginator(this._$url, this, formData);
    }

    static get observedAttributes() {
        return ["url", "token"];
    }
}

export default CreatePerformerModal;
