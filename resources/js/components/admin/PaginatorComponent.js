import BaseComponent from "../BaseComponent";

class PaginatorComponent extends BaseComponent {
    constructor() {
        super();

        this._$title = null;
        this._$url = null;
        this._$locations = null;
        this._$update_event = null;
        this._$create_event = null;
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
                
                .action-add-item {
                
                }
            </style>
        `;
    }

    initComponent(data) {
        console.log(data);
        this._$locations = data.location;
        console.log(this._$url)

        if(this._$fields !== null && typeof this._$fields === 'string')
            this._$fields = Array.from(this._$fields.split("|"));

        console.log(this._$fields)

        this.shadowRoot.innerHTML = `
            ${this.styleObject()}
            <div class="container">
                <div class="actions">
                    <input class="actions-search" type="text" name="search" placeholder="search...">
                    <div class="action-add-item"">Add ${this._$title}</div>
                </div>
                <div class="sub-actions">
                    <a class="sub-actions-pref">pref</a>    
                    <input value="${this._$currentPage}" type="number" name="page">    
                    <a class="sub-actions-next">next</a>    
                </div>
                <div class="paginator">
                    <div class="paginator-title">
                        ${this._$fields !== null ? this._$fields.map((field) => {
                            return `<div class="paginator-con">${field}</div>`;
                        }).join('') : ''}
                        <div class="paginator-actions">Actions</div>
                    </div>
                    <div class="paginator-data">
                        ${data.location.map((loc) => {
                            if(this._$fields === null) 
                                return `<div>No data found</div>`;
                            
                            return `<div class="paginator-row">${this._$fields.map((field) => {
                                return `<div class="paginator-con">${loc[field]}</div>`;
                            }).join('')}<div id="${loc["id"]}" class="paginator-actions">btn</div></div>`
    
                        }).join('')}
                    </div>
                </div>
            </div>
        `;

        this.shadowRoot.querySelector(".sub-actions-pref").addEventListener("click", this.pref.bind(this))
        this.shadowRoot.querySelector(".sub-actions-next").addEventListener("click", this.next.bind(this))
        this.shadowRoot.querySelector(".action-add-item").addEventListener("click", this.addItem.bind(this))
    }

    addItem(){
        window.dispatchEvent(new CustomEvent(this._$create_event, {detail: true}))
    }

    pref(){
        if(this._$currentPage <= 0)return;

        this._$currentPage = this._$currentPage - 1;
        this.init();
    }

    next(){
        this._$currentPage = this._$currentPage + 1;
        this.init();
    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["url", "fields", "update_event", "create_event" ,"title"];
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
        return url.replace(/amount/g, this._$amount);
    }
}

export default PaginatorComponent;
