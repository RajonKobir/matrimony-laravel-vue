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

    <div class="main-container">

        <div class="grid grid-cols-12 gap-0">

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.form_holder_desc }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.male_guardian_desc_title_male : translations.biodata_form.others_biodata.male_guardian_desc_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.male_guardian_desc }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.male_guardian_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.male_guardian_agreement_options[single_biodata.male_guardian_agreement] }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.deserved_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_money_pay }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.media_terms_one_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.media_terms_one_agreement_options[single_biodata.media_terms_one_agreement] }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.hundred_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.hundred_money_pay_options[single_biodata.hundred_money_pay] }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.three_hundred_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.three_hundred_money_pay_options[single_biodata.three_hundred_money_pay] }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.media_terms_two_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.media_terms_two_agreement_options[single_biodata.media_terms_two_agreement] }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.reference_code_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.reference_code }}
                    </span>
                </p>
            </div>

        </div>

    </div>


</template>
