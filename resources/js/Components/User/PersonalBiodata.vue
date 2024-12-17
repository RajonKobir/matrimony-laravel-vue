<script setup>
import { ref, onMounted, defineEmits } from 'vue';
import DatePicker from './DatePicker.vue';
import PopupMessage from './PopupMessage.vue';
import axios from 'axios';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../InputError.vue';



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
});


const emits = defineEmits([
    'onCompleteTab'
]);


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user["id"];
const media_agreement = ref(false);
const gender = ref('');
const single_biodata = ref([]);
const selectedDate = ref('2015-12-31');
const modalMessage = ref({});
const isModalOpen = ref(false);


const form = useForm({
    _token: '',
    user_id: user_id,
    birth_date: null,
    skin_color: null,
    height: null,
    weight: null,
    blood_group: null,
});
const submit = () => {
    form.post(route('user.biodata.post.update_personal_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {

            if( page.props.flash.success ){
                emits('onCompleteTab', 1);
            }
            else if( page.props.flash.error ){
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.flash.error,
                }
                isModalOpen.value = true;
            }

        },
    });
};


const closeModal = (value) => {
    isModalOpen.value = value;
}

const onUpdateDate = (date) => {
    form.birth_date = date;
    selectedDate.value = date;
}



const mediaAgreement = (e) => {
    e.preventDefault();
    let mediaAgreement = e.target.value;
    if( mediaAgreement == '' || mediaAgreement == 'false'){
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.error_description,
        }
        isModalOpen.value = true;
        return;
    }
    if (mediaAgreement == 'true') {
        media_agreement.value = true;

        axios.post(route('user.biodata.post.update_media_agreement', {
            csrf_token,
            user_id,
            media_agreement: media_agreement.value
        } ))
        .then(function (response) {
            if( response.data ){
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.modal_messages.success_description,
                }
                isModalOpen.value = true;
            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.modal_messages.error_description,
                }
                isModalOpen.value = true;
            }
        })
        .catch(function (error) {
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.translations.modal_messages.error_description,
            }
            isModalOpen.value = true;
        });
    }
}
// media agreement ends



const genderUpdate = (e) => {
    e.preventDefault();
    let genderValue = e.target.value;
    if( genderValue == ''){
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.error_description,
        }
        isModalOpen.value = true;
        return;
    } else {
        gender.value = genderValue;
        // e.target.disabled = true;

        axios.post(route('user.biodata.post.update_gender', {
            csrf_token,
            user_id,
            gender: gender.value
        } ))
        .then(function (response) {
            if( response.data ){
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.modal_messages.success_description,
                }
                isModalOpen.value = true;
            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.modal_messages.error_description,
                }
                isModalOpen.value = true;
            }
        })
        .catch(function (error) {
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.translations.modal_messages.error_description,
            }
            isModalOpen.value = true;
        });
    }
}
// media agreement ends




onMounted(() => {


    axios.get(route('user.biodata.get', {
        csrf_token,
        user_id
    }))
    .then(function (response) {
        if( response.data.length == 0){
            return;
        }
        single_biodata.value = response.data[0];
        let single_biodata_keys = Object.keys(single_biodata.value);

        single_biodata_keys.forEach(function(item, index, arr){
            if( single_biodata.value[item] != '' && single_biodata.value[item] != null ){
                switch(item) {
                case 'media_agreement':
                    media_agreement.value = single_biodata.value[item];
                    break;
                case 'gender':
                    gender.value = single_biodata.value[item];
                    break;
                case 'birth_date':
                    selectedDate.value = single_biodata.value[item];
                    form.birth_date = selectedDate.value;
                    break;
                case 'skin_color':
                    form.skin_color = single_biodata.value[item];
                    break;
                case 'height':
                    form.height = single_biodata.value[item];
                    break;
                case 'weight':
                    form.weight = single_biodata.value[item];
                    break;
                case 'blood_group':
                    form.blood_group = single_biodata.value[item];
                    break;
                }
            }
        });

    })
    .catch(function (error) {
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.error_description,
        }
        isModalOpen.value = true;
    });

});


</script>


<template>


    <div v-if="!media_agreement" class="grid grid-cols-12 gap-0">
        <div class="form_item col-span-12 md:col-start-4 md:col-span-6 p-2">
            <label for="media_agreement">{{ translations.biodata_form.personal_biodata.media_agreement }}</label>
            <select @change="mediaAgreement" id="media_agreement" name="media_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="">{{ translations.form_basics.select_text }}</option>
                <option value="true">{{ translations.form_basics.inshallah_yes }}</option>
                <option value="false">{{ translations.form_basics.no }}</option>
            </select>
        </div>
    </div>

    <div v-if="media_agreement" class="grid grid-cols-12 gap-0">
        <div class="form_item col-span-12 md:col-start-4 md:col-span-6 p-2">
            <label for="gender">{{ translations.biodata_form.personal_biodata.gender_title }}</label>
            <select @change="genderUpdate" id="gender" name="gender"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option  value="">{{ translations.form_basics.select_text }}</option>
                <option v-for="(single_gender, gender_key) in translations.biodata_form.personal_biodata.gender_options" :key="single_gender.id" :value="gender_key" :selected="gender_key == gender">{{ single_gender }}</option>
            </select>
        </div>
    </div>


    <form v-if="media_agreement && gender != ''" @submit.prevent="submit" class="grid grid-cols-12 gap-0">
        <input type="hidden" name="_token" :value="$page.props.csrf_token">

        <div class="form_item col-span-6 p-2">
            <DatePicker :translations :selectedDate @onUpdateDate="onUpdateDate" />
            <InputError class="mt-2" :message="form.errors.birth_date" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.skin_color" id="skin_color" name="skin_color"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected hidden>{{ translations.biodata_form.personal_biodata.skin_color_title }}</option>
                <option v-for="skin_color in translations.biodata_form.personal_biodata.skin_color_options" :key="skin_color.id" :value="skin_color">{{ skin_color }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.skin_color" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.height" id="height" name="height"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected hidden>{{ translations.biodata_form.personal_biodata.height_title }}</option>
                <option v-for="height in translations.biodata_form.personal_biodata.height_options" :key="height.id" :value="height">{{ height }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.height" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.weight" id="weight" name="weight"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected hidden>{{ translations.biodata_form.personal_biodata.weight_title }}</option>
                <option v-for="height in translations.biodata_form.personal_biodata.weight_options" :key="height.id" :value="height">{{ height }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.weight" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.blood_group" id="blood_group" name="blood_group"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected hidden>{{ translations.biodata_form.personal_biodata.blood_group_title }}</option>
                <option v-for="blood_group in translations.biodata_form.personal_biodata.blood_group_options" :key="blood_group.id" :value="blood_group">{{ blood_group }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.blood_group" />
        </div>


        <!-- <div class="form_item col-span-12 p-2">
            <div class="mt-1 od-contact-us-form-top od-text-align-center">
                <div v-if="$page.props.flash.success" class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                        {{ $page.props.flash.success }}
                    </div>
                </div>
                <div v-if="$page.props.flash.error" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                        {{ $page.props.flash.error }}
                    </div>
                </div>
            </div>
        </div> -->

        <div class="form_item col-span-12 p-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                {{ translations.biodata_form.personal_biodata.submit_button_text }}
            </button>
        </div>

    </form>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />


</template>
