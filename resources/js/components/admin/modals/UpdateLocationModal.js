
import CreateLocationModal from "./CreateLocationModal";

class UpdateLocationModal extends CreateLocationModal {
    constructor() {
        super();

        this._$query_url = '';
        this._$delete_url = '';
        this._$update = true;
        this._$formData = {
            name: '',
            city: '',
            address: '',
            stage: '',
            color: '',
            seats: '',
        };
    }

    connectedCallback(){
        window.addEventListener("modal-update-location", this.initForm.bind(this));
    }

    async initForm(e){
        let url = this._$query_url.replace('{', '');
        url = url.replace('}', '');
        url = url.replace('id', e.detail);

        const resFormData = await this.queryGet(url);

        for (const key in resFormData.location) {
            if (!resFormData.location.hasOwnProperty(key) && this._$formData.hasOwnProperty(key))
                return;
            this._$formData[key] = resFormData.location[key]
        }

        this.renderContent();

        const imgUrl = location.protocol + '//' + location.host + '/images/' + resFormData.location.images[0]["file_location"];
        const img = this.shadowRoot.querySelector('.placeholder-image');
        img.src = imgUrl;
        this.updateModalTitle("Update Location");

        this.shadowRoot.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                img.onload = () => {
                    URL.revokeObjectURL(img.src);
                }

                img.src = URL.createObjectURL(this.files[0]);
            }
        });

        const elements = this.shadowRoot.querySelectorAll(".input");
        const _this = this;
        Array.from(elements).forEach(function(element) {
            element.addEventListener('change', _this.updateData.bind(_this) );
        });
    }

    handleUpdateBtnClick(){
        const image = this.shadowRoot.querySelector('input[type="file"]').files[0];

        let formData = this.createFormData(this._$formData)
        formData.append("file", image)
        formData.append("token", this._$token)

        const xhr = new XMLHttpRequest();
        const _this = this;
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent('paginator-force-reload', {detail: true}))
                _this._$formData = _this.clearFormData(_this._$formData)
                _this.closeForm();
            }
        }

        let url = this._$url.replace('{', '');
        url = url.replace('}', '');
        url = url.replace('id', this._$formData.id);
        xhr.open('POST', url, true);
        xhr.send(formData);
    }

    handleDeleteBtnClick(){
        console.log("delete")

        const xhr = new XMLHttpRequest();
        const _this = this;
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                window.dispatchEvent(new CustomEvent('paginator-force-reload', {detail: true}))
                _this._$formData = _this.clearFormData(_this._$formData)
                _this.closeForm();
            }
        }

        let url = this._$delete_url.replace('{', '');
        url = url.replace('}', '');
        url = url.replace('id', this._$formData.id);
        xhr.open('POST', url, true);
        xhr.send();
    }

    static get observedAttributes() {
        return ["url", "token", "query_url", "delete_url"];
    }
}

export default UpdateLocationModal;