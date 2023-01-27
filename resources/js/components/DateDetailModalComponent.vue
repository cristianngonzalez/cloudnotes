<template>

<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>
-->

    <!-- Modal -->
    <div class="modal fade" id="dateDetailModal" tabindex="-1" aria-labelledby="dateDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="dateDetailModalLabel">{{ dateStr }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary" @click="toggleMenu">
                                <span v-if="!addNewEventMenu">Add new event</span>
                                <span v-else="!addNewEventMenu">View events of this date</span>
                            </button>
                        </div>
                    </div>

                    <div v-if="!addNewEventMenu" class="row">
                        <div class="col-12" v-for="event in events">
                            <div v-if="event.start == dateStr">
                                {{ event.title }}
                            </div>
                        </div>
                    </div>

                    <form v-else="!addNewEventMenu">
                        <div class="mb-1">
                            <label for="eventStart" class="col-form-label">When does the event start?</label>
                            <input type="date" class="form-control" id="eventStart">
                        </div>
                        <div class="mb-1">
                            <label for="eventEnd" class="col-form-label">When does the event finish?</label>
                            <input type="date" class="form-control" id="eventEnd">
                        </div>
                        <div class="mb-1">
                            <label for="eventName" class="col-form-label">What is the name of the event?</label>
                            <input type="text" class="form-control" id="eventName">
                        </div>
                        <div class="mb-1">
                            <button class="btn btn-primary" @click="setEvent($event)">Create event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</template>

<script>

    import { Modal } from 'bootstrap';


    export default{
        props: {
            events: Object
        },
        data() {
            return{
                token: token,//Token comes from the blade layout file
                url: url, //Url comes from the blade layout file

                dateDetailModal: null, //Dom modal element

                addNewEventMenu: false,//Param that switch the modal menu between add event and     

                //This object is for binding class of inputs form addEvent
                validateForm: {
                    end: true,
                    start: true,
                    name: true,
                },

                dateStr: '',
                thisDateEvents: [],
            }
        },  
        mounted() {
            this.dateDetailModal = new Modal(document.getElementById('dateDetailModal'));
        },
        methods: {
            showModal: function(info){
                //info param comes from the 'dateClick' event of fullcalendar into the parentComponent

                console.log(info)
                this.dateStr = info.dateStr;

                this.dateDetailModal.show();
            },

            toggleMenu: function(){
                this.addNewEventMenu = !this.addNewEventMenu;
            },

            setEvent: function(e){

                e.preventDefault();


                axios.post(
                    `${this.url}/events/set`,
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
                }).catch((res) => {

                });

            }
        }
    }

</script>

<style>

.formRequired{
    border-color: #FF0000;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
}

</style>