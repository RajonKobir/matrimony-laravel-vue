<script setup>
import { ref, onMounted } from 'vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';
import DynamicAddress from './DynamicAddress.vue';
import RangeSlider from './RangeSlider.vue';


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
const dynamicAddress = ref({});


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
    deserved_maritial_status_desc: null,
    deserved_others_desc: null,
});
const submit = (e) => {
    e.preventDefault();
    form.post(route('user.biodata.post.update_family_biodata'), {
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
    props.single_biodata.deserved_division = form.deserved_division = address.deserved_division;
    props.single_biodata.deserved_district = form.deserved_district = address.deserved_district;
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'deserved_division':
                form.deserved_division = props.single_biodata[item];
                dynamicAddress.value.deserved_division = props.single_biodata[item];
                break;
            case 'deserved_district':
                form.deserved_district = props.single_biodata[item];
                dynamicAddress.value.deserved_district = props.single_biodata[item];
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
            case 'deserved_maritial_status_desc':
                form.deserved_maritial_status_desc = props.single_biodata[item];
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
            <DynamicAddress :translations :locale :dynamicAddress @onUpdateDynamicAddress="onUpdateDynamicAddress" />
            <InputError v-if="form.errors.deserved_division || form.errors.deserved_district" class="mt-2" :message="translations.biodata_form.personal_biodata.dynamic_address_error" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <RangeSlider/>
        </div>

        <!-- <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.father_desc" @input="(e) => { single_biodata.father_desc = e.target.value }" name="father_desc" rows="2" maxlength="255" :placeholder="translations.biodata_form.family_biodata.father_desc_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.father_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <input type="text" v-model="form.mother_name" @input="(e) => { single_biodata.mother_name = e.target.value }" name="mother_name" :placeholder="translations.biodata_form.family_biodata.mother_name_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
            <InputError class="mt-2" :message="form.errors.mother_name" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.mother_desc" @input="(e) => { single_biodata.mother_desc = e.target.value }" name="mother_desc" rows="2" maxlength="255" :placeholder="translations.biodata_form.family_biodata.mother_desc_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.mother_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.brother_sister_desc" @input="(e) => { single_biodata.brother_sister_desc = e.target.value }" name="brother_sister_desc" rows="2" maxlength="255" :placeholder="translations.biodata_form.family_biodata.brother_sister_desc_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.brother_sister_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.relative_desc" @input="(e) => { single_biodata.relative_desc = e.target.value }" name="relative_desc" rows="2" maxlength="255" :placeholder="translations.biodata_form.family_biodata.relative_desc_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.relative_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.family_condition" @change="(e) => { single_biodata.family_condition = e.target.value }" id="family_condition" name="family_condition"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.family_biodata.family_condition_title }}</option>
                <option v-for="family_condition in translations.biodata_form.family_biodata.family_condition_options" :key="family_condition.id" :value="family_condition">{{ family_condition }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.family_condition" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.property_and_income" @input="(e) => { single_biodata.property_and_income = e.target.value }" name="property_and_income" rows="4" maxlength="255" :placeholder="translations.biodata_form.family_biodata.property_and_income_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.property_and_income" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.personal_maritial_agreement" @change="(e) => { single_biodata.personal_maritial_agreement = JSON.parse(e.target.value) }" id="personal_maritial_agreement" name="personal_maritial_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.family_biodata.personal_maritial_agreement_title }}</option>
                <option v-for="(personal_maritial_agreement, personal_maritial_agreement_key) in translations.biodata_form.family_biodata.personal_maritial_agreement_options" :key="personal_maritial_agreement.id" :value="JSON.parse(personal_maritial_agreement_key)">{{ personal_maritial_agreement }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.personal_maritial_agreement" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.family_maritial_agreement" @change="(e) => { single_biodata.family_maritial_agreement = JSON.parse(e.target.value) }" id="family_maritial_agreement" name="family_maritial_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.family_biodata.family_maritial_agreement_title }}</option>
                <option v-for="(family_maritial_agreement, family_maritial_agreement_key) in translations.biodata_form.family_biodata.family_maritial_agreement_options" :key="family_maritial_agreement.id" :value="JSON.parse(family_maritial_agreement_key)">{{ family_maritial_agreement }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.family_maritial_agreement" />
        </div> -->


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
</style>
