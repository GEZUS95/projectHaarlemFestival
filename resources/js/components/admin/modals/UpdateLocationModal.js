import BaseModal from "./BaseModal";

class UpdateLocationModal extends BaseModal {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
        this._$formData = {
            name: '',
            city: '',
            address: '',
            stage: '',
            color: '',
            seats: '',
        };
    }


}