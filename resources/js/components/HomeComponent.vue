<template>

    <div class="container">

        <div class="row mt-3">
            <div class="col-12" id="alerts-container-respawn">
                
            </div>
        </div>

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
    
    <DateDetailModalComponent ref="DateDetailModalComponentRef" :events="calendarOptions.events" @newEvent="newEvent"></DateDetailModalComponent>

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
    import DateDetailModalComponent from './DateDetailModalComponent.vue';

    export default {
        components: {
            FullCalendar, // make the <FullCalendar> tag available
            DateDetailModalComponent,
        },
        mounted() {

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
                this.calendarOptions.events = { // this object will be "parsed" into an Event Object
                            id: 0,
                            title: 'Ay jesus', // a property!
                            start: '2023-01-01', // a property!
                            end: '2023-01-04', // a property! ** see important note below about 'end' **
                            editable: true,
                }
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
                    dateClick: (info) => {
                        this.showDateDetailModal(info);
                    },
                    //End Methods
                    //==============================================================================================================
                    //============================================================================================================
                    //Events
                    events: [],
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
            showDateDetailModal: function(info){
                this.$refs.DateDetailModalComponentRef.showModal(info);
            },
            //==========================================================
            //Emit Receipt events
            newEvent: function(event){
                if(event){
                    //The new event to the events array
                    this.calendarOptions.events.push(event);
                    this.printAlertToDom("<strong>Perfect!</strong> you have created a new event, we'll remind you." , 'success');
                }else{
                    this.printAlertToDom('Siii' , 'success');
                }
            },
            //Emit Receipt events end
            //==========================================================
            printAlertToDom: function(text , action){
                let container = document.getElementById('alerts-container-respawn');

                container.innerHTML = `
                    <div class="alert alert-${action} alert-dismissible fade show" role="alert">
                        ${text}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `
            }
        }
    }
</script>
