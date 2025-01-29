<script setup>

import { ref } from 'vue';
import DynamicAddress from './DynamicAddress.vue';
import AgeSlider from './AgeSlider.vue';


const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
});


// initializing
const isDisabled = ref(true);
const searchNumber = ref(1);
const innerHTML = ref('');
const selectedGender = ref(null);
const maritialStatus = ref(null);
const dynamicAddress = ref({});
const ageRange = ref(null);
const deservedLowerAge = ref(16);
const deservedHigherAge = ref(65);
const selectedCategory = ref(null);


const onUpdateAgeSlider = (slider_state) => {
    deservedLowerAge.value = slider_state[0];
    deservedHigherAge.value = slider_state[1];
    ageRange.value = deservedLowerAge.value + ' - ' + deservedHigherAge.value;
}


const onUpdateDynamicAddress = (address) => {
    dynamicAddress.value = address;
}


const searchButtonClick = (e) => {
    e.preventDefault();
    alert("Search button is clicked!");
}


</script>

<template>


    <div class="main-search-option">

        <div class="grid grid-cols-12 gap-0 text-gray-950 text-base">

            <div class="form_item col-span-12 md:col-start-4 md:col-span-6 pb-8">
                <label for="main_search_choice" class="text-base">
                    {{ props.translations.searchForm.search_initiate_title }}
                </label>
                <select id="main_search_choice" @change="(e) => { searchNumber = e.target.value }" name="main_search_choice"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option v-for="(search_initiate, search_initiate_key) in props.translations.searchForm.search_initiate_options" :key="search_initiate.id" :value="search_initiate_key" >{{ search_initiate }}</option>
                </select>
            </div>

            <div class="form_item col-span-12 md:col-span-6 lg:col-span-4 p-2">
                <label for="search_gender" class="text-base">
                    {{ props.translations.searchForm.dropdown_1_heading }}
                </label>
                <select id="search_gender" @change="(e) => { selectedGender = e.target.value }" name="search_gender" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected>{{ translations.form_basics.select_text }}</option>
                    <option value="male">{{ props.translations.searchForm.dropdown_1_option_2 }}</option>
                    <option value="female">{{ props.translations.searchForm.dropdown_1_option_3 }}</option>
                </select>
            </div>

            <div class="form_item col-span-12 md:col-span-6 lg:col-span-4 p-2">
                <label for="maritial_status" class="text-base">
                    {{ props.translations.biodata_form.personal_biodata.maritial_status_title }}
                </label>
                <select id="maritial_status" @change="(e) => { maritialStatus = e.target.value }" name="maritial_status"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected>{{ translations.form_basics.select_text }}</option>
                    <option v-for="(maritial_status, maritial_status_key) in translations.biodata_form.personal_biodata.maritial_status_options" :key="maritial_status.id" :value="maritial_status_key" >{{ maritial_status }}</option>
                </select>
            </div>

            <div class="form_item col-span-12 md:col-span-6 lg:col-span-4 p-2">
                <DynamicAddress :translations :locale :isDisabled=isDisabled  @onUpdateDynamicAddress="onUpdateDynamicAddress" />
            </div>

            <div class="form_item col-span-12 md:col-span-6 lg:col-span-4 py-2 px-4">
                <AgeSlider :translations @onUpdateAgeSlider="onUpdateAgeSlider"/>
            </div>

            <div class="form_item col-span-12 md:col-span-6 lg:col-span-4 p-2">
                <label for="search_category" class="text-base">
                    {{ props.translations.searchForm.category_title }}
                </label>
                <select id="search_category" @change="(e) => { selectedCategory = e.target.value }" name="search_category"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected>{{ translations.form_basics.select_text }}</option>
                    <option v-for="(single_category, category_key) in props.translations.searchForm.category_options" :key="single_category.id" :value="category_key" >{{ single_category }}</option>
                </select>
            </div>


            <div class="form_item col-span-12 md:col-start-4 md:col-span-6 p-2">
                <div class="od-search-fields odsf-submit">
                    <div class="od-submit-btn !text-center ">
                        <button @click="searchButtonClick" type="button" class="od-button !text-xl" :disabled="isDisabled" >
                            <i class="fa fa-search"></i>
                            {{ props.translations.searchForm.search_indicator }}
                        </button>
                    </div>
                </div>
            </div>


        </div>


    </div>

</template>
