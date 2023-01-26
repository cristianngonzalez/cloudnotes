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
                        <div class="col-12" v-for="event in events">
                            <div v-if="event.start == dateStr">
                                {{ event.title }}
                            </div>
                        </div>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">New Event</button>
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
                dateDetailModal: null, //Dom modal element

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
            }
        }
    }

</script>