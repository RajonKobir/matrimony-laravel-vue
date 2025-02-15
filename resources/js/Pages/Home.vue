<script setup>
import Homepage from './Frontend/Homepage.vue'
import GuestLayout from '../Layouts/GuestLayout.vue';

defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Array,
    },
    districts: {
        type: Object,
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



</script>

<template>

    <GuestLayout :translations :locale :locales :canLogin :canRegister :single_biodata >
        <Homepage :translations :locale :districts />
    </GuestLayout>

</template>
