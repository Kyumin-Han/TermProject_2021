<template>
    <app-layout title="소유한 차량들">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                소유한 차량들
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <car-info-view :cars="cars" :owner="owner" :user="user"/>
                    <jet-section-border />
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
    import CarInfoView from '@/Pages/Home/CarInfoView.vue'

    export default defineComponent({
        props: ['user', 'cars'],

        components: {
            AppLayout,
            JetSectionBorder,
            CarInfoView
        },
    })
</script>
