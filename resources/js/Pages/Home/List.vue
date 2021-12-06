<template>
    <div class="card lg:card-side bordered" v-for="loc in locations" :key="loc">
        <div class="card-body">
            <h2 class="card-title">{{ loc.충전소명 }}</h2> 
            <p>Rerum reiciendis beatae tenetur excepturi aut pariatur est eos. Sit sit necessitatibus veritatis sed molestiae voluptates incidunt iure sapiente.</p> 
            <div class="card-actions">
                <button class="btn btn-primary">Get Started</button> 
                <button class="btn btn-ghost">More info</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['locations']
}
</script>