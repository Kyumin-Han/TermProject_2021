<template>
    <div class="card lg:card-side bordered" v-for="loc in locations" :key="loc">
        <div class="card-body">
            <h2 class="card-title">{{ loc.충전소명 }}</h2> 
            <p>{{  }}</p> 
            <div class="card-actions">
                <button @click="move(loc.위도, loc.경도)" class="btn btn-primary">위치로 가기</button> 
                <button class="btn btn-ghost">More info</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['locations'],
    methods: {
        move(lat, lng) {
            this.$parent.setLocation(lat, lng)
        }
    }
}
</script>