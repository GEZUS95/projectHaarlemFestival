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
            <div>
                <div>filler div!</div>
                <div>
                    ${displayHours.map((hours) => {
                        return `<div>${hours}</div>`
                    }).join('')}
                </div>
            </div>
            ${this._$scedule.map((days) => {
                return `
                <div>
                    <div>${days.date}</div>
                    
                    <div>
                        ${days.hours.map((hours) => {
                        return `
                            <div>${hours.hourInt}</div>`
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