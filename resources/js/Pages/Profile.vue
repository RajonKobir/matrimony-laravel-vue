<script setup>
import AuthenticatedLayout from '../Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import Biodata from './User/Biodata.vue';
import { ref, onMounted } from "vue";

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
    single_biodata: {
        type: Object,
    },
});

// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const single_biodata_data = ref([]);

const loadSingleBiodata = (singleBiodata) => {
    single_biodata_data.value = singleBiodata;
}


onMounted(() => {
    single_biodata_data.value = page.props.single_biodata;
})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.biodata");

</script>

<template>

    <Head title="Profile"/>

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata="single_biodata_data" >

        <Biodata :translations :locale :locales :districts :single_biodata="single_biodata_data" @loadSingleBiodata="loadSingleBiodata" />

    </AuthenticatedLayout>

</template>
