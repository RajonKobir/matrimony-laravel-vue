<script setup>

import { ref } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import PersonalBiodata from '../../Components/User/ShowBiodata/PersonalBiodata/PersonalBiodata.vue';
import ReligiousBiodata from '../../Components/User/ShowBiodata/ReligiousBiodata/ReligiousBiodata.vue';
import FamilyBiodata from '../../Components/User/ShowBiodata/FamilyBiodata/FamilyBiodata.vue';
import DeservedBiodata from '../../Components/User/ShowBiodata/DeservedBiodata/DeservedBiodata.vue';
import OthersBiodata from '../../Components/User/ShowBiodata/OthersBiodata/OthersBiodata.vue';
// import HideOrDeleteBiodata from '../../Components/User/ShowBiodata/HideOrDeleteBiodata/HideOrDeleteBiodata.vue';
import ShowBiodataUpper from '../../Components/User/ShowBiodata/ShowBiodataUpper.vue';
import { usePage } from '@inertiajs/vue3';


const emits = defineEmits([
    'onClickEditButton',
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
    single_biodata: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user.id;
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


const onClickEditButton = (clicked_true) => {
    emits('onClickEditButton', clicked_true);
}



</script>


<template>


    <ShowBiodataUpper :translations :locale :locales :single_biodata @onClickEditButton="onClickEditButton"  />



    <div class="biodata_main w-full min-h-screen">
        <TabGroup @change="changeTab">

            <TabList class="flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" :class="['mx-2']">
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.religious_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.family_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.deserved_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.others_biodata.title }}
                    </button>
                </Tab>

                <!-- <Tab v-if="single_biodata.is_approved" v-slot="{ selected }" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.hide_or_delete.hide_or_delete_title }}
                    </button>
                </Tab> -->

            </TabList>


            <TabPanels class="mt-2">

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <PersonalBiodata :translations :locale :locales :single_biodata="single_biodata" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <ReligiousBiodata :translations :locale :locales :single_biodata="single_biodata" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <FamilyBiodata :translations :locale :locales :single_biodata="single_biodata" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <DeservedBiodata :translations :locale :locales :single_biodata="single_biodata" />

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <OthersBiodata :translations :locale :locales :single_biodata="single_biodata" />

                </TabPanel>

                <!-- <TabPanel v-if="single_biodata.is_approved" :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <HideOrDeleteBiodata :translations :locale :locales :single_biodata="single_biodata" :selectedGender />

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
