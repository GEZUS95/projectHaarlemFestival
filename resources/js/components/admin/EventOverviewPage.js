class EventOverviewPage extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this._$root = null;
        this._$scedule = this.getScheduleWithOutItems();
        console.log(this._$scedule);
    }

    getStyleObject(){
        return `<style>    
            .schedule {
                display: flex;
                flex-direction: row;
            }    
            
            .schedule-hours-display {
                min-width: 90px;
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
            
            .schedule-holder {
                height: 70px;
            }
        
        </style>`
    }

    connectedCallback() {
        let displayHours = [];
        for(let hours = 0; hours < 24; hours++){
            displayHours.push(hours);
        }
        this.shadowRoot.innerHTML = `
        ${this.getStyleObject()}
        <div class="schedule">
            <div class="schedule-hours-display">
                <div class="schedule-days-title"></div>
                <div>
                    ${displayHours.map((hours) => {
                        return `<div class="schedule-holder">${hours}</div>`
                    }).join('')}
                </div>
            </div>
            ${this._$scedule.map((days) => {
                return `
                <div class="schedule-days">
                    <div class="schedule-days-title">${this.formatDayString(days.date)}</div>
                    
                    <div>
                        ${days.hours.map((hours) => {
                        return `
                            <div class="schedule-holder">${hours.hourInt}</div>`
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

    getScheduleWithOutItems(){
        const monday = this.getMonday(new Date());
        let scheduleWithOutItems = [];
        for(let days = 0; days < 7; days++){
            let hoursArray = [];
            const nextDays = new Date(monday);
            nextDays.setDate(monday.getDate() + days);

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
        return [""];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            console.log(newValue);
        }
    }
}

export default EventOverviewPage;