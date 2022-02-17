import BaseComponent from "../BaseComponent";

class PaginatorComponent extends BaseComponent {
    constructor() {
        super();

        this._$url = null;
        this._$fields = null;
    }

    styleObject(){
        return `
            <style>
                :host {
                    height: 100%;
                    width: 100%;
                }
            
                .container {
                    height: 100%;
                    background-color: #BAC8CF;
                }
            </style>
        `;
    }

    initComponent() {
        console.log(this._$url)
        console.log(this._$fields)
        if(this._$fields !== null)
            this._$fields = Array.from(this._$fields.split("|"));

        this.shadowRoot.innerHTML = `
            ${this.styleObject()}
            <div class="container">
                <div class="actions">
                    <input type="text" name="search" placeholder="search...">
                    <div>Add location</div>
                </div>
                <div class="sub-actions">
                    <div>pref</div>    
                    <input type="number" name="page">    
                    <div>next</div>    
                </div>
                <div class="paginator"></div>
            </div>
        `
    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["url", "fields"];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+name] = newValue;

            const _this = this;
            if(this._$url === null)
                return;

            this.queryGet(this._$url).then(res => {
                _this.initComponent();
            });
        }
    }
}

export default PaginatorComponent;
