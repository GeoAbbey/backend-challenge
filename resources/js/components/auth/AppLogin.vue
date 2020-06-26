<template>
    <div class="row">
        <div class="col-md-3"></div><div class="col-md-6">
            <form @submit.prevent="login">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" required class="form-control" id="exampleInputEmail1" v-model="form.email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" required class="form-control" v-model="form.password" id="exampleInputPassword1">
                </div>
                <small class="form-text text-muted">Don't have an account? <a :href="'/auth/register'">Register</a></small>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data () {
            return {
                form : this.formData()
            }
        },

        methods : {
            async login () {
                var self = this
                await axios.post('/api/attendees/auth/login', this.form).then(response => {
                    window.localStorage.setItem('attendeeToken', JSON.stringify(response.data.access_token));
                    self.getAttendee(response.data.access_token)
                    self.form = self.formData()
                    window.location.href = '/'
                }).catch(error => {
                    self.handleError(error)
                })
            },
            async getAttendee (token) {
                var self = this
                await axios.get(`/api/attendees/me`, {
                    headers : {
                        'Accept' : 'application/json',
                        'Content-Type' : 'application/json',
                        'Authorization' : 'Bearer ' + token
                    }
                }).then(response => {
                    window.localStorage.setItem('attendee', JSON.stringify(response.data.data));
                }).catch(error => {
                    self.handleError(error)
                })
            },

            formData () {
                return {
                    email : '',
                    password : ''
                }
            }
        }
    }
</script>
