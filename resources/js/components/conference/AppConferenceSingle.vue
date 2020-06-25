<template>
    <div class="card">
        <img src="https://via.placeholder.com/500" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title">{{conference.theme}}</h5>
            <p class="card-text">{{this.truncateSentence(conference.description, 20)}}...</p>
            <a :href="'/conferences/'+conference.id" class="btn btn-primary">View details</a>
        </div>
    </div>
</template>
<script>
    export default {
        props : {
            conference : {
                required : true,
                type : Object
            }
        },
        methods : {
            truncateSentence (string, numberOfWords) {
                return string.split(" ").splice(0,numberOfWords).join(" ");
            }
        }
    }
</script>
