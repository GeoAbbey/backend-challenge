<template>
    <div class="jumbotron">
        <h1 class="display-4">{{conference.theme}}</h1>
        <p class="lead">{{conference.description}}</p>
        <hr class="my-4">
        <h3 class="display-6">Talks</h3>
        <div class="accordion" id="accordionExample">
            <div class="card" v-for="(talk, index) in talks" :key="talk.id">
                <app-talks :index="index" :talk="talk"/>
            </div>
        </div>
        <hr class="my-4">
        <p>Start Date : {{conference.start_date}}</p>
        <p>End Date : {{conference.end_date}}</p>
        <p>Address : {{conference.address}}</p>
        <a class="btn btn-primary btn-lg" @click="buyTicket" role="button">Buy Ticker</a>
    </div>
</template>
<script>
    import axios from 'axios'
    import AppTalks from "../talks/AppTalks";
    export default {
        components: {AppTalks},
        data () {
            return {
                conference : {},
                talks : [],
                token : ''
            }
        },

        props : {
            id : {
                type : Number,
                required : true
            }
        },

        methods : {
            async getConferenceDetails () {
                let response = await axios(`/api/conferences/${this.id}`)
                this.conference = response.data.data
                this.talks = response.data.talks
            },

            formData () {
                var talkIds = {'talks' : []};
                this.talks.forEach(function(talk) {
                    talkIds.talks.push({
                        'id' : talk.id
                    })
                })
                return talkIds
            },

            async buyTicket() {
                if(this.isAttendeeLoggedIn()) {
                    var self = this
                    await axios.post(`/api/conferences/${this.conference.id}/tickets`, self.formData(), {
                        headers : {
                            'Accept' : 'application/json',
                            'Content-Type' : 'application/json',
                            'Authorization' : 'Bearer ' + self.token
                        }
                    }).then(response => {
                        alert('Your attendance have been booked successfully')
                    }).catch(error => {
                        this.handleError(error)
                    });
                }else {
                    alert('Please login before you can book a conference')
                    return
                }

            }
        },

        mounted() {
            this.getConferenceDetails(),
            this.token = this.getAttendeeToken()
        }
    }
</script>
