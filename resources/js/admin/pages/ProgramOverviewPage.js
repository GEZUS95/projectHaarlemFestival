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

    content(program){
        if(program === null)
            return;

        this.shadowRoot.innerHTML =`
            ${this.style()}
            <admin-sub-navigation title="Program"></admin-sub-navigation>
            <div class="container">
                <div class="sidenav">
                    <div class="sidenav-title-holder">
                        <div class="sidenav-title">${program.title}</div>
                        <div class="sidenav-title-underline"></div>
                    </div>
                    <div class="sidenav-items">
                        ${program.items.map((item) => {
                            return `<div class="sidenav-items-item" id="${item.id}">${item["performer"].name}</div>`;
                        }).join('')}
                    </div>
                    <div class="sidenav-action">
                        <div class="sidenav-action-add">Add item</div>
                    </div>
                </div>
            
                <div class="program-item-extra-container">
                    <div class="program-item-extra-time">
                        <div class="program-item-extra-time-title-container">
                            <div class="program-item-extra-time-title">Program start time</div>
                            <div class="program-item-extra-time-sub-title"> - ${new Date(program.start_time).toDateString()}</div>
                        </div>
                        <div class="program-item-extra-time-underline"></div>
                    </div>
                    
                    <div class="">
                        
                    </div>
                    
                    ${program.items.map((item) => {
                        return `
                            <program-item-overview-component
                                start_time="${item.start_time}"
                                end_time="${item.end_time}"
                                artist="${item["performer"].name}"
                                location="${item["location"].name}"
                                seats="${item["location"].seats}"
                                price="${item["price"]}"
                                special_guest="${item["special_guest_id"] !== null ? item["special_guest"].name : "no special guest"}"
                            ></program-item-overview-component>`;
                        }).join('')}      
                </div>
            </div>
            
            <create-item-modal></create-item-modal>
            
            <update-item-modal></update-item-modal>
        `;

        this.shadowRoot.querySelector(".sidenav-action-add").addEventListener("click", () => {
            window.dispatchEvent(new CustomEvent('modal-create-item', {detail: program.id}))
        });

        const elements = this.shadowRoot.querySelectorAll(".sidenav-items-item");
        Array.from(elements).forEach((element) => {
            element.addEventListener('click', (e) =>
                window.dispatchEvent(new CustomEvent('modal-update-item',{
                    detail: {
                        item_id: e.path[0].id,
                        program_id: program.id
                    }}
                ))
            );
        });

    }

    async connectedCallback(){
        await this.test();
        window.addEventListener("refresh-program-overview", this.initForm.bind(this));
    }

    async test(){
        const res = await this.queryGet("http://127.0.0.1:4321/admin/program/1")

        this.content(res);
    }

    async initForm(e){
        const res = await this.queryGet("http://127.0.0.1:4321/admin/program/" + e.detail)

        this.content(res);
    }

    static get observedAttributes() {
        return [];
    }
}

export default ProgramOverviewPage;
