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


    <div class="container">

        <div class="grid grid-cols-12 gap-0">

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.five_waqt_salat_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.five_waqt_salat }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.beard_quantity_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.beard_quantity }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.pants_worn_style_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.pants_worn_style }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.borka_wearing_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.borka_wearing }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.nikab_with_borka_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.nikab_with_borka }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.veiling_style_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.veiling_style }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.islamic_studies_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.islamic_studies }}
                    </span>
                </p>
            </div>


            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.drugs_taken_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.drugs_taken }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.gender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.dowry_deserve_title_male }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.dowry_deserve_male }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.gender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.dowry_deserve_title_female }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.dowry_deserve_female }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.akida_majhhab_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.akida_majhhab }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.family_islam_maintain_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.family_islam_maintain }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.three_choosen_alems_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.three_choosen_alems }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.biodata_form.religious_biodata.physical_weakness_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ translations.biodata_form.religious_biodata.physical_weakness_options[single_biodata.physical_weakness] }}
                    </span>
                </p>
            </div>

            <div v-if="single_biodata.physical_weakness" class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.physical_weakness_desc_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.physical_weakness_desc }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.good_affairs_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.good_affairs }}
                    </span>
                </p>
            </div>

            <div class="form_item col-span-12 md:col-span-6 p-2">
                <p class="text-base text-left">
                    <span class="text-lg text-left font-bold">
                        {{ translations.search_page.religious_future_plan_title }}
                    </span>
                    <span class="text-base text-left pl-2">
                        {{ single_biodata.religious_future_plan }}
                    </span>
                </p>
            </div>

        </div>

    </div>


</template>
