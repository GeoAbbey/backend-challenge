<template>
    <div class="row">
        <div class="col-md-3"></div><div class="col-md-6">
        <form @submit.prevent="registerAttendee">
            <div class="form-group">
                <label for="exampleInputFirstName">First Name</label>
                <input type="text" class="form-control" required id="exampleInputFirstName" v-model="form.first_name" aria-describedby="firstNameHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputLastName">Last Name</label>
                <input type="text" class="form-control" required id="exampleInputLastName" v-model="form.last_name" aria-describedby="lastNameHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" v-model="form.email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" required class="form-control" v-model="form.password" id="exampleInputPassword">
            </div>
            <div class="form-group">
                <label for="exampleInputRePassword">Re-Password</label>
                <input type="password" required class="form-control" v-model="form.re_password" id="exampleInputRePassword">
            </div>
            <div class="form-group">
                <label for="exampleInputPhoneNumber">Phone Number</label>
                <input type="text" required class="form-control" id="exampleInputPhoneNumber" v-model="form.phone_number" aria-describedby="phoneNumberHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputAddress">Address</label>
                <input type="text" required class="form-control" id="exampleInputAddress" v-model="form.address" aria-describedby="addressHelp">
            </div>
            <small class="form-text text-muted">Already have an account? <a :href="'/auth/login'">Login</a></small>
            <button type="submit" class="btn btn-primary">Register</button>
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
                form : this.formData(),
            }
        },
        methods : {
            registerAttendee() {
                var self = this
                axios.post('/api/attendees', this.form).then(response => {
                    alert('Attendee registered successfully')
                    this.form = this.formData()
                }).catch(error => {
                    this.handleError(error)
                });
            },

            formData () {
                return  {
                    first_name : '',
                        last_name : '',
                        email : '',
                        password : '',
                        re_password : '',
                        phone_number : '',
                        address : ''
                };
            }
        }
    }
</script>
