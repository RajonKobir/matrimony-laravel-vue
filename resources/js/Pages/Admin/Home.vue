<script setup>
import { ref } from 'vue';
import { Link, usePage, Head } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import Biodata from '../../Components/Admin/Biodata/Biodata.vue';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import Header from '../../Components/Admin/Header.vue';
import Content from '../../Components/Admin/Content/Content.vue';


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
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
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
const selectedTab = ref(0);


function changeTab(index) {
    selectedTab.value = index;
}


const onUpdateAllBiodatas = (biodatas) => {
    page.props.all_biodatas = biodatas;
}


</script>


<template>

    <Head title="Dashboard" />

    <AdminLayout :translations :locale :locales>

        <Header :translations :locale :locales :canLogin :canRegister />

        <div class="biodata_main w-full min-h-screen">
            <TabGroup :selectedIndex="selectedTab" @change="changeTab">

                <TabList class="relative flex justify-center space-x-1 rounded-xl bg-blue-900/20 p-1">
                    <Tab v-slot="{ selected }" :class="['mx-2']">
                        <button
                            :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                            Biodatas
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                            Users
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                            Likes
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                            Messages
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                            Packages
                        </button>
                    </Tab>
                    <Tab v-slot="{ selected }" >
                        <button
                            :class="['w-full px-1 md:px-4 rounded-lg py-2.5 text-sm font-medium leading-5', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2', selected ? 'bg-white text-blue-700 shadow' : 'text-slate-800 hover:bg-white/[0.12] hover:text-white',]">
                            Contents
                        </button>
                    </Tab>

                </TabList>


                <TabPanels class=" ">

                    <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]">

                        <Biodata :translations :all_biodatas @onUpdateAllBiodatas="onUpdateAllBiodatas" />

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

                    <TabPanel :class="['rounded-xl bg-white p-3', 'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]">

                        <Content :translations />

                    </TabPanel>

                </TabPanels>

            </TabGroup>

        </div>

    </AdminLayout>

</template>

<style>
.logout_image{
    background: #fef1f6;
    border-radius: 4px;
    width: 25px;
    height: 25px;
    filter: grayscale(100%);
    transition: filter .29s ease 0s;
    padding: 5px;
    border-radius: 4px;
    object-fit: contain;
    object-position: center;
}
.od-localization-container {
    padding-left: 0 !important;
}
</style>
