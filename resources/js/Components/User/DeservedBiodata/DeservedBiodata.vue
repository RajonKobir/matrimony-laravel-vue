<script setup>
import { ref, onMounted } from 'vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';
import AgeSlider from './AgeSlider.vue';
import HeightSlider from './HeightSlider.vue';
import MultipleSkinColorsSelection from './MultipleSkinColorsSelection.vue';
import MultipleMaritialStatusSelection from './MultipleMaritialStatusSelection.vue';
import MultipleAkidaMajhabSelection from './MultipleAkidaMajhabSelection.vue';
import MultipleFamilyConditionsSelection from './MultipleFamilyConditionsSelection.vue';
import MultipleJobTitlesSelection from './MultipleJobTitlesSelection.vue';
import MultipleConditionsSelection from './MultipleConditionsSelection.vue';
import MultipleEducationMediumSelection from './MultipleEducationMediumSelection.vue';
import MultipleGeneralItemsSelection from './MultipleGeneralItemsSelection.vue';
import MultipleAliyaItemsSelection from './MultipleAliyaItemsSelection.vue';
import MultipleKowmiItemsSelection from './MultipleKowmiItemsSelection.vue';
import MultipleStudyOthersItemsSelection from './MultipleStudyOthersItemsSelection.vue';
import MultipleDistrictsSelection from './MultipleDistrictsSelection.vue';


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
    districts: {
        type: Object,
    },
});


const emits = defineEmits([
    'onCompleteTab',
]);


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user["id"];
const modalMessage = ref({});
const isModalOpen = ref(false);
const deservedLowerAge = ref(16);
const deservedHigherAge = ref(65);
const deservedLowerHeight = ref(16);
const deservedHigherHeight = ref(65);


const form = useForm({
    csrf_token: csrf_token,
    biodata_completion: 80,
    running_tab: 4,
    user_id: user_id,
    deserved_districts: null,
    deserved_age_range: null,
    deserved_skin_colors: null,
    deserved_height_range: null,
    deserved_akida_majhhabs: null,
    deserved_family_conditions: null,
    deserved_job_titles: null,
    deserved_education_mediums: null,
    deserved_general_selected: null,
    deserved_general_degrees: null,
    deserved_aliya_selected: null,
    deserved_aliya_degrees: null,
    deserved_kowmi_selected: null,
    deserved_kowmi_degrees: null,
    deserved_study_others_selected: null,
    deserved_study_others_degrees: null,
    deserved_maritial_statuses: null,
    deserved_conditions: null,
    deserved_others_desc: null,
});
const submit = (e) => {
    e.preventDefault();
    form.post(route('user.biodata.post.update_deserved_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {

            if( page.props.flash.success ){
                form.reset();
                emits('onCompleteTab', 4, form.biodata_completion);
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


const onSelectDistricts = (selectedDistricts) => {
    props.single_biodata.deserved_districts = form.deserved_districts = selectedDistricts.map((district) => district).join(', ');
}


const onUpdateAgeSlider = (slider_state) => {
    deservedLowerAge.value = slider_state[0];
    deservedHigherAge.value = slider_state[1];
    props.single_biodata.deserved_age_range = form.deserved_age_range = deservedLowerAge.value + ' - ' + deservedHigherAge.value;
}


const onUpdateHeightSlider = (slider_state) => {
    deservedLowerHeight.value = props.translations.biodata_form.personal_biodata.height_options[slider_state[0]];
    deservedHigherHeight.value = props.translations.biodata_form.personal_biodata.height_options[slider_state[1]];
    props.single_biodata.deserved_height_range = form.deserved_height_range = deservedLowerHeight.value + ' - ' + deservedHigherHeight.value;
}


const onSelectSkinColors = (selectedSkinColorsArray) =>{
    props.single_biodata.deserved_skin_colors = form.deserved_skin_colors = selectedSkinColorsArray.map((skin_color) => skin_color).join(', ');
}

const onSelectMaritialStatuses = (selectedMaritialStatusesArray) =>{
    props.single_biodata.deserved_maritial_statuses = form.deserved_maritial_statuses = selectedMaritialStatusesArray.map((maritial_status) => maritial_status).join(', ');
}

const onSelectAkidaMajhabs = (selectedAkidaMajhabsArray) =>{
    props.single_biodata.deserved_akida_majhhabs = form.deserved_akida_majhhabs = selectedAkidaMajhabsArray.map((akida_majhab) => akida_majhab).join(', ');
}

const onSelectFamilyConditions = (selectedFamilyConditionsArray) =>{
    props.single_biodata.deserved_family_conditions = form.deserved_family_conditions = selectedFamilyConditionsArray.map((family_condition) => family_condition).join(', ');
}

const onSelectJobTitles = (selectedJobTitlesArray) =>{
    props.single_biodata.deserved_job_titles = form.deserved_job_titles = selectedJobTitlesArray.map((job_title) => job_title).join(', ');
}

const onSelectConditions = (selectedConditionsArray) =>{
    props.single_biodata.deserved_conditions = form.deserved_conditions = selectedConditionsArray.map((condition) => condition).join(', ');
}

const onSelectEducationMedium = (selectedEducationMediumArray) =>{
    form.deserved_education_mediums = selectedEducationMediumArray.map((medium_of_study) => medium_of_study).join(', ');
    props.single_biodata.deserved_education_mediums = form.deserved_education_mediums;

    if( form.deserved_education_mediums.includes("যেকোনো") || form.deserved_education_mediums.includes("Any") ){
        form.deserved_general_selected = form.deserved_aliya_selected = form.deserved_kowmi_selected = form.deserved_study_others_selected = true;
        return;
    }

    if( form.deserved_education_mediums.includes("জেনারেল") || form.deserved_education_mediums.includes("General") ){
        form.deserved_general_selected = true;
    }else{
        form.deserved_general_selected = false;
    }

    if( form.deserved_education_mediums.includes("আলিয়া") || form.deserved_education_mediums.includes("Aliya") ){
        form.deserved_aliya_selected = true;
    }else{
        form.deserved_aliya_selected = false;
    }

    if( form.deserved_education_mediums.includes("ক্বওমী") || form.deserved_education_mediums.includes("Kowmi") ){
        form.deserved_kowmi_selected = true;
    }else{
        form.deserved_kowmi_selected = false;
    }

    if( form.deserved_education_mediums.includes("অন্যান্য") || form.deserved_education_mediums.includes("Others") ){
        form.deserved_study_others_selected = true;
    }else{
        form.deserved_study_others_selected = false;
    }
}

const onSelectGeneralItems = (selectedGeneralItemsArray) =>{
    props.single_biodata.deserved_general_degrees = form.deserved_general_degrees = selectedGeneralItemsArray.map((general_degree) => general_degree).join(', ');
}

const onSelectAliyaItems = (selectedAliyaItemsArray) =>{
    props.single_biodata.deserved_aliya_degrees = form.deserved_aliya_degrees = selectedAliyaItemsArray.map((aliya_degree) => aliya_degree).join(', ');
}

const onSelectKowmiItems = (selectedKowmiItemsArray) =>{
    props.single_biodata.deserved_kowmi_degrees = form.deserved_kowmi_degrees = selectedKowmiItemsArray.map((kowmi_degree) => kowmi_degree).join(', ');
}

const onSelectStudyOthersItems = (selectedStudyOthersItemsArray) =>{
    props.single_biodata.deserved_study_others_degrees = form.deserved_study_others_degrees = selectedStudyOthersItemsArray.map((study_others_degree) => study_others_degree).join(', ');
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'deserved_districts':
                form.deserved_districts = props.single_biodata[item];
                break;
            case 'deserved_age_range':
                form.deserved_age_range = props.single_biodata[item];
                break;
            case 'deserved_skin_colors':
                form.deserved_skin_colors = props.single_biodata[item];
                break;
            case 'deserved_height_range':
                form.deserved_height_range = props.single_biodata[item];
                break;
            case 'deserved_akida_majhhabs':
                form.deserved_akida_majhhabs = props.single_biodata[item];
                break;
            case 'deserved_family_conditions':
                form.deserved_family_conditions = props.single_biodata[item];
                break;
            case 'deserved_job_titles':
                form.deserved_job_titles = props.single_biodata[item];
                break;
            case 'deserved_education_mediums':
                form.deserved_education_mediums = props.single_biodata[item];
                break;
            case 'deserved_general_selected':
                form.deserved_general_selected = props.single_biodata[item];
                break;
            case 'deserved_general_degrees':
                form.deserved_general_degrees = props.single_biodata[item];
                break;
            case 'deserved_aliya_selected':
                form.deserved_aliya_selected = props.single_biodata[item];
                break;
            case 'deserved_aliya_degrees':
                form.deserved_aliya_degrees = props.single_biodata[item];
                break;
            case 'deserved_kowmi_selected':
                form.deserved_kowmi_selected = props.single_biodata[item];
                break;
            case 'deserved_kowmi_degrees':
                form.deserved_kowmi_degrees = props.single_biodata[item];
                break;
            case 'deserved_study_others_selected':
                form.deserved_study_others_selected = props.single_biodata[item];
                break;
            case 'deserved_study_others_degrees':
                form.deserved_study_others_degrees = props.single_biodata[item];
                break;
            case 'deserved_maritial_statuses':
                form.deserved_maritial_statuses = props.single_biodata[item];
                break;
            case 'deserved_conditions':
                form.deserved_conditions = props.single_biodata[item];
                break;
            case 'deserved_others_desc':
                form.deserved_others_desc = props.single_biodata[item];
                break;
            }
        });

    }, 500);


});


