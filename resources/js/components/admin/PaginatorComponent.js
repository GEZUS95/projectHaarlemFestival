import BaseComponent from "../BaseComponent";

class PaginatorComponent extends BaseComponent {
    constructor() {
        super();

        this._$url = null;
        this._$locations = null;
        this._$updateUrl = null;
        this._$createUrl = null;
        this._$fields = null;
        this._$currentPage = 0;
        this._$amount = 10;
        this._$search = '';
    }

    styleObject(){
        return `
            <style>
                :host {
                    height: 100%;
                    width: 100%;
                }
                
                :host * {
                    box-sizing: border-box;
                }
            
                .container {
                    height: 100%;
                    background-color: #BAC8CF;
                    padding: 10px 20px;
                }
                
                .paginator {
                    min-height: calc(45px * 11);
                    display: flex;
                    flex-direction: column;
                    border: #000000 solid 1px;
                    background: #ECEFF1;
                }
                
                .paginator-title {
                    display: flex;
                    flex-direction: row;
                    background: #C9CFD2;
                    border: #000000 solid 1px;
                    box-shadow: 0 3px 10px -2px #000000;
                }
                
                .paginator-data {
                    display: flex;
                    flex-direction: column;
                }
                
                .paginator-row {
                    border: #000000 solid 1px;
                    display: flex;
                    flex-direction: row;
                }
                
                .paginator-con {
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    padding: 0 10px;
                    height: 45px;
                    width: 100%;
                    font-size: 20px;
                    color: #000000;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
                
                .paginator-actions {
                    padding: 0 10px;
                    height: 45px;
                    font-size: 20px;
                    min-width: 100px;
                    max-width: 100px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .actions  {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
                
                .sub-actions {
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                }
                
                .actions-search {
                    height: 40px;
                    width: 270px;
                    font-size: 20px;
                    font-weight: bold;
                }
            </style>
        `;
    }

    initComponent(data) {
        this._$locations = data.location;

        if(this._$fields !== null && typeof this._$fields === "string")
            this._$fields = Array.from(this._$fields.split("|"));

        this.shadowRoot.innerHTML = `
            ${this.styleObject()}
            <div class="container">
                <div class="actions">
                    <input class="actions-search" type="text" name="search" placeholder="search...">
                    <a href="#">Add location</a>
                </div>
                <div class="sub-actions">
                    <div class="sub-actions-pref">pref</div>    
                    <input value="${this._$currentPage}" type="number" name="page">    
                    <div class="sub-actions-next">next</div>    
                </div>
                <div class="paginator">
                    <div class="paginator-title">
                        ${this._$fields !== null ? this._$fields.map((field) => {
                            return `<div class="paginator-con">${field}</div>`;
                        }).join('') : ''}
                        <div class="paginator-actions">Actions</div>
                    </div>
                    <div class="paginator-data">
                        ${this._$locations.map((loc) => {
                            if(this._$fields === null) 
                                return `<div>No data found</div>`;
                            
                            return `<div class="paginator-row">${this._$fields.map((field) => {
                                return `<div class="paginator-con">${loc[field]}</div>`;
                            }).join('')}<a href="#" class="paginator-actions">btn</a></div>`
    
                        }).join('')}
                    </div>
                </div>
            </div>
        `;

        this.shadowRoot.querySelector(".sub-actions-pref").addEventListener("click", this.pref.bind(this));
        this.shadowRoot.querySelector(".sub-actions-next").addEventListener("click", this.next.bind(this));
    }

    pref(){
        if(this._$locations === null || this._$currentPage === 0)
            return;

        this._$currentPage = this._$currentPage - 1;
        this.init();
    }

    next(){
        if(this._$locations === null || this._$locations.length < this._$amount)
            return;

        this._$currentPage = this._$currentPage + 1;
        this.init();
    }

    disconnectedCallback() {

    }

    updateItem(){

    }

    static get observedAttributes() {
        return ["url", "fields", "updateUrl", "createUrl"];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+name] = newValue;

            if(this._$url === null)
                return;

            this.init();
        }
    }

    init(){
        const _this = this;
        this.queryGet(this.getCorrectUrl(this._$url)).then(res => {
            _this.initComponent(res);
        });
    }

    getCorrectUrl(url){
        url = url.split("{").join('');
        url = url.split("}").join('');
        url = url.replace(/page/g, this._$currentPage);
        url = url.replace(/amount/g, this._$amount);
        return url;
    }
}

export default PaginatorComponent;
