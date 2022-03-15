import BaseComponent from "../../BaseComponent";

class ProgramOverviewPage extends BaseComponent {
    constructor() {
        super();

        this._$url = null;
        this._$token = null;
    }

    style(){
        return `
        <style>      
            :host {
                height: 100%;
            }
        
            .container {
                height: 100%;
                background-color: #ECEFF1;
                display: flex;
                flex-direction: row;
            } 
            
            .program-item-extra-container {
                background-color: #BAC8CF;
                width: 100%;
            }
            
            .sidenav {
                width: 340px;
            }
            
            .sidenav-title-holder {
                display: flex;
                align-items: flex-start;
                justify-content: center;
                flex-direction: column;
                padding: 0 20px;
                height: 50px;
                background-color: #CFD8DC;
            }
            
            .sidenav-title {
                font-size: 20px;
                color: #263238;
            }
            
            .sidenav-title-underline {
                width: 100%;
                height: 2px;
                background: #263238;
            }
            
            .sidenav-items {
                background-color: #B0BEC5;
            }
        </style>
       `;
    }

    content(){
        this.shadowRoot.innerHTML =`
            ${this.style()}
            <admin-sub-navigation title="Program"></admin-sub-navigation>
            <div class="container">
                <div class="sidenav">
                    <div class="sidenav-title-holder">
                        <div class="sidenav-title">Program Name</div>
                        <div class="sidenav-title-underline"></div>
                    </div>
                    <div class="sidenav-items">
                        <div>Program item title</div>
                        <div>Program item title</div>
                        <div>Program item title</div>
                        <div>Program item title</div>
                        <div>Add program item</div>
                    </div>
                </div>
            
                <div class="program-item-extra-container">
                    <div>program start time</div>
                    <div>more program item info!</div>
                    <div>program end time</div>
                </div>
            </div>
        `
    }

    connectedCallback(){
        this.content();
        console.log("test");
        // window.addEventListener("modal-update-overview", this.initForm.bind(this));
    }

    initForm(){
        this.content();


    }

    static get observedAttributes() {
        return ["url", "token"];
    }
}

export default ProgramOverviewPage;
