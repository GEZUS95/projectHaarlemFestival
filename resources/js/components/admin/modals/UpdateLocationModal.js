
import CreateLocationModal from "./CreateLocationModal";

class UpdateLocationModal extends CreateLocationModal {
    constructor() {
        super();

        this._$query_url = '';
    }

    connectedCallback(){
        const _this = this;
        window.addEventListener("modal-update-location", (e => {
            console.log(e, _this._$query_url)
            _this.renderContent();

            // _this.updateModalTitle("Update Location");
            // _this.shadowRoot.querySelector('input[type="file"]').addEventListener('change', function() {
            //     if (this.files && this.files[0]) {
            //         const img = _this.shadowRoot.querySelector('.placeholder-image');
            //         img.onload = () => {
            //             URL.revokeObjectURL(img.src);
            //         }
            //
            //         img.src = URL.createObjectURL(this.files[0]);
            //     }
            // });
            //
            // const elements = _this.shadowRoot.querySelectorAll(".input");
            // Array.from(elements).forEach(function(element) {
            //     element.addEventListener('change', _this.updateData.bind(_this) );
            // });
        }));
    }

    static get observedAttributes() {
        return ["url", "token", "query_url"];
    }
}

export default UpdateLocationModal;