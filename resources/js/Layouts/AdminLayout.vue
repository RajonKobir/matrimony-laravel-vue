<script setup>

import Footer from '../Components/Admin/Footer.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Array,
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});


function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}


</script>

<template>


    <Head>
        <link rel="stylesheet" :href="`/assets/css/frontend/frontend.css`">
        <link rel="stylesheet" :href="`/assets/css/frontend/font-awesome.min.css`">
        <link rel="stylesheet" :href="`/assets/css/backend/dataTables.min.css`">
    </Head>


    <div class="shadibari-container-main">

        <slot />

        <Footer />

    </div>

</template>
