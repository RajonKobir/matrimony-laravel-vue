<script setup>

import { Head, usePage, Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from "vue";
import PopupMessage from './PopupMessage.vue';
import PopupView from './PopupView.vue';


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
    sent_biodatas: {
        type: Object,
    },
    received_biodatas: {
        type: Object,
    },
    sent_proposals: {
        type: Object,
    },
    received_proposals: {
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
const isModalOpen = ref(false);
const modalMessage = ref({});
const all_biodatas = ref({});
const all_proposals = ref({});
const isPopupViewModalOpen = ref(false);
const modalInner = ref({});
const self_likes = ref({});
const likeReceiverUserIds = ref([]);
const proposalType = ref(1);
const freeOrPaidPrposal = ref(1);


const closeModal = (value) => {
    isModalOpen.value = value;
    isPopupViewModalOpen.value = value;
}


const onClickInterested = (single_proposal, single_biodata) => {
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
                all_proposals.value = response.data;

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


const onClickNotInterested = (single_proposal, single_biodata) => {
    if(confirm( props.translations.proposal_page.confirm_reject )){
        axios.post(route('user.proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_rejected : true,
            user_page : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateReceivedProposals', response.data);
                all_proposals.value = response.data;

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


const onClickSingleViewDetails = (single_biodata, tab_index) => {

    if( !props.single_biodata.is_approved ){
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.view_unapproved,
        }
        isModalOpen.value = true;
        return;
    }

    modalInner.value = {
        single_biodata,
        tab_index,
        proposals : all_proposals.value,
    }
    isPopupViewModalOpen.value = true;
}


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


const proposeType = (e) => {
    e.preventDefault();
    proposalType.value = e.target.value;
    if( proposalType.value == 1 ){
        all_biodatas.value = props.received_biodatas;
        all_proposals.value = props.received_proposals;
    }
    else if( proposalType.value == 2 ){
        all_biodatas.value = props.sent_biodatas;
        all_proposals.value = props.sent_proposals;
    }
}


const freeOrPaid = (e) => {
    e.preventDefault();
    freeOrPaidPrposal.value = e.target.value;
}


function extractDate(datetime) {
    return new Date(datetime).toISOString().split("T")[0];
}


function calculateHoursSince(startTime) {
    const start = new Date(startTime.replace(" ", "T"));
    const now = new Date();
    const diffMs = now - start;
    const hours = diffMs / (1000 * 60 * 60);
    return hours.toFixed(2);
}


const onUpdateReceivedProposals = (proposals) => {
    emits('onUpdateReceivedProposals', proposals);
    all_proposals.value = proposals;
}


watch(props, async (newValue, oldValue) => {
    if( newValue ){
        if( proposalType.value == 1 ){
            all_biodatas.value = props.received_biodatas;
            all_proposals.value = props.received_proposals;
        }
        if( proposalType.value == 2 ){
            all_biodatas.value = props.sent_biodatas;
            all_proposals.value = props.sent_proposals;
        }
    }
});


onMounted(() => {
    setTimeout(() => {
        single_biodata_data.value = props.single_biodata;

        if( proposalType.value == 1 ){
            all_biodatas.value = props.received_biodatas;
            all_proposals.value = props.received_proposals;
            all_biodatas.value.data = props.received_biodatas.data;
        }
        if( proposalType.value == 2 ){
            all_biodatas.value = props.sent_biodatas;
            all_proposals.value = props.sent_proposals;
            all_biodatas.value.data = props.sent_biodatas.data;
        }

        self_likes.value = props.likes;
        if( self_likes.value.length > 0 ){
            self_likes.value.forEach(function(item, index, arr){
                likeReceiverUserIds.value.push( item.receiver_user_id );
            })
        }

    }, 500);
})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.proposals.detailed");

</script>

<template>

    <Head title="Detailed Proposals" />

        <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

        <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" @onUpdateReceivedProposals="onUpdateReceivedProposals" />

            <div class="content-main">
            <div class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
                <div class="top-bg-content-container pt-[30px] md:pt-[40px]">
                    <div class="main-container">

                        <section class="common_section">

                            <div class="grid grid-cols-12 gap-0">

                                <div class="form_item col-span-6 md:col-start-3 md:col-span-4 p-2">
                                    <select v-model="proposalType" @change="proposeType" id="propose_type" name="propose_type" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="1">
                                            {{ translations.proposal_page.received_title }}
                                        </option>
                                        <option value="2">
                                            {{ translations.proposal_page.sent_title }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form_item col-span-6 md:col-span-4 p-2">
                                    <select v-model="freeOrPaidPrposal" @change="freeOrPaid" id="free_or_paid" name="free_or_paid" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="1">
                                            {{ translations.proposal_page.free_text }}
                                        </option>
                                        <option value="2">
                                            {{ translations.proposal_page.paid_text }}
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <table class="w-full table-fixed text-center text-gray-700 my-2">
                                <caption>
                                    <h2 class="text-center text-xl font-bold text-gray-800 my-2">
                                        {{ proposalType == 1 ? translations.proposal_page.received_title : translations.proposal_page.sent_title }} - {{ freeOrPaidPrposal == 1 ? translations.proposal_page.free_text : translations.proposal_page.paid_text }}
                                    </h2>
                                </caption>
                                <thead>
                                    <tr class="bg-[#ad277c] text-white">
                                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                                            {{ translations.proposal_page.table_heading_1 }}
                                        </th>
                                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                                            {{ translations.proposal_page.table_heading_2 }}
                                        </th>
                                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                                            {{ translations.proposal_page.table_heading_3 }}
                                        </th>
                                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                                            {{ translations.proposal_page.table_heading_4 }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="all_biodatas.total > 0">
                                    <tr v-for="(single_biodata, single_biodata_key) in all_biodatas.data" :key="single_biodata_key" class="bg-white hover:bg-[#f9e0f0]">
                                    <template v-if="(freeOrPaidPrposal == 1 && all_proposals[single_biodata_key].free_proposal) || (freeOrPaidPrposal == 2 && !all_proposals[single_biodata_key].free_proposal)">
                                        <td class="py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                                            {{ all_biodatas.data.length - single_biodata_key }}
                                        </td>
                                        <td class="py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                                            {{ single_biodata.biodata_code }}
                                        </td>
                                        <td class="py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                                            {{ extractDate(all_proposals[single_biodata_key].proposal_sent_datetime) + ' (' + calculateHoursSince(all_proposals[single_biodata_key].proposal_sent_datetime) + 'h)' }}
                                        </td>
                                        <td class="py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                                            <template v-if="proposalType == 1 && !all_proposals[single_biodata_key].proposal_rejected && !all_proposals[single_biodata_key].proposal_accepted">
                                                <div class="flex flex-col sm:flex-row justify-center items-center gap-1">
                                                    <button type="button" @click="onClickInterested(all_proposals[single_biodata_key], single_biodata)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                                                        {{ translations.proposal_page.interested }}
                                                    </button>
                                                    <button type="button" @click="onClickNotInterested(all_proposals[single_biodata_key], single_biodata)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                                                        {{ translations.proposal_page.not_interested }}
                                                    </button>
                                                    <button type="button" @click="onClickSingleViewDetails(single_biodata, 0)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                                                        {{ translations.profile_page.details_title }}
                                                    </button>
                                                </div>
                                            </template>
                                            <template v-else>
                                                {{ all_proposals[single_biodata_key].proposal_status }}
                                            </template>
                                        </td>
                                    </template>
                                    </tr>
                                </tbody>

                                <tfoot >
                                    <tr >
                                        <td colspan="4" class="text-center">
                                            <template v-if="all_biodatas.total == 0">
                                                <h3 class="p-2 text-center">
                                                    {{ props.translations.proposal_page.sent_no_items_title }}
                                                </h3>
                                            </template>

                                            <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                                <template v-for=" (link, index) in all_biodatas.links" :key="index">
                                                    <Link
                                                        preserve-state
                                                        v-if="link.url && !link.active"
                                                        :href="link.url"
                                                        class="pagination-link px-1 border-2"
                                                        v-html="link.label"
                                                    />
                                                </template>
                                            </div>

                                        </td>
                                    </tr>
                                </tfoot>

                            </table>



                            <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                <Link :href="route('user.profile')" method="get"  as="button" class="bg-green-700 p-2 rounded-lg !text-white hover:!text-black hover:bg-green-100 transition-all font-bold" >
                                    BackToProfile
                                </Link>
                            </div>

                        </section>

                    </div>
                </div>
            </div>

        </div>

</template>
