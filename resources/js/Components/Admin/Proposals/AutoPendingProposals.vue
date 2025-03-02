<script setup>
import { ref, onMounted } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';
import PopupMessage from './PopupMessage.vue';
import axios from 'axios';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-dt';
import Responsive from 'datatables.net-responsive-dt';
import jszip from 'jszip';
import pdfmake from 'pdfmake/build/pdfmake';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print.min';
import 'pdfmake/build/vfs_fonts';
// import 'datatables.net-buttons/js/buttons.html5';
// import 'datatables.net-responsive-dt';
// import 'datatables.net-dt';
// import 'datatables.net-buttons-dt';
import 'datatables.net-select-dt';


DataTable.use(DataTablesCore);
DataTable.use(Responsive);
DataTablesCore.Buttons.jszip(jszip);
DataTablesCore.Buttons.pdfMake(pdfmake);


const emits = defineEmits([
    'onUpdateAllProposals'
]);

const props = defineProps({
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
    all_biodatas: {
        type: Object,
    },
    all_proposals: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user.id;
const isPopupMessageModalOpen = ref(false);
const isPopupViewModalOpen = ref(false);
const modalInner = ref({});
let dt;
const table = ref();
const selectedRowIds = ref([]);


const options = ref({
    responsive: true,
    responsive: {
        details: {
            // type: 'column',
            // target: 'tr',
            alwaysVisible: false,
        },
    },
    select: true,
    select: {
        style: 'multi',
    },
    columnDefs: [
        {
            targets: 0,
            orderable: false,
            className: 'select-checkbox',
        },
        {
            targets: 1,
            responsivePriority: 2,
        },
        {
            targets: -1,
            orderable: false,
            className: 'action_buttons',
            responsivePriority: 1,
        },
    ],
    layout: {
        top2: 'buttons',
        top: {
            buttons: [
                {
                    text: 'Perform Action on Selected',
                    className: 'btn btn-primary',
                    action: function (e, dt, node, config) {
                        if (dt.rows({ selected: true }).count() > 0) {
                            const selectedData = dt.rows({ selected: true }).data().toArray(); // Get selected rows data
                            selectedRowIds.value = selectedData.map(row => row[2]); // Extract ids only

                            modalInner.value = {
                                modalHeading : 'Take Actions!',
                                modalDescription : 'The selected UserIDs are: ' + selectedRowIds.value,
                                showButtons : true,
                                trashIds : selectedRowIds.value,
                                approvePage: true
                            }
                            isPopupMessageModalOpen.value = true;
                        }else{
                            modalInner.value = {
                                modalHeading : 'A problem occured!',
                                modalDescription : 'Please select at least one row.',
                                showButtons : false
                            }
                            isPopupMessageModalOpen.value = true;
                        }
                    },
                },
            ]
        },
        topStart: 'pageLength',
        topEnd: 'search',
        bottomStart: 'info',
        bottomEnd: 'paging',
    },
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print' // Add buttons as needed ('selectAll', 'selectNone')
    ],
});


const onClickInterested = (single_proposal) => {

    if(confirm("Are you sure?")){
        axios.post(route('backend.proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_accepted : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateAllProposals', response.data);
                // dt.rows( function ( idx, data, node ) {
                //     return data[2] == user_id ? true : false;
                // }).remove().draw();
                dt.rows('.selected').remove().draw();
                modalInner.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The proposal has been accepted successfully.',
                    showButtons : false
                }
                isPopupMessageModalOpen.value = true;
            }else{
                modalInner.value = {
                    modalHeading : 'Error!',
                    modalDescription : 'Something went wrong.',
                    showButtons : false
                }
                isPopupMessageModalOpen.value = true;
            }

        });
    }
}


const onClickNotInterested = (single_proposal) => {

    if(confirm("Are you sure?")){
        axios.post(route('backend.proposals.single_accept', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            proposal_rejected : true,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateAllProposals', response.data);
                dt.rows('.selected').remove().draw();
                modalInner.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The proposal has been rejected successfully.',
                    showButtons : false
                }
                isPopupMessageModalOpen.value = true;
            }else{
                modalInner.value = {
                    modalHeading : 'Error!',
                    modalDescription : 'Something went wrong.',
                    showButtons : false
                }
                isPopupMessageModalOpen.value = true;
            }

        });
    }
}


const onClickCancel = (single_proposal) => {

    if(confirm("Are you sure?")){
        axios.post(route('backend.proposals.single_cancel', {
            csrf_token,
            sender_user_id : single_proposal.sender_user_id,
            receiver_user_id : single_proposal.receiver_user_id,
            free_proposal : single_proposal.free_proposal,
        }))
        .then((response) => {
            if( response.data ){
                emits('onUpdateAllProposals', response.data);
                dt.rows('.selected').remove().draw();
                modalInner.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The proposal has been canceled successfully.',
                    showButtons : false
                }
                isPopupMessageModalOpen.value = true;
            }else{
                modalInner.value = {
                    modalHeading : 'Error!',
                    modalDescription : 'Something went wrong.',
                    showButtons : false
                }
                isPopupMessageModalOpen.value = true;
            }

        });
    }
}


const onClickMultipleTrash = (user_ids) => {
    if(confirm("Are you sure?")){
        isPopupMessageModalOpen.value = false;
        axios.post(route('backend.biodata.multiple_trash', {
            csrf_token,
            user_ids,
            in_admin_trash : true
        }))
        .then((response) => {
            emits('onUpdateAllProposals', response.data);
            dt.rows('.selected').remove().draw();
            modalInner.value = {
                modalHeading : 'Success!',
                modalDescription : 'The Biodata of user_ids:' + user_ids + ' have been moved to trash Successfully.',
                showButtons : false
            }
            isPopupMessageModalOpen.value = true;
        });
    }
}

