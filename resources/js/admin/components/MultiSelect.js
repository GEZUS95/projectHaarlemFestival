class MultiSelect extends HTMLElement {

    constructor() {
        super();

        this.attachShadow({mode: "open"});
        this._$items = [];
        this._$selected = [];
        this.title = "Untitled";
    }

    render(){
        this.shadowRoot.innerHTML = `
            <style>
                #selected-items-container {
                    display: flex;
                    flex-wrap: wrap;
                    box-sizing: border-box;
                    background-color: #BAC8CF;
                    width: 100%;
                    border-width: 2px;                    border-style: inset;
                    border-color: rgb(118, 118, 118);
                    min-height: 40px;
                }
                
                .selected-item {
                    padding: 4px;
                    background: #007BFF;
                    color: white;
                    border-radius: 5px;
                    margin: 2px 5px;
                    border: unset;
                }
                
                #perms {
                    width: 100%;
                    margin-top: 5px;
                }
            </style>

            <label class="label">${this._$title}</label>
            <div id="selected-items-container">
                ${this._$selected.length !== 0 ? this._$selected.map((selected) => {
                    return `<div class="selected-item" id="${selected}">${selected}</div>`;
                }).join('') : ''}
            </div>
            <select name="perms" id="perms" multiple>
                   ${this._$items.map((perm) => {
                        if(!this._$selected.includes(perm))
                            return `<option value="${perm}">${perm}</option>`;
                    }).join('')}
            </select>
        `;

        const select = this.shadowRoot.querySelector("#perms");
        const selectItemsContainer = this.shadowRoot.querySelector("#selected-items-container");
        this.initClickEvents();
        select.addEventListener('change', (event) => {
            const perm = event.target.value;
            select.querySelector('option[value='+perm+']').remove();
            if(!Array.isArray(this._$selected)) this._$selected = [];
            this._$selected.push(perm);
            selectItemsContainer.innerHTML += `<div class="selected-item" id='${perm}'>${perm}</div>`
            this.initClickEvents();
            //if u do .innerHTML it deletes all existing elements on parent container so we have to recall it!
            // and we need to do it so it adds the new items into the click events
        });
    }

    connectedCallback(){
        if(this._$items === [])
            return;

        this._$items = this._$items.split(",")

        if(this._$selected.length !== 0)
            this._$selected = this._$selected.split(",")

        this.render();
    }

    initClickEvents(){
        const elements = this.shadowRoot.querySelectorAll(".selected-item");
        Array.from(elements).forEach((element) => element.addEventListener('click', this.removeSelectedItem.bind(this)))
    }

    removeSelectedItem(e) {
        const el = e.path[0]
        const index = this._$selected.indexOf(el.id);
        if (index > -1) {
            this._$selected.splice(index, 1);
            this.render();
        }
    }

    get value () {
        return this._$selected;
    }

    // noinspection JSUnusedGlobalSymbols
    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+ name] = newValue;
        }
    }

    static get observedAttributes() {
        return ["items", "selected", "title"];
    }
}

export default MultiSelect;