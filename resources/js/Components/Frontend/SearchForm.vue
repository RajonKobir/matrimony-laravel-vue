<script setup>

import { ref } from 'vue';
import DynamicAddress from './DynamicAddress.vue';


const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
});


// initializing
let isDisabled = ref(true);


const updateIsDisabled = (trueOrFalse) => {
    isDisabled.value = trueOrFalse;
}


const searchButtonClick = (e) => {
    e.preventDefault();
    alert("Search button is clicked!");
}


</script>

<template>

    <div class="od-search-option">
        <div class="od-search-fields">
            <div class="od-search-option-label">{{ props.translations.searchForm.dropdown_1_heading }}</div>
            <div class="od-search-option-input">
                <select name="search_gender">
                    <option value="no_selected">{{ props.translations.searchForm.dropdown_1_option_1 }}</option>
                    <option value="1">{{ props.translations.searchForm.dropdown_1_option_2 }}</option>
                    <option value="2">{{ props.translations.searchForm.dropdown_1_option_3 }}</option>
                </select>
            </div>
        </div>
        <div class="od-search-fields">
            <div class="od-search-option-label">{{ props.translations.searchForm.dropdown_2_heading }}</div>
            <div class="od-search-option-input">
                <select name="search_marriage_status">
                    <option value="no_selected" >{{ props.translations.searchForm.dropdown_2_option_1 }}</option>
                    <option value="5">{{ props.translations.searchForm.dropdown_2_option_2 }}</option>
                    <option value="6">{{ props.translations.searchForm.dropdown_2_option_3 }}</option>
                    <option value="7">{{ props.translations.searchForm.dropdown_2_option_4 }}</option>
                    <option value="8">{{ props.translations.searchForm.dropdown_2_option_5 }}</option>
                </select>
            </div>
        </div>

        <DynamicAddress :translations :locale :isDisabled=isDisabled  @updateIsDisabled=updateIsDisabled />

        <div class="od-search-fields odsf-submit">
            <div class="od-submit-btn">
                <button @click="searchButtonClick" type="button" class="od-button" :disabled="isDisabled" >
                    <i class="fa fa-search"></i>
                    &nbsp;{{ props.translations.searchForm.search_indicator }}
                </button>
            </div>
        </div>


    </div>

</template>
