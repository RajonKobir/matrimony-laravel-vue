<script setup>
import { ref, onMounted } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import PopupMessage from './PopupMessage.vue';
import { usePage } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';


const emits = defineEmits([
    'onUpdateEducationTab'
]);


defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Array,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user.id;
const single_biodata = ref([]);
// const selectedEducationTab = ref(0);
const modalMessage = ref({});
const isModalOpen = ref(false);


const closeModal = (value) => {
    isModalOpen.value = value;
}


// function changeEducationTab(index) {
//     emits('onUpdateEducationTab');
//     selectedEducationTab.value = index;
//     return false;
// }



onMounted(() => {



});



</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />


    <div class="w-full">

        <h6 class="text-center">Education</h6>

        <!-- <TabGroup :selectedIndex="selectedEducationTab" @change="changeEducationTab" > -->
        <TabGroup manual >

            <TabList class="flex justify-end space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" :class="['mx-2']">
                    <span
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.education_medium_general_title }}
                    </span>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <span
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.education_medium_aliya_title }}
                    </span>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <span
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.education_medium_kowmi_title }}
                    </span>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <span
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.education_medium_others_title }}
                    </span>
                </Tab>
            </TabList>



            <TabPanels class="mt-2">
                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <div class="form_item col-span-2 p-2">
                        <select  @change="(e) => { single_biodata.general_highest_degree = e.target.value }" id="general_highest_degree" name="general_highest_degree"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="null" disabled selected >{{ translations.biodata_form.personal_biodata.general_highest_degree_title }}</option>
                            <option v-for="(general_highest_degree, general_highest_degree_key) in translations.biodata_form.personal_biodata.general_highest_degree_options" :key="general_highest_degree_key" :value="general_highest_degree">{{ general_highest_degree }}</option>
                        </select>

                    </div>

                </TabPanel>
                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">
                    Content 2
                </TabPanel>
                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">
                    Content 3
                </TabPanel>
                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">
                    Content 4
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>


</template>
