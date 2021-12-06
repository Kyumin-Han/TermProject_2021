<template>
    <div v-if="cars">
        <div class="card lg:card-side bordered mb-10" v-for="car in cars" :key="car">
            <figure>
                <img class="w-20" :src="car.image" alt="사진이 등록되지 않았습니다">
            </figure> 
            <div class="card-body">
                <h2 class="card-title">차량 이름 : {{ car.carname }}</h2>
                <h2 class="card-title">차량 번호 : {{ car.carnum }}</h2>
                <h2 class="card-title">브랜드 : {{ car.brand }}</h2>
                <h3 class="card-title">소유주 이름 : {{ user.name }}</h3>
            </div>
            <button @click="deleteCar(car.id)" class="btn btn-circle btn-xs">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current">   
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>                       
                </svg>
            </button>
        </div>
    </div>
    <div v-if="cars.length==0">
        <div class="card lg:card-side mb-10 place-content-center">
            <button onclick="location.href='/mycar'" class="btn btn-wide btn-lg">차량 정보 입력하러 가기</button>
        </div>
    </div>
     
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        components: {
        },

        props: ['user', 'cars'],

        methods: {
            deleteCar(id) {
                 this.$inertia.delete('/deletecar/' + id)
            }
        },
    })
</script>
