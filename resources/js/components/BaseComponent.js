class BaseComponent extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

    }

    async query(url = '', data, method = "POST") {
        const response = await fetch(url, {
            method: method,
            body: data
        });

        return response.json();
    }

    async queryGet(url) {
        const response = await fetch(url, {
            method: "GET",
        });

        return response.json();
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

}

export default BaseComponent;
