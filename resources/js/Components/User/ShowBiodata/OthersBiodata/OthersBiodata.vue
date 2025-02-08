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
                <h1 class="text-base">{{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}</h1>

                <p class="text-base">{{ single_biodata.form_holder_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.male_guardian_desc_title_male : translations.biodata_form.others_biodata.male_guardian_desc_title_female }}</h1>

                <p class="text-base">{{ single_biodata.male_guardian_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.male_guardian_agreement_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.others_biodata.male_guardian_agreement_options[single_biodata.male_guardian_agreement] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.deserved_money_pay_title }}</h1>

                <p class="text-base">{{ single_biodata.deserved_money_pay }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.media_terms_one_agreement_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.others_biodata.media_terms_one_agreement_options[single_biodata.media_terms_one_agreement] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.hundred_money_pay_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.others_biodata.hundred_money_pay_options[single_biodata.hundred_money_pay] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.three_hundred_money_pay_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.others_biodata.three_hundred_money_pay_options[single_biodata.three_hundred_money_pay] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.media_terms_two_agreement_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.others_biodata.media_terms_two_agreement_options[single_biodata.media_terms_two_agreement] }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base">{{ translations.biodata_form.others_biodata.reference_code_title }}</h1>

                <p class="text-base">{{ translations.biodata_form.others_biodata.media_terms_two_agreement_options[single_biodata.reference_code] }}</p>
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
