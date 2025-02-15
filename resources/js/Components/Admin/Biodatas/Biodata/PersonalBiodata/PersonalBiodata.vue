<script setup>
import { ref, watch, onMounted } from 'vue';
import DatePicker from './DatePicker.vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../../../InputError.vue';
import PermanentDynamicAddress from './PermanentDynamicAddress.vue';
import TemporaryDynamicAddress from './TemporaryDynamicAddress.vue';
import MultipleJobSelection from './MultipleJobSelection.vue';
import MultipleEducationMediumSelection from './MultipleEducationMediumSelection.vue';
import axios from 'axios';


const emits = defineEmits([
    'onCompleteTab',
    'onUpdateGender',
    'onUpdateDeservedJobTitles',
    'onUpdateDeservedMaritialStatuses',
]);


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
    districts: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = ref(null);
const gender = ref(null);
const modalMessage = ref({});
const isModalOpen = ref(false);
const permanentAddress = ref({});
const temporaryAddress = ref({});
const isJobSelected = ref(false);
const isGeneralHonorable = ref(false);
const isAliyaHonorable = ref(false);
const isKowmiHonorable = ref(false);


const form = useForm({
    csrf_token: csrf_token,
    biodata_completion: 20,
    running_tab: 1,
    user_id: user_id.value,
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
    permanent_union_parishad: null,
    address_same: false,
    temporary_country: null,
    temporary_division: null,
    temporary_district: null,
    temporary_upazila: null,
    temporary_union_parishad: null,
    job_title: null,
    job_details: null,
    job_location: null,
    monthly_income: null,
    medium_of_study: null,
    general_selected: null,
    general_highest_degree: null,
    is_general_honorable_selected: null,
    aliya_selected: null,
    aliya_highest_degree: null,
    is_aliya_honorable_selected: null,
    kowmi_selected: null,
    kowmi_highest_degree: null,
    is_kowmi_honorable_selected: null,
    study_others_selected: null,
    study_others_highest_degree: null,
    study_in_details: '',
    is_honorable_selected: null,
    honorable_degree_details: null,
    honorable_degree_place: null,
});
const submit = (e) => {
    e.preventDefault();
    form.post(route('backend.biodata.post.update_personal_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {
            if( page.props.flash.success ){
                form.errors = false;
                form.reset();
                emits('onCompleteTab', 1, form.biodata_completion);
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
    props.single_biodata.birth_date = date;
}


const genderUpdate = (e) => {
    e.preventDefault();
    let genderValue = e.target.value;
    let modalDescription = '';
    gender.value = genderValue;
    emits('onUpdateGender', gender.value);
    props.single_biodata.gender = gender.value;
    if( gender.value == 'male' ){
        modalDescription = page.props.translations.modal_messages.gender_update_message_male;
    }else{
        modalDescription = page.props.translations.modal_messages.gender_update_message_female;
    }

    axios.post(route('backend.biodata.post.update_gender', {
        csrf_token,
        user_id: user_id.value,
        gender: gender.value
    } ))
    .then(function (response) {
        if( response.data ){
            form.maritial_status = props.single_biodata.maritial_status = response.data.maritial_status;
            form.job_title = props.single_biodata.job_title = response.data.job_title;
            emits( 'onUpdateDeservedJobTitles', response.data.deserved_job_titles );
            emits( 'onUpdateDeservedMaritialStatuses', response.data.deserved_maritial_statuses );
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
// media agreement ends


const onUpdatePermanentAddress = (address) => {
    props.single_biodata.permanent_country = form.permanent_country = address.selectedCountry;
    props.single_biodata.permanent_division = form.permanent_division = address.selectedDivision;
    props.single_biodata.permanent_district = form.permanent_district = address.selectedDistrict;
    props.single_biodata.permanent_upazila = form.permanent_upazila = address.selectedUpazila;
    props.single_biodata.permanent_union_parishad = form.permanent_union_parishad = address.selectedUnionParishad;
}


const onUpdateTemporaryAddress = (address) => {
    props.single_biodata.temporary_country = form.temporary_country = address.selectedCountry;
    props.single_biodata.temporary_division = form.temporary_division = address.selectedDivision;
    props.single_biodata.temporary_district = form.temporary_district = address.selectedDistrict;
    props.single_biodata.temporary_upazila = form.temporary_upazila = address.selectedUpazila;
    props.single_biodata.temporary_union_parishad = form.temporary_union_parishad = address.selectedUnionParishad;
}


const addressAreSame = (true_or_false) => {
    if( true_or_false ){

        if( !form.permanent_upazila && !form.permanent_union_parishad){
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.translations.modal_messages.permanent_address_error,
            }
            isModalOpen.value = true;
            return;
        }

        form.address_same = true_or_false;

        temporaryAddress.value.selectedCountry = props.single_biodata.temporary_country = form.temporary_country = form.permanent_country;
        temporaryAddress.value.selectedDivision = props.single_biodata.temporary_division = form.temporary_division = form.permanent_division;
        temporaryAddress.value.selectedDistrict = props.single_biodata.temporary_district = form.temporary_district = form.permanent_district;
        temporaryAddress.value.selectedUpazila = props.single_biodata.temporary_upazila = form.temporary_upazila = form.permanent_upazila;
        temporaryAddress.value.selectedUnionParishad = props.single_biodata.temporary_union_parishad = form.temporary_union_parishad = form.permanent_union_parishad;

    }
}


const onSelectJobs = (selectedJobsArray) =>{
    form.job_title = selectedJobsArray.map((job) => job).join(', ');
    props.single_biodata.job_title = form.job_title;
    if( form.job_title.trim() == '' || form.job_title.includes("নাই") || form.job_title.includes("None") ){
        isJobSelected.value = false;
    }else{
        isJobSelected.value = true;
    }
}


const onSelectEducationMedium = (selectedEducationMediumArray) =>{
    form.medium_of_study = selectedEducationMediumArray.map((medium_of_study) => medium_of_study).join(', ');
    props.single_biodata.medium_of_study = form.medium_of_study;

    if( form.medium_of_study.includes("জেনারেল") || form.medium_of_study.includes("General") ){
        form.general_selected = true;
    }else{
        form.general_selected = false;
    }

    if( form.medium_of_study.includes("আলিয়া") || form.medium_of_study.includes("Aliya") ){
        form.aliya_selected = true;
    }else{
        form.aliya_selected = false;
    }

    if( form.medium_of_study.includes("ক্বওমী") || form.medium_of_study.includes("Kowmi") ){
        form.kowmi_selected = true;
    }else{
        form.kowmi_selected = false;
    }

    if( form.medium_of_study.includes("অন্যান্য") || form.medium_of_study.includes("Others") ){
        form.study_others_selected = true;
    }else{
        form.study_others_selected = false;
    }

}


const onChangeGeneralItem = (e) => {
    let item_key = 0;
    let itemValue = e.target.value;
    let selectedIndex = e.target.selectedIndex;
    let allOptions = e.target.options;

    item_key = parseInt(allOptions[selectedIndex].getAttribute('item_key'));
    props.single_biodata.general_highest_degree = itemValue;

    if( item_key > 5 ){
        isGeneralHonorable.value = true;
        form.is_honorable_selected = true;
        form.is_general_honorable_selected = true;
        props.single_biodata.is_honorable_selected = true;
        props.single_biodata.is_general_honorable_selected = true;
    }else{
        isGeneralHonorable.value = false;
        form.is_general_honorable_selected = false;
        props.single_biodata.is_general_honorable_selected = false;
        if( !isAliyaHonorable.value && !isKowmiHonorable.value ){
            form.is_honorable_selected = false;
            props.single_biodata.is_honorable_selected = false;
        }
    }

}


const onChangeAliyaItem = (e) => {
    let item_key = 0;
    let itemValue = e.target.value;
    let selectedIndex = e.target.selectedIndex;
    let allOptions = e.target.options;

    item_key = parseInt(allOptions[selectedIndex].getAttribute('item_key'));
    props.single_biodata.aliya_highest_degree = itemValue;

    if( item_key > 3 ){
        isAliyaHonorable.value = true;
        form.is_honorable_selected = true;
        form.is_aliya_honorable_selected = true;
        props.single_biodata.is_honorable_selected = true;
        props.single_biodata.is_aliya_honorable_selected = true;
    }else{
        isAliyaHonorable.value = false;
        form.is_aliya_honorable_selected = false;
        props.single_biodata.is_aliya_honorable_selected = false;
        if( !isGeneralHonorable.value && !isKowmiHonorable.value ){
            form.is_honorable_selected = false;
            props.single_biodata.is_honorable_selected = false;
        }
    }
}


const onChangeKowmiItem = (e) => {
    let item_key = 0;
    let itemValue = e.target.value;
    let selectedIndex = e.target.selectedIndex;
    let allOptions = e.target.options;

    item_key = parseInt(allOptions[selectedIndex].getAttribute('item_key'));
    props.single_biodata.kowmi_highest_degree = itemValue;

    if( item_key > 12 ){
        isKowmiHonorable.value = true;
        form.is_honorable_selected = true;
        form.is_kowmi_honorable_selected = true;
        props.single_biodata.is_honorable_selected = true;
        props.single_biodata.is_kowmi_honorable_selected = true;
    }else{
        isKowmiHonorable.value = false;
        form.is_kowmi_honorable_selected = false;
        props.single_biodata.is_kowmi_honorable_selected = false;
        if( !isGeneralHonorable.value && !isAliyaHonorable.value ){
            form.is_honorable_selected = false;
            props.single_biodata.is_honorable_selected = false;
        }
    }
}


watch(props, async (newValue, oldValue) => {
    if( newValue.single_biodata.user_id ){
        user_id.value = newValue.single_biodata.user_id;
        form.user_id = newValue.single_biodata.user_id;
    }
});


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'user_id':
                user_id.value = form.user_id = props.single_biodata[item];
                break;
            case 'gender':
                gender.value = props.single_biodata[item];
                break;
            case 'gender':
                gender.value = props.single_biodata[item];
                break;
            case 'birth_date':
                form.birth_date = props.single_biodata[item];
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
            case 'permanent_union_parishad':
                form.permanent_union_parishad = props.single_biodata[item];
                permanentAddress.value.selectedUnionParishad = props.single_biodata[item];
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
            case 'temporary_union_parishad':
                form.temporary_union_parishad = props.single_biodata[item];
                temporaryAddress.value.selectedUnionParishad = props.single_biodata[item];
                break;
            case 'job_title':
                form.job_title = props.single_biodata[item];
                break;
            case 'job_details':
                if( props.single_biodata[item] != null ){
                    form.job_details = props.single_biodata[item];
                }
                break;
            case 'job_location':
                if( props.single_biodata[item] != null ){
                    form.job_location = props.single_biodata[item];
                }
                break;
            case 'monthly_income':
                if( props.single_biodata[item] != null ){
                    form.monthly_income = props.single_biodata[item];
                }
                break;
            case 'medium_of_study':
                form.medium_of_study = props.single_biodata[item];
                break;
            case 'general_selected':
                form.general_selected = props.single_biodata[item];
                break;
            case 'general_highest_degree':
                form.general_highest_degree = props.single_biodata[item];
                break;
            case 'is_general_honorable_selected':
                form.is_general_honorable_selected = props.single_biodata[item];
                isGeneralHonorable.value = props.single_biodata[item];
                break;
            case 'aliya_selected':
                form.aliya_selected = props.single_biodata[item];
                break;
            case 'aliya_highest_degree':
                form.aliya_highest_degree = props.single_biodata[item];
                break;
            case 'is_aliya_honorable_selected':
                form.is_aliya_honorable_selected = props.single_biodata[item];
                isAliyaHonorable.value = props.single_biodata[item];
                break;
            case 'kowmi_selected':
                form.kowmi_selected = props.single_biodata[item];
                break;
            case 'kowmi_highest_degree':
                form.kowmi_highest_degree = props.single_biodata[item];
                break;
            case 'is_kowmi_honorable_selected':
                form.is_kowmi_honorable_selected = props.single_biodata[item];
                isKowmiHonorable.value = props.single_biodata[item];
                break;
            case 'study_others_selected':
                form.study_others_selected = props.single_biodata[item];
                break;
            case 'study_others_highest_degree':
                form.study_others_highest_degree = props.single_biodata[item];
                break;
            case 'study_in_details':
                form.study_in_details = props.single_biodata[item];
                break;
            case 'is_honorable_selected':
                form.is_honorable_selected = props.single_biodata[item];
                break;
            case 'honorable_degree_details':
                form.honorable_degree_details = props.single_biodata[item];
                break;
            case 'honorable_degree_place':
                form.honorable_degree_place = props.single_biodata[item];
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
                <label for="gender" class="text-base">{{ translations.biodata_form.personal_biodata.gender_title }}</label>
                <select @change="genderUpdate" id="gender" name="gender"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option  value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                    <option v-for="(single_gender, gender_key) in translations.biodata_form.personal_biodata.gender_options" :key="single_gender.id" :value="gender_key" :selected="gender_key == gender">{{ single_gender }}</option>
                </select>
            </div>
        </div>


        <form v-if="gender != null" @submit.prevent="submit" class="grid grid-cols-12 gap-0">
            <input v-model="form.csrf_token" type="hidden" name="csrf_token" >
            <input v-model="form.running_tab" type="hidden" name="running_tab" >

            <div class="form_item col-span-6 p-2">
                <DatePicker :translations :birth_date="form.birth_date" @onUpdateDate="onUpdateDate" />
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
                    <option v-for="weight in translations.biodata_form.personal_biodata.weight_options" :key="weight.id" :value="weight">{{ weight }}</option>
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
                    class="maritial_status block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
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
                <InputError v-if="form.errors.permanent_country || form.errors.permanent_division || form.errors.permanent_district || form.errors.permanent_upazila" class="mt-2" :message="translations.biodata_form.personal_biodata.permanent_address_error" />
            </div>
            <div class="form_item col-span-12 md:col-span-6 p-2">
                <TemporaryDynamicAddress :translations :locale :temporaryAddress @addressAreSame="addressAreSame" @onUpdateTemporaryAddress="onUpdateTemporaryAddress" />
                <InputError v-if="form.errors.temporary_country || form.errors.temporary_division || form.errors.temporary_district || form.errors.temporary_upazila " class="mt-2" :message="translations.biodata_form.personal_biodata.temporary_address_error" />
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <MultipleJobSelection :translations :jobTitles="single_biodata.job_title" :gender="single_biodata.gender" @onSelectJobs="onSelectJobs"/>
                <InputError class="mt-2" :message="form.errors.job_title" />
            </div>

            <div v-if="isJobSelected" class="form_item col-span-12 md:col-span-6 p-2">
                <textarea v-model="form.job_details" @input="(e) => { single_biodata.job_details = e.target.value }" name="job_details" rows="1" :placeholder="translations.biodata_form.personal_biodata.job_details_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <InputError class="mt-2" :message="form.errors.job_details" />
            </div>

            <div v-if="isJobSelected" class="form_item col-span-12 md:col-span-6 p-2">
                <input type="text" v-model="form.job_location" @input="(e) => { single_biodata.job_location = e.target.value }" name="job_location" maxlength="100" list="job_location_lists" :placeholder="translations.biodata_form.personal_biodata.job_location_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
                <datalist id="job_location_lists">
                    <option v-for="single_district in districts" :key="single_district.id">{{ locale == 'en' ? single_district.district_name : single_district.district_bn_name }}</option>
                </datalist>
                <InputError class="mt-2" :message="form.errors.job_location" />
            </div>

            <div v-if="isJobSelected" class="form_item col-span-12 md:col-span-6 p-2">
                <select v-model="form.monthly_income" @change="(e) => { single_biodata.monthly_income = e.target.value }" id="monthly_income" name="monthly_income"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.monthly_income_title }}</option>
                    <option v-for="monthly_income in translations.biodata_form.personal_biodata.monthly_income_options" :key="monthly_income.id" :value="monthly_income">{{ monthly_income }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.monthly_income" />
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <MultipleEducationMediumSelection :translations :educationMediums="single_biodata.medium_of_study" @onSelectEducationMedium="onSelectEducationMedium"/>
                <InputError class="mt-2" :message="form.errors.medium_of_study" />
            </div>

            <div v-if="form.general_selected" class="form_item col-span-12 md:col-span-6 p-2">
                <select v-model="form.general_highest_degree" @change="onChangeGeneralItem" id="general_highest_degree" name="general_highest_degree"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option item_key="0" value="null" disabled selected >{{ translations.biodata_form.personal_biodata.general_highest_degree_title }}</option>
                    <option v-for="(general_highest_degree, general_highest_degree_key) in translations.biodata_form.personal_biodata.general_highest_degree_options" :key="general_highest_degree_key" :item_key="general_highest_degree_key" :value="general_highest_degree">{{ general_highest_degree }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.general_highest_degree" />
            </div>

            <div v-if="form.aliya_selected" class="form_item col-span-12 md:col-span-6 p-2">
                <select v-model="form.aliya_highest_degree" @change="onChangeAliyaItem" id="aliya_highest_degree" name="aliya_highest_degree"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.aliya_highest_degree_title }}</option>
                    <option v-for="(aliya_highest_degree, aliya_highest_degree_key) in translations.biodata_form.personal_biodata.aliya_highest_degree_options" :key="aliya_highest_degree_key" :item_key="aliya_highest_degree_key" :value="aliya_highest_degree">{{ aliya_highest_degree }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.aliya_highest_degree" />
            </div>

            <div v-if="form.kowmi_selected" class="form_item col-span-12 md:col-span-6 p-2">
                <select v-model="form.kowmi_highest_degree" @change="onChangeKowmiItem" id="kowmi_highest_degree" name="kowmi_highest_degree"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.kowmi_highest_degree_title }}</option>
                    <option v-for="(kowmi_highest_degree, kowmi_highest_degree_key) in translations.biodata_form.personal_biodata.kowmi_highest_degree_options" :key="kowmi_highest_degree_key" :item_key="kowmi_highest_degree_key" :value="kowmi_highest_degree">{{ kowmi_highest_degree }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.kowmi_highest_degree" />
            </div>

            <div v-if="form.study_others_selected" class="form_item col-span-12 md:col-span-6 p-2">
                <select v-model="form.study_others_highest_degree" @change="(e) => { single_biodata.study_others_highest_degree = e.target.value }" id="study_others_highest_degree" name="study_others_highest_degree"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.study_others_highest_degree_title }}</option>
                    <option v-for="(study_others_highest_degree, study_others_highest_degree_key) in translations.biodata_form.personal_biodata.study_others_highest_degree_options" :key="study_others_highest_degree_key" :item_key="study_others_highest_degree_key" :value="study_others_highest_degree">{{ study_others_highest_degree }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.study_others_highest_degree" />
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <textarea v-model="form.study_in_details" @input="(e) => { single_biodata.study_in_details = e.target.value }" name="study_in_details" rows="3" maxlength="500" :placeholder="translations.biodata_form.personal_biodata.study_in_details_watermark" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <InputError class="mt-2" :message="form.errors.study_in_details" />
            </div>

            <div v-if="form.is_honorable_selected" class="form_item col-span-12 md:col-span-6 p-2">
                <textarea v-model="form.honorable_degree_details" @input="(e) => { single_biodata.honorable_degree_details = e.target.value }" name="honorable_degree_details" rows="2" maxlength="500" :placeholder="translations.biodata_form.personal_biodata.honorable_degree_details_placeholder" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <InputError class="mt-2" :message="form.errors.honorable_degree_details" />
            </div>

            <div v-if="form.is_honorable_selected" class="form_item col-span-12 md:col-span-6 p-2">
                <select v-model="form.honorable_degree_place" @change="(e) => { single_biodata.honorable_degree_place = e.target.value }" id="honorable_degree_place" name="honorable_degree_place"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.honorable_degree_place_title }}</option>
                    <option v-for="(honorable_degree_place, honorable_degree_place_key) in translations.biodata_form.personal_biodata.honorable_degree_place_options" :key="honorable_degree_place_key" :value="honorable_degree_place">{{ honorable_degree_place }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.honorable_degree_place" />
            </div>

            <div class="form_item col-span-12 p-2">
                <button class="biodata_submit_button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ translations.biodata_form.submit_button_text }}
                </button>
            </div>

        </form>

    </div>


</template>


<style>
.biodata_submit_button{
    color: #fff !important;
}
@media(max-width: 768px) {
    .maritial_status{
        padding-left: 5px !important;
    }
}
</style>
