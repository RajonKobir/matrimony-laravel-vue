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

            <div v-if="single_biodata.form_holder_desc != biodata_update.form_holder_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.form_holder_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ biodata_update.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.form_holder_desc }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.male_guardian_desc != biodata_update.male_guardian_desc" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.male_guardian_desc_title_male : translations.biodata_form.others_biodata.male_guardian_desc_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.male_guardian_desc }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ biodata_update.gender == 'male' ? translations.biodata_form.others_biodata.male_guardian_desc_title_male : translations.biodata_form.others_biodata.male_guardian_desc_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.male_guardian_desc }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.male_guardian_agreement != biodata_update.male_guardian_agreement" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.male_guardian_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.male_guardian_agreement_options[single_biodata.male_guardian_agreement] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.male_guardian_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.male_guardian_agreement_options[biodata_update.male_guardian_agreement] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.deserved_money_pay != biodata_update.deserved_money_pay" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.deserved_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.deserved_money_pay }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.deserved_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.deserved_money_pay }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.media_terms_one_agreement != biodata_update.media_terms_one_agreement" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.media_terms_one_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.media_terms_one_agreement_options[single_biodata.media_terms_one_agreement] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.media_terms_one_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.media_terms_one_agreement_options[biodata_update.media_terms_one_agreement] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.hundred_money_pay != biodata_update.hundred_money_pay" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.hundred_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.hundred_money_pay_options[single_biodata.hundred_money_pay] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.hundred_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.hundred_money_pay_options[biodata_update.hundred_money_pay] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.three_hundred_money_pay != biodata_update.three_hundred_money_pay" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.three_hundred_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.three_hundred_money_pay_options[single_biodata.three_hundred_money_pay] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.three_hundred_money_pay_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.three_hundred_money_pay_options[biodata_update.three_hundred_money_pay] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.media_terms_two_agreement != biodata_update.media_terms_two_agreement" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.media_terms_two_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.media_terms_two_agreement_options[single_biodata.media_terms_two_agreement] }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.media_terms_two_agreement_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.others_biodata.media_terms_two_agreement_options[biodata_update.media_terms_two_agreement] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.reference_code != biodata_update.reference_code" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    Before:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.reference_code_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.reference_code }}
                    </span>
                </p>
                <p class="text-base text-left">
                    After:
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.others_biodata.reference_code_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ biodata_update.reference_code }}
                    </span>
                </p>
            </div>

        </div>

    </div>


</template>
