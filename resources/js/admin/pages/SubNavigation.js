import BaseComponent from "../../BaseComponent";

class SubNavigation extends BaseComponent {
    constructor() {
        super();

        this.back = false
        this.title = "";
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
                    justify-content: flex-start;
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
                
                .back {
                
                }
            </style>
            <div class="navigation">
                ${this.back === "true" ? `<div class="back title">Go Back</div>` : ""}
                <div class="title">${this.title}</div>
            </div>
        `;

        if(this.back !== "true")
            return;

        this.shadowRoot.querySelector(".back").addEventListener("click",() => {
            window.dispatchEvent(new CustomEvent("hide-program-overview", {detail : true}))
            window.dispatchEvent(new CustomEvent("show-event-overview", {detail : true}))
        })

    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this[name] = newValue;
        }
    }

    static get observedAttributes() {
        return ["title", "back"];
    }
}

export default SubNavigation;
