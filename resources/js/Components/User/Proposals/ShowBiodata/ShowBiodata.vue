<script setup>
import { ref, onMounted } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import PersonalBiodata from './PersonalBiodata/PersonalBiodata.vue';
import ReligiousBiodata from './ReligiousBiodata/ReligiousBiodata.vue';
import FamilyBiodata from './FamilyBiodata/FamilyBiodata.vue';
import DeservedBiodata from './DeservedBiodata/DeservedBiodata.vue';
import ShowBiodataUpper from './ShowBiodataUpper.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import PopupMessage from '../PopupMessage.vue';


const emits = defineEmits([
    'onUpdateReceivedProposals'
]);


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
    proposal: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const selectedTab = ref(0);
const isModalOpen = ref(false);
const modalMessage = ref({});
const updatedProposal = ref({});


const closeModal = (value) => {
    isModalOpen.value = value;
}


function changeTab(index) {
    selectedTab.value = index;
}


const onClickInterested = (single_proposal) => {
    if( confirm( props.translations.proposal_page.confirm_accept ) ){
        axios.post(route('proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_accepted : true,
            user_page : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateReceivedProposals', response.data);
                updatedProposal.value.proposal_accepted = true;
                modalMessage.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The proposal has been accepted successfully.',
                    showButtons : false
                }
                isModalOpen.value = true;
            }else{
                modalMessage.value = {
                    modalHeading : 'Error!',
                    modalDescription : 'Something went wrong.',
                    showButtons : false
                }
                isModalOpen.value = true;
            }

        });
    }
}


const onClickNotInterested = (single_proposal) => {
    if(confirm( props.translations.proposal_page.confirm_reject )){
        axios.post(route('proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_rejected : true,
            user_page : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateReceivedProposals', response.data);
                updatedProposal.value.proposal_rejected = true;
                modalMessage.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The proposal has been rejected successfully.',
                    showButtons : false
                }
                isModalOpen.value = true;
            }else{
                modalMessage.value = {
                    modalHeading : 'Error!',
                    modalDescription : 'Something went wrong.',
                    showButtons : false
                }
                isModalOpen.value = true;
            }

        });
    }
}


onMounted(() => {

    setTimeout(() => {
        if( typeof props.tab_index !== 'undefined' ){
            selectedTab.value =  props.tab_index;
        }

        updatedProposal.value = props.proposal;

    }, 500);

});


</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

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
                <Tab v-slot="{ selected }" >
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

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <template v-if="$page.props.auth.user.id == updatedProposal.sender_user_id">

                        <template v-if="!updatedProposal.in_trash && !updatedProposal.in_admin_trash">

                            <template v-if="updatedProposal.proposal_accepted">

                                    <h1 v-if="!updatedProposal.auto_received" class="text-center py-4">
                                        {{ translations.proposal_page.accepted_message }}
                                    </h1>
                                    <h1 v-if="updatedProposal.auto_received" class="text-center py-4">
                                        {{ translations.proposal_page.media_accepted_message }}
                                    </h1>
                                    <div class="container">
                                        <div class="grid grid-cols-12 gap-0">
                                            <div class="form_item col-span-12 md:col-span-6 p-2">
                                                <p class="text-base text-left">
                                                    <span class="text-lg text-left font-bold">
                                                        {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}
                                                    </span>
                                                    <span class="text-base text-left pl-2">
                                                        {{ single_biodata.form_holder_desc }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                            </template>

                            <template v-if="!updatedProposal.proposal_accepted">

                                <h1 v-if="updatedProposal.proposal_rejected" class="text-center py-4">
                                    {{ translations.proposal_page.proposal_rejected }}
                                </h1>

                                <h1 v-if="!updatedProposal.proposal_rejected" class="text-center py-4">
                                    {{ translations.proposal_page.success_propose_message }}
                                </h1>

                            </template>

                        </template>

                        <template v-if="updatedProposal.in_trash || updatedProposal.in_admin_trash">
                            <h1 class="text-center py-4">
                                Proposal Deleted
                            </h1>
                        </template>

                    </template>

                    <template v-if="$page.props.auth.user.id == updatedProposal.receiver_user_id">

                        <template v-if="!updatedProposal.in_trash && !updatedProposal.in_admin_trash">

                            <template v-if="updatedProposal.proposal_accepted">

                                    <h1 v-if="!updatedProposal.auto_received" class="text-center py-4">
                                        {{ translations.proposal_page.accepted_by_receiver }}
                                    </h1>
                                    <h1 v-if="updatedProposal.auto_received" class="text-center py-4">
                                        {{ translations.proposal_page.media_accepted_message }}
                                    </h1>
                                    <div class="container">
                                        <div class="grid grid-cols-12 gap-0">
                                            <div class="form_item col-span-12 md:col-span-6 p-2">
                                                <p class="text-base text-left">
                                                    <span class="text-lg text-left font-bold">
                                                        {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}
                                                    </span>
                                                    <span class="text-base text-left pl-2">
                                                        {{ single_biodata.form_holder_desc }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                            </template>

                            <template v-if="!updatedProposal.proposal_accepted">

                                <h1 v-if="updatedProposal.proposal_rejected" class="text-center py-4">
                                    {{ translations.proposal_page.rejected_message_sender }}
                                </h1>

                                <template v-if="!updatedProposal.proposal_rejected">
                                    <h1 class="text-center py-4">
                                        {{ translations.proposal_page.proposal_received }}
                                    </h1>

                                    <div class="flex flex-col sm:flex-row justify-center items-center gap-1">
                                        <button type="button" @click="onClickInterested(updatedProposal)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                            {{ translations.proposal_page.interested }}
                                        </button>
                                        <button type="button" @click="onClickNotInterested(updatedProposal)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                            {{ translations.proposal_page.not_interested }}
                                        </button>
                                    </div>

                                </template>


                            </template>

                            </template>

                            <template v-if="updatedProposal.in_trash || updatedProposal.in_admin_trash">
                            <h1 class="text-center py-4">
                                Proposal Deleted
                            </h1>
                            </template>

                    </template>

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
