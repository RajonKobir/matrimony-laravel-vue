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
    'onSelectDistricts'
]);

const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
    Districts: {
        type: String,
    },
    districts: {
        type: Object,
    },
});

const selectedDistricts = ref([]);
const showPopup = ref(false);
const newDivisionId = ref('');
const districts_reversed = ref({});
const divisionNames = {
    '1' : { "name" : "Barishal", "bn_name" : "বরিশাল", },
    '2' : { "name": "Chattogram", "bn_name": "চট্টগ্রাম", },
    '3' : { "name": "Dhaka", "bn_name": "ঢাকা", },
    '4' : { "name": "Khulna", "bn_name": "খুলনা", },
    '5' : { "name": "Rajshahi", "bn_name": "রাজশাহী", },
    '6' : { "name": "Rangpur", "bn_name": "রংপুর", },
    '7' : { "name": "Sylhet", "bn_name": "সিলেট", },
    '8' : { "name": "Mymensingh", "bn_name": "ময়মনসিংহ", },
};

const showDivisionName = (divisionId) => {
    if( newDivisionId.value != divisionId ){
        newDivisionId.value = divisionId;
        return true;
    }else{
        return false;
    }
}


const onClickDistrictsItems = (e) => {
    if( selectedDistricts.value.includes("যেকোনো") || selectedDistricts.value.includes("Any") ){
        selectedDistricts.value = selectedDistricts.value.filter(function(item) {
            return item === "যেকোনো" || item === "Any";
        })
    }
    emits('onSelectDistricts', selectedDistricts.value);
};


onMounted(() => {
    if( props.Districts != null ){
        if( props.Districts != '' ){
            selectedDistricts.value = props.Districts.split(", ");
            emits('onSelectDistricts', selectedDistricts.value);
        }
    }

    districts_reversed.value = props.districts.reverse();

});


</script>


<template>
    <Listbox v-model="selectedDistricts" multiple>
        <ListboxButton @click="showPopup = !showPopup"
            class="relative appearance-none w-full text-left bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <span class="block truncate leading-tight">
                <ListboxLabel>{{ translations.biodata_form.deserved_biodata.deserved_district_title }}:</ListboxLabel>
                {{ selectedDistricts.map((district) => district).join(', ') }}
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

                    <div v-if="selectedDistricts.length > 0" @click="showPopup = false" class="okay_button px-4 py-2 font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm flex justify-center w-12">
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        <span>{{ translations.biodata_form.multiple_selection_ok }}</span>
                    </div>


                    <template v-for="district in districts_reversed" :key="district.id" >

                        <div v-if="[13, 17, 25, 33, 39, 50, 54, 64].includes(district.id)" class="relative flex items-center">
                            <div class="flex-grow border-t border-gray-400"></div>
                            <span class="flex-shrink mx-4 text-gray-400">
                                {{ locale == 'bn' ? divisionNames[district.division_id].bn_name + ' বিভাগ' :  divisionNames[district.division_id].name + ' Division' }}
                            </span>
                            <div class="flex-grow border-t border-gray-400"></div>
                        </div>

                        <ListboxOption @click="onClickDistrictsItems" v-slot="{ active, selected }" :value="locale == 'en' ? district.district_name : district.district_bn_name" as="template" :disabled="district.unavailable" >
                            <li :class="[
                                active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-10 pr-4',
                            ]">
                                <span :class="[
                                    selected ? 'font-medium' : 'font-normal',
                                    'block truncate',
                                ]">

                                    {{ locale == 'en' ? district.district_name : district.district_bn_name }}

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
