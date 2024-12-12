<script setup>
import { ref } from 'vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import DatePicker from './DatePicker.vue';


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

const media_agreement = ref(false);
const selected_gender = ref('');

const mediaAgreement = (e) => {
    e.preventDefault();
    if (e.target.value == 'yes') {
        media_agreement.value = true;
    }
}

const selectGender = (e) => {
    e.preventDefault();
    if (e.target.value == 'male') {
        selected_gender.value = 'male';
    }
    else if (e.target.value == 'female') {
        selected_gender.value = 'female';
    }
    // alert(e.target.value);
}

</script>


<template>
    <div class="grid grid-cols-2 gap-1">

        <div v-if="!media_agreement" class="form_item">
            <label for="media_agreement">{{ translations.biodata_form.personal_biodata.media_agreement }}</label>
            <select @change="mediaAgreement" id="media_agreement" name="media_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>{{ translations.form_basics.select_text }}</option>
                <option value="yes">{{ translations.form_basics.inshallah_yes }}</option>
                <option value="no">{{ translations.form_basics.no }}</option>
            </select>
        </div>

        <div v-if="media_agreement">
            <div class="form_item">
                <label for="select_gender">{{ translations.biodata_form.personal_biodata.select_gender }}</label>
                <select @change="selectGender" id="select_gender" name="select_gender"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>{{ translations.form_basics.select_text }}</option>
                    <option value="male">{{ translations.biodata_form.personal_biodata.select_gender_male }}</option>
                    <option value="female">{{ translations.biodata_form.personal_biodata.select_gender_female }}</option>
                </select>
            </div>
            <div class="form_item">
                <DatePicker />
            </div>
        </div>

    </div>
</template>
