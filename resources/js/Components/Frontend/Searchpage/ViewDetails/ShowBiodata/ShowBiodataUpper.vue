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


const highestDegreeSelection = (single_biodata) => {
    let highestDegree = '';
    if( single_biodata.medium_of_study ){
        if( single_biodata.medium_of_study != '' ){
            let educationMediumArray = single_biodata.medium_of_study.split(",").map(item => item.trim());
            educationMediumArray.forEach(function(item, index, arr){
                const wordBeforeBracket = item.split("(")[0].trim().toLowerCase();
                if( index > 0 ){
                    highestDegree += ', ';
                }
                switch(wordBeforeBracket) {
                    case 'জেনারেল' || 'general':
                        if( single_biodata.general_selected ){
                            highestDegree += single_biodata.general_highest_degree;
                        }
                        break;
                    case 'আলিয়া' || 'aliya':
                        if( single_biodata.aliya_selected ){
                            highestDegree += single_biodata.aliya_highest_degree;
                        }
                        break;
                    case 'ক্বওমী' || 'kowmi':
                        if( single_biodata.kowmi_selected ){
                            highestDegree += single_biodata.kowmi_highest_degree;
                        }
                        break;
                    case 'অন্যান্য' || 'others' || 'other':
                        if( single_biodata.study_others_selected ){
                            highestDegree += single_biodata.study_others_highest_degree;
                        }
                        break;
                }

                if( highestDegree != '' ){
                    highestDegree += ' ';
                    highestDegree += item.match(/\(.*?\)/)[0];
                }

            });
        }
    }

    if( highestDegree == '' ){
        if( single_biodata.medium_of_study ){
            highestDegree = single_biodata.medium_of_study;
        }
    }

    return highestDegree;
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
        <div class="container">

            <div class="grid grid-cols-12 gap-0 py-2 text-white text-base overflow-hidden">

                <div class="col-span-12 md:col-start-4 md:col-span-6 p-2 relative">

                    <div class="text-center">
                        <img v-if="single_biodata.free_biodata" class="absolute top-4 right-4 animate__animated animate__heartBeat animate__delay-2s animate__infinite infinite" src="/assets/images/free.png" alt="free" width="30">
                    </div>

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
                                {{ highestDegreeSelection(single_biodata) }}
                            </p>
                            <p class="font-bold text-xl">
                                {{ single_biodata.job_title }}{{ ['নাই', 'None', null].includes(single_biodata.monthly_income) ? '' : ' (' + single_biodata.monthly_income + ')' }}
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