const onClickMultipleAction = (user_ids) => {
    if(confirm("Are you sure?")){
        isPopupMessageModalOpen.value = false;
        alert('onClickMultipleAction');
    }
}

const onClickMultipleUnApprove = (user_ids) => {
    if(confirm("Are you sure?")){
        isPopupMessageModalOpen.value = false;
        axios.post(route('backend.biodata.multiple_approve', {
            csrf_token,
            user_ids,
            is_approved : false
        }))
        .then((response) => {
            emits('onUpdateAllProposals', response.data);
            dt.rows('.selected').remove().draw();
            modalInner.value = {
                modalHeading : 'Success!',
                modalDescription : 'The Biodata of user_ids:' + user_ids + ' have been unapproved Successfully.',
                showButtons : false
            }
            isPopupMessageModalOpen.value = true;
        });
    }
}


const closeModal = (value) => {
    isPopupMessageModalOpen.value = value;
    isPopupViewModalOpen.value = value;
    modalInner.value = {};
    page.props.flash = [];
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


onMounted(() => {

    setTimeout(() => {
        if( table.value ){
            dt = table.value.dt;
        }
        // Handle the Select All checkbox functionality
        if( document.getElementById('selectAll') ){
            document.getElementById('selectAll').addEventListener('change', function () {
                if (this.checked) {
                    dt.rows().select();
                } else {
                    dt.rows().deselect();
                }
            });
        }

    }, 1000);

    // document.addEventListener('DOMContentLoaded', function () {

    // });

});



document.body.classList.remove(...document.body.classList);
document.body.classList.add("backend.proposals.auto_pending");


</script>


<template>

    <Head title="Auto Pending Proposals" />

    <PopupMessage :translations :isPopupMessageModalOpen :modalInner @closeModal=closeModal @onClickMultipleTrash="onClickMultipleTrash" @onClickMultipleAction="onClickMultipleAction" @onClickMultipleUnApprove="onClickMultipleUnApprove" />

    <div class="biodata_main w-full min-h-screen">

        <DataTable v-if="all_proposals.length > 0" ref="table" id="myTable" :options="options" class="display responsive  stripe row-border hover order-column nowrap" style="width:100%">
            <caption>
                <!-- Table Title -->
                <h2 class="text-center text-xl font-bold text-gray-800 my-4">
                    Auto Pending Proposals Table
                </h2>
            </caption>
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="selectAll" />
                    </th>
                    <!-- <th>Id</th> -->
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Free</th>
                    <th>Status</th>
                    <th>Datetime</th>
                    <th>AcceptedDatetime</th>
                    <th>RejectedDatetime</th>
                    <th>AutoReceivedDatetime</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="single_proposal in all_proposals"
                :key="single_proposal.id">
                    <tr v-if="!single_proposal.in_trash && calculateHoursSince(single_proposal.proposal_sent_datetime) > 12 && single_proposal.proposal_status == 'Pending'">
                        <td></td>
                        <!-- <td>{{ single_proposal.id }}</td> -->
                        <td>{{ single_proposal.sender_biodata_code }}</td>
                        <td>{{ single_proposal.receiver_biodata_code }}</td>
                        <td>{{ single_proposal.free_proposal ? 'yes' : 'no' }}</td>
                        <td>{{ single_proposal.proposal_status }}</td>
                        <td>{{ extractDate(single_proposal.proposal_sent_datetime) + ' (' + calculateHoursSince(single_proposal.proposal_sent_datetime) + 'h)' }}</td>
                        <td>{{ single_proposal.proposal_accepted_datetime }}</td>
                        <td>{{ single_proposal.proposal_rejected_datetime }}</td>
                        <td>{{ single_proposal.auto_received_datetime }}</td>
                        <td>
                            <div class="flex flex-col sm:flex-row justify-center items-center gap-1">
                                <button type="button" @click="onClickInterested(single_proposal)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                    {{ props.front_end_translations.proposal_page.interested }}
                                </button>
                                <button type="button" @click="onClickNotInterested(single_proposal)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                    {{ props.front_end_translations.proposal_page.not_interested }}
                                </button>
                                <button type="button" @click="onClickCancel(single_proposal)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                    {{ props.front_end_translations.proposal_page.cancel_request }}
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </DataTable>

    </div>

</template>


<style>
@import 'datatables.net-dt';
@import 'datatables.net-buttons-dt';
@import 'datatables.net-select-dt';
@import 'datatables.net-responsive-dt';

@media only screen and (max-width: 768px) {
    div.dt-buttons > .dt-button{
        padding: 0.5em !important;
    }
    table.dataTable th.dt-type-numeric, table.dataTable th.dt-type-date, table.dataTable td.dt-type-numeric, table.dataTable td.dt-type-date {
        text-align: center !important;
    }
    table.dataTable > thead > tr.action_buttons > th, table.dataTable > thead > tr > td{
        padding: 0 !important;
    }
    table.dataTable > tbody > tr > th, table.dataTable > tbody > tr > td{
        padding: 0 0 !important;
    }
    .action_buttons{
        width: 70% !important;
    }

}

.action_button{
    padding: 0.5em 1em;
    margin: 0.2em;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.action_button:hover{
    background-color: #0056b3;
}

</style>
