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
    'onSelectMultipleCategories'
]);

const props = defineProps({
    translations: {
        type: Object,
    },
    MultipleCategories: {
        type: Object,
    },
});

const selectedMultipleCategories = ref([]);
const showPopup = ref(false);


const onClickMultipleCategoriesItems = (e) => {
    if( selectedMultipleCategories.value.includes("যেকোনো") || selectedMultipleCategories.value.includes("Any") ){
        selectedMultipleCategories.value = selectedMultipleCategories.value.filter(function(item) {
            return item === "যেকোনো" || item === "Any";
        })
    }
    emits('onSelectMultipleCategories', selectedMultipleCategories.value);
};



onMounted(() => {
    if( props.MultipleCategories != null ){
        if( props.MultipleCategories != '' ){
            selectedMultipleCategories.value = props.MultipleCategories.split(",");
            emits('onSelectAkidaMajhabs', selectedMultipleCategories.value);
        }
    }
});


</script>


<template>
    <Listbox v-model="selectedMultipleCategories" multiple  >
        <ListboxButton @click="showPopup = !showPopup"
            class="relative appearance-none w-full text-left bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <span class="block truncate leading-tight">
                <ListboxLabel>{{ props.translations.searchForm.special_search_4_category_title }}:</ListboxLabel>
                {{ selectedMultipleCategories.map((categories) => categories).join(', ') }}
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </span>
        </ListboxButton>

        <div v-show="showPopup">

            <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
                leave-to-class="opacity-0">

                <ListboxOptions static
                    class="popup_categories_section absolute mt-1 h-60  overflow-auto rounded-md bg-white border border-gray-400 hover:border-gray-500 px-4 py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">

                    <div v-if="selectedMultipleCategories.length > 0" @click="showPopup = false" class="okay_button px-4 py-2 font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm flex justify-center w-12">
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        <span>{{ translations.biodata_form.multiple_selection_ok }}</span>
                    </div>

                    <ListboxOption @click="onClickMultipleCategoriesItems" v-slot="{ active, selected }" v-for="(categories, categories_key) in props.translations.searchForm.special_search_4_category_options" :key="categories_key" :value="categories" as="template" :disabled="categories.unavailable" >
                        <li :class="[
                            active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                            'relative cursor-default select-none py-2 pl-10 pr-4',
                        ]">
                            <span :class="[
                                selected ? 'font-medium' : 'font-normal',
                                'block truncate',
                            ]">

                                {{ categories }}

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
.popup_categories_section{
    width: 18rem;
    z-index: 999;
}
@media screen and (max-width: 768px) {
    .popup_categories_section{
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
