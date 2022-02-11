class SideNavigationLink extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });
        this._$a = null;
    }
    connectedCallback() {
        const href = this.getAttribute("href") || "#";
        const name = this.getAttribute("link-name") || "link name";
        this.shadowRoot.innerHTML = `
        <style>
            a {
                background-color: #CFD8DC;
                color: #263238;
                font-size: 20px;
                height: 40px;
                text-decoration: none;
                width: 100%;
            }
        </style>
        <a href="${href}">
            <slot>${name}</slot>
        </a>
    `;
        this._$a = this.shadowRoot.querySelector("a");
        this._$a.addEventListener("click", e => {
            console.log(e.target.href);
        });
    }
    static get observedAttributes() { return ["href"]; }
    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            if (this._$a === null) return;
            this._$a.setAttribute("href", newValue);
        }
    }
}

export default SideNavigationLink;
// customElements.define("confirm-link", ConfirmLink);