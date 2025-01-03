<script setup>
import AuthenticatedLayout from '../Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Biodata from './User/Biodata.vue';
import { ref } from "vue";

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
    districts: {
        type: Object,
    },
});

// initializing
const single_biodata = ref([]);

const loadSingleBiodata = (singleBiodata) => {
    single_biodata.value = singleBiodata;
}

document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.biodata");

</script>

<template>

    <Head title="Profile"/>

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata >

        <Biodata :translations :locale :locales :districts @loadSingleBiodata="loadSingleBiodata" />

    </AuthenticatedLayout>

</template>
