<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mt-3">
                <div class="card">

                    <div class="card-body">
                        
                        <FullCalendar :options="calendarOptions" />

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>





<script>

    //Full calendar
    import FullCalendar from '@fullcalendar/vue3'
    //Components optionals of full calendar
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction'



    export default {
        data() {
            return {
                calendarOptions: {
                    plugins: [ dayGridPlugin, interactionPlugin , timeGridPlugin ],
                    initialView: 'dayGridMonth',
                    selectable: true,
                    //============================================================================================================
                    //Methods
                    dateClick: function(info) {
                        console.log(info)
                        alert('Clicked on: ' + info.dateStr);
                        alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        alert('Current view: ' + info.view.type);
                        // change the day's background color just for fun
                        info.dayEl.style.backgroundColor = 'red';
                    },
                    //End Methods
                    //==============================================================================================================
                    //============================================================================================================
                    //Events
                    events: [
                        { // this object will be "parsed" into an Event Object
                            title: 'The Title', // a property!
                            start: '2023-01-01', // a property!
                            end: '2023-01-04', // a property! ** see important note below about 'end' **
                            editable: true,
                        }
                    ],
                    eventColor: '#378006',
                    //End Events
                    //==============================================================================================================
                    //============================================================================================================
                    //Events Methods
                    eventClick: function(info) {
                        alert('Event: ' + info.event.title);
                        alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        alert('View: ' + info.view.type);
                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    eventDragStart: function(info){
                        console.log(info)
                    },
                    eventDragStop: function(info){
                        console.log(info)
                    }
                    //End Events Methods
                    //============================================================================================================
                }
            }
        },
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
