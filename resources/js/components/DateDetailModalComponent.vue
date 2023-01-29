<template>

    <!-- Modal -->
    <div class="modal fade" id="dateDetailModal" tabindex="-1" aria-labelledby="dateDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="dateDetailModalLabel">{{ dateStr }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-2">
                        <div class="col-12">
                            <button class="btn btn-sm btn-primary" @click="toggleMenu">
                                <span v-if="!addNewEventMenu">Add new event</span>
                                <span v-else="!addNewEventMenu">View events of this date</span>
                            </button>
                        </div>
                    </div>

                    <div v-if="!addNewEventMenu" class="row">
                        <!---------------------------------------------------------------->
                        <!--List events-->
                        <div v-if="events.length > 0">

                            <table class="table">
                                <tbody>
                                    <tr v-for="event in events">
                                        <template v-if="event.start == dateStr">
                                            <td>{{ event.title }}</td>
                                            <td><button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash3"></i>
                                            </button></td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>

                            
                        </div>
                        <!--End list events-->
                        <!---------------------------------------------------------------->

                        <!---------------------------------------------------------------->
                        <!--If there aren't events-->
                        <div v-if="events.length < 0">
                            <span><i class="bi bi-journal-x"></i></span>
                            <span>There are not event for this date, make one!</span>
                        </div>
                        <!---------------------------------------------------------------->
                    </div>

                    <form v-else="!addNewEventMenu">
                        <div class="mb-1">
                            <label for="eventStart" class="col-form-label">When does the event start?</label>
                            <input v-model="event.start" type="date" class="form-control" :class="{'form-control-danger' : !validateForm.start }">
                        </div>
                        <div class="mb-1">
                            <label for="eventEnd" class="col-form-label">When does the event finish?</label>
                            <input v-model="event.end" type="date" class="form-control">
                        </div>
                        <div class="mb-1">
                            <label for="eventName" class="col-form-label">What is the name of the event?</label>
                            <input v-model="event.title" type="text" class="form-control">
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
                    title: true,
                },
                //Data of new event (model with the template form)
                event: {
                    user_id: '2',
                    start: false,
                    end: false,
                    title: '',
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
                //ValidateForm
                

                axios.post(
                    `${this.url}/events/set`, this.event ,
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

.form-control-danger{
    border-color: #FF0000;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
}

</style>