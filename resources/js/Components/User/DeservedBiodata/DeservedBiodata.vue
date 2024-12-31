<script setup>
import { ref, onMounted } from 'vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';
import DynamicAddress from './DynamicAddress.vue';
import AgeSlider from './AgeSlider.vue';
import HeightSlider from './HeightSlider.vue';


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
    running_tab: 4,
    user_id: user_id,
    deserved_division: null,
    deserved_district: null,
    deserved_age: null,
    deserved_skin_color: null,
    deserved_height: null,
    deserved_akida_majhhab: null,
    deserved_family_condition: null,
    deserved_job_title: null,
    deserved_education: null,
    deserved_maritial_status: null,
    deserved_condition: null,
    deserved_others_desc: null,
});
const submit = (e) => {
    e.preventDefault();
    form.post(route('user.biodata.post.update_deserved_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {

            if( page.props.flash.success ){
                form.reset();
                emits('onCompleteTab', 4);
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


const onUpdateDynamicAddress = (address) => {
    props.single_biodata.deserved_division = form.deserved_division = address.selectedDivision;
    props.single_biodata.deserved_district =  form.deserved_district = address.selectedDistrict;
}


const onUpdateAgeSlider = (slider_state) => {
    deservedLowerAge.value = slider_state[0];
    deservedHigherAge.value = slider_state[1];
    props.single_biodata.deserved_age = form.deserved_age = deservedLowerAge.value + ' - ' + deservedHigherAge.value;
}


const onUpdateHeightSlider = (slider_state) => {
    deservedLowerHeight.value = props.translations.biodata_form.personal_biodata.height_options[slider_state[0]];
    deservedHigherHeight.value = props.translations.biodata_form.personal_biodata.height_options[slider_state[1]];
    props.single_biodata.deserved_height = form.deserved_height = deservedLowerHeight.value + ' - ' + deservedHigherHeight.value;
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'deserved_division':
                form.deserved_division = props.single_biodata[item];
                break;
            case 'deserved_district':
                form.deserved_district = props.single_biodata[item];
                break;
            case 'deserved_age':
                form.deserved_age = props.single_biodata[item];
                break;
            case 'deserved_skin_color':
                form.deserved_skin_color = props.single_biodata[item];
                break;
            case 'deserved_height':
                form.deserved_height = props.single_biodata[item];
                break;
            case 'deserved_akida_majhhab':
                form.deserved_akida_majhhab = props.single_biodata[item];
                break;
            case 'deserved_family_condition':
                form.deserved_family_condition = props.single_biodata[item];
                break;
            case 'deserved_job_title':
                form.deserved_job_title = props.single_biodata[item];
                break;
            case 'deserved_education':
                form.deserved_education = props.single_biodata[item];
                break;
            case 'deserved_maritial_status':
                form.deserved_maritial_status = props.single_biodata[item];
                break;
            case 'deserved_condition':
                form.deserved_condition = props.single_biodata[item];
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
            <DynamicAddress :translations :locale :deserved_division="single_biodata.deserved_division" :deserved_district="single_biodata.deserved_district" @onUpdateDynamicAddress="onUpdateDynamicAddress" />
            <InputError v-if="form.errors.deserved_division || form.errors.deserved_district" class="mt-2" :message="translations.biodata_form.deserved_biodata.dynamic_address_error" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <AgeSlider :translations :deserved_age="single_biodata.deserved_age" @onUpdateAgeSlider="onUpdateAgeSlider"/>
            <InputError class="mt-2" :message="form.errors.deserved_age" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_skin_color" @change="(e) => { single_biodata.deserved_skin_color = e.target.value }" id="deserved_skin_color" name="deserved_skin_color"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_skin_color_title }}</option>
                <option v-for="deserved_skin_color in translations.biodata_form.personal_biodata.skin_color_options" :key="deserved_skin_color.id" :value="deserved_skin_color">{{ deserved_skin_color }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_skin_color" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_maritial_status" @change="(e) => { single_biodata.deserved_maritial_status = e.target.value }" id="deserved_maritial_status" name="deserved_maritial_status"
                class="deserved_maritial_status block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_maritial_status_title }}</option>
                <template v-for="(deserved_maritial_status, deserved_maritial_status_key) in translations.biodata_form.personal_biodata.maritial_status_options" :key="deserved_maritial_status.id">
                        <option :value="deserved_maritial_status_key" v-if="(single_biodata.gender == 'male' && deserved_maritial_status_key != 'widow_no_child' && deserved_maritial_status_key != 'widow_with_child' ) || (single_biodata.gender == 'female' && deserved_maritial_status_key != 'widower_no_child' && deserved_maritial_status_key != 'widower_with_child' )" >
                            {{ deserved_maritial_status }}
                        </option>
                </template>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_maritial_status" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <HeightSlider :translations :deserved_height="single_biodata.deserved_height" @onUpdateHeightSlider="onUpdateHeightSlider"/>
            <InputError class="mt-2" :message="form.errors.deserved_height" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_akida_majhhab" @change="(e) => { single_biodata.deserved_akida_majhhab = e.target.value }" id="deserved_akida_majhhab" name="deserved_akida_majhhab"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_akida_majhhab_title }}</option>
                <option v-for="deserved_akida_majhhab in translations.biodata_form.religious_biodata.akida_majhhab_options" :key="deserved_akida_majhhab.id" :value="deserved_akida_majhhab">{{ deserved_akida_majhhab }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_akida_majhhab" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_family_condition" @change="(e) => { single_biodata.deserved_family_condition = e.target.value }" id="deserved_family_condition" name="deserved_family_condition"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_family_condition_title }}</option>
                <option v-for="deserved_family_condition in translations.biodata_form.family_biodata.family_condition_options" :key="deserved_family_condition.id" :value="deserved_family_condition">{{ deserved_family_condition }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_family_condition" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_job_title" @change="(e) => { single_biodata.deserved_job_title = e.target.value }" id="deserved_job_title" name="deserved_job_title"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_job_title_title }}</option>
                <option v-for="deserved_job_title in translations.biodata_form.personal_biodata.job_title_options" :key="deserved_job_title.id" :value="deserved_job_title">{{ deserved_job_title }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_job_title" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_education" @change="(e) => { single_biodata.deserved_education = e.target.value }" id="deserved_education" name="deserved_education"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_education_title }}</option>
                <option v-for="deserved_education in translations.biodata_form.personal_biodata.education_medium_options" :key="deserved_education.id" :value="deserved_education">{{ deserved_education }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_education" />
        </div>

        <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_condition" @change="(e) => { single_biodata.deserved_condition = e.target.value }" id="deserved_condition" name="deserved_condition"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_condition_title_male }}</option>
                <option v-for="deserved_condition in translations.biodata_form.deserved_biodata.deserved_condition_options_male" :key="deserved_condition.id" :value="deserved_condition">{{ deserved_condition }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_condition" />
        </div>

        <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.deserved_condition" @change="(e) => { single_biodata.deserved_condition = e.target.value }" id="deserved_condition" name="deserved_condition"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.deserved_biodata.deserved_condition_title_female }}</option>
                <option v-for="deserved_condition in translations.biodata_form.deserved_biodata.deserved_condition_options_female" :key="deserved_condition.id" :value="deserved_condition">{{ deserved_condition }}</option>
                <option :value="translations.biodata_form.deserved_biodata.deserved_special_selection" >{{ translations.biodata_form.deserved_biodata.deserved_special_selection }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_condition" />
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
    .deserved_maritial_status{
        padding-left: 5px !important;
    }
}
</style>
