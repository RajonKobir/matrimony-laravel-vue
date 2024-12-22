<script setup>
import { ref, onMounted } from 'vue';
import DatePicker from './DatePicker.vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../InputError.vue';
import PermanentDynamicAddress from './PermanentDynamicAddress.vue';
import TemporaryDynamicAddress from './TemporaryDynamicAddress.vue';
import MultipleJobSelection from './MultipleJobSelection.vue';
import MultipleEducationMediumSelection from './MultipleEducationMediumSelection.vue';



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
});


const emits = defineEmits([
    'onCompleteTab',
    'onUpdateGender',
]);


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user["id"];
const media_agreement = ref(false);
const gender = ref('');
const selectedDate = ref(null);
const modalMessage = ref({});
const isModalOpen = ref(false);
var permanentAddress = ref({});
var temporaryAddress = ref({});


const form = useForm({
    csrf_token: csrf_token,
    running_tab: 1,
    user_id: user_id,
    birth_date: null,
    skin_color: null,
    height: null,
    weight: null,
    blood_group: null,
    maritial_status: null,
    permanent_country: null,
    permanent_division: null,
    permanent_district: null,
    permanent_upazila: null,
    permanent_post_office: null,
    permanent_post_code: null,
    address_same: false,
    temporary_country: null,
    temporary_division: null,
    temporary_district: null,
    temporary_upazila: null,
    temporary_post_office: null,
    temporary_post_code: null,
    job_title: '',
    job_details: null,
    medium_of_study: '',
});
const submit = () => {
    form.post(route('user.biodata.post.update_personal_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {

            if( page.props.flash.success ){
                form.reset();
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
    props.single_biodata.birth_date = date;
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
    let modalDescription = '';
    if( genderValue == ''){
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.error_description,
        }
        isModalOpen.value = true;
        return;
    } else {
        gender.value = genderValue;
        emits('onUpdateGender', gender.value);
        props.single_biodata.gender = gender.value;
        if( gender.value == 'male' ){
            modalDescription = page.props.translations.modal_messages.gender_update_message_male;
        }else{
            modalDescription = page.props.translations.modal_messages.gender_update_message_female;
        }
        axios.post(route('user.biodata.post.update_gender', {
            csrf_token,
            user_id,
            gender: gender.value
        } ))
        .then(function (response) {
            if( response.data ){
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : modalDescription,
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
            console.log(error);
        });
    }
}
// media agreement ends


const onUpdatePermanentAddress = (address) => {
    form.permanent_country = address.selectedCountry;
    form.permanent_division = address.selectedDivision;
    form.permanent_district = address.selectedDistrict;
    form.permanent_upazila = address.selectedUpazila;
    form.permanent_post_office = address.selectedPostOffice;
    form.permanent_post_code = address.selectedPostCode;
    props.single_biodata.permanent_country = address.selectedCountry;
    props.single_biodata.permanent_division = address.selectedDivision;
    props.single_biodata.permanent_district = address.selectedDistrict;
    props.single_biodata.permanent_upazila = address.selectedUpazila;
    props.single_biodata.permanent_post_office = address.selectedPostOffice;
    props.single_biodata.permanent_post_code = address.selectedPostCode;
}


const onUpdateTemporaryAddress = (address) => {
    form.temporary_country = address.selectedCountry;
    form.temporary_division = address.selectedDivision;
    form.temporary_district = address.selectedDistrict;
    form.temporary_upazila = address.selectedUpazila;
    form.temporary_post_office = address.selectedPostOffice;
    form.temporary_post_code = address.selectedPostCode;
    props.single_biodata.temporary_country = address.selectedCountry;
    props.single_biodata.temporary_division = address.selectedDivision;
    props.single_biodata.temporary_district = address.selectedDistrict;
    props.single_biodata.temporary_upazila = address.selectedUpazila;
    props.single_biodata.temporary_post_office = address.selectedPostOffice;
    props.single_biodata.temporary_post_code = address.selectedPostCode;
}


const addressAreSame = (true_or_false) => {
    if( true_or_false ){
        form.address_same = true_or_false;

        form.temporary_country = form.permanent_country;
        form.temporary_division = form.permanent_division;
        form.temporary_district = form.permanent_district;
        form.temporary_upazila = form.permanent_upazila;
        form.temporary_post_office = form.permanent_post_office;
        form.temporary_post_code = form.permanent_post_code;

        props.single_biodata.temporary_country = form.temporary_country;
        props.single_biodata.temporary_division = form.temporary_division;
        props.single_biodata.temporary_district = form.temporary_district;
        props.single_biodata.temporary_upazila = form.temporary_upazila;
        props.single_biodata.temporary_post_office = form.temporary_post_office;
        props.single_biodata.temporary_post_code = form.temporary_post_code;

        temporaryAddress.value.selectedCountry = form.temporary_country;
        temporaryAddress.value.selectedDivision = form.temporary_division;
        temporaryAddress.value.selectedDistrict = form.temporary_district;
        temporaryAddress.value.selectedUpazila = form.temporary_upazila;
        temporaryAddress.value.selectedPostOffice = form.temporary_post_office;
        temporaryAddress.value.selectedPostCode = form.temporary_post_code;

    }
}


const onSelectJobs = (selectedJobsArray) =>{
    form.job_title = selectedJobsArray.map((job) => job).join(', ');
    props.single_biodata.job_title = form.job_title;
}


const onSelectEducationMedium = (selectedEducationMediumArray) =>{
    form.medium_of_study = selectedEducationMediumArray.map((medium_of_study) => medium_of_study).join(', ');
    props.single_biodata.medium_of_study = form.medium_of_study;
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            if( props.single_biodata[item] != '' && props.single_biodata[item] != null ){
                switch(item) {
                case 'media_agreement':
                    media_agreement.value = props.single_biodata[item];
                    break;
                case 'gender':
                    gender.value = props.single_biodata[item];
                    break;
                case 'birth_date':
                    selectedDate.value = props.single_biodata[item];
                    form.birth_date = selectedDate.value;
                    break;
                case 'skin_color':
                    form.skin_color = props.single_biodata[item];
                    break;
                case 'height':
                    form.height = props.single_biodata[item];
                    break;
                case 'weight':
                    form.weight = props.single_biodata[item];
                    break;
                case 'blood_group':
                    form.blood_group = props.single_biodata[item];
                    break;
                case 'maritial_status':
                    form.maritial_status = props.single_biodata[item];
                    break;
                case 'permanent_country':
                    form.permanent_country = props.single_biodata[item];
                    permanentAddress.value.selectedCountry = props.single_biodata[item];
                    break;
                case 'permanent_division':
                    form.permanent_division = props.single_biodata[item];
                    permanentAddress.value.selectedDivision = props.single_biodata[item];
                    break;
                case 'permanent_district':
                    form.permanent_district = props.single_biodata[item];
                    permanentAddress.value.selectedDistrict = props.single_biodata[item];
                    break;
                case 'permanent_upazila':
                    form.permanent_upazila = props.single_biodata[item];
                    permanentAddress.value.selectedUpazila = props.single_biodata[item];
                    break;
                case 'permanent_post_office':
                    form.permanent_post_office = props.single_biodata[item];
                    permanentAddress.value.selectedPostOffice = props.single_biodata[item];
                    break;
                case 'permanent_post_code':
                    form.permanent_post_code = props.single_biodata[item];
                    permanentAddress.value.selectedPostCode = props.single_biodata[item];
                    break;
                case 'temporary_country':
                    form.temporary_country = props.single_biodata[item];
                    temporaryAddress.value.selectedCountry = props.single_biodata[item];
                    break;
                case 'temporary_division':
                    form.temporary_division = props.single_biodata[item];
                    temporaryAddress.value.selectedDivision = props.single_biodata[item];
                    break;
                case 'temporary_district':
                    form.temporary_district = props.single_biodata[item];
                    temporaryAddress.value.selectedDistrict = props.single_biodata[item];
                    break;
                case 'temporary_upazila':
                    form.temporary_upazila = props.single_biodata[item];
                    temporaryAddress.value.selectedUpazila = props.single_biodata[item];
                    break;
                case 'temporary_post_office':
                    form.temporary_post_office = props.single_biodata[item];
                    temporaryAddress.value.selectedPostOffice = props.single_biodata[item];
                    break;
                case 'temporary_post_code':
                    form.temporary_post_code = props.single_biodata[item];
                    temporaryAddress.value.selectedPostCode = props.single_biodata[item];
                    break;
                case 'job_details':
                    form.job_details = props.single_biodata[item];
                    break;
                case 'medium_of_study':
                    form.medium_of_study = props.single_biodata[item];
                    break;
                }
            }
        });

    }, 500);


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
        <input v-model="form.csrf_token" type="hidden" name="csrf_token" >
        <input v-model="form.running_tab" type="hidden" name="running_tab" >

        <div class="form_item col-span-6 p-2">
            <DatePicker :translations :selectedDate @onUpdateDate="onUpdateDate" />
            <InputError class="mt-2" :message="form.errors.birth_date" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.skin_color" @change="(e) => { single_biodata.skin_color = e.target.value }" id="skin_color" name="skin_color"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.skin_color_title }}</option>
                <option v-for="skin_color in translations.biodata_form.personal_biodata.skin_color_options" :key="skin_color.id" :value="skin_color">{{ skin_color }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.skin_color" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.height" @change="(e) => { single_biodata.height = e.target.value }" id="height" name="height"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.height_title }}</option>
                <option v-for="height in translations.biodata_form.personal_biodata.height_options" :key="height.id" :value="height">{{ height }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.height" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.weight" @change="(e) => { single_biodata.weight = e.target.value }" id="weight" name="weight"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.weight_title }}</option>
                <option v-for="height in translations.biodata_form.personal_biodata.weight_options" :key="height.id" :value="height">{{ height }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.weight" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.blood_group" @change="(e) => { single_biodata.blood_group = e.target.value }" id="blood_group" name="blood_group"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.blood_group_title }}</option>
                <option v-for="blood_group in translations.biodata_form.personal_biodata.blood_group_options" :key="blood_group.id" :value="blood_group">{{ blood_group }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.blood_group" />
        </div>
        <div class="form_item col-span-6 p-2">
            <select v-model="form.maritial_status" @change="(e) => { single_biodata.maritial_status = e.target.value }" id="maritial_status" name="maritial_status"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.maritial_status_title }}</option>
                <template v-for="(maritial_status, maritial_status_key) in translations.biodata_form.personal_biodata.maritial_status_options" :key="maritial_status.id">
                        <option :value="maritial_status_key" v-if="(single_biodata.gender == 'male' && maritial_status_key != 'widow_no_child' && maritial_status_key != 'widow_with_child' ) || (single_biodata.gender == 'female' && maritial_status_key != 'widower_no_child' && maritial_status_key != 'widower_with_child' )" >
                            {{ maritial_status }}
                        </option>
                </template>
            </select>
            <InputError class="mt-2" :message="form.errors.maritial_status" />
        </div>
        <div class="form_item col-span-12 md:col-span-6 p-2">
            <PermanentDynamicAddress :translations :locale :permanentAddress @onUpdatePermanentAddress="onUpdatePermanentAddress" />
            <InputError v-if="form.errors.permanent_country || form.errors.permanent_division || form.errors.permanent_district || form.errors.permanent_upazila || form.errors.permanent_post_office || form.errors.permanent_post_code" class="mt-2" :message="translations.biodata_form.personal_biodata.permanent_address_error" />
        </div>
        <div class="form_item col-span-12 md:col-span-6 p-2">
            <TemporaryDynamicAddress :translations :locale :temporaryAddress @addressAreSame="addressAreSame" @onUpdateTemporaryAddress="onUpdateTemporaryAddress" />
            <InputError v-if="form.errors.temporary_country || form.errors.temporary_division || form.errors.temporary_district || form.errors.temporary_upazila || form.errors.temporary_post_office || form.errors.temporary_post_code" class="mt-2" :message="translations.biodata_form.personal_biodata.temporary_address_error" />
        </div>
        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleJobSelection :translations :jobTitles="single_biodata.job_title" @onSelectJobs="onSelectJobs"/>
            <InputError class="mt-2" :message="form.errors.job_title" />
        </div>
        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.job_details" name="job_details" rows="1" maxlength="200" :placeholder="translations.biodata_form.personal_biodata.job_details_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.job_details" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleEducationMediumSelection :translations :educationMediums="single_biodata.medium_of_study" @onSelectEducationMedium="onSelectEducationMedium"/>
            <InputError class="mt-2" :message="form.errors.medium_of_study" />
        </div>

        <div class="form_item col-span-12 p-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                {{ translations.biodata_form.personal_biodata.submit_button_text }}
            </button>
        </div>

    </form>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />


</template>
