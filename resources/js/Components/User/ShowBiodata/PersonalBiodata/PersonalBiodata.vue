<script setup>

import { ref, onMounted } from 'vue';


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


// initializing
const birthDay = ref(null);
const shortMonth = ref(null);
const fullYear = ref(null);
const calculatedAge = ref(null);
const birthDayString = ref('');
const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}


onMounted(() => {

    setTimeout(() => {
        if( props.single_biodata.birth_date ){
            birthDay.value = new Date(props.single_biodata.birth_date);
            shortMonth.value = month[birthDay.value.getMonth()].slice(0, 3);
            fullYear.value = birthDay.value.getFullYear();
            calculatedAge.value =  getAge(props.single_biodata.birth_date);
            birthDayString.value = shortMonth.value + ', ' + fullYear.value + ' (' + calculatedAge.value + ')';
        }
    }, 500);


});


</script>


<template>


    <div class="grid grid-cols-12 gap-0">

        <div class="form_item col-span-12 p-2">
            <h1 class="text-lg text-left">{{ single_biodata.gender == 'male' ?  translations.biodata_form.personal_biodata.gender_options.male : translations.biodata_form.personal_biodata.gender_options.female }}</h1>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.birth_date_title }}</h1>
                <p class="text-base text-left">{{ birthDayString }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.skin_color_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.skin_color }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.height_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.height }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.weight_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.weight }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.blood_group_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.blood_group }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.maritial_status_title }}</h1>

                <p class="text-base text-left">{{ translations.biodata_form.personal_biodata.maritial_status_options[single_biodata.maritial_status] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.permanent_address_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.permanent_upazila + ', ' + single_biodata.permanent_district + ', ' + single_biodata.permanent_division }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.temporary_address_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.temporary_upazila + ', ' + single_biodata.temporary_district + ', ' + single_biodata.temporary_division }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.job_title_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.job_title }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.job_details_title_2 }}</h1>

                <p class="text-base text-left">{{ single_biodata.job_details }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.job_location_title_2 }}</h1>

                <p class="text-base text-left">{{ single_biodata.job_location }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.monthly_income_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.monthly_income }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.education_medium_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.medium_of_study }}</p>
            </div>
        </div>

        <div v-if="single_biodata.general_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.general_highest_degree_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.general_highest_degree }}</p>
            </div>
        </div>

        <div v-if="single_biodata.aliya_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.aliya_highest_degree_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.aliya_highest_degree }}</p>
            </div>
        </div>

        <div v-if="single_biodata.kowmi_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.kowmi_highest_degree_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.kowmi_highest_degree }}</p>
            </div>
        </div>

        <div v-if="single_biodata.study_others_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.study_others_highest_degree_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.study_others_highest_degree }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.study_in_details_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.study_in_details }}</p>
            </div>
        </div>

        <div v-if="single_biodata.is_honorable_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.personal_biodata.honorable_degree_place_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.honorable_degree_place }}</p>
            </div>
        </div>

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
