import BaseComponent from "../BaseComponent";

class SubNavigation extends BaseComponent {
    constructor() {
        super();

    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
            <style>
                .navigation {
                    height: 70px;
                    width: 100%;
                    background-color: #ECEFF1;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
                
                .title {
                    color: #5A5D61;
                    font-size: 36px;
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    font-weight: bold;
                    padding: 0 35px;
                }
            </style>
            <div class="navigation">
                <div class="title">${this.title} - Programs overview</div>
            </div>
        `;

    }

    disconnectedCallback() {

    }

    static get observedAttributes() {
        return ["title"];
    }
}

export default SubNavigation;
