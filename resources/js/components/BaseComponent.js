class BaseComponent extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

    }

    async query(url = '', data, method = "GET") {
        const response = await fetch(url, {
            method: method,
            body: data
        });

        return response.json();
    }

}

export default BaseComponent;
