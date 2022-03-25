class BaseComponent extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this.baseURL = window.location.origin;
    }

    getToken(){
        return window["csrfToken"];
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

        return await response.json();
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
