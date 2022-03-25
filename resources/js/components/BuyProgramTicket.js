import BaseComponent from "../BaseComponent";

class BuyProgramTicket extends BaseComponent {
    constructor() {
        super();

        this._$route = null;
        this._$token = null;
        this._$program_id = null;

    }

    style(){
        return `
        <style>
            .add-to-cart {
                color: #4b58b2;
                font-weight: bold;
                font-size: 24px;
            }     
        </style>    
       `;
    }

    content(){
        this.shadowRoot.innerHTML =`
            ${this.style()}
            <div>
                <input type="number" value="0" name="amount" class="number">
                <div class="add-to-cart">Buy Day Pass</div>
            </div>
        `

        this.shadowRoot.querySelector('.add-to-cart').addEventListener('click', this.sendRequestForm.bind(this))
    }

    sendRequestForm(){
        const number = this.shadowRoot.querySelector(".number").value;

        let formData = new FormData();
        formData.append("token", this._$token)
        formData.append("id", this._$program_id)
        formData.append("amount", number)
        formData.append("type", "Program")

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                alert("Added program to your ticket");
            }
        }

        xhr.open('POST', this._$route, true);
        xhr.send(formData);
    }

    connectedCallback(){
        this.content();
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+ name] = newValue;
        }
    }

    static get observedAttributes() {
        return ["route", "token", "program_id"];
    }
}

export default BuyProgramTicket;
