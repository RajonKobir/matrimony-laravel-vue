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
    'onSelectEducationMedium'
]);

const props = defineProps({
    translations: {
        type: Object,
    },
    educationMediums: {
        type: String,
    },
});

const selectedEducationMediums = ref([]);


const onClickEducationMediumItems = (e) => {

    if( selectedEducationMediums.value.length > 0 ){
        let popedItem = selectedEducationMediums.value.pop();

        const temp_arr = popedItem.split("(");
        selectedEducationMediums.value.forEach(function(item, index, arr){
            if( item.includes(temp_arr[0]) ){
                selectedEducationMediums.value.splice(index, 1);
            }
        });

        selectedEducationMediums.value.push(popedItem);
    }

    emits('onSelectEducationMedium', selectedEducationMediums.value);
};


onMounted(() => {
    if( props.educationMediums != null ){
        if( props.educationMediums != '' ){
            selectedEducationMediums.value = props.educationMediums.split(", ");
            emits('onSelectEducationMedium', selectedEducationMediums.value);
        }
    }
});


</script>


<template>
    <Listbox v-model="selectedEducationMediums" multiple>
        <ListboxButton
            class="relative appearance-none w-full text-left bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <span class="block truncate leading-tight">
                <ListboxLabel>{{ translations.biodata_form.personal_biodata.education_medium_title }}:</ListboxLabel>
                {{ selectedEducationMediums.map((medium_of_study) => medium_of_study).join(', ') }}
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </span>
        </ListboxButton>

        <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
            leave-to-class="opacity-0">

            <ListboxOptions
                class="popup_jobs_section absolute mt-1 h-60  overflow-auto rounded-md bg-white border border-gray-400 hover:border-gray-500 px-4 py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">

                <ListboxOption @click="onClickEducationMediumItems" v-slot="{ active, selected }" v-for="(medium_of_study, medium_of_study_key) in translations.biodata_form.personal_biodata.education_medium_options" :key="medium_of_study_key" :value="medium_of_study" as="template" :disabled="medium_of_study.unavailable" >
                    <li :class="[
                        active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                        'relative cursor-default select-none py-2 pl-10 pr-4',
                    ]">
                        <span :class="[
                            selected ? 'font-medium' : 'font-normal',
                            'block truncate',
                        ]">

                            {{ medium_of_study }}

                        </span>

                        <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 ">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ListboxOption>

            </ListboxOptions>

        </transition>

    </Listbox>
</template>


<style>
.popup_jobs_section{
    width: 45%;
}
</style>
