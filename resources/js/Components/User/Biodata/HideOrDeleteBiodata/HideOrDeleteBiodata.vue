<script setup>
import { ref, onMounted } from 'vue';
import PopupMessage from './PopupMessage.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';


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
    single_biodata: {
        type: Object,
    },
    selectedGender: {
        type: String,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user.id;
const modalMessage = ref({});
const isModalOpen = ref(false);
const hide_biodata = ref(null);


const hideBiodata = (e) => {
    e.preventDefault();
    hide_biodata.value = props.single_biodata.hide_biodata = e.target.value;

    axios.post(route('user.biodata.post.update_hide_biodata', {
        csrf_token,
        user_id,
        hide_biodata: hide_biodata.value,
    } ))
    .then(function (response) {
        if( response.data ){
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.translations.biodata_form.hide_or_delete.success_text,
            }
            isModalOpen.value = true;
        }else{
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.translations.biodata_form.hide_or_delete.error_text,
            }
            isModalOpen.value = true;
        }
    })
    .catch(function (error) {
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.biodata_form.hide_or_delete.error_text,
        }
        isModalOpen.value = true;
    });
}


const onClickSelfBiodataDelete = (user_id) => {
    if(confirm("Are you sure?")){
        axios.post(route('user.biodata.post.onClickPermanentDelete', {
            csrf_token,
            user_id,
        }))
        .then((response) => {
            if( response.data ){
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.biodata_form.hide_or_delete.success_text_on_deletion,
                }
                isModalOpen.value = true;
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.biodata_form.hide_or_delete.error_text,
                }
                isModalOpen.value = true;
            }
        })
        .catch(function (error) {
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.translations.biodata_form.hide_or_delete.error_text,
            }
            isModalOpen.value = true;
        });
    }
}


const closeModal = (value) => {
    isModalOpen.value = value;
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'hide_biodata':
                hide_biodata.value = props.single_biodata[item];
                break;
            }
        });

    }, 500);


});


</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

    <div class="main-container">

        <div class="grid grid-cols-12 gap-0">
            <div class="form_item col-span-12 md:col-start-4 md:col-span-6 p-2">
                <label for="hide_biodata" class="text-base">
                    {{ translations.biodata_form.hide_or_delete.hide_or_delete_text }}
                </label>
                <select @change="hideBiodata" id="hide_biodata" name="hide_biodata"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled :selected="hide_biodata == null">{{ translations.form_basics.select_text }}</option>
                    <option value="1" :selected="hide_biodata == 1">{{ translations.form_basics.yes }}</option>
                    <option value="0" :selected="hide_biodata == 0">{{ translations.form_basics.no }}</option>
                </select>
            </div>
        </div>


        <div class="mt-8 text-center">
            <button type="button" @click="onClickSelfBiodataDelete(user_id)" class="text-xs bg-red-500 hover:bg-red-700 !text-white font-bold py-2 px-4 rounded-full">
                Delete Permanently
            </button>
        </div>

    </div>


</template>
