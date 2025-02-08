<script setup>


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


</script>


<template>


    <div class="grid grid-cols-12 gap-0">

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.deserved_district_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_districts }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_age_range_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_age_range }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_height_range_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_height_range }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_skin_colors_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_skin_colors }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_maritial_statuses_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_maritial_statuses.split(",").map((maritial_status) => translations.biodata_form.deserved_biodata.deserved_maritial_statuses_options[maritial_status.trim()]).join(', ') }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_akida_majhhabs_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_akida_majhhabs }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_family_conditions_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_family_conditions }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_job_titles_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_job_titles }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.deserved_education_mediums_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_education_mediums }}</p>
            </div>
        </div>

        <div v-if="single_biodata.deserved_general_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_general_degrees_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_general_degrees }}</p>
            </div>
        </div>

        <div v-if="single_biodata.deserved_aliya_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_aliya_degrees_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_aliya_degrees }}</p>
            </div>
        </div>

        <div v-if="single_biodata.deserved_kowmi_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_kowmi_degrees_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_kowmi_degrees }}</p>
            </div>
        </div>

        <div v-if="single_biodata.deserved_study_others_selected" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.deserved_biodata.deserved_study_others_degrees_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_study_others_degrees }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ single_biodata.gender == 'male' ? translations.search_page.deserved_condition_title_male : translations.biodata_form.deserved_biodata.deserved_condition_title_female }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_conditions }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.deserved_others_desc_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.deserved_others_desc }}</p>
            </div>
        </div>

    </div>


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
