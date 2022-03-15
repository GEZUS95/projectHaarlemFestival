import BaseComponent from "../../BaseComponent";

class ProgramOverviewPage extends BaseComponent {
    constructor() {
        super();
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
                padding: 20px 20px 20px 40px;
                background-color: #BAC8CF;
                width: 100%;
            }
            
            .sidenav {
                min-width: 240px;
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
            
            .sidenav-items-item {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                padding: 15px 20px;
                font-size: 18px;
            }
            
            .sidenav-action {
                background-color: #B0BEC5;
                display: flex;
                align-items: center;
                justify-content: flex-end;
                padding: 15px 20px;
                font-size: 18px;
            }
            
            .sidenav-action-add {
                padding: 5px 10px;
                background-color: #90A4AE;
                color: #4C1F32;
            }
            
            .program-item-extra-time-title {
                font-size: 20px;
                font-weight: bold;
            }
            
            .program-item-extra-time-sub-title {
                font-size: 20px;
                margin-left: 5px;
            }
            
            .program-item-extra-time-underline {
                width: 100%;
                height: 2px;
                background: #4C1F32;
            }
            
            .program-item-extra-time {
                margin-bottom: 5px;
            }
            
            .program-item-extra-time-title-container {
                display: flex;
                flex-direction: row;
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
                        <div class="sidenav-items-item">Artist Name</div>
                        <div class="sidenav-items-item">Artist Name</div>
                        <div class="sidenav-items-item">Artist Name</div>
                        <div class="sidenav-items-item">Artist Name</div>
                    </div>
                    <div class="sidenav-action">
                        <div class="sidenav-action-add">Add item</div>
                    </div>
                </div>
            
                <div class="program-item-extra-container">
                    <div class="program-item-extra-time">
                        <div class="program-item-extra-time-title-container">
                            <div class="program-item-extra-time-title">Program start time</div>
                            <div class="program-item-extra-time-sub-title"> - 29-Jul Friday 2021</div>
                        </div>
                        <div class="program-item-extra-time-underline"></div>
                    </div>
                    
                    <div class="">
                        
                    </div>
                    
                    <program-item-overview-component
                        start_time="${new Date()}"
                        end_time="${new Date()}"
                        artist="Artist Name"
                        location="Patronaat"
                        seats="200"
                        price="90"
                        special_guest="Special Guest"
                    ></program-item-overview-component>
                    
                    <program-item-overview-component
                        start_time="${new Date()}"
                        end_time="${new Date()}"
                        artist="Artist Name"
                        location="Patronaat"
                        seats="200"
                        price="90"
                        special_guest="Special Guest"
                    ></program-item-overview-component>
                   
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
        return [];
    }
}

export default ProgramOverviewPage;
