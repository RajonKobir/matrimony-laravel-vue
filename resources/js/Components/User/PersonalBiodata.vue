<script setup>
import { ref, onMounted } from 'vue';
import DatePicker from './DatePicker.vue';
import PopupMessage from './PopupMessage.vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';



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


// initializing
const csrf_token = usePage().props.csrf_token;
const user_id = usePage().props.auth.user["id"];
const media_agreement = ref(false);
const selected_gender = ref('');
const single_biodata = ref([]);
const selectedDate = ref('');
const modalMessage = ref('');
const isModalOpen = ref(false);


const closeModal = (value) => {
    isModalOpen.value = value;
}

const onUpdateDate = (date) => {
    selectedDate.value = date;
}



const mediaAgreement = (e) => {
    e.preventDefault();
    let mediaAgreement = e.target.value;
    if( mediaAgreement == '' || mediaAgreement == 'false'){
        modalMessage.value = "You must agree!";
        isModalOpen.value = true;
        return;
    }
    if (mediaAgreement == 'true') {
        media_agreement.value = true;

        axios.post(route('user.biodata.post', {
            csrf_token,
            user_id,
            media_agreement: media_agreement.value
        } ))
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    }

}

const selectGender = (e) => {
    e.preventDefault();
    if (e.target.value == 'male') {
        selected_gender.value = 'male';
    }
    else if (e.target.value == 'female') {
        selected_gender.value = 'female';
    }
    // alert(e.target.value);
}



onMounted(() => {

// console.log(usePage().props.auth.user["id"]);

axios.get(route('user.biodata.get', {
    csrf_token,
    user_id
}))
.then(function (response) {
    if( response.data.length == 0){
        return;
    }
    single_biodata.value = response.data[0];
    if(response.data[0].media_agreement == true){
        media_agreement.value = true;
    }
})
.catch(function (error) {
    console.log(error);
});

});


</script>


<template>

    <PopupMessage :isModalOpen :modalMessage @closeModal=closeModal />

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

    <div v-if="!media_agreement" class="grid grid-cols-12 gap-0">
        <div class="form_item col-start-3 col-span-6 p-2">
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
        <div class="form_item col-start-3 col-span-6 p-2">
            <label for="select_gender">{{ translations.biodata_form.personal_biodata.select_gender }}</label>
            <select @change="selectGender" id="select_gender" name="select_gender"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>{{ translations.form_basics.select_text }}</option>
                <option value="male">{{ translations.biodata_form.personal_biodata.select_gender_male }}</option>
                <option value="female">{{ translations.biodata_form.personal_biodata.select_gender_female }}</option>
            </select>
        </div>
        <div class="form_item col-span-6 p-2">
            <DatePicker @onUpdateDate=onUpdateDate />
        </div>
        <div class="form_item col-span-6 p-2">
            <DatePicker @onUpdateDate=onUpdateDate />
        </div>
    </div>


</template>
