<script setup>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import Biodata from '../../Components/User/Biodata/Biodata.vue';
import ShowBiodata from '../../Components/User/ShowBiodata/ShowBiodata.vue';
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
const inEditMode = ref(true);

const loadSingleBiodata = (singleBiodata) => {
    single_biodata_data.value = singleBiodata;
}


const onClickEditButton = (clicked_true) => {
    inEditMode.value = clicked_true;
}


onMounted(() => {

    setTimeout(() => {
        single_biodata_data.value = page.props.single_biodata;
        if( page.props.single_biodata.is_approved || page.props.single_biodata.biodata_completion == 100 ){
            inEditMode.value = false;
        }
    }, 500);
})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.biodata");

</script>

<template>


    <Head title="Profile"/>

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata="single_biodata_data" >

        <div v-if="(inEditMode && $page.props.single_biodata.is_approved) || ( inEditMode && $page.props.single_biodata.biodata_completion == 100)"  class="flex justify-center items-center py-4 bg-[#FBD5B1]">
            <button v-if="$page.props.single_biodata.is_approved" @click="inEditMode = !inEditMode" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                {{ translations.profile_page.edit_request_title }}
            </button>
            <button v-if="inEditMode && !$page.props.single_biodata.is_approved" @click="inEditMode = !inEditMode" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                {{ translations.profile_page.edit_done_title }}
            </button>
        </div>

        <Biodata v-if="inEditMode" :translations :locale :locales :districts :single_biodata="single_biodata_data" @loadSingleBiodata="loadSingleBiodata" />

        <ShowBiodata v-if="!inEditMode" :translations :locale :locales  :single_biodata="single_biodata_data" @onClickEditButton="onClickEditButton" />

    </AuthenticatedLayout>

</template>
