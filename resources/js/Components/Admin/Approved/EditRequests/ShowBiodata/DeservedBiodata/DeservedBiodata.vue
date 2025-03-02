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
    biodata_update: {
        type: Object,
    },
});


</script>


<template>


    <div class="container">

        <div class="grid grid-cols-12 gap-0">

            <div v-if="single_biodata.deserved_districts != biodata_update.deserved_districts" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.deserved_district_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_districts }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.deserved_district_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_districts }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_age_range != biodata_update.deserved_age_range" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_age_range_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_age_range }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_age_range_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_age_range }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_height_range != biodata_update.deserved_height_range" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_height_range_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_height_range }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_height_range_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_height_range }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_skin_colors != biodata_update.deserved_skin_colors" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_skin_colors_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_skin_colors }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_skin_colors_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_skin_colors }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_maritial_statuses != biodata_update.deserved_maritial_statuses" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_maritial_statuses_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_maritial_statuses ? single_biodata.deserved_maritial_statuses.split(",").map((maritial_status) => translations.biodata_form.deserved_biodata.deserved_maritial_statuses_options[maritial_status.trim()]).join(', ') : '' }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_maritial_statuses_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_maritial_statuses ? biodata_update.deserved_maritial_statuses.split(",").map((maritial_status) => translations.biodata_form.deserved_biodata.deserved_maritial_statuses_options[maritial_status.trim()]).join(', ') : '' }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_akida_majhhabs != biodata_update.deserved_akida_majhhabs" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_akida_majhhabs_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_akida_majhhabs }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_akida_majhhabs_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_akida_majhhabs }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_family_conditions != biodata_update.deserved_family_conditions" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_family_conditions_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_family_conditions }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_family_conditions_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_family_conditions }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_job_titles != biodata_update.deserved_job_titles" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_job_titles_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_job_titles }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_job_titles_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_job_titles }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_education_mediums != biodata_update.deserved_education_mediums" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.deserved_education_mediums_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_education_mediums }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.deserved_education_mediums_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_education_mediums }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_general_degrees != biodata_update.deserved_general_degrees" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_general_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_general_degrees }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_general_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_general_degrees }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_aliya_degrees != biodata_update.deserved_aliya_degrees" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_aliya_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_aliya_degrees }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_aliya_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_aliya_degrees }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_kowmi_degrees != biodata_update.deserved_kowmi_degrees" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_kowmi_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_kowmi_degrees }}
                    </span>
                </p>
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_kowmi_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_kowmi_degrees }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_study_others_degrees != biodata_update.deserved_study_others_degrees" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_study_others_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_study_others_degrees }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.deserved_biodata.deserved_study_others_degrees_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_study_others_degrees }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_conditions != biodata_update.deserved_conditions" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ single_biodata.gender == 'male' ? translations.search_page.deserved_condition_title_male : translations.biodata_form.deserved_biodata.deserved_condition_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_conditions }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ biodata_update.gender == 'male' ? translations.search_page.deserved_condition_title_male : translations.biodata_form.deserved_biodata.deserved_condition_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_conditions }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_others_desc != biodata_update.deserved_others_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.deserved_others_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_others_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.deserved_others_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_others_desc }}
                    </span>
                </p>
            </div>

        </div>

    </div>


</template>
