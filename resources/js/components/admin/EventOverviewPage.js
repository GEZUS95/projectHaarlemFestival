class EventOverviewPage extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this._$root = null;
        this._$date = this.getMonday(new Date())
        this._$url = null;

        window.addEventListener("schedule-next-week", (() => {
            this._$date = this.getMonday(new Date(this._$date.setDate(this._$date.getDate() + 7)))
            this.fetchData();
        }));

        window.addEventListener("schedule-pref-week", (() => {
            this._$date = this.getMonday(new Date(this._$date.setDate(this._$date.getDate() - 7)))
            this.fetchData();
        }));

        window.addEventListener("schedule-custom-date", (evt => {
            this._$date = this.getMonday(evt.detail)
            this.fetchData();
        }));
    }

    getStyleObject(){
        return `<style>    
            .schedule {
                display: flex;
                flex-direction: row;
            }    
            
            .schedule-hours-filler {
                min-width: 75px;
            }
            
            .schedule-days {
                width: 100%;
            }
            
            .schedule-days-title {
                justify-content: center;
                width: 100%;
                display: flex;
                align-items: center;
                height: 50px;
                font-size: 18px;
                font-weight: bold;
                background-color: #DDE1E3;
            }
            
            .schedule-hours-display-holder-hours {
                font-size: 32px;
                font-weight: bold;
            }
            
            .schedule-hours-display-holder-minutes{
                font-size: 16px;
                font-weight: bold;
                margin-left: 5px;
                margin-top: 5px;
            }
            
            .schedule-hours-display-holder {
                display: flex;
                align-items: flex-start;
                justify-content: flex-start;
                margin-left: 10px;
            }
            .schedule-holder {
                max-height: 70px;
                min-height: 70px;
            }
            
            .schedule-hours-display {
                background-color: #DDE1E3;
            }
            
            .schedule-hours-box {
                background-color: #BAC8CF;
                box-sizing: border-box;
                border-right:  1px solid #ffffff;
                border-bottom: 2px solid #ffffff;
                border-left:   1px solid #ffffff;
            }
        
        </style>`
    }

    initComponent(data) {
        console.log(JSON.parse(data))
        const schedule = this.getSchedule()
        let displayHours = [];
        for(let hours = 0; hours < 24; hours++){
            displayHours.push(hours);
        }
        this.shadowRoot.innerHTML = `
        ${this.getStyleObject()}
        <div class="schedule">
            <div class="schedule-hours-filler">
                <div class="schedule-days-title"></div>
                <div class="schedule-hours-display">
                    ${displayHours.map((hours) => {
                        return `<div class="schedule-holder schedule-hours-display-holder">
                                    <div class="schedule-hours-display-holder-hours">${hours.toLocaleString('en-US', {
                                        minimumIntegerDigits: 2,
                                        useGrouping: false
                                    })}</div>
                                    <div class="schedule-hours-display-holder-minutes">00</div>
                            </div>`
                    }).join('')}
                </div>
            </div>
            ${schedule.map((days) => {
                return `
                <div class="schedule-days">
                    <div class="schedule-days-title" id="${days}">${this.formatDayString(days.date)}</div>
                    
                    <div>
                        ${days.hours.map((hours) => {
                        return `
                            <div class="schedule-holder schedule-hours-box" id="${hours.hourInt}"></div>`
                        }).join('')}
                    </div>
                </div>
                `
            }).join('')}
        </div>
        `;
    }
    disconnectedCallback() {

    }

    getSchedule(){
        let scheduleWithOutItems = [];
        for(let days = 0; days < 7; days++){
            let hoursArray = [];
            const nextDays = new Date(this._$date);
            nextDays.setDate(this._$date.getDate() + days);

            for(let hours = 0; hours < 24; hours++){
                hoursArray.push({
                    hourInt: hours,
                    items: [],
                })
            }

            scheduleWithOutItems.push({
                date: nextDays,
                hours: hoursArray
            })
        }

        return scheduleWithOutItems;
    }

    getMonday(date) {
        const day = date.getDay() || 7;
        if (day !== 1)
            date.setHours(-24 * (day - 1));
        return date;
    }

    formatDayString(date){
        let dateString = date.toLocaleDateString('en-us', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        return dateString.replace(/,/g, "");
    }

    static get observedAttributes() {
        return ["link"];
    }

    fetchData(){
        const _this = this;

        fetch(this._$url)
            .then(response => response.json())
            .then((data) => {
                _this.initComponent(data);
            });
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this._$url = newValue;
            this.fetchData();
        }
    }
}

export default EventOverviewPage;
