<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage, Head } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import Biodata from '../../Components/Admin/Biodatas/Biodata.vue';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import Header from '../../Components/Admin/Header.vue';
import Content from '../../Components/Admin/Contents/Content.vue';
import Proposals from '../../Components/Admin/Proposals/Proposal.vue';
import Others from '../../Components/Admin/Others/Others.vue';
import Approved from '../../Components/Admin/Approved/Approved.vue';


defineProps({
    translations: {
        type: Object,
    },
    front_end_translations: {
        type: Object,
    },
    districts: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Array,
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    all_biodatas: {
        type: Object,
    },
    biodata_updates: {
        type: Object,
    },
    all_proposals: {
        type: Object,
    },
    all_terms: {
        type: Object,
    },
});


// initializing
const page = usePage();
// const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user.id;
const selectedTab = ref(0);
const allBiodatas = ref({});
const allProposals = ref({});
const allTerms = ref({});


function changeTab(index) {
    selectedTab.value = index;
}


const onUpdateAllBiodatas = (biodatas) => {
    allBiodatas.value = biodatas;
}

const onUpdateAllProposals = (proposals) => {
    allProposals.value = proposals;
}

const onUpdateAllTerms = (terms) => {
    allTerms.value = terms;
}


onMounted(() => {

    setTimeout(() => {
        allBiodatas.value = page.props.all_biodatas;
        allProposals.value = page.props.all_proposals;
        allTerms.value = page.props.all_terms;
    }, 500);

});


</script>


<template>


    <Head title="Dashboard" />

    <AdminLayout :translations :locale :locales>

        <div class="shadibari-container-main">

            <Header :translations :locale :locales :canLogin :canRegister />

            <div class="container max-w-screen-xl mx-auto">
                <div class="biodata_main w-full min-h-screen">
                    <TabGroup :selectedIndex="selectedTab" @change="changeTab">

                        <TabList class="relative flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                            <Tab v-slot="{ selected }" :class="['mx-2']">
                                <button
                                    :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                                    Biodatas
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" >
                                <button
                                    :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                                    Proposals
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" >
                                <button
                                    :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                                    Approved
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" >
                                <button
                                    :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                                    Others
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" >
                                <button
                                    :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                                    Contents
                                </button>
                            </Tab>

                        </TabList>


                        <TabPanels class=" ">

                            <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            ]">

                                <Biodata :translations :locale :locales :front_end_translations :all_biodatas="allBiodatas" :districts @onUpdateAllBiodatas="onUpdateAllBiodatas" />

                            </TabPanel>

                            <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            ]">

                                <Proposals :translations :locale :locales :front_end_translations :all_biodatas="allBiodatas" :all_proposals="allProposals" :districts @onUpdateAllProposals="onUpdateAllProposals" />

                            </TabPanel>

                            <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            ]">

                                <Approved :translations :locale :locales :front_end_translations :all_biodatas="allBiodatas" :biodata_updates :all_proposals="allProposals" :districts  @onUpdateAllBiodatas="onUpdateAllBiodatas" />

                            </TabPanel>

                            <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            ]">

                                <Others :translations :locale :locales :front_end_translations :all_biodatas="allBiodatas" :districts :all_terms="allTerms" @onUpdateAllTerms="onUpdateAllTerms" />

                            </TabPanel>

                            <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            ]">

                                <Content :translations />

                            </TabPanel>

                        </TabPanels>

                    </TabGroup>

                </div>
            </div>

        </div>

    </AdminLayout>

</template>

<style>
.logout_image{
    background: #fef1f6;
    border-radius: 4px;
    width: 25px;
    height: 25px;
    filter: grayscale(100%);
    transition: filter .29s ease 0s;
    padding: 5px;
    border-radius: 4px;
    object-fit: contain;
    object-position: center;
}
.od-localization-container {
    padding-left: 0 !important;
}
</style>
