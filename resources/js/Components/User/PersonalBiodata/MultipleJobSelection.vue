<script setup>
import { ref, onMounted, watch } from 'vue';
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue';
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid';

const emits = defineEmits([
    'onSelectJobs'
]);

const props = defineProps({
    translations: {
        type: Object,
    },
    jobTitles: {
        type: String,
    },
    gender: {
        type: String,
    },
});

// initializing
const selectedJobs = ref([]);
const showPopup = ref(false);


const onClickJobItems = (e) => {
    if( selectedJobs.value.includes("নাই") || selectedJobs.value.includes("None") ){
        selectedJobs.value = selectedJobs.value.filter(function(item) {
            return item === "নাই" || item === "None";
        })
    }
    else if( selectedJobs.value.length > 3 ){
        selectedJobs.value.pop();
    }
    emits('onSelectJobs', selectedJobs.value);
};

if ( props.jobTitles ){
    selectedJobs.value = props.jobTitles.split(", ");
}


onMounted(() => {
    if( props.jobTitles != null ){
        if( props.jobTitles != '' ){
            selectedJobs.value = props.jobTitles.split(", ");
            emits('onSelectJobs', selectedJobs.value);
        }
    }
});


watch(props, async (newValue, oldValue) => {
    if( newValue ){
        if( newValue.jobTitles ){
            selectedJobs.value = newValue.jobTitles.split(", ");
        }
        else if( newValue.jobTitles == null ){
            selectedJobs.value = [];
        }
    }
})


</script>


<template>
    <Listbox v-model="selectedJobs" multiple>
        <ListboxButton @click="showPopup = !showPopup"
            class="relative appearance-none w-full text-left bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <span class="block truncate leading-tight">
                <ListboxLabel>{{ translations.biodata_form.personal_biodata.job_title_title }}:</ListboxLabel>
                {{ selectedJobs.map((job_title) => job_title).join(', ') }}
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </span>
        </ListboxButton>

        <div v-show="showPopup">

            <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
                leave-to-class="opacity-0">

                <ListboxOptions static
                    class="popup_jobs_section absolute mt-1 h-60  overflow-auto rounded-md bg-white border border-gray-400 hover:border-gray-500 px-4 py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">

                    <div v-if="selectedJobs.length > 0" @click="showPopup = false" class="okay_button px-4 py-2 font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm flex justify-center w-12">
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        <span>{{ translations.biodata_form.multiple_selection_ok }}</span>
                    </div>

                    <ListboxOption @click="onClickJobItems" v-slot="{ active, selected }" v-for="(job_title, job_title_key) in translations.biodata_form.personal_biodata.job_title_options" :key="job_title_key" :value="gender == 'female' ? job_title.replace('শিক্ষক', 'শিক্ষিকা') : job_title" as="template" :disabled="job_title.unavailable" >
                        <li :class="[
                            active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                            'relative cursor-default select-none py-2 pl-10 pr-4',
                        ]">
                            <span :class="[
                                selected ? 'font-medium' : 'font-normal',
                                'block truncate',
                            ]">

                                {{ gender == 'female' ? job_title.replace('শিক্ষক', 'শিক্ষিকা') : job_title }}

                            </span>

                            <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 ">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>

                </ListboxOptions>

            </transition>

        </div>

    </Listbox>
</template>


<style>
.popup_jobs_section{
    width: 45%;
    z-index: 999;
}
@media screen and (max-width: 768px) {
    .popup_jobs_section{
        width: 90% !important;
    }
}
.okay_button {
  position: sticky;
  top: 0;
  margin-left: auto;
  margin-right: auto;
  z-index: 999;
  cursor: pointer;
}
</style>
