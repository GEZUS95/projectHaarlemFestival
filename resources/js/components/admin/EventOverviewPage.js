class EventOverviewPage extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this._$root = null;
        this._$date = this.getMonday(new Date())
        this._$url = null;

        window.addEventListener("schedule-next-week", (() => {
            this._$date = this.getMonday(new Date(new Date(this._$date).setDate(new Date(this._$date).getDate() + 7)))
            this.fetchData();
        }));

        window.addEventListener("schedule-pref-week", (() => {
            this._$date = this.getMonday(new Date(new Date(this._$date).setDate(new Date(this._$date).getDate() - 7)))
            this.fetchData();
        }));

        window.addEventListener("schedule-custom-date", (evt => {
            this._$date = this.getMonday(evt.detail)
            this.fetchData();
        }));
    }

    getStyleObject() {
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
            
            .schedule-hours-box-sub {
                display: flex;
                justify-content: center;
                min-height: 70px;
            }
            .schedule-hours-box {
                background-color: #BAC8CF;
                box-sizing: border-box;
                border-right:  1px solid #ffffff;
                border-bottom: 2px solid #ffffff;
                border-left:   1px solid #ffffff;
            }
        
            .program_start {
                border-top:    1px solid  #000000;
                border-right:  1px solid  #000000;
                border-left:   1px solid  #000000;
                width: 100%;
                border-top-right-radius: 2px;
                border-top-left-radius: 2px;
                padding: 5px 5px 0 5px;
                margin: 5px 5px 0 5px;
            }
            
            .program_between {
                border-right:  1px solid  #000000;
                border-left:   1px solid  #000000;
                width: 100%;
                padding: 0 5px 0 5px;
                margin: 0 5px 0 5px;
            }
            
            .program_end {
                border-right:  1px solid  #000000;
                border-bottom: 1px solid  #000000;
                border-left:   1px solid  #000000;
                width: 100%;
                height: 10px;
                border-bottom-right-radius: 2px;
                border-bottom-left-radius: 2px;
                padding: 0 5px 0 5px;
                margin: 0 5px 0 5px;
            }
            
            .item_start {
                padding: 5px;
                margin-top: 5px;
                background: #0569c1;
                height: 70px;
                border-top-right-radius: 2px;
                border-top-left-radius: 2px;
            }
            
            .item_between {
                padding: 5px;
                background: #0569c1;
                height: 70px;
                border-top-right-radius: 2px;
                border-top-left-radius: 2px;
            }
            
            .item_end {
                margin-bottom: 5px;
            }
            
        </style>`
    }

    initComponent(data) {
        const schedule = this.getSchedule(data)
        let displayHours = [];
        for (let hours = 0; hours < 24; hours++) {
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
                            <div class="schedule-holder schedule-hours-box" id="${hours.hourInt}">
                                ${hours.program.map((pro) => {
                                    return `
                                    <div class="schedule-hours-box-sub">
                                        <div class="${pro.type}" style="background-color: ${pro.program.color}">
                                            ${pro.type === "program_start" ? pro.program.title : ''}
                                            ${hours.items.map((i) => {
                                                console.log(hours.items);
                                                
                                                return `
                                                <div class="${i.type}">
                                                    ${i.type === "item_start" ? i.item["performer"]["name"] : ''}
                                                </div>`
                                            }).join('')}
                                        </div>
                                    </div>`
                                }).join('')}
                            </div>`
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

    getSchedule(data) {
        let schedule = [];
        for (let days = 0; days < 7; days++) {
            let hoursArray = [];
            const nextDays = new Date(this._$date);
            nextDays.setDate(new Date(this._$date).getDate() + days);
            for (let hours = 0; hours < 24; hours++) {
                let programArr = [];
                let itemArr = [];

                if(data != null) {
                    if (data["programs"]) {
                        data["programs"].forEach((program) => {
                            const programStartTime = new Date(program["start_time"]);
                            const programEndTime = new Date(program["end_time"]);
                            if (this.datesAreOnSameDay(nextDays, programStartTime)) {

                                if (programStartTime.getHours() === hours) programArr.push({
                                    type: "program_start",
                                    program
                                })
                                if (hours > programStartTime.getHours() && hours < programEndTime.getHours()) programArr.push({
                                    type: "program_between",
                                    program
                                })
                                if (programEndTime.getHours() === hours) programArr.push({type: "program_end", program})

                                if (program["items"]) {
                                    program["items"].forEach((item) => {
                                        const itemStartTime = new Date(item["start_time"]);
                                        const itemEndTime = new Date(item["end_time"]);

                                        if (itemStartTime.getHours() === hours) itemArr.push({type: "item_start", item})
                                        if (hours > itemStartTime.getHours() && hours < itemEndTime.getHours()) itemArr.push({
                                            type: "item_between",
                                            item
                                        })
                                        if (itemEndTime.getHours() === hours) itemArr.push({type: "item_end", item})
                                    })
                                }
                            }
                        })
                    }
                }

                hoursArray.push({
                    hourInt: hours,
                    program: programArr,
                    items: itemArr,
                })
            }

            schedule.push({
                date: nextDays,
                hours: hoursArray
            })
        }

        console.log(schedule)
        return schedule;
    }

    getMonday(date) {
        const day = date.getDay() || 7;
        if (day !== 1)
            date.setHours(-24 * (day - 1));
        return date.toISOString().split('T')[0];
    }

    formatDayString(date) {
        let dateString = date.toLocaleDateString('en-us', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
        return dateString.replace(/,/g, "");
    }

    static get observedAttributes() {
        return ["link"];
    }

    fetchData() {
        const _this = this;

        if (this._$date == null || this._$url == null)
            return;

        let formData = new FormData();
        formData.append('date', this._$date);

        this.postFormData(this._$url, formData).then(data => {
            _this.initComponent(JSON.parse(data["events"]));
        });
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this._$url = newValue;
            this.fetchData();
        }
    }

    async postFormData(url = '', data) {
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });

        return response.json();
    }

    datesAreOnSameDay(first, second) {
        return first.getFullYear() === second.getFullYear() &&
            first.getMonth() === second.getMonth() &&
            first.getDate() === second.getDate();
    }
}

export default EventOverviewPage;
