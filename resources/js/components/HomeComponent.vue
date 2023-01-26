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
    





    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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

    import axios from 'axios';
    import Swal from 'sweetalert2';
    import { Modal } from 'bootstrap';

    export default {
        components: {
            FullCalendar, // make the <FullCalendar> tag available
        },
        mounted() {

            this.exampleModal = new Modal(document.getElementById('exampleModal'));
            this.exampleModal.show();

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
