<template>
    <div>
        <div class="card-header" :id="'heading'+index">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" :data-target="'#collapse'+index" aria-expanded="true" :aria-controls="'collapseOne'+index">
                    {{talk.title}}
                </button>
            </h2>
        </div>

        <div :id="'collapse'+index" class="collapse" :class="{ 'show' : index === 0 }":aria-labelledby="'heading'+index" data-parent="#accordionExample">
            <div class="card-body">
                <p>{{talk.description}}</p>
                <p>Address : {{talk.address}}</p>
                <p>Start Time : {{talk.start_time}}</p>
                <p>End Time : {{talk.end_time}}</p>
            </div>
            <div class="card mb-3 ml-2" style="max-width: 540px;" v-for="speaker in talk.speakers" :key="speaker.id">
                <app-speakers :speaker="speaker" />
            </div>
        </div>
    </div>
</template>
<script>
    import AppSpeakers from "../speakers/AppSpeakers";
    export default {
        components: {AppSpeakers},
        props : {
            talk : {
                type : Object,
                required : true
            },
            index : {
                type : Number,
                required : true
            }
        }
    }
</script>
