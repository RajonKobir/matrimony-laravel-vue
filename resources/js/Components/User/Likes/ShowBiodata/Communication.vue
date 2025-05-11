<script setup>
import { ref, onMounted } from 'vue';
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
    self_biodata: {
        type: Object,
    },
    proposal: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const isModalOpen = ref(false);
const modalMessage = ref({});
const updatedProposal = ref({});


const closeModal = (value) => {
    isModalOpen.value = value;
}


const onClickInterested = (single_proposal) => {
    if( confirm( props.translations.proposal_page.confirm_accept ) ){
        axios.post(route('user.proposals.single_accept', {
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
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.modal_messages.success_accept,
                    showButtons : false
                }
                isModalOpen.value = true;

            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.modal_messages.success_accept_error,
                    showButtons : false
                }
                isModalOpen.value = true;
            }

        });
    }
}


const onClickNotInterested = (single_proposal) => {
    if(confirm( props.translations.proposal_page.confirm_reject )){

        // initializing
        let rejected_by_sender = false;
        let rejected_by_receiver = false;
        if( page.props.auth.user.id == single_proposal.sender_user_id ){
            rejected_by_sender = true;
        }
        else if( page.props.auth.user.id == single_proposal.receiver_user_id ){
            rejected_by_receiver = true;
        }

        axios.post(route('user.proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_rejected : true,
            proposal_accepted : false,
            rejected_by_sender,
            rejected_by_receiver,
            user_page : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateReceivedProposals', response.data);
                updatedProposal.value.proposal_rejected = true;
                updatedProposal.value.proposal_accepted = false;
                updatedProposal.value.rejected_by_sender = rejected_by_sender;
                updatedProposal.value.rejected_by_receiver = rejected_by_receiver;

                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.modal_messages.success_reject,
                    showButtons : false
                }
                isModalOpen.value = true;

            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.modal_messages.success_reject_error,
                    showButtons : false
                }
                isModalOpen.value = true;
            }

        });
    }
}


const onClickRemoveProposal = (single_proposal) => {
    if(confirm( props.translations.proposal_page.confirm_remove )){

        // initializing
        let rejected_by_sender = false;
        let rejected_by_receiver = false;
        if( page.props.auth.user.id == single_proposal.sender_user_id ){
            rejected_by_sender = true;
        }
        else if( page.props.auth.user.id == single_proposal.receiver_user_id ){
            rejected_by_receiver = true;
        }

        axios.post(route('user.proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_rejected : true,
            proposal_accepted : false,
            rejected_by_sender,
            rejected_by_receiver,
            user_page : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateReceivedProposals', response.data);
                updatedProposal.value.proposal_rejected = true;
                updatedProposal.value.proposal_accepted = false;
                updatedProposal.value.rejected_by_sender = rejected_by_sender;
                updatedProposal.value.rejected_by_receiver = rejected_by_receiver;
                modalMessage.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The proposal has been removed successfully.',
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

        updatedProposal.value = props.proposal;

    }, 500);

});


</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

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
                            <p v-if="single_biodata.gender == 'male'" class="text-base text-left">
                                <span class="text-lg text-left font-bold">
                                    {{ translations.proposal_page.communication_title_male }}
                                </span>
                                <span class="text-base text-left pl-2">
                                    {{ single_biodata.form_holder_desc }}
                                </span>
                            </p>
                            <p class="text-base text-left">
                                <span class="text-lg text-left font-bold">
                                    {{ translations.proposal_page.communication_title_guardian }}
                                </span>
                                <span class="text-base text-left pl-2">
                                    {{ single_biodata.male_guardian_desc }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <button type="button" @click="onClickRemoveProposal(updatedProposal)" class="text-xs bg-red-500 hover:bg-red-700 !text-white font-bold py-2 px-4 rounded-full">
                        Remove
                    </button>
                </div>

            </template>

            <template v-if="!updatedProposal.proposal_accepted">

                <template v-if="updatedProposal.proposal_rejected">
                    <h1 v-if="updatedProposal.rejected_by_sender" class="text-center py-4">
                        {{ translations.proposal_page.rejected_by_sender }}
                    </h1>
                    <h1 v-else class="text-center py-4">
                        {{ translations.proposal_page.rejected_by_receiver }}
                    </h1>
                </template>

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
                            <p v-if="single_biodata.gender == 'male'" class="text-base text-left">
                                <span class="text-lg text-left font-bold">
                                    {{ translations.proposal_page.communication_title_male }}
                                </span>
                                <span class="text-base text-left pl-2">
                                    {{ single_biodata.form_holder_desc }}
                                </span>
                            </p>
                            <p class="text-base text-left">
                                <span class="text-lg text-left font-bold">
                                    {{ translations.proposal_page.communication_title_guardian }}
                                </span>
                                <span class="text-base text-left pl-2">
                                    {{ single_biodata.male_guardian_desc }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <button type="button" @click="onClickRemoveProposal(updatedProposal)" class="text-xs bg-red-500 hover:bg-red-700 !text-white font-bold py-2 px-4 rounded-full">
                        Remove
                    </button>
                </div>

            </template>

            <template v-if="!updatedProposal.proposal_accepted">

                <template v-if="updatedProposal.proposal_rejected">
                    <h1 v-if="updatedProposal.rejected_by_receiver" class="text-center py-4">
                        {{ translations.proposal_page.rejected_by_sender }}
                    </h1>
                    <h1 v-else class="text-center py-4">
                        {{ translations.proposal_page.rejected_by_receiver_page }}
                    </h1>
                </template>

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


</template>
