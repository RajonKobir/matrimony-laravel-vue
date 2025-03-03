<script setup>
import { ref, onMounted } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import PersonalBiodata from './PersonalBiodata/PersonalBiodata.vue';
import ReligiousBiodata from './ReligiousBiodata/ReligiousBiodata.vue';
import FamilyBiodata from './FamilyBiodata/FamilyBiodata.vue';
import DeservedBiodata from './DeservedBiodata/DeservedBiodata.vue';
import OthersBiodata from './OthersBiodata/OthersBiodata.vue';
import HideOrDeleteBiodata from './HideOrDeleteBiodata/HideOrDeleteBiodata.vue';
import PopupMessage from './PersonalBiodata/PopupMessage.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';


const emits = defineEmits([
    'loadSingleBiodata',
]);


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
    districts: {
        type: Object,
    },
    single_biodata: {
        type: Object,
    },
    editRequest: {
        type: Boolean,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user.id;
const single_biodata_data = ref([]);
const selectedTab = ref(0);
const disableTab1 = ref(true);
const disableTab2 = ref(true);
const disableTab3 = ref(true);
const disableTab4 = ref(true);
const modalMessage = ref({});
const isModalOpen = ref(false);
const runningTab = ref(0);
const selectedGender = ref('');


const closeModal = (value) => {
    isModalOpen.value = value;
}


function changeTab(index) {
    selectedTab.value = index;
}


const onUpdateGender = (gender) => {
    selectedGender.value = gender;
}


const onUpdateDeservedJobTitles = (deserved_job_titles) => {
    single_biodata_data.value.deserved_job_titles = deserved_job_titles;
}


const onUpdateDeservedMaritialStatuses = (deserved_maritial_statuses) => {
    single_biodata_data.value.deserved_maritial_statuses = deserved_maritial_statuses;
}


const onCompleteTab = (nextIndex, biodataCompletion) => {
    if( single_biodata_data.value.biodata_completion < biodataCompletion ){
        single_biodata_data.value.biodata_completion = biodataCompletion;
        emits('loadSingleBiodata', single_biodata_data.value);
    }
    switch(nextIndex) {
    case 1:
        disableTab1.value = false;
        runningTab.value = 1;
        break;
    case 2:
        disableTab1.value = false;
        disableTab2.value = false;
        runningTab.value = 2;
        break;
    case 3:
        disableTab1.value = false;
        disableTab2.value = false;
        disableTab3.value = false;
        runningTab.value = 3;
        break;
    case 4:
        disableTab1.value = false;
        disableTab2.value = false;
        disableTab3.value = false;
        disableTab4.value = false;
        runningTab.value = 4;
        break;
    }
    setTimeout(function(){
        selectedTab.value = nextIndex;
        if( page.props.flash.success ){
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.flash.success,
            }
            isModalOpen.value = true;
        }

    }, 500);
}



onMounted(() => {

    single_biodata_data.value = page.props.single_biodata;
    onCompleteTab(single_biodata_data.value.running_tab, single_biodata_data.value.biodata_completion);
    selectedGender.value = single_biodata_data.value.gender;
    emits('loadSingleBiodata', single_biodata_data.value);

});



</script>


<template>



    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />


    <div class="biodata_main w-full min-h-screen">
        <TabGroup :selectedIndex="selectedTab" @change="changeTab">

            <TabList class="flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" :class="['mx-2']">
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab1" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.religious_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab2" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.family_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab3" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.deserved_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab4">
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.others_biodata.title }}
                    </button>
                </Tab>

                <!-- <Tab v-if="single_biodata_data.is_approved" v-slot="{ selected }" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.hide_or_delete.hide_or_delete_title }}
                    </button>
                </Tab> -->

            </TabList>


            <TabPanels class="mt-2">

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <PersonalBiodata :translations :locale :locales :single_biodata="single_biodata_data" :districts :editRequest @onCompleteTab="onCompleteTab" @onUpdateGender="onUpdateGender" @onUpdateDeservedJobTitles="onUpdateDeservedJobTitles" @onUpdateDeservedMaritialStatuses="onUpdateDeservedMaritialStatuses" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <ReligiousBiodata :translations :locale :locales :editRequest :single_biodata="single_biodata_data" :selectedGender @onCompleteTab="onCompleteTab" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <FamilyBiodata :translations :locale :locales :editRequest :single_biodata="single_biodata_data" :selectedGender @onCompleteTab="onCompleteTab" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <DeservedBiodata :translations :locale :locales :editRequest :single_biodata="single_biodata_data" :selectedGender :districts @onCompleteTab="onCompleteTab" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <OthersBiodata :translations :locale :locales :editRequest :single_biodata="single_biodata_data" :selectedGender @onCompleteTab="onCompleteTab" />

                </TabPanel>

                <!-- <TabPanel v-if="single_biodata_data.is_approved" :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <HideOrDeleteBiodata :translations :locale :locales :single_biodata="single_biodata_data" :selectedGender />

                </TabPanel> -->

            </TabPanels>

        </TabGroup>

    </div>


</template>


<style>
.biodata_main, .biodata_main button{
    color: #000;
    font-weight: 500;
}
</style>
