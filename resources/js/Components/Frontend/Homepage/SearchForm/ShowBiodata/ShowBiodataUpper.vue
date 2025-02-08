<script setup>


defineProps({
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

    <div class="grid grid-cols-12 gap-0 py-2 bg-[#ad277c] text-white text-base overflow-hidden shadow-md rounded-xl">

        <div class="col-span-12 md:col-start-4 md:col-span-6 p-2">
            <div class="biodata_single_box_upper col-span-12 p-2 pr-0 text-left md:text-center">
                <div class="text-center">
                    <h3 class=" text-xl">
                        {{ single_biodata.gender == 'male' ? translations.searchForm.male_title : translations.searchForm.female_title }}
                    </h3>
                    <p class="mb-4 text-xl">
                        {{ translations.searchForm.biodata_code_title }} : {{ single_biodata.biodata_code }}
                    </p>
                </div>

                <div class="leading-8">
                    <p class="font-bold text-xl">
                        {{ translations.searchForm.biodata_age_title.replace(':age', single_biodata.age) }}, {{ single_biodata.height }}, {{ single_biodata.skin_color }}
                    </p>
                    <p class="font-bold text-xl">
                        {{ single_biodata.general_highest_degree }}
                    </p>
                    <p class="font-bold text-xl">
                        {{ single_biodata.job_title }} ({{ single_biodata.monthly_income }})
                    </p>
                    <p class="font-bold text-xl">
                        {{ single_biodata.permanent_upazila }}, {{ single_biodata.permanent_district }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-start-4 md:col-span-6 p-2 px-4">
            <div class="flex justify-between md:justify-center gap-8">
                <span class="text-lg cursor-pointer">
                    <i class="fa-regular fa-thumbs-up"></i> {{ translations.profile_page.like_title }}
                </span>
                <span class="text-lg cursor-pointer">
                    <i class="fa-regular fa-message"></i> {{ translations.profile_page.message_title }}
                </span>
                <span class="text-lg cursor-pointer">
                    <i class="fa fa-paper-plane"></i>
                    {{ translations.profile_page.interested_title }}
                </span>

            </div>
        </div>


    </div>

</template>
