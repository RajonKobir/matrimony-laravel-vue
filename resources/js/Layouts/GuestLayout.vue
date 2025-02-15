<script setup>

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
    single_biodata: {
        type: Object,
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

    <div class="shadibari-container-main">

        <Header :translations :locale :locales :canLogin :canRegister :single_biodata />

            <slot />

        <Footer />

    </div>

</template>
