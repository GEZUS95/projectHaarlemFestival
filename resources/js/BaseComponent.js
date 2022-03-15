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

}

export default BaseComponent;
