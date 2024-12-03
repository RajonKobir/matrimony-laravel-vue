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
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});



</script>

<template>

    <GuestLayout :translations :locale :locales :canLogin :canRegister>
        <Homepage :translations />
    </GuestLayout>

</template>
