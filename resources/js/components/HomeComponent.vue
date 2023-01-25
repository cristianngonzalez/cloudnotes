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
                    //====================================================================================
                    //Events
                    dateClick: function(info) {
                        alert('Clicked on: ' + info.dateStr);
                        alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        alert('Current view: ' + info.view.type);
                        // change the day's background color just for fun
                        info.dayEl.style.backgroundColor = 'red';
                    }
                    //End Events
                    //====================================================================================
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
