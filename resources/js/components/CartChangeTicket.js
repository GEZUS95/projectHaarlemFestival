import BaseComponent from "../BaseComponent";

class CartChangeTicket extends BaseComponent {
    constructor() {
        super();

        this._$route = null;
        this._$token = null;
        this._$id = null;
        this._$type = null;
        this._$amount = null;
    }

    style() {
        return `
        <style>
            .add-to-cart {
                color: #4b58b2;
                font-weight: bold;
                font-size: 12px;
            }
            .add-to-cart:hover {
                color: #000000;
            }     
            
            .input {
                width: 40px;
            }
        </style>    
       `;
    }

    content() {
        this.shadowRoot.innerHTML = `
            ${this.style()}
            <div>
                <input class="input" type="number" name="amount" class="number" value="${this._$amount}">
                <div class="add-to-cart">Change Ticket</div>
            </div>
        `
        this.shadowRoot.querySelector('.add-to-cart').addEventListener('click', this.sendRequestForm.bind(this))
    }

    sendRequestForm() {
        const number = this.shadowRoot.querySelector(".number").value;

        let formData = new FormData();
        formData.append("token", this._$token)
        formData.append("id", this._$id)
        formData.append("amount", number)
        formData.append("type", this._$type)

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this._$route, true);
        xhr.send(formData);
    }

    connectedCallback() {
        this.content();
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$" + name] = newValue;
        }
    }

    static get observedAttributes() {
        return ["route", "token", "id", "type", "amount"];
    }
}

export default CartChangeTicket;
