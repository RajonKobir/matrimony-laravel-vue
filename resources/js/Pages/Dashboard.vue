<script setup>
import AuthenticatedLayout from '../Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Biodata from './User/Biodata.vue';

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

document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.biodata");

</script>

<template>
    <Head title="Biodata"/>

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister>

        <Biodata :translations :locale :locales />

    </AuthenticatedLayout>
</template>
