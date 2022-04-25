import BaseComponent from "../../BaseComponent";

class ProgramItemOverviewComponent extends BaseComponent {
    constructor() {
        super();

        this._$start_time = new Date();
        this._$end_time = new Date();
        this._$artist = null;
        this._$location = null;
        this._$seats = null;
        this._$price = null;
        this._$special_guest = null;
    }

    style(){
        return `
        <style>     
         
            .time-container {
                display: flex;
                align-items: center;
            }
            
            .time {
                display: flex;
                color: white;
            }
            
            .time-hours {
                font-size: 20px;
                font-weight: bold;
            }
            
            .time-minutes {
                font-size: 12px;
                font-weight: bold;
            }
            
            .time-line {
                margin: 0 3px 0 7px;
                background-color: white;
                width: 5px;
                height: 2px;
            }
            
            .artist {
                background: #00A9F4;
                padding: 8px;
                box-sizing: border-box;
                border-radius: 1px 1px 0 0;
                width: 100%;
                color: #fff;
                font-weight: bold;
                font-size: 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            
            .container-top {
                margin-top: 10px;
                display: flex;
                flex-direction: row;
                box-shadow: 0 0 5px 0 rgb(0, 0, 0, / 92%);
            }
            
            .container-bottom {
                border-radius: 1px;
                overflow: hidden;
                box-sizing: border-box;
                width: 100%;
            }
            
            .head {
                border-bottom: rgb(186 200 207) 2px solid;
                padding: 5px;
                background-color: #fff;
                display: flex;
                flex-direction: row;
            }
            
            .body {
                padding: 5px;
                display: flex;
                flex-direction: row;
                background-color: #fff;
            }
            
            .item-info {
                width: 25%;
                color: #222222;
            }
        </style>
       `;
    }

    content(){
        this.shadowRoot.innerHTML =`
            ${this.style()}
            <div class="container-top">
                <div class="artist">
                    ${this._$artist}
                    <div class="time-container">
                        ${this.makeTimeElement(this._$start_time)}
                        <div class="time-line"></div>
                        ${this.makeTimeElement(this._$end_time)}
                    </div>  
                </div>
            </div>
            
            <div class="container-bottom">
                <div class="head">
                    <div class="item-info">Location:</div>
                    <div class="item-info">Seats:</div>
                    <div class="item-info">Price:</div>
                    <div class="item-info">Special Guest:</div>
                </div>
                <div class="body">
                    <div class="item-info">${this._$location}</div>
                    <div class="item-info">${this._$seats}</div>
                    <div class="item-info">${this._$price}</div>
                    <div class="item-info">${this._$special_guest}</div>
                </div>
            </div>
        `
    }

    makeTimeElement(date){
        date = new Date(date);
        date.setHours(date.getHours() - 1)
        return `
            <div class="time">
                <div class="time-hours">${this.padTo2Digits(date.getHours())}</div>
                <div class="time-minutes">${this.padTo2Digits(date.getMinutes())}</div>
            </div> 
        `
    }

    padTo2Digits(num) {
        return String(num).padStart(2, '0');
    }

    connectedCallback(){
        this.content();
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+ name] = newValue;
        }
    }

    static get observedAttributes() {
        return ["start_time", "end_time", "artist", "location", "seats", "price", "special_guest"];
    }
}

export default ProgramItemOverviewComponent;
