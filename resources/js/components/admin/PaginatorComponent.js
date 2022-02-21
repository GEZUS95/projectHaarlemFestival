import BaseComponent from "../BaseComponent";

class PaginatorComponent extends BaseComponent {
    constructor() {
        super();

        this._$url = null;
        this._$fields = null;
        this._$currentPage = 0;
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
                }
                
                .paginator {
                    min-height: calc(45px * 11);
                    display: flex;
                    flex-direction: column;
                    margin: 20px;
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
            </style>
        `;
    }

    initComponent(data) {
        console.log(data);
        console.log(this._$url)

        if(this._$fields !== null)
            this._$fields = Array.from(this._$fields.split("|"));

        console.log(this._$fields)

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
                            }).join('')}<div class="paginator-actions">btn</div></div>`
    
                        }).join('')}
                    </div>
                </div>
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
                _this.initComponent(res);
            });
        }
    }
}

export default PaginatorComponent;
