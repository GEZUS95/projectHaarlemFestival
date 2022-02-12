class EventSubNavigation extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });

        this._$currentTime = new Date()
        this._$root = null;
        this._$btn = null;
        this._$time = null;

        this._$interval = setInterval(() => {
            this._$time.innerHTML = this.getDateString();
        }, 1000);
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
                
                .actions {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .btn {
                    color: #ffffff;
                    font-size: 36px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    background-color: #7711BB;
                    margin-right: 10px;
                }
                
                .time {
                    color: #000000;
                    font-size: 16px;
                    font-weight: bold;
                    margin-right: 15px;
                }
                
            </style>
            <div class="navigation">
                <div class="title">${this.title} - Programs overview</div>
                <div class="actions">
                    <div class="btn">?</div>
                    <div class="time">${this.getDateString()}</div>
                </div>
            </div>
        `;

        this._$root = this.shadowRoot.querySelector(".navigation");
        this._$btn = this._$root.querySelector(".btn");
        this._$time = this._$root.querySelector(".time");
        this._$btn.addEventListener("click", this.handleBtnClick);
    }

    getDateString(){
        const date = new Date();
        let dateString = date.toLocaleDateString('en-us', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' }) + " " +
            ("00" + date.getHours()).slice(-2) + ":" +
            ("00" + date.getMinutes()).slice(-2);
        return dateString.replace(/,/g, "");
    }

    handleBtnClick(event) {
        //@TODO open modal that explains instructions! make a custom web component for this
        console.log("open modal that explains instructions! make a custom web component for this");
    }

    disconnectedCallback() {
        clearInterval(this._$interval);
        this._$btn.removeEventListener("click", this.handleBtnClick, false);
    }

    static get observedAttributes() { return ["title"]; }
}

export default EventSubNavigation;