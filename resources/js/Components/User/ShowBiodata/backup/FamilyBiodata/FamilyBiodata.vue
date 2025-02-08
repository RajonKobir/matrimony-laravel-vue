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
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.father_name_title }}</h1>

                <p class="text-base">{{ single_biodata.father_name }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.father_desc_title }}</h1>

                <p class="text-base">{{ single_biodata.father_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.mother_name_title }}</h1>

                <p class="text-base">{{ single_biodata.mother_name }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.mother_desc_title }}</h1>

                <p class="text-base">{{ single_biodata.mother_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.brother_sister_desc_title }}</h1>

                <p class="text-base">{{ single_biodata.brother_sister_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.relative_desc_title }}</h1>

                <p class="text-base">{{ single_biodata.relative_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.family_condition_title }}</h1>

                <p class="text-base">{{ single_biodata.family_condition }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.property_and_income_title }}</h1>

                <p class="text-base">{{ single_biodata.property_and_income }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.personal_maritial_agreement_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.family_biodata.personal_maritial_agreement_options[single_biodata.personal_maritial_agreement] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.family_biodata.family_maritial_agreement_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.family_biodata.family_maritial_agreement_options[single_biodata.family_maritial_agreement] }}</p>
            </div>
        </div>

    </div>


</template>


<style>
.biodata_submit_button{
    color: #fff !important;
}
</style>
