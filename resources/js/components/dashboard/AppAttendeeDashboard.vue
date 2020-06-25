<template>
    <div class="accordion" id="accordionExample1">
        <div class="card" v-for="(ticket, index) in tickets" :key="ticket.ticket_number">
            <div class="card-header" :id="'heading'+ticket.ticket_number">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" :data-target="'#collapse'+ticket.ticket_number" aria-expanded="true" :aria-controls="'collapse'+ticket.ticket_number">
                        Ticket Number : {{ticket.ticket_number}}
                    </button>
                </h2>
            </div>

            <div :id="'collapse'+ticket.ticket_number" class="collapse" :class="{'show' : index === 0}" :aria-labelledby="'heading'+ticket.ticket_number" data-parent="#accordionExample1">
                <div class="card-body">
                    <h6>{{ticket.conference.theme}}</h6>
                    <p>{{ticket.conference.description}}</p>
                </div>

                <div class="accordion" id="accordionExample">
                    <div class="card" v-for="(talk, index) in ticket.conference.talks" :key="talk.id">
                        <app-talks :index="index" :talk="talk"/>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data () {
            return {
                tickets : [],
                token : ''
            }
        },

        methods : {
            async getTickets () {
                var self = this
                await axios.get(`/api/attendees/tickets`, {
                    headers : {
                        'Accept' : 'application/json',
                        'Content-Type' : 'application/json',
                        'Authorization' : 'Bearer ' + self.token
                    }
                }).then(response => {
                    self.tickets = response.data.data
                }).catch(error => {
                    this.handleError(error)
                });
            }
        },

        mounted() {
            this.token = this.getAttendeeToken()
            this.getTickets()
        }
    }
</script>
