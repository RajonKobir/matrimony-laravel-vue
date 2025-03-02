<script setup>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import Biodata from '../../Components/User/Biodata/Biodata.vue';
import ShowBiodata from '../../Components/User/ShowBiodata/ShowBiodata.vue';
import { ref, onMounted } from "vue";
import PopupMessage from '../../Components/User/PopupMessage.vue';
import axios from 'axios';

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
const isModalOpen = ref(false);
const modalMessage = ref({});
const editRequest = ref(false);


const loadSingleBiodata = (singleBiodata) => {
    single_biodata_data.value = singleBiodata;
}


const onClickEditButton = (clicked_true) => {

    if( !page.props.single_biodata.is_approved ){
        inEditMode.value = clicked_true;
        return;
    }

    if(confirm( page.props.translations.profile_page.edit_confirm )){
        axios.post(route('user.biodata.post.biodata_duplication', {
            user_id : page.props.single_biodata.user_id,
        }))
        .then((response) => {
            if( response.data ){
                single_biodata_data.value = response.data;
                inEditMode.value = clicked_true;
                editRequest.value = clicked_true;
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.modal_messages.edit_request_message,
                }
                isModalOpen.value = true;
            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.modal_messages.edit_request_failed,
                }
                isModalOpen.value = true;
            }
        });
    }
}


const onClickEditRequest = () => {
    axios.post(route('user.biodata.post.edit_request', {
        user_id : page.props.single_biodata.user_id,
    }))
    .then((response) => {
        if( response.data ){
            single_biodata_data.value.in_edit_request = true;
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.translations.modal_messages.edit_request_sent,
            }
            isModalOpen.value = true;
        }else{
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.translations.modal_messages.edit_request_failed,
            }
            isModalOpen.value = true;
        }
        inEditMode.value = !inEditMode.value;
    });
}


const closeModal = (value) => {
    isModalOpen.value = value;
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

    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata="single_biodata_data" >

        <div v-if="(inEditMode && single_biodata.is_approved) || ( inEditMode && single_biodata.biodata_completion == 100)"  class="flex justify-center items-center py-4 bg-[#FBD5B1]">
            <button v-if="single_biodata.is_approved" @click="onClickEditRequest" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                {{ translations.profile_page.edit_request_title }}
            </button>
            <button v-if="inEditMode && !single_biodata.is_approved" @click="inEditMode = !inEditMode" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                {{ translations.profile_page.edit_done_title }}
            </button>
        </div>

        <Biodata v-if="inEditMode" :translations :locale :locales :districts :editRequest :single_biodata="single_biodata_data" @loadSingleBiodata="loadSingleBiodata" />

        <ShowBiodata v-if="!inEditMode" :translations :locale :locales  :single_biodata="single_biodata_data" @onClickEditButton="onClickEditButton" />

    </AuthenticatedLayout>

</template>
