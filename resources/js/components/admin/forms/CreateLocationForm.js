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
                    <label for="file-upload" style="margin-right: 30px; margin-bottom: 30px" class="image-label">Image</label>
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
