class SideNavigationEvents extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });

        this._$event_link = null;
        this._$url = null;
    }

    async connectedCallback(){
        if(!this._$url)
            return;

        const res = await fetch(this._$url)
        const events = await res.json()
        this.initComponent(events)
    }

    initComponent(events) {
        this.shadowRoot.innerHTML = `
            <style>
                .tab-container {
                    background-color: #CFD8DC;
                    color: #263238;
                    font-size: 20px;
                    height: 40px;
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                }
                
                .tab-container-title {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                    padding-left: 35px;
                    color: #263238;
                    text-decoration: none;
                }
                
                .tab-container:hover .tab-container-title {
                    background-color: #BAC8CF;
                    color: #ffffff;
                }
                
                .tab-container:hover .tab-container-edit {
                    visibility: visible;
                }
                
                .tab-container-edit {    
                    color: #263238;
                    text-decoration: none;
                    visibility: hidden;
                    background-color: #ffc107;
                    width: 100px;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>

            <div id="main">
                ${events.map((event) => {
                    return `
                        <div class="tab-container">
                            <a href="${this.queryUrlReplaceId(this._$event_link, event.id)}" class="tab-container-title">${event.title}</a>
                            <div id="${event.id}" class="tab-container-edit">Edit</div>
                        </div>`;
                }).join('')}
            </div>
        `;

        Array.from(this.shadowRoot.querySelectorAll(".tab-container-edit")).forEach(el => {
            el.addEventListener("click", (e) => {
                const element = e.path[0];
                window.dispatchEvent(new CustomEvent("modal-update-event", {detail: element.id}))
            })
        })
    }


    static get observedAttributes() { return ["url", "event_link"]; }
    
    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+ name] = newValue;
        }
    }

    queryUrlReplaceId(url, id){
        url = url.replace('{', '');
        url = url.replace('}', '');
        return url.replace('id', id);
    }
}

export default SideNavigationEvents;