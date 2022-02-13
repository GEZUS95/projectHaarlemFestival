class EventSubNavigation extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

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
                
                .helpers {
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
                
                .actions {
                    justify-content: center;
                    align-items: center;
                    display: flex;
                }
                
                .actions-icons {
                    width: 35px;
                    height: 35px;
                }
                
            </style>
            <div class="navigation">
                <div class="title">${this.title} - Programs overview</div>
                <div class="actions">
<!--                    Week back-->
                    <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="actions-icons bi bi-caret-left-fill" viewBox="0 0 16 16">
                         <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg></div>
<!--                    calender-->
                    <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="actions-icons bi bi-calendar-day-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16v9zm-4.785-6.145a.428.428 0 1 0 0-.855.426.426 0 0 0-.43.43c0 .238.192.425.43.425zm.336.563h-.672v4.105h.672V8.418zm-6.867 4.105v-2.3h2.261v-.61H4.684V7.801h2.464v-.61H4v5.332h.684zm3.296 0h.676V9.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a1.806 1.806 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98v4.105z"/>
</svg></div>
<!--                    week forward-->
                    <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="actions-icons bi bi-caret-right-fill" viewBox="0 0 16 16">
                         <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                    </svg></div>
                </div>
                <div class="helpers">
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

    getDateString() {
        const date = new Date();
        let dateString = date.toLocaleDateString('en-us', {
                weekday: 'long',
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            }) + " " +
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

    static get observedAttributes() {
        return ["title"];
    }
}

export default EventSubNavigation;