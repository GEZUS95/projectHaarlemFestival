class EventOverviewPage extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({mode: "open"});

        this._$date = this.getMonday(new Date())
        this._$url = null;
        this._$event_id = null;

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

        window.addEventListener("force-refresh", (evt => {
            this._$date = this.getMonday(evt.detail)
            this.fetchData();
        }));
    }

    getStyleObject() {
        return `<style>   
            :host {
                -webkit-user-select: none; /* Safari */        
                -moz-user-select: none; /* Firefox */
                -ms-user-select: none; /* IE10+/Edge */
                user-select: none; /* Standard */
            }
             
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
                max-height: 70px;
                min-height: 70px;
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
        if(data)
            this._$event_id = data.id;

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
                        return `
                             <div class="schedule-hours-display-holder">
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
                            <div class="schedule-holder schedule-hours-box" id="${new Date(days.date).getDay() +"_"+ hours.hourInt}">
                                ${hours.program.map((pro) => {
                                    return `
                                    <div class="schedule-hours-box-sub">
                                        <div class="${pro.type}" style="background-color: ${pro.program.color}">
                                            ${pro.type === "program_start" ? pro.program.title : ''}
                                            ${hours.items.map((i) => {
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

        this._$row = null;
        this._$firstPlaced = false;
        this._$lastPlacedItemId = null;
        this._$firstPlacedItemId = null;
        this.shadowRoot.querySelector(".schedule").addEventListener('mousemove', this.createPrograms.bind(this) );
    }

    createPrograms(event){
        // `event.buttons` gets the state of the mouse buttons
        // 0 = not pressed, 1 = left click pressed, 2 = right click pressed
        if (event.buttons === 1) {
            const el = event.path[0];
            if(el.classList[0] !== "schedule-holder")
                return;

            if(this._$row == null)
                this._$row = el.id.split("_")[0];

            if(this._$firstPlaced === false) {
                this._$firstPlaced = true;

                const idOfElementBelowThisNode = this._$row + "_" + (parseInt(el.id.split("_")[1]) + 1);
                const elementBelowThisNode = Array.from(el.parentElement.children).find(e => {
                    return e.id === idOfElementBelowThisNode
                });

                if(elementBelowThisNode.querySelector(".schedule-hours-box-sub") !== null)
                    return;

                el.innerHTML += `<div class="schedule-hours-box-sub"> <div class="program_start" style="background-color: #ffffff"></div></div>`;
                elementBelowThisNode.innerHTML = `<div class="schedule-hours-box-sub"> <div class="program_end" style="background-color: #ffffff"></div></div>`;
                this._$firstPlacedItemId = el.id
                this._$lastPlacedItemId = elementBelowThisNode.id
            }

            if(this._$row != null &&
                this._$row === el.id.split("_")[0] &&
                this._$firstPlaced === true &&
                el.querySelector(".schedule-hours-box-sub") === null
            ){
                Array.from(el.parentElement.childNodes).forEach((element) => {
                    if(!(el.id === element.id && element.id.split("_")[1] > 0))
                        return;

                    const idOfElementAboveThisNode = this._$row + "_" + (element.id.split("_")[1] - 1);
                    const idOfElementTwoAboveThisNode = this._$row + "_" + (element.id.split("_")[1] - 2);

                    const elementAboveThisNode = Array.from(el.parentElement.children).find(e => { return e.id === idOfElementAboveThisNode});
                    const elementTwoAboveThisNode = Array.from(el.parentElement.children).find(e => { return e.id === idOfElementTwoAboveThisNode});

                    if(!elementAboveThisNode.querySelector(".schedule-hours-box-sub"))
                        return;

                    if(elementTwoAboveThisNode && elementAboveThisNode){
                        if(!elementAboveThisNode.querySelector(".program_start")) elementAboveThisNode.innerHTML = `<div class="schedule-hours-box-sub"> <div class="program_between" style="background-color: #ffffff"></div></div>`;
                        el.innerHTML = `<div class="schedule-hours-box-sub"> <div class="program_end" style="background-color: #ffffff"></div></div>`;
                    }

                    if(elementTwoAboveThisNode === undefined && elementAboveThisNode){
                        el.innerHTML = `<div class="schedule-hours-box-sub"> <div class="program_end" style="background-color: #ffffff"></div></div>`;
                    }

                    this._$lastPlacedItemId = el.id;
                })
            }
        }

        if (event.buttons === 0) {
            if(this._$firstPlacedItemId === null && this._$lastPlacedItemId === null)
                return;

            const firstPlaced = this._$firstPlacedItemId;
            const lastPlaced = this._$lastPlacedItemId;
            const eventId = this._$event_id;
            setTimeout(() => {
                let startTime = this.getMonday(new Date(this._$date));

                if(parseInt(firstPlaced.split("_")[0]) === 0)
                    startTime = this.getSundayOfWeek(this._$date);

                let endTime = startTime;

                if(parseInt(firstPlaced.split("_")[0]) === 0) {
                    startTime = new Date(new Date(startTime).setHours(parseInt(firstPlaced.split("_")[1])));
                    startTime = new Date(new Date(startTime).setDate(new Date(new Date(startTime)).getDate() + (parseInt(firstPlaced.split("_")[0]))));

                    endTime = new Date(new Date(endTime).setHours(parseInt(lastPlaced.split("_")[1])));
                    endTime = new Date(new Date(endTime).setDate(new Date(new Date(endTime)).getDate() + (parseInt(lastPlaced.split("_")[0]))));
                } else {
                    startTime = new Date(new Date(startTime).setHours(parseInt(firstPlaced.split("_")[1])));
                    startTime = new Date(new Date(startTime).setDate(new Date(new Date(startTime)).getDate() + (parseInt(firstPlaced.split("_")[0]) - 1)));

                    endTime = new Date(new Date(endTime).setHours(parseInt(lastPlaced.split("_")[1])));
                    endTime = new Date(new Date(endTime).setDate(new Date(new Date(endTime)).getDate() + (parseInt(lastPlaced.split("_")[0]) - 1)));
                }

                window.dispatchEvent(new CustomEvent('init-create-program-modal', {
                    detail: {
                        startTime: startTime,
                        endTime: endTime,
                        eventId: eventId,
                    }
                }))
            }, 0)

            this._$firstPlacedItemId = null;
            this._$lastPlacedItemId = null;
            this._$row = null;
            this._$firstPlaced = false;
        }
    }

    getSundayOfWeek(date) {
        const today = new Date(date);
        const first = today.getDate() - today.getDay() + 1;
        const last = first + 6;

        return new Date(today.setDate(last));
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

                if (data != null && data["programs"]) {
                    data["programs"].forEach((program) => {
                        const programStartTime = new Date(program["start_time"]);
                        const programEndTime = new Date(program["end_time"]);

                        if (!this.datesAreOnSameDay(nextDays, programStartTime))
                            return;

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
                    })
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

        return schedule;
    }

    getMonday(fromDate) {
        fromDate = new Date(fromDate);
        let dayLength = 24 * 60 * 60 * 1000;
        let currentDate = new Date(fromDate.getFullYear(), fromDate.getMonth(), fromDate.getDate());
        let currentWeekDayMillisecond = ((currentDate.getDay()) * dayLength);
        let monday = new Date(currentDate.getTime() - currentWeekDayMillisecond + dayLength);

        if (monday > currentDate) {
            monday = new Date(monday.getTime() - (dayLength * 7));
        }

        return monday;
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
        return ["url", "event_id"];
    }

    fetchData() {
        const _this = this;

        let formData = new FormData();
        formData.append('date', this._$date);

        this.postFormData(this._$url, formData).then(data => {
            console.log(data)
            _this.initComponent(data["events"]);
        });
    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (oldValue !== newValue) {
            this["_$"+ name] = newValue;

            if(this._$url == null)
                return;

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
