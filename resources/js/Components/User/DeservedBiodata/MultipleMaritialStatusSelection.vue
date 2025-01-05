<script setup>
import { ref, onMounted } from 'vue';
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue';
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid';

const emits = defineEmits([
    'onSelectMaritialStatuses'
]);

const props = defineProps({
    translations: {
        type: Object,
    },
    maritialStatuses: {
        type: String,
    },
    gender: {
        type: String,
    },
});

const selectedMaritialStatuses = ref([]);
const showPopup = ref(false);


const onClickMaritialStatusesItems = (e) => {
    if( selectedMaritialStatuses.value.includes("যেকোনো") || selectedMaritialStatuses.value.includes("Any") ){
            Object.keys(props.translations.biodata_form.religious_biodata.islamic_studies_options).forEach(function(item, index, arr){
            if( index != 0 ){
                selectedMaritialStatuses.value = selectedMaritialStatuses.value.filter(function(item) {
                    return item === "যেকোনো" || item === "Any";
                })

            }
        });
    }
    emits('onSelectMaritialStatuses', selectedMaritialStatuses.value);
};


onMounted(() => {
    if( props.maritialStatuses != null ){
        if( props.maritialStatuses != '' ){
            selectedMaritialStatuses.value = props.maritialStatuses.split(", ");
            emits('onSelectMaritialStatuses', selectedMaritialStatuses.value);
        }
    }
});


</script>


<template>
    <Listbox v-model="selectedMaritialStatuses" multiple>
        <ListboxButton @click="showPopup = !showPopup"
            class="relative appearance-none w-full text-left bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <span class="block truncate leading-tight">
                <ListboxLabel>{{ translations.biodata_form.deserved_biodata.deserved_maritial_statuses_title }}:</ListboxLabel>
                {{ selectedMaritialStatuses.map((maritial_status) => maritial_status).join(', ') }}
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

                    <div v-if="selectedMaritialStatuses.length > 0" @click="showPopup = false" class="okay_button px-4 py-2 font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm flex justify-center w-12">
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        <span>{{ translations.biodata_form.multiple_selection_ok }}</span>
                    </div>

                    <template v-for="(maritial_status, maritial_status_key) in translations.biodata_form.deserved_biodata.deserved_maritial_statuses_options" :key="maritial_status.id">


                        <ListboxOption @click="onClickMaritialStatusesItems" v-slot="{ active, selected }" :value="maritial_status" v-if="(gender == 'female' && maritial_status_key != 'widow_no_child' && maritial_status_key != 'widow_with_child' ) || (gender == 'male' && maritial_status_key != 'widower_no_child' && maritial_status_key != 'widower_with_child' )" as="template" :disabled="maritial_status.unavailable" >
                            <li :class="[
                                active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-10 pr-4',
                            ]">
                                <span :class="[
                                    selected ? 'font-medium' : 'font-normal',
                                    'block truncate',
                                ]">

                                    {{ maritial_status }}

                                </span>

                                <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 ">
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                            </li>
                        </ListboxOption>


                    </template>

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
