<template>
    <Link :href="'/'">
        <img src="/images/logo.png" style="width:250px; height:250px" alt="">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
