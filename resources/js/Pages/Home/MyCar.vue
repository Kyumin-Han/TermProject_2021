<template>
    <app-layout title="내 차 정보 입력하기">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                내 차 정보 입력
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <car-info :user="user"/>
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
    import CarInfo from '@/Pages/Home/CarInfo.vue'

    export default defineComponent({
        props: ['user'],

        components: {
            AppLayout,
            JetSectionBorder,
            CarInfo
        },
    })
</script>
