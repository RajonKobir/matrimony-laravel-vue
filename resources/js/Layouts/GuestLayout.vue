<script setup>

import { Head } from '@inertiajs/vue3';
import Header from '../Components/Frontend/Header.vue';
import Footer from '../Components/Frontend/Footer.vue';

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

const current_domain = window.location.host;


</script>

<template>

    <Head>
        <link rel="shortcut icon" :href="`/assets/css/images/favicon.png`">
        <link rel="stylesheet" :href="`/assets/css/frontend/frontend.css`">
        <link rel="stylesheet" :href="`/assets/css/frontend/font-awesome.min.css`">
    </Head>

    <div class="od-container-main">

        <Header :translations :locale :locales :canLogin :canRegister />

            <slot />

        <Footer />

    </div>

</template>
