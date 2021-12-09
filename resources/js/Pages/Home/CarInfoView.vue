<template>
    <div v-if="cars">
        <div class="card lg:card-side bordered mb-10" v-for="car in cars" :key="car">
            <figure>
                <img class="w-20" :src="car.image" alt="사진이 등록되지 않았습니다">
            </figure> 
            <div class="card-body">
                <Link :href="'/moreinfo/'+car.id"><h2 class="card-title">차량 이름 : {{ car.carname }}</h2></Link>
                <h2 class="card-title">브랜드 : {{ car.brand }}</h2>
            </div>
            <button @click="deleteCar(car.id)" class="btn btn-circle btn-xs">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current">   
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>                       
                </svg>
            </button>
        </div>
    </div>
    <div class="mt-10" v-if="cars.length==0">
        <div class="card lg:card-side mb-10 place-content-center">
            <button onclick="location.href='/mycar'" class="btn btn-wide btn-lg">차량 정보 입력하러 가기</button>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import {Link} from '@inertiajs/inertia-vue3'
    export default defineComponent({
        components: {
            Link
        },

        props: ['user', 'cars'],
        data() {
            return {
                form: {
                    name: null,
                    carnum: null,
                    brand: null
                },
                confirmUpdate: false,
            }
        },
        methods: {
            deleteCar(id) {
                 this.$inertia.delete('/deletecar/' + id)
            }
        },
    })
</script>
