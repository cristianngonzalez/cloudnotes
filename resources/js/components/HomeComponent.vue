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
    
    <AddEventModalComponent></AddEventModalComponent>

</template>





<script>

    //Full calendar
    import FullCalendar from '@fullcalendar/vue3'
    //Components optionals of full calendar
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction'

    //Other libraries
    import axios from 'axios';
    import Swal from 'sweetalert2';

    //Components
    import AddEventModalComponent from './AddEventModalComponent.vue';

    export default {
        components: {
            FullCalendar, // make the <FullCalendar> tag available
            AddEventModalComponent,
        },
        mounted() {

            let events;

            axios.post(
                `${this.url}/events/all`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "Access-Control-Allow-Origin": "*",
                        "X-CSRF-TOKEN": this.token,
                    },
                }
            ).then((res) => {
                console.log(res.data)
                this.calendarOptions.events = res.data;
            }).catch((res) => {

            });

            

            console.log('Component mounted.')
        },
        data() {
            return {
                token: token,//Token comes from the blade layout file
                url: url, //Url comes from the blade layout file

                exampleModal: null,

                calendarOptions: {
                    plugins: [ dayGridPlugin, interactionPlugin , timeGridPlugin ],
                    initialView: 'dayGridMonth',
                    selectable: true,
                    //============================================================================================================
                    //Methods
                    dateClick: function(info) {
                        console.log(info)

                        this.$bvModal.show('exampleModal')

                    },
                    //End Methods
                    //==============================================================================================================
                    //============================================================================================================
                    //Events
                    events: [
                        { // this object will be "parsed" into an Event Object
                            id: 0,
                            title: 'The Title', // a property!
                            start: '2023-01-01', // a property!
                            end: '2023-01-04', // a property! ** see important note below about 'end' **
                            editable: true,
                        },
                        { // this object will be "parsed" into an Event Object
                            id: 24,
                            title: 'Mi segundo evento', // a property!
                            start: '2023-01-13', // a property!
                            end: '2023-01-14', // a property! ** see important note below about 'end' **
                            editable: true,
                        },
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
                        console.log(info.event.id)
                    },
                    eventDragStart: function(info){
                        console.log(info)
                    },
                    eventDragStop: function(info){
                        console.log(info)
                    },
                    selectMirror: function(info){
                        console.log('Arrastre')
                        console.log(info)
                    },
                    //End Events Methods
                    //============================================================================================================
                }
            }
        },
        
        methods: {
            
        }
    }
</script>
