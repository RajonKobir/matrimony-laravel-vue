<script setup>
import { ref, onMounted } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';
import PopupMessage from './PopupMessage.vue';
import PopupView from './PopupView.vue';
import axios from 'axios';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-dt';
import Responsive from 'datatables.net-responsive-dt';
import jszip from 'jszip';
import pdfmake from 'pdfmake/build/pdfmake';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print.min';
import 'pdfmake/build/vfs_fonts';
import 'datatables.net-select-dt';


DataTable.use(DataTablesCore);
DataTable.use(Responsive);
DataTablesCore.Buttons.jszip(jszip);
DataTablesCore.Buttons.pdfMake(pdfmake);


const emits = defineEmits([
    'onUpdateAllBiodatas'
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
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user.id;
const isPopupMessageModalOpen = ref(false);
const isPopupViewModalOpen = ref(false);
const modalInner = ref({});
const viewBiodata = ref({});
let dt;
const table = ref();
const selectedUsernames = ref([]);


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
            targets: [1,2],
            visible: false,
        },
        {
            targets: 5,
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
                            selectedUsernames.value = selectedData.map(row => row[2]); // Extract ids only

                            modalInner.value = {
                                modalHeading : 'Take Actions!',
                                modalDescription : 'The selected UserIDs are: ' + selectedUsernames.value,
                                showButtons : true,
                                trashIds : selectedUsernames.value,
                                approvePage: false,
                                trashPage: false,
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


const onClickView = (single_biodata) => {

    let username = single_biodata.user_email ? '<a class="text-lg underline" href="mailto:' + single_biodata.user_email + '">' + single_biodata.user_email + '</a>' : '<a class="text-lg underline" href="callto:' + single_biodata.user_mobile + '">' + single_biodata.user_mobile + '</a>';

    viewBiodata.value = single_biodata;

    modalInner.value = {
        modalHeading : 'The Biodata of username: ' + username,
        viewBiodata,
        showTakeAction: false,
        showAllData: true,
    }
    isPopupViewModalOpen.value = true;
}


const onClickTakeAction = (single_biodata) => {

    let username = single_biodata.user_email ? '<a class="text-lg underline" href="mailto:' + single_biodata.user_email + '">' + single_biodata.user_email + '</a>' : '<a class="text-lg underline" href="callto:' + single_biodata.user_mobile + '">' + single_biodata.user_mobile + '</a>';

    viewBiodata.value = single_biodata;

    modalInner.value = {
        modalHeading : 'The Biodata of username: ' + username,
        viewBiodata,
        showTakeAction: true,
        showAllData: false,
    }
    isPopupViewModalOpen.value = true;
}


const onClickApprove = (user_id) => {
    if(confirm("Are you sure?")){
        axios.post(route('backend.biodata.single_approve', {
            csrf_token,
            user_id,
            is_approved : false
        }))
        .then((response) => {
            emits('onUpdateAllBiodatas', response.data);
            dt.rows( function ( idx, data, node ) {
                return data[2] == user_id ? true : false;
            }).remove().draw();
            modalInner.value = {
                modalHeading : 'Success!',
                modalDescription :  + ' has been unapproved successfully.',
                showButtons : false
            }
            isPopupMessageModalOpen.value = true;
        });
    }
}


const onClickMoveToTrash = (single_biodata) => {

    let username = single_biodata.user_email ? single_biodata.user_email : single_biodata.user_mobile;
    let user_id = single_biodata.user_id;

    if(confirm("Are you sure?")){
        axios.post(route('backend.biodata.single_trash', {
            csrf_token,
            user_id,
            in_admin_trash : true
        }))
        .then((response) => {
            emits('onUpdateAllBiodatas', response.data);
            dt.rows( function ( idx, data, node ) {
                return data[2] == user_id ? true : false;
            }).remove().draw();
            modalInner.value = {
                modalHeading : 'Success!',
                modalDescription : 'The Biodata of username: ' + username + ' has been sent to admin trash successfully.',
                showButtons : false
            }
            isPopupMessageModalOpen.value = true;
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
            emits('onUpdateAllBiodatas', response.data);
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
            emits('onUpdateAllBiodatas', response.data);
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

const onClickMultipleApprove = (user_ids) => {
    if(confirm("Are you sure?")){
        isPopupMessageModalOpen.value = false;
        axios.post(route('backend.biodata.multiple_approve', {
            csrf_token,
            user_ids,
            is_approved : true
        }))
        .then((response) => {
            emits('onUpdateAllBiodatas', response.data);
            dt.rows('.selected').remove().draw();
            modalInner.value = {
                modalHeading : 'Success!',
                modalDescription : 'The Biodata of user_ids:' + user_ids + ' have been approved Successfully.',
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
document.body.classList.add("backend.biodata.approved");


</script>


<template>

    <Head title="Incompleted Biodata" />

    <PopupMessage :translations :isPopupMessageModalOpen :modalInner @closeModal=closeModal @onClickMultipleTrash="onClickMultipleTrash" @onClickMultipleAction="onClickMultipleAction" @onClickMultipleUnApprove="onClickMultipleUnApprove" @onClickMultipleApprove="onClickMultipleApprove"  />

    <PopupView :translations :locale :locales :front_end_translations :districts :isPopupViewModalOpen :modalInner @closeModal=closeModal />

    <div class="biodata_main w-full min-h-screen">

        <DataTable v-if="all_biodatas.length > 0" ref="table" id="myTable" :options="options" class="display responsive  stripe row-border hover order-column nowrap" style="width:100%">
            <caption>
                <!-- Table Title -->
                <h2 class="text-center text-xl font-bold text-gray-800 my-4">
                    Incomplete Biodatas Table
                </h2>
            </caption>
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="selectAll" />
                    </th>
                    <th>Id</th>
                    <th>User Id</th>
                    <!-- <th>Approved</th> -->
                    <th>Biodata Code</th>
                    <th>Biodata Completion</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="single_biodata in all_biodatas"
                :key="single_biodata.id">
                    <tr v-if="!single_biodata.is_approved && parseInt(single_biodata.biodata_completion) < 100 && ( !single_biodata.in_admin_trash || single_biodata.in_admin_trash == 0 )">
                        <td></td>
                        <td>{{ single_biodata.id }}</td>
                        <td>{{ single_biodata.user_id }}</td>
                        <!-- <td>{{ single_biodata.is_approved ? 'yes' : 'no' }}</td> -->
                        <td>{{ single_biodata.biodata_code }}</td>
                        <td>{{ single_biodata.biodata_completion }}%</td>
                        <td class="truncate">{{ single_biodata.user_email }}</td>
                        <td>{{ single_biodata.user_mobile }}</td>
                        <td>
                            <div class="flex flex-col sm:flex-row justify-center items-center gap-1">
                                <button type="button" @click="onClickView(single_biodata)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                    View
                                </button>
                                <button type="button" @click="onClickTakeAction(single_biodata)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                    Action
                                </button>
                                <button type="button" @click="onClickMoveToTrash(single_biodata)" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                                    Trash
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
