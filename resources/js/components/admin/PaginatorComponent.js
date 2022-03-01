import BaseComponent from "../BaseComponent";

class PaginatorComponent extends BaseComponent {
    constructor() {
        super();

        this._$title = null;
        this._$url = null;
        this._$object_name = null;
        this._$update_event = null;
        this._$create_event = null;
        this._$fields = null;
        this._$currentPage = 0;
        this._$amount = 10;
        this._$search_url = '';
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
                
                .sub-action-class {
                        padding: 5px 20px;
                        font-size: 24px;
                        font-weight: bold;
                        color: blue;
                        text-decoration: underline;
                }
                
                .action-add-item {
                    background-color: #007BFF;
                    color: #ffffff;
                    font-size: 24px;
                    cursor: pointer;
                    padding: 12px;
                    line-height: 1.5;
                    border-radius: 0.3rem;
                    user-select: none;
                    border: 1px solid transparent;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                    height: 50px;
                    margin: 0 10px;
                }
            </style>
        `;
    }

    initComponent(data) {
        if(this._$fields !== null && typeof this._$fields === 'string')
            this._$fields = Array.from(this._$fields.split("|"));

        this.shadowRoot.innerHTML = `
            ${this.styleObject()}
            <div class="container">
                <div class="actions">
                    <input class="actions-search" type="text" value="${this._$search}" name="search" placeholder="search...">
                    <div class="action-add-item"">Add ${this._$title}</div>
                </div>
                <div class="sub-actions">
                    <a class="sub-actions-pref sub-action-class">pref</a>    
                    <a class="sub-actions-next sub-action-class">next</a>    
                </div>
                <div class="paginator">
                    <div class="paginator-title">
                        ${this._$fields !== null ? this._$fields.map((field) => {
                            return `<div class="paginator-con">${field}</div>`;
                        }).join('') : ''}
                        <div class="paginator-actions">Actions</div>
                    </div>
                    <div class="paginator-data">
                        ${data[this._$object_name].map((i) => {
                            if(this._$fields === null) 
                                return `<div>No data found</div>`;
                            
                            return `<div class="paginator-row">${this._$fields.map((field) => {
                                return `<div class="paginator-con">${i[field]}</div>`;
                            }).join('')}<div id="${i["id"]}" class="paginator-actions paginator-update-btn">btn</div></div>`
    
                        }).join('')}
                    </div>
                </div>
            </div>
        `;

        this.shadowRoot.querySelector(".sub-actions-pref").addEventListener("click", this.pref.bind(this))
        this.shadowRoot.querySelector(".sub-actions-next").addEventListener("click", this.next.bind(this))
        this.shadowRoot.querySelector(".action-add-item").addEventListener("click", this.addItem.bind(this))
        this.shadowRoot.querySelector(".actions-search").addEventListener("change", this.search.bind(this))
        Array.from(this.shadowRoot.querySelectorAll(".paginator-update-btn")).forEach(el => {
            el.addEventListener("click", this.updateItem.bind(this))
        })
    }

    search(e){
        const el = e.path[0];

        if(el.value.length < 3)
            return;

        const _this = this;
        let url = this._$search_url.split("{").join('');
        url = url.split("}").join('');
        url = url.replace(/search/g, el.value);
        this._$search = el.value;
        this.queryGet(url).then(res => {
            _this.initComponent(res);
        });
    }

    updateItem(event){
        const el = event.path[0];
        window.dispatchEvent(new CustomEvent(this._$update_event, {detail: el.id}))
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
        return ["url", "fields", "update_event", "create_event" ,"title", "object_name", "search_url"];
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
