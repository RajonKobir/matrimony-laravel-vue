<script setup>

import { ref, onMounted } from 'vue';

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


// initializing
const ageString = ref('');


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}


onMounted(() => {

    setTimeout(() => {
        if( props.single_biodata.birth_date ){
            ageString.value =  getAge(props.single_biodata.birth_date);
        }
    }, 500);

});


</script>


<template>


    <div class="bg-[#ad277c] shadow-md rounded-xl">
        <div class="main-container">

            <div class="grid grid-cols-12 gap-0 py-2 text-white text-base overflow-hidden">

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
                                {{ translations.searchForm.biodata_age_title.replace(':age', ageString) }}, {{ single_biodata.height }}, {{ single_biodata.skin_color }}
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

            </div>
        </div>
    </div>

</template>