</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />


    <form @submit.prevent="submit" class="grid grid-cols-12 gap-0">

        <input v-model="form.csrf_token" type="hidden" name="csrf_token" >
        <input v-model="form.running_tab" type="hidden" name="running_tab" >

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleDistrictsSelection :translations :locale :Districts="single_biodata.deserved_districts" :districts="districts" @onSelectDistricts="onSelectDistricts" />
            <InputError class="mt-2" :message="form.errors.deserved_districts" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <AgeSlider :translations :deserved_age_range="single_biodata.deserved_age_range" @onUpdateAgeSlider="onUpdateAgeSlider"/>
            <InputError class="mt-2" :message="form.errors.deserved_age_range" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <HeightSlider :translations :deserved_height_range="single_biodata.deserved_height_range" @onUpdateHeightSlider="onUpdateHeightSlider"/>
            <InputError class="mt-2" :message="form.errors.deserved_height_range" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleSkinColorsSelection :translations :skinColors="single_biodata.deserved_skin_colors" @onSelectSkinColors="onSelectSkinColors" />
            <InputError class="mt-2" :message="form.errors.deserved_skin_colors" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleMaritialStatusSelection :translations :maritialStatuses="single_biodata.deserved_maritial_statuses" :gender="single_biodata.gender" @onSelectMaritialStatuses="onSelectMaritialStatuses" />
            <InputError class="mt-2" :message="form.errors.deserved_maritial_statuses" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleAkidaMajhabSelection :translations :akidaMajhabs="single_biodata.deserved_akida_majhhabs" @onSelectAkidaMajhabs="onSelectAkidaMajhabs" />
            <InputError class="mt-2" :message="form.errors.deserved_akida_majhhabs" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleFamilyConditionsSelection :translations :familyConditions="single_biodata.deserved_family_conditions" @onSelectFamilyConditions="onSelectFamilyConditions" />
            <InputError class="mt-2" :message="form.errors.deserved_family_conditions" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleJobTitlesSelection :translations :JobTitles="single_biodata.deserved_job_titles" :gender="single_biodata.gender" @onSelectJobTitles="onSelectJobTitles" />
            <InputError class="mt-2" :message="form.errors.deserved_job_titles" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleEducationMediumSelection :translations :educationMediums="single_biodata.deserved_education_mediums" @onSelectEducationMedium="onSelectEducationMedium"/>
            <InputError class="mt-2" :message="form.errors.deserved_education_mediums" />
        </div>

        <div v-if="form.deserved_general_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleGeneralItemsSelection :translations :GeneralItems="single_biodata.deserved_general_degrees" @onSelectGeneralItems="onSelectGeneralItems" />
            <InputError class="mt-2" :message="form.errors.deserved_general_degrees" />
        </div>

        <div v-if="form.deserved_aliya_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleAliyaItemsSelection :translations :AliyaItems="single_biodata.deserved_aliya_degrees" @onSelectAliyaItems="onSelectAliyaItems" />
            <InputError class="mt-2" :message="form.errors.deserved_aliya_degrees" />
        </div>

        <div v-if="form.deserved_kowmi_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleKowmiItemsSelection :translations :KowmiItems="single_biodata.deserved_kowmi_degrees" @onSelectKowmiItems="onSelectKowmiItems" />
            <InputError class="mt-2" :message="form.errors.deserved_kowmi_degrees" />
        </div>

        <div v-if="form.deserved_study_others_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleStudyOthersItemsSelection :translations :StudyOthersItems="single_biodata.deserved_study_others_degrees" @onSelectStudyOthersItems="onSelectStudyOthersItems" />
            <InputError class="mt-2" :message="form.errors.deserved_study_others_degrees" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleConditionsSelection :translations :gender="single_biodata.gender" :conditions="single_biodata.deserved_conditions" @onSelectConditions="onSelectConditions" />
            <InputError class="mt-2" :message="form.errors.deserved_conditions" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.deserved_others_desc" @input="(e) => { single_biodata.deserved_others_desc = e.target.value }" name="deserved_others_desc" rows="2" maxlength="255" :placeholder="translations.biodata_form.deserved_biodata.deserved_others_desc_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.deserved_others_desc" />
        </div>


        <div class="form_item col-span-12 p-2">
            <button class="biodata_submit_button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                {{ translations.biodata_form.submit_button_text }}
            </button>
        </div>

    </form>


</template>


<style>
.biodata_submit_button{
    color: #fff !important;
}
@media(max-width: 768px) {
    .deserved_maritial_statuses{
        padding-left: 5px !important;
    }
}
</style>
