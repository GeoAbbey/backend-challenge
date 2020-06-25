<template>
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="https://via.placeholder.com/500" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{speaker.name}}</h5>
                <p class="card-text">
                    {{speaker.email}}
                </p>
                <p class="card-text" v-if="speaker.phone_number"><small class="text-muted">{{speaker.phone_number}}</small></p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props : {
            speaker : {
                type : Object,
                required : true
            }
        }
    }
</script>
