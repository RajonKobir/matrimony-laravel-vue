<script setup>

import { onMounted, watch } from 'vue';
import { usePage, useForm, Link } from '@inertiajs/vue3';
import InputError from '../../../InputError.vue';
import AgeSlider from './AgeSlider.vue';
import HeightSlider from './HeightSlider.vue';
import MultipleSkinColorsSelection from './MultipleSkinColorsSelection.vue';
import MultipleAkidaMajhabSelection from './MultipleAkidaMajhabSelection.vue';
import MultipleFamilyConditionsSelection from './MultipleFamilyConditionsSelection.vue';
import MultipleJobsSelection from './MultipleJobsSelection.vue';
import MultipleEducationMediumSelection from './MultipleEducationMediumSelection.vue';
import MultipleDistrictsSelection from './MultipleDistrictsSelection.vue';
import MultipleMaritialStatusSelection from './MultipleMaritialStatusSelection.vue';


const props = defineProps({
    translations: {
        type: Object,
    },
    districts: {
        type: Object,
    },
    locale: {
        type: String,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;


const form = useForm({
    // csrf_token: csrf_token,
    searchNumber: 1,
    selectedGender: null,
    selectedDistricts: null,
    ageRange: '16-65',
    maritialStatuses: null,
    selectedCategory: null,
    codeNumber: null,
    heightRange: '৪\'৮" এর কম-৭\' এর বেশি',
    skinColors: null,
    akidaMajhabs: null,
    familyConditions: null,
    selectedJobs: null,
    educationMediums: null,
    specialCategory: null,
});


const submit = (e) => {
    e.preventDefault();
    page.props.flash = [];
    form.get(route('frontend.biodata_search'), {
        preserveState: true,
        preserveScroll: true,
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {
            setTimeout(() => {
                page.props.flash = [];
            }, 3000);
        }
    })
}


const onSelectMaritialStatuses = (selectedMaritialStatusesArray) =>{
    form.maritialStatuses = selectedMaritialStatusesArray.map((maritial_status) => maritial_status).join(',');
}


const onSelectEducationMedium = (selectedEducationMediumArray) =>{
    form.educationMediums = selectedEducationMediumArray.map((medium_of_study) => medium_of_study).join(',');
}

const onSelectJobs = (selectedJobTitlesArray) =>{
    form.selectedJobs = selectedJobTitlesArray.map((job_title) => job_title).join(',');
}

const onSelectFamilyConditions = (selectedFamilyConditionsArray) =>{
    form.familyConditions = selectedFamilyConditionsArray.map((family_condition) => family_condition).join(',');
}

const onSelectAkidaMajhabs = (selectedAkidaMajhabsArray) =>{
    form.akidaMajhabs = selectedAkidaMajhabsArray.map((akida_majhab) => akida_majhab).join(',');
}

const onUpdateAgeSlider = (slider_state) => {
    form.ageRange = slider_state[0] + '-' + slider_state[1];
}

const onSelectDistricts = (districts) => {
    form.selectedDistricts = districts.map((district) => district).join(',');
}

const onUpdateHeightSlider = (slider_state) => {
    form.heightRange = props.translations.biodata_form.personal_biodata.height_options[slider_state[0]] + '-' + props.translations.biodata_form.personal_biodata.height_options[slider_state[1]];
}


const onSelectSkinColors = (selectedSkinColorsArray) =>{
    form.skinColors = selectedSkinColorsArray.map((skin_color) => skin_color).join(',');
}


// watch(form, async (newValue, oldValue) => {
//     if( newValue.searchNumber ){
//         form.reset();
//     }
// });


onMounted(() => {

    page.props.flash = [];

});


</script>

<template>


    <div class="main-search-option">

        <form @submit.prevent="submit" class="grid grid-cols-12 gap-0 text-gray-950 text-base">

            <div class="form_item col-start-4 col-span-6 md:col-start-5 md:col-span-4 p-2 pb-8">
                <select id="main_search_choice" v-model="form.searchNumber" name="main_search_choice"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="null" disabled selected>{{ props.translations.searchForm.search_initiate_title }}</option>
                    <option v-for="(search_initiate, search_initiate_key) in props.translations.searchForm.search_initiate_options" :key="search_initiate.id" :value="search_initiate_key" >{{ search_initiate }}</option>
                </select>
            </div>

            <template v-if="form.searchNumber == 1">

                    <div class="form_item col-span-6 lg:col-start-3 lg:col-span-4 p-2">
                        <select id="search_gender"  v-model="form.selectedGender" name="search_gender" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="null" disabled selected>{{ props.translations.searchForm.dropdown_1_heading }}</option>
                            <option value="male">{{ props.translations.searchForm.dropdown_1_option_2 }}</option>
                            <option value="female">{{ props.translations.searchForm.dropdown_1_option_3 }}</option>
                        </select>
                        <InputError class="mt-2" :message="page.props.errors.selectedGender" />
                    </div>

                    <div class="form_item col-span-6 lg:col-span-4 p-2">
                        <MultipleDistrictsSelection :translations :locale  :districts="districts" @onSelectDistricts="onSelectDistricts" />
                        <InputError class="mt-2" :message="page.props.errors.selectedDistricts" />
                    </div>

                    <div class="form_item col-span-12 md:col-start-4 md:col-span-6 lg:col-start-5 lg:col-span-4 p-2 px-8 md:px-4 pb-4">
                        <AgeSlider :translations @onUpdateAgeSlider="onUpdateAgeSlider"/>
                        <InputError class="mt-2" :message="page.props.errors.ageRange" />
                    </div>

                    <div class="form_item col-span-6 lg:col-start-3 lg:col-span-4 p-2">
                        <MultipleMaritialStatusSelection :translations :gender="form.selectedGender" @onSelectMaritialStatuses="onSelectMaritialStatuses" />
                        <InputError class="mt-2" :message="page.props.errors.maritialStatuses" />
                    </div>

                    <div class="form_item col-span-6 lg:col-span-4 p-2">
                        <select id="search_category" v-model="form.selectedCategory" name="search_category"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="null" disabled selected>{{ props.translations.searchForm.category_title }}</option>
                            <option v-for="(single_category, category_key) in props.translations.searchForm.category_options" :key="single_category.id" :value="category_key" >{{ single_category }}</option>
                        </select>
                        <InputError class="mt-2" :message="page.props.errors.selectedCategory" />
                    </div>

            </template>


            <template v-if="form.searchNumber == 2">
                <div class="form_item col-span-12 md:col-start-4 md:col-span-6 p-2">
                    <input type="text" v-model="form.codeNumber" id="code_number" name="code_number" :placeholder="props.translations.searchForm.code_number_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
                    <InputError class="mt-2" :message="page.props.errors.codeNumber" />
                </div>

            </template>


            <template v-if="form.searchNumber == 3">
                <div class="form_item col-span-6 lg:col-start-3 lg:col-span-4 p-2">
                    <select id="search_gender" v-model="form.selectedGender" name="search_gender" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="null" disabled selected>{{ props.translations.searchForm.dropdown_1_heading }}</option>
                        <option value="male">{{ props.translations.searchForm.dropdown_1_option_2 }}</option>
                        <option value="female">{{ props.translations.searchForm.dropdown_1_option_3 }}</option>
                    </select>
                    <InputError class="mt-2" :message="page.props.errors.selectedGender" />
                </div>

                <div class="form_item col-span-6 lg:col-span-4 p-2">
                    <MultipleDistrictsSelection :translations :locale  :districts="districts" @onSelectDistricts="onSelectDistricts" />
                    <InputError class="mt-2" :message="page.props.errors.selectedDistricts" />
                </div>

                <div class="form_item col-span-6 lg:col-start-3 lg:col-span-4 p-2">
                    <MultipleMaritialStatusSelection :translations :gender="form.selectedGender" @onSelectMaritialStatuses="onSelectMaritialStatuses" />
                    <InputError class="mt-2" :message="page.props.errors.maritialStatuses" />
                </div>

                <div class="form_item col-span-6 lg:col-span-4 p-2">
                    <MultipleAkidaMajhabSelection :translations @onSelectAkidaMajhabs="onSelectAkidaMajhabs" />
                    <InputError class="mt-2" :message="page.props.errors.akidaMajhabs" />
                </div>

                <div class="form_item col-span-12 md:col-span-6 lg:col-start-3 lg:col-span-4 p-2 px-8 pb-4">
                    <AgeSlider :translations @onUpdateAgeSlider="onUpdateAgeSlider"/>
                    <InputError class="mt-2" :message="page.props.errors.ageRange" />
                </div>

                <div class="form_item col-span-12 md:col-span-6 lg:col-span-4 p-2 px-8 pb-4">
                    <HeightSlider :translations @onUpdateHeightSlider="onUpdateHeightSlider"/>
                    <InputError class="mt-2" :message="page.props.errors.heightRange" />
                </div>

                <div class="form_item col-span-6 lg:col-start-3 lg:col-span-4 p-2">
                    <MultipleJobsSelection :translations :gender="form.selectedGender" @onSelectJobs="onSelectJobs" />
                    <InputError class="mt-2" :message="page.props.errors.selectedJobs" />
                </div>

                <div class="form_item col-span-6 lg:col-span-4 p-2">
                    <MultipleSkinColorsSelection :translations  @onSelectSkinColors="onSelectSkinColors" />
                    <InputError class="mt-2" :message="page.props.errors.skinColors" />
                </div>

                <div class="form_item col-span-6 lg:col-start-3 lg:col-span-4 p-2">
                    <MultipleEducationMediumSelection :translations  @onSelectEducationMedium="onSelectEducationMedium"/>
                    <InputError class="mt-2" :message="page.props.errors.educationMediums" />
                </div>

                <div class="form_item col-span-6 lg:col-span-4 p-2">
                    <MultipleFamilyConditionsSelection :translations  @onSelectFamilyConditions="onSelectFamilyConditions" />
                    <InputError class="mt-2" :message="page.props.errors.familyConditions" />
                </div>

            </template>


            <template v-if="form.searchNumber == 4">
                <div class="form_item col-span-6 lg:col-start-1 lg:col-span-4 p-2">
                    <select id="search_gender" v-model="form.selectedGender" name="search_gender" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="null" disabled selected>{{ props.translations.searchForm.dropdown_1_heading }}</option>
                        <option value="male">{{ props.translations.searchForm.dropdown_1_option_2 }}</option>
                        <option value="female">{{ props.translations.searchForm.dropdown_1_option_3 }}</option>
                    </select>
                    <InputError class="mt-2" :message="page.props.errors.selectedGender" />
                </div>

                <div class="form_item col-span-6 lg:col-span-4 p-2">
                    <MultipleDistrictsSelection :translations :locale  :districts="districts" @onSelectDistricts="onSelectDistricts" />
                    <InputError class="mt-2" :message="page.props.errors.selectedDistricts" />
                </div>

                <div class="form_item col-span-12 md:col-start-4 md:col-span-6 lg:col-span-4 p-2">
                    <select id="special_category" v-model="form.specialCategory" name="special_category"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="null" disabled selected>{{ props.translations.searchForm.special_search_4_category_title }}</option>
                        <option v-for="(category, categories_key) in props.translations.searchForm.special_search_4_category_options" :key="categories_key" :value="category" >{{ category }}</option>
                    </select>
                    <InputError class="mt-2" :message="page.props.errors.specialCategory" />
                </div>

            </template>

            <div class="form_item col-span-12 md:col-start-4 md:col-span-6 p-2">

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

                <div class="od-search-fields odsf-submit">
                    <div class="od-submit-btn !text-center ">
                        <button type="submit" class="text-white bg-[#ad277c] rounded-xl cursor-pointer p-4 mt-4 text-center transition duration-200 hover:shadow-xl hover:opacity-75 !text-xl" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            <i class="fa fa-search"></i>
                            {{ props.translations.searchForm.search_indicator }}
                        </button>

                    </div>
                </div>

            </div>

        </form>


    </div>

</template>

<style>
@media screen and (max-width: 768px) {
    .main-search-option{
        padding: 35px 0 20px !important;
    }
}
</style>
