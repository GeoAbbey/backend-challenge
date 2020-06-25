<template>
    <div class="row">
        <div class="col-md-3"></div><div class="col-md-6">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" required class="form-control" id="exampleInputEmail1" v-model="form.email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" required class="form-control" v-model="form.password" id="exampleInputPassword1">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <small class="form-text text-muted">Don't have an account? <a :href="'/auth/register'">Register</a></small>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                form : {
                    email : '',
                    password : ''
                }
            }
        }
    }
</script>
