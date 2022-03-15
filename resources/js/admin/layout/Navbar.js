class Navbar extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});
        this._$a = null;
    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
        <style>
            .partials-admin-layout-nav {
              min-height: 70px;
              background: #1A222A;
              box-shadow: rgba(0, 0, 0, 0.44) 1.95px 1.95px 2.6px;
              display: flex;
              font-size: 24px;
              align-items: center;
              justify-content: flex-start;
              z-index: 100;
            }
            
            .partials-admin-layout-nav-header {
              font-size: 28px;
              font-weight: bold;
              margin-left: 245px;
              color: #ffffff;
            }
        </style>
            <nav class="partials-admin-layout-nav">
                <div class="partials-admin-layout-nav-header">
                    Content Management
                </div>
            </nav>
        `;
    }
}

export default Navbar;