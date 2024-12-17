<script setup>
import { ref } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import PersonalBiodata from '../../Components/User/PersonalBiodata.vue';
import PopupMessage from '../../Components/User/PopupMessage.vue';
import { usePage } from '@inertiajs/vue3';


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
const selectedTab = ref(0);
const disableTab1 = ref(true);
const disableTab2 = ref(true);
const disableTab3 = ref(true);
const disableTab4 = ref(true);
const modalMessage = ref({});
const isModalOpen = ref(false);
const runningTab = ref(0);


const closeModal = (value) => {
    isModalOpen.value = value;
}


function changeTab(index) {
    selectedTab.value = index;
}


const onCompleteTab = (nextIndex) => {
    switch(nextIndex) {
    case 1:
        disableTab1.value = false;
        runningTab.value = 1;
        break;
    case 2:
        disableTab2.value = false;
        runningTab.value = 2;
        break;
    case 3:
        disableTab3.value = false;
        runningTab.value = 3;
        break;
    case 4:
        disableTab4.value = false;
        runningTab.value = 4;
        break;
    }
    setTimeout(function(){
        selectedTab.value = nextIndex;
        if( page.props.flash.success ){
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.flash.success,
            }
            isModalOpen.value = true;
        }

    }, 500);
}


</script>


<template>
    <div class="w-full min-h-screen">
        <TabGroup :selectedIndex="selectedTab" @change="changeTab">

            <TabList class="flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" :class="['mx-2']">
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.personal_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab1" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.religious_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab2" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.family_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab3" >
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.targeted_biodata.title }}
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" :disabled="disableTab4">
                    <button
                        :class="['w-full px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
                        {{ translations.biodata_form.others_biodata.title }}
                    </button>
                </Tab>
            </TabList>



            <TabPanels class="mt-2">
                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">
                    <PersonalBiodata :translations :locale :locales @onCompleteTab="onCompleteTab" />
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
                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">
                    Content 5
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>

    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

</template>
