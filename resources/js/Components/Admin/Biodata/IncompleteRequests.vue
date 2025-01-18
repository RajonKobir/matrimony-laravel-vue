<script setup>
import { ref, watch, onMounted } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';
import PopupMessage from './PopupMessage.vue';
import DataTable from 'datatables.net-dt';
import axios from 'axios';


const emits = defineEmits([
    'onUpdateAllBiodatas'
]);

defineProps({
    translations: {
        type: Object,
    },
    all_biodatas: {
        type: Object,
    },
});

// initializing
const page = usePage();
// const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user["id"];
// const single_biodata = ref([]);
const modalMessage = ref({});
const isModalOpen = ref(false);
const table = ref({});


const closeModal = (value) => {
    isModalOpen.value = value;
}



watch(page, async (newValue, oldValue) => {
    if( newValue ){
        if( newValue.props.flash.success ){
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.flash.success,
            }
            isModalOpen.value = true;
        }
        else if( newValue.props.flash.error ){
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : page.props.flash.error,
            }
            isModalOpen.value = true;
        }
    }
});


const onClickApprove = (user_id) => {
    if(confirm("Are you sure?")){
        axios.post(route('backend.biodata.approve', {
            user_id,
            is_approved : true
        }))
        .then((response) => {
            emits('onUpdateAllBiodatas', response.data);
            table.value.destroy();
            setTimeout(() => {
                table.value = new DataTable('#myTable', {
                    responsive: true
                });
            }, 500);
        });
    }
}


onMounted(() => {

    table.value = new DataTable('#myTable', {
        responsive: true
    });

});



document.body.classList.remove(...document.body.classList);
document.body.classList.add("backend.biodata.incomplete");



</script>


<template>

    <Head title="Incomplete Requests" />

    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

    <div class="biodata_main w-full min-h-screen">

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>Approved</th>
                    <th>Biodata Code</th>
                    <th>Biodata Completion</th>
                    <th>Running Tab</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="single_biodata in all_biodatas"
                :key="single_biodata.id">
                    <tr v-if="!single_biodata.is_approved && parseInt(single_biodata.biodata_completion) < 100">
                        <td>{{ single_biodata.id }}</td>
                        <td>{{ single_biodata.user_id }}</td>
                        <td>{{ single_biodata.is_approved ? 'yes' : 'no' }}</td>
                        <td>{{ single_biodata.biodata_code }}</td>
                        <td>{{ single_biodata.biodata_completion }}%</td>
                        <td>{{ single_biodata.running_tab }}</td>
                        <td>
                            <button @click="onClickApprove(single_biodata.user_id)" class="text-xs bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                Approve
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

    </div>

</template>
