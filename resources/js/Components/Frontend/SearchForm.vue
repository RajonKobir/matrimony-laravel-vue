<script setup>

import { ref, onMounted, onUpdated } from 'vue';
import axios from 'axios';

const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
});

let test = '<button onclick="countryClick" country_id="880" class="selected">বাংলাদেশ</button>';

let innerHTML = ref('');
// let innerHTML = ref(test);
let isHidden = ref(true);
const addressHandler = (e) => {
    e.preventDefault();
    isHidden.value = !isHidden;
    e.target.classList.toggle('dropdown_popup_amimation');
}


const countryClick = (e) => {
    e.preventDefault();
    // innerHTML.value = '';
    // alert('dgdgd');
    // return;
    let country_id = e.currentTarget.getAttribute('country_id');
    axios.post(route('address.getDivisionsByCountryId', country_id))
        .then((res) => {
            //   alert(res.data[0]["id"]);
            innerHTML.value = '';
            innerHTML.value = '<button onclick="alert()">';
            innerHTML.value += res.data[0]["division_bn_name"];
            innerHTML.value += '</button>';
            // res.data.forEach(function (item, index, arr) {
            //     innerHTML.value += props.locale == 'en' ? item["division_name"] : item["division_bn_name"];
            //     innerHTML.value += '&#nbsp;';
            // });
            // alert(innerHTML.value);
        })
        .catch((error) => {
            console.log(error);
        })
}


onMounted(() => {
    document.addEventListener('load', function () {
        setTimeout(function () {

        }, 1000);

    }, false);
});

onUpdated(() => {

});


</script>

<template>


    <div class="od-search-option">
        <div class="od-search-fields">
            <div class="od-search-option-label">আমি খুঁজছি</div>
            <div class="od-search-option-input">
                <select name="search_gender">
                    <option value="no_selected" data-select2-id="3">সকল</option>
                    <option value="3">পাত্রের বায়োডাটা</option>
                    <option value="4">পাত্রীর বায়োডাটা</option>
                </select>
            </div>
        </div>
        <div class="od-search-fields">
            <div class="od-search-option-label">বৈবাহিক অবস্থা</div>
            <div class="od-search-option-input">
                <select name="search_marriage_status">
                    <option value="no_selected" data-select2-id="6">সকল</option>
                    <option value="5">অবিবাহিত</option>
                    <option value="6">বিবাহিত</option>
                    <option value="7">ডিভোর্সড</option>
                    <option value="8">বিধবা</option>
                    <option value="9">বিপত্নীক</option>
                </select>
            </div>
        </div>

        <div class="od-search-fields">
            <div class="od-search-option-label">স্থায়ী ঠিকানা</div>
            <div class="od-search-option-input">
                <div class="od-location-dropdown od-field-type__location od-biodata-search-control" data-field_id="10">
                    <button @click="addressHandler" class="od-location-dropdown-trigger">
                        ঠিকানা নির্বাচন করুন
                    </button>
                    <div v-if="!isHidden" class="odl-wrap od-location-panel-wrap active dropdown_popup_amimation"
                        data-parent_name="বাংলাদেশ">
                        <div class="odl-head">
                            <button @click="isHidden = !isHidden" class="od-location-picker-previous">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                            <h3>দেশ নির্বাচন করুন</h3>
                            <button @click="isHidden = !isHidden" class="od-close-panel">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="od-form-group-input">
                            <input class="location-search" data-target="country" type="search" placeholder="দেশ খুঁজুন">
                        </div>
                        <ul class="odl-nav">
                            <li>
                                <button @click="countryClick" country_id="880" class="selected">বাংলাদেশ</button>
                            </li>
                            <li v-html="innerHTML"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="od-search-fields odsf-submit">
            <div class="od-submit-btn">
                <button type="button" class="od-button"><i class="fa fa-search"></i>&nbsp;
                    খুঁজুন</button>
            </div>
        </div>
    </div>

</template>
