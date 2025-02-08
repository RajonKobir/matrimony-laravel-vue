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
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.five_waqt_salat_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.five_waqt_salat }}</p>
            </div>
        </div>

        <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.beard_quantity_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.beard_quantity }}</p>
            </div>
        </div>

        <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.pants_worn_style_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.pants_worn_style }}</p>
            </div>
        </div>

        <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.borka_wearing_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.borka_wearing }}</p>
            </div>
        </div>

        <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.nikab_with_borka_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.nikab_with_borka }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.veiling_style_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.veiling_style }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.islamic_studies_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.islamic_studies }}</p>
            </div>
        </div>


        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.drugs_taken_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.drugs_taken }}</p>
            </div>
        </div>

        <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.dowry_deserve_title_male }}</h1>

                <p class="text-base text-left">{{ single_biodata.dowry_deserve_male }}</p>
            </div>
        </div>

        <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.dowry_deserve_title_female }}</h1>

                <p class="text-base text-left">{{ single_biodata.dowry_deserve_female }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.akida_majhhab_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.akida_majhhab }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.family_islam_maintain_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.family_islam_maintain }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.three_choosen_alems_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.three_choosen_alems }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.biodata_form.religious_biodata.physical_weakness_title }}</h1>

                <p class="text-base text-left">{{ translations.biodata_form.religious_biodata.physical_weakness_options[single_biodata.physical_weakness] }}</p>
            </div>
        </div>

        <div v-if="single_biodata.physical_weakness" class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.physical_weakness_desc_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.physical_weakness_desc }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.good_affairs_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.good_affairs }}</p>
            </div>
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <div class="">
                <h1 class="text-base text-left">{{ translations.search_page.religious_future_plan_title }}</h1>

                <p class="text-base text-left">{{ single_biodata.religious_future_plan }}</p>
            </div>
        </div>

    </div>


</template>


<style>
.biodata_submit_button{
    color: #fff !important;
}
</style>
