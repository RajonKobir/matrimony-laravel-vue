<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage, Head } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';


defineProps({
    translations: {
        type: Object,
    },
});


// initializing
const page = usePage();
// const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user.id;
// const single_biodata = ref([]);
const selectedTab = ref(0);


function changeTab(index) {
    selectedTab.value = index;
}


</script>


<template>

    <Head title="Dashboard" />

    <div class="biodata_main w-full min-h-screen">
        <TabGroup :selectedIndex="selectedTab" @change="changeTab">

            <TabList class="relative flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" :class="['mx-2']">
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                        Translations
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" >
                    <button
                        :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                        File Manager
                    </button>
                </Tab>

            </TabList>


            <TabPanels class="mt-2">

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <iframe width="100%" src="/translations" class="min-h-screen"></iframe>

                </TabPanel>

                <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                ]">

                    <iframe width="100%" src="/filemanager" class="min-h-screen"></iframe>

                </TabPanel>

            </TabPanels>

        </TabGroup>

    </div>

</template>
