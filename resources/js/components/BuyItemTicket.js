import BaseComponent from "../BaseComponent";

class BuyItemTicket extends BaseComponent {
    constructor() {
        super();

        this._$route = null;
        this._$token = null;
        this._$item_id = null;
        this._$performer_name = null;

    }

    style(){
        return `
        <style>
            .add-to-cart {
                color: #40CA5E;
                font-weight: bold;
            }     
        </style>    
       `;
    }

    content(){
        this.shadowRoot.innerHTML =`
            ${this.style()}
            <div>
                <input type="number" value="0" name="amount" class="number">
                <div class="add-to-cart">Add To Cart</div>
            </div>
        `

        this.shadowRoot.querySelector('.add-to-cart').addEventListener('click', this.sendRequestForm.bind(this))
    }

    sendRequestForm(){
        const number = this.shadowRoot.querySelector(".number").value;

        let formData = new FormData();
        formData.append("token", this._$token)
        formData.append("id", this._$item_id)
        formData.append("amount", number)
        formData.append("type", "item")

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                alert(this._$performer_name + " set " + number + " to your ticket");
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
        return ["route", "token", "item_id", "performer_name"];
    }
}

export default BuyItemTicket;
