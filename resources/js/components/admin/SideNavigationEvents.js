class SideNavigationEvents extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });
    }
    initComponent(data) {
        const _this = this;
        const titles = data["titles"];
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
            ${titles.map((links) => {
            return _this.getTabElement(links.title)
        }).join('')}
            </div>
        `;
    }


    static get observedAttributes() { return ["titles"]; }
    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            const _this = this;

            fetch(newValue)
                .then(response => response.json())
                .then((data) => {
                    _this.initComponent(data);
                })
        }
    }


    getTabElement(title){
        const eventLink = window.location.protocol + "//" + window.location.host + "/admin/event/" + title;
        const eventEditLink = window.location.protocol + "//" + window.location.host + "/admin/event/" + title + "/edit";
        return `
        <div class="tab-container">
            <a href="${eventLink}" class="tab-container-title">${title}</a>
            <a href="${eventEditLink}" class="tab-container-edit">Edit</a>
        </div>
        `;
    }
}

export default SideNavigationEvents;