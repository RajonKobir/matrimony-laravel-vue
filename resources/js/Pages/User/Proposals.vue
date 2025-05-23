<script setup>

import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import ReceivedProposals from '../../Components/User/Proposals/ReceivedProposals.vue';
import SentProposals from '../../Components/User/Proposals/SentProposals.vue';
import DetailedProposals from '../../Components/User/Proposals/DetailedProposals.vue';


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
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    single_biodata: {
        type: Object,
    },
    sent_biodatas: {
        type: Object,
    },
    all_sent_biodatas: {
        type: Object,
    },
    received_biodatas: {
        type: Object,
    },
    all_received_biodatas: {
        type: Object,
    },
    sent_proposals: {
        type: Object,
    },
    all_sent_proposals: {
        type: Object,
    },
    received_proposals: {
        type: Object,
    },
    all_received_proposals: {
        type: Object,
    },
    likes: {
        type: Object,
    },
});

// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const single_biodata_data = ref([]);
const selectedTab = ref(0);
const receivedProposals = ref({});
const sentProposals = ref({});

const tabMapping = {
  1: 'received',
  2: 'sent',
  3: 'detailed',
};

function changeTab(index) {
    selectedTab.value = index;
    router.get(route('user.proposals'), { index }, { preserveState: true, replace: true });
}


const onUpdateReceivedProposals = (proposals) => {
    receivedProposals.value = proposals;
    receivedProposals.value = receivedProposals.value.filter((value, index, self) => value.proposal_rejected !== false);
}


onMounted(() => {

    const urlTab = parseInt(new URLSearchParams(window.location.search).get('index')) || 0;
    if (tabMapping[urlTab]) {
        selectedTab.value = urlTab;
    }

    setTimeout(() => {

        single_biodata_data.value = page.props.single_biodata;

        receivedProposals.value = props.received_proposals;

        sentProposals.value = props.sent_proposals;

        receivedProposals.value = receivedProposals.value.filter((value, index, self) => value.proposal_rejected !== false);

        sentProposals.value = sentProposals.value.filter((value, index, self) => value.proposal_rejected !== false);

    }, 500);
})


</script>

<template>


    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata="single_biodata_data">

        <div class="bg-[#3BA038] p-4">
            <h1 class="od-banner-text">{{ translations.proposal_page.page_title }}</h1>
        </div>

        <div class="biodata_main w-full min-h-screen">
            <TabGroup :selectedIndex="selectedTab" @change="changeTab">

                <TabList class="flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                    <Tab v-slot="{ selected }" :class="['mx-2']">
                        <button
                            :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-gray-950 hover:bg-white/[0.12] hover:text-white',]">
                            {{ translations.proposal_page.received_title }}
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-gray-950 hover:bg-white/[0.12] hover:text-white',]">
                            {{ translations.proposal_page.sent_title }}
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-gray-950 hover:bg-white/[0.12] hover:text-white',]">
                            {{ translations.proposal_page.details_title }}
                        </button>
                    </Tab>

                </TabList>


                <TabPanels class="">

                    <TabPanel :class="['rounded-xl bg-white', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]">

                        <ReceivedProposals :translations :locale :locales  :single_biodata="single_biodata_data" :biodatas="received_biodatas" :proposals="receivedProposals" :likes @onUpdateReceivedProposals="onUpdateReceivedProposals" />

                    </TabPanel>

                    <TabPanel :class="['rounded-xl bg-white', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]">

                        <SentProposals :translations :locale :locales  :single_biodata="single_biodata_data" :biodatas="sent_biodatas" :proposals="sentProposals" :likes />

                    </TabPanel>

                    <TabPanel :class="['rounded-xl bg-white', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]">

                        <DetailedProposals :translations :locale :locales  :single_biodata="single_biodata_data" :sent_biodatas="all_sent_biodatas" :received_biodatas="all_received_biodatas" :sent_proposals="all_sent_proposals" :received_proposals="all_received_proposals" :likes @onUpdateReceivedProposals="onUpdateReceivedProposals" />

                    </TabPanel>

                </TabPanels>

            </TabGroup>

        </div>

    </AuthenticatedLayout>

</template>
