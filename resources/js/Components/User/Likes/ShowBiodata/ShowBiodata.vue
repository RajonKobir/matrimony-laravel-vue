<script setup>
import { ref, onMounted } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import PersonalBiodata from './PersonalBiodata/PersonalBiodata.vue';
import ReligiousBiodata from './ReligiousBiodata/ReligiousBiodata.vue';
import FamilyBiodata from './FamilyBiodata/FamilyBiodata.vue';
import DeservedBiodata from './DeservedBiodata/DeservedBiodata.vue';
import ShowBiodataUpper from './ShowBiodataUpper.vue';
import { usePage } from '@inertiajs/vue3';


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
    tab_index: {
        type: Number,
    },
    proposed: {
        type: Boolean,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const selectedTab = ref(0);
const isModalOpen = ref(false);


const closeModal = (value) => {
    isModalOpen.value = value;
}


function changeTab(index) {
    selectedTab.value = index;
}

onMounted(() => {

setTimeout(() => {
    if( typeof props.tab_index !== 'undefined' ){
        selectedTab.value =  props.tab_index;
    }

    // updatedProposal.value = props.proposal;

}, 500);

});


</script>


<template>


    <ShowBiodataUpper :translations :locale :locales :single_biodata  />


    <div class="biodata_main w-full min-h-screen">
        <TabGroup :selectedIndex="selectedTab" @change="changeTab">

            <TabList class="flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" :class="['mx-2']">
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.religious_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.family_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.deserved_biodata.title }}
                    </button>
                </Tab>
                <Tab v-if="proposed" v-slot="{ selected }" >
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.profile_page.interested_done_title }}
                    </button>
                </Tab>

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

                    <DeservedBiodata :translations :locale :locales :single_biodata="single_biodata"  />

                </TabPanel>

                <TabPanel v-if="proposed" :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <h1 class="text-center py-4">
                        শীঘ্রই আসছে...
                    </h1>

                </TabPanel>

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
