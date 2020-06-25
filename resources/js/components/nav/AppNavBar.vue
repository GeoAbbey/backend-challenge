<template>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" :href="'/'">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active" v-if="isAttendeeLoggedIn()">
                <a class="nav-link" href="">{{attendee.first_name}}</a>
            </li>
            <li class="nav-item active" v-else>
                <a class="nav-link" :href="'/auth/register'">Register</a>
            </li>
            <li class="nav-item active" v-if="isAttendeeLoggedIn()">
                <a class="nav-link" type="button" @click="logout">Logout</a>
            </li>
            <li class="nav-item active" v-else>
                <a class="nav-link" :href="'/auth/login'">Login</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data () {
            return {
                attendee : this.getAttendee(),
                token : ''
            }
        },
        mounted () {
            this.token = this.getAttendeeToken()
        },
        methods : {
            async logout () {
                var self = this
                await axios.get('/api/attendees/auth/logout', {
                    headers : {
                        'Accept' : 'application/json',
                        'Content-Type' : 'application/json',
                        'Authorization' : 'Bearer ' + self.token
                    }
                })
                this.removeItemFromStorage('attendeeToken')
                this.removeItemFromStorage('attendee')
                window.location.href = '/'
            }
        }
    }
</script>
