class BaseComponent extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this.baseURL = window.location.origin;
        this._$crsfToken = document.querySelector('meta[property~="csrf-token"]')?.content;
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

    generateArrFromResponse(res){
        if(Array.isArray(res)) return res;

        const data = JSON.parse(res);
        let tmpArr = [];
        for(const key in data)
            if (data.hasOwnProperty(key))
                tmpArr.push(data[key]);

        return tmpArr
    }

}

export default BaseComponent;
