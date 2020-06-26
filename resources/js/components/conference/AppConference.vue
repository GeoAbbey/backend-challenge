<template>
    <div class="row">
        <div class="col-md-4" v-for="conference in conferences" :key="conference.id">
            <app-conference-single :conference="conference" />
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data () {
            return {
                conferences : []
            }
        },

        methods : {
            async getConferences () {
                let response = await axios.get('/api/conferences', )
                this.conferences = response.data.data
            }
        },

        mounted () {
            this.getConferences()
        }
    }
</script>
