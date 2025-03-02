<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage, Head } from '@inertiajs/vue3';
import PopupMessage from './PopupMessage.vue';
import PopupView from './PopupView.vue';
import axios from 'axios';


const emits = defineEmits([
    'onUpdateAllTerms'
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
    all_terms: {
        type: Object,
    },
});


// initializing
const page = usePage();
// const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user.id;
const isModalOpen = ref(false);
const modalMessage = ref({});
const modalInner = ref({});
const isPopupViewModalOpen = ref(false);
const allTerms = ref({});


const onAddedSingleTerm = (term) => {
    allTerms.value.push(term);
    emits('onUpdateAllTerms', allTerms.value);
}


const closeModal = (value) => {
    isModalOpen.value = value;
    isPopupViewModalOpen.value = value;
}


const onClickAddNew = (e) => {
    modalInner.value = {
        onEdit: false,
        onView: false,
        addNew: true,
        single_term: {},
    };
    isPopupViewModalOpen.value = true;
}

const onClickView = (single_term) => {
    modalInner.value = {
        onView: true,
        addNew: false,
        onEdit: false,
        single_term: single_term,
    };
    isPopupViewModalOpen.value = true;
}

const onClickEdit = (single_term) => {
    modalInner.value = {
        onView: false,
        addNew: false,
        onEdit: true,
        single_term: single_term,
    };
    isPopupViewModalOpen.value = true;
}

const onClickDelete = (single_term) => {
    if(confirm("Are you sure?")){
        axios.post(route('backend.terms.destroy', single_term.id))
        .then((response) => {
            if( response.data ){
                emits('onUpdateAllTerms', response.data);
                allTerms.value = response.data;
                modalMessage.value = {
                    modalHeading : 'Success!',
                    modalDescription : 'The term has been deleted successfully.',
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

    allTerms.value = props.all_terms;

});


</script>


<template>



    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

    <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" @onAddedSingleTerm="onAddedSingleTerm" />

    <div class="biodata_main w-full min-h-screen">

        <div class="main-container">

            <div class="flex flex-row justify-center items-center gap-1">
                <button @click="onClickAddNew" type="button"  class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                    Add New
                </button>
            </div>

            <table class="w-full table-fixed text-center text-gray-700 my-4">
                <thead>
                    <tr class="bg-[#ad277c] text-white">
                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                            Serial
                        </th>
                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                            Question
                        </th>
                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                            Answer
                        </th>
                        <th class="py-2 px-3 w-1/4 sm:w-auto text-sm md:text-base">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody v-if="allTerms.length > 0">
                    <tr v-for="(single_term, single_term_key) in allTerms" :key="single_term_key" class="bg-white hover:bg-[#f9e0f0]">
                        <td class="py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                            {{ single_term.serial_no }}
                        </td>
                        <td class="truncate py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                            {{ single_term.question }}
                        </td>
                        <td class="truncate py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                            {{ single_term.answer }}
                        </td>
                        <td class="py-2 px-3 text-[#ad277c] break-words text-sm sm:text-base">
                            <div class="flex flex-col sm:flex-row justify-center items-center gap-1">
                                <button @click="onClickView(single_term)" type="button"  class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                                    View
                                </button>
                                <button @click="onClickEdit(single_term)" type="button"  class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                                    Edit
                                </button>
                                <button @click="onClickDelete(single_term)" type="button"  class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-1 px-2 sm:py-2 sm:px-4 rounded-full">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>

                <tfoot >
                    <tr >
                        <td colspan="4" class="text-center">
                            <template v-if="allTerms.length == 0">
                                <h3 class="p-2 text-center">
                                    No Items!
                                </h3>
                            </template>
                        </td>
                    </tr>
                </tfoot>

            </table>

        </div>

    </div>

</template>
