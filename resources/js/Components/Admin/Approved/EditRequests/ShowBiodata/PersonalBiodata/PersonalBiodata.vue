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
    biodata_update: {
        type: Object,
    },
});


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

const birthDayString = (birth_date) => {
    const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    let birthDay = new Date(birth_date);
    let shortMonth = month[birthDay.getMonth()].slice(0, 3);
    let fullYear = birthDay.getFullYear();
    let calculatedAge =  getAge(birth_date);
    return shortMonth + ', ' + fullYear + ' (' + calculatedAge + ')';
}


onMounted(() => {

    setTimeout(() => {

    }, 500);

});


</script>


<template>


    <div class="container">

        <div class="grid grid-cols-12 gap-0">

            <div v-if="single_biodata.gender != biodata_update.gender" class="form_item col-span-12 p-2">
                <h1 class="text-lg text-left">Before: {{ single_biodata.gender == 'male' ?  translations.biodata_form.personal_biodata.gender_options.male : translations.biodata_form.personal_biodata.gender_options.female }}</h1>
                <h1 class="text-lg text-left">After: {{ biodata_update.gender == 'male' ?  translations.biodata_form.personal_biodata.gender_options.male : translations.biodata_form.personal_biodata.gender_options.female }}</h1>
            </div>

            <div v-if="single_biodata.birth_date != biodata_update.birth_date" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.birth_date_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ birthDayString( single_biodata.birth_date ) }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.birth_date_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ birthDayString( biodata_update.birth_date ) }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.skin_color != biodata_update.skin_color" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.skin_color_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.skin_color }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.skin_color_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.skin_color }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.height != biodata_update.height" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.height_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.height }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.height_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.height }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.weight != biodata_update.weight" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.weight_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.weight }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.weight_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.weight }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.blood_group != biodata_update.blood_group" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.blood_group_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.blood_group }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.blood_group_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.blood_group }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.maritial_status != biodata_update.maritial_status" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.maritial_status_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.personal_biodata.maritial_status_options[single_biodata.maritial_status] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.maritial_status_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.personal_biodata.maritial_status_options[biodata_update.maritial_status] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.permanent_upazila + ', ' + single_biodata.permanent_district + ', ' + single_biodata.permanent_division != biodata_update.permanent_upazila + ', ' + biodata_update.permanent_district + ', ' + biodata_update.permanent_division" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.permanent_address_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.permanent_upazila + ', ' + single_biodata.permanent_district + ', ' + single_biodata.permanent_division }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.permanent_address_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.permanent_upazila + ', ' + biodata_update.permanent_district + ', ' + biodata_update.permanent_division }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.temporary_upazila + ', ' + single_biodata.temporary_district + ', ' + single_biodata.temporary_division != biodata_update.temporary_upazila + ', ' + biodata_update.temporary_district + ', ' + biodata_update.temporary_division" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.temporary_address_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.temporary_upazila + ', ' + single_biodata.temporary_district + ', ' + single_biodata.temporary_division }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.temporary_address_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.temporary_upazila + ', ' + biodata_update.temporary_district + ', ' + biodata_update.temporary_division }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.job_title != biodata_update.job_title" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.job_title_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.job_title }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.job_title_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.job_title }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.job_details != biodata_update.job_details" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.job_details_title_2 }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.job_details }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.job_details_title_2 }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.job_details }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.job_location != biodata_update.job_location" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.job_location_title_2 }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.job_location }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.job_location_title_2 }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.job_location }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.monthly_income != biodata_update.monthly_income" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.monthly_income_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.monthly_income }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.monthly_income_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.monthly_income }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.medium_of_study != biodata_update.medium_of_study" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.education_medium_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.medium_of_study }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.education_medium_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.medium_of_study }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.general_highest_degree != biodata_update.general_highest_degree" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.general_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.general_highest_degree }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.general_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.general_highest_degree }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.aliya_highest_degree != biodata_update.aliya_highest_degree" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.aliya_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.aliya_highest_degree }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.aliya_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.aliya_highest_degree }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.kowmi_highest_degree != biodata_update.kowmi_highest_degree" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.kowmi_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.kowmi_highest_degree }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.kowmi_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.kowmi_highest_degree }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.study_others_highest_degree != biodata_update.study_others_highest_degree" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.study_others_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.study_others_highest_degree }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.study_others_highest_degree_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.study_others_highest_degree }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.study_in_details != biodata_update.study_in_details" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.study_in_details_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.study_in_details }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.study_in_details_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.study_in_details }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.honorable_degree_details != biodata_update.honorable_degree_details" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.honorable_degree_result_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.honorable_degree_details }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.honorable_degree_result_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.honorable_degree_details }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.honorable_degree_place != biodata_update.honorable_degree_place" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.honorable_degree_place_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.honorable_degree_place }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.personal_biodata.honorable_degree_place_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.honorable_degree_place }}
                    </span>
                </p>
            </div>

        </div>

    </div>


</template>
