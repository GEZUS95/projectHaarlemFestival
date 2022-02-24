
import CreateLocationModal from "./CreateLocationModal";

class UpdateLocationModal extends CreateLocationModal {
    constructor() {
        super();

        this._$query_url = '';
        this._$update = true;
        this._$formData = {
            title: "Untitled",
            total_price_program: '',
            start_time: null,
            end_time: null,
            color: '#ffffff',
            event_id: null,
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
                const img = this.shadowRoot.querySelector('.placeholder-image');
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
        console.log("update")
    }

    handleDeleteBtnClick(){
        console.log("delete")
    }

    static get observedAttributes() {
        return ["url", "token", "query_url"];
    }
}

export default UpdateLocationModal;