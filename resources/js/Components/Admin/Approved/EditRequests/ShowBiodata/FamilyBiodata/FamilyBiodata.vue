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

            <div v-if="single_biodata.father_name != biodata_update.father_name" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.father_name_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.father_name }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.father_name_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.father_name }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.father_desc != biodata_update.father_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.father_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.father_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.father_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.father_desc }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.mother_name != biodata_update.mother_name" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.mother_name_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.mother_name }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.mother_name_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.mother_name }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.mother_desc != biodata_update.mother_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.mother_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.mother_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.mother_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.mother_desc }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.brother_sister_desc != biodata_update.brother_sister_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.brother_sister_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.brother_sister_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.brother_sister_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.brother_sister_desc }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.relative_desc != biodata_update.relative_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.relative_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.relative_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.relative_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.relative_desc }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.family_condition != biodata_update.family_condition" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.family_biodata.family_condition_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.family_condition }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.family_biodata.family_condition_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.family_condition }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.property_and_income != biodata_update.property_and_income" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.property_and_income_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.property_and_income }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.property_and_income_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.property_and_income }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.personal_maritial_agreement != biodata_update.personal_maritial_agreement" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ single_biodata.gender == 'male' ? translations.search_page.personal_maritial_agreement_title_male : translations.search_page.personal_maritial_agreement_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.search_page.personal_maritial_agreement_options[single_biodata.personal_maritial_agreement] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ biodata_update.gender == 'male' ? translations.search_page.personal_maritial_agreement_title_male : translations.search_page.personal_maritial_agreement_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.search_page.personal_maritial_agreement_options[biodata_update.personal_maritial_agreement] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.family_maritial_agreement != biodata_update.family_maritial_agreement" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.family_maritial_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.search_page.family_maritial_agreement_options[single_biodata.family_maritial_agreement] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.family_maritial_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.search_page.family_maritial_agreement_options[biodata_update.family_maritial_agreement] }}
                    </span>
                </p>
            </div>

        </div>

    </div>


</template>
