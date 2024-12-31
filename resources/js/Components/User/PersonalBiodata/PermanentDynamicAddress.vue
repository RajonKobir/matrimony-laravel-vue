<script setup>

import { ref, onMounted, onUpdated } from 'vue';
import axios from 'axios';

const emits = defineEmits([
    'onUpdatePermanentAddress'
]);


const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
    permanentAddress: {
        type: Object,
    },
});


// initializing
let innerHTML = ref('');
let selectedPermanentPostOffice = ref(props.permanentAddress.selectedPostOffice == null || props.permanentAddress.selectedPostCode == null ? props.translations.biodata_form.personal_biodata.permanent_address_title : props.permanentAddress.selectedPostOffice +' - '+ props.permanentAddress.selectedPostCode);
let selectCountryInnerHTML = ref(`<div class="odl-head">
        <button action="goBackHandler" class="od-location-picker-previous">
            <i action="goBackHandler" class="fa fa-arrow-left"></i>
        </button>
        <h3>${ props.translations.biodata_form.personal_biodata.permanent_address_title }</h3>
        <h3>${ props.translations.searchForm.select_country_heading }</h3>
        <button action="onClickClose" class="od-close-panel">
            <i action="onClickClose" class="fa fa-times"></i>
        </button>
    </div>
    <ul class="odl-nav">
        <li>
            <button action="countryClick" country_id="880" country_name="${ props.translations.searchForm.initial_country }" class="selected">
                ${ props.translations.searchForm.initial_country }
            </button>
        </li>
    </ul>`);
let selectDivisionInnerHTML = ref('');
let selectDistrictInnerHTML = ref('');
let selectUpazilaInnerHTML = ref('');
let selectPostCodeInnerHTML = ref('');
let isHidden = ref(true);
let isSearchAble = ref(false);
let currentLayer = ref('');
let selected_country_id = ref('');
let selectedCountry = ref('');
let selectedDivision = ref('');
let selectedDistrict = ref('');
let selectedUpazila = ref('');
let selectedPostOffice = ref('');
let selectedPostCode = ref('');



const addressHandler = (e) => {
    e.preventDefault();
    if( innerHTML.value == '' ){
        innerHTML.value = selectCountryInnerHTML.value;
    }
    isHidden.value = !isHidden.value;
    e.target.classList.toggle('dropdown_popup_amimation');
}


const handleLineClicks = (e) => {
    e.preventDefault();
    // let clickedAction = e.target.id;
    let clickedAction = e.target.getAttribute('action');


    if ( clickedAction === 'goBackHandler' ) {
        switch(currentLayer.value) {
        case "divisionClick":
            currentLayer.value = 'countryClick';
            innerHTML.value = selectCountryInnerHTML.value;
            break;
        case "districtClick":
            currentLayer.value = 'divisionClick';
            innerHTML.value = selectDivisionInnerHTML.value;
            break;
        case "upazilaClick":
            currentLayer.value = 'districtClick';
            innerHTML.value = selectDistrictInnerHTML.value;
            break;
        case "postcodeClick":
            currentLayer.value = 'upazilaClick';
            innerHTML.value = selectUpazilaInnerHTML.value;
            break;
        default:
            isHidden.value = !isHidden.value;
            e.target.classList.toggle('dropdown_popup_amimation');
        }
    }

    else if ( clickedAction === 'onClickClose' ) {
        isHidden.value = !isHidden.value;
    }


    else if ( clickedAction === 'countryClick' ) {
        let country_id = e.target.getAttribute('country_id');
        let country_name = e.target.getAttribute('country_name');
        selected_country_id.value = country_id;
        selectedCountry.value = country_name;
        axios.post(route('address.getDivisionsByCountryId', country_id))
        .then((response) => {
            selectDivisionInnerHTML.value = `<div class="odl-head">
                    <button action="goBackHandler" class="od-location-picker-previous">
                        <i action="goBackHandler" class="fa fa-arrow-left"></i>
                    </button>
                    <h3>${ props.translations.biodata_form.personal_biodata.permanent_address_title }</h3>
                    <h3>${ props.translations.searchForm.select_division_heading }</h3>
                    <button action="onClickClose" class="od-close-panel">
                        <i action="onClickClose" class="fa fa-times"></i>
                    </button>
                </div>
                <ul class="odl-nav">`;
            let division_id = '';
            let division_name = '';
            response.data.forEach(function(item, index, arr){
                division_id = item["division_id"];
                division_name = props.locale == 'en' ? item["division_name"] : item["division_bn_name"];
                selectDivisionInnerHTML.value += '<li>';
                selectDivisionInnerHTML.value += '<button action="divisionClick" division_id="'+division_id+'" division_name="'+division_name+'" >';
                selectDivisionInnerHTML.value += division_name;
                selectDivisionInnerHTML.value += '</button>';
                selectDivisionInnerHTML.value += '</li>';
            });

            selectDivisionInnerHTML.value += `</ul>`;
            innerHTML.value = selectDivisionInnerHTML.value;
            currentLayer.value = 'divisionClick';

        })
        .catch((error) => {
            console.log(error);
        })
    }

    else if( clickedAction === 'divisionClick') {
        let division_id = e.target.getAttribute('division_id');
        let division_name = e.target.getAttribute('division_name');
        selectedDivision.value = division_name;
        axios.post(route('address.getDistrictsByDivisionId', division_id))
        .then((response) => {
            selectDistrictInnerHTML.value = `<div class="odl-head">
                    <button action="goBackHandler" class="od-location-picker-previous">
                        <i action="goBackHandler" class="fa fa-arrow-left"></i>
                    </button>
                    <h3>${ props.translations.biodata_form.personal_biodata.permanent_address_title }</h3>
                    <h3>${ props.translations.searchForm.select_district_heading }</h3>
                    <button action="onClickClose" class="od-close-panel">
                        <i action="onClickClose" class="fa fa-times"></i>
                    </button>
                </div>
                <ul class="odl-nav">`;
            let district_id = '';
            let district_name = '';
            response.data.forEach(function(item, index, arr){
                district_id = item["district_id"];
                district_name = props.locale == 'en' ? item["district_name"] : item["district_bn_name"];
                selectDistrictInnerHTML.value += '<li>';
                selectDistrictInnerHTML.value += '<button action="districtClick" district_id="'+district_id+'" district_name="'+district_name+'" >';
                selectDistrictInnerHTML.value += district_name;
                selectDistrictInnerHTML.value += '</button>';
                selectDistrictInnerHTML.value += '</li>';
            });

            selectDistrictInnerHTML.value += `</ul>`;
            innerHTML.value = selectDistrictInnerHTML.value;
            currentLayer.value = 'districtClick';

        })
        .catch((error) => {
            console.log(error);
        })
    }

    else if( clickedAction === 'districtClick') {
        let district_id = e.target.getAttribute('district_id');
        let district_name = e.target.getAttribute('district_name');
        selectedDistrict.value = district_name;
        axios.post(route('address.getUpazilasByDistrictId', district_id))
        .then((response) => {
            selectUpazilaInnerHTML.value = `<div class="odl-head">
                    <button action="goBackHandler" class="od-location-picker-previous">
                        <i action="goBackHandler" class="fa fa-arrow-left"></i>
                    </button>
                    <h3>${ props.translations.biodata_form.personal_biodata.permanent_address_title }</h3>
                    <h3>${ props.translations.searchForm.select_upazila_heading }</h3>
                    <button action="onClickClose" class="od-close-panel">
                        <i action="onClickClose" class="fa fa-times"></i>
                    </button>
                </div>
                <ul class="odl-nav">`;
            let upazila_id = '';
            let upazila_name = '';
            let upazila_en_name = '';
            response.data.forEach(function(item, index, arr){
                upazila_id = item["upazila_id"];
                upazila_name = props.locale == 'en' ? item["upazila_name"] : item["upazila_bn_name"];
                upazila_en_name = item["upazila_name"];
                selectUpazilaInnerHTML.value += '<li>';
                selectUpazilaInnerHTML.value += '<button action="upazilaClick" upazila_en_name="'+upazila_en_name+'" upazila_name="'+upazila_name+'" >';
                selectUpazilaInnerHTML.value += upazila_name;
                selectUpazilaInnerHTML.value += '</button>';
                selectUpazilaInnerHTML.value += '</li>';
            });

            selectUpazilaInnerHTML.value += `</ul>`;
            innerHTML.value = selectUpazilaInnerHTML.value;
            currentLayer.value = 'upazilaClick';

        })
        .catch((error) => {
            console.log(error);
        })
    }

    else if( clickedAction === 'upazilaClick') {
        let upazila_en_name = e.target.getAttribute('upazila_en_name');
        let upazila_name = e.target.getAttribute('upazila_name');
        selectedUpazila.value = upazila_name;
        axios.post(route('address.getPostcodesByUpazilaName', upazila_en_name))
        .then((response) => {
            selectPostCodeInnerHTML.value = `<div class="odl-head">
                    <button action="goBackHandler" class="od-location-picker-previous">
                        <i action="goBackHandler" class="fa fa-arrow-left"></i>
                    </button>
                    <h3>${ props.translations.biodata_form.personal_biodata.permanent_address_title }</h3>
                    <h3>${ props.translations.searchForm.select_postoffice_heading }</h3>
                    <button action="onClickClose" class="od-close-panel">
                        <i action="onClickClose" class="fa fa-times"></i>
                    </button>
                </div>
                <ul class="odl-nav">`;
            let post_office_name = '';
            let post_code = '';
            response.data.forEach(function(item, index, arr){
                post_office_name = item["post_office_name"];
                post_code = item["post_code"];
                selectPostCodeInnerHTML.value += '<li>';
                selectPostCodeInnerHTML.value += '<button action="postcodeClick" post_office_name="'+post_office_name+'" post_code="'+post_code+'" >';
                selectPostCodeInnerHTML.value += post_office_name + ' - ' +post_code;
                selectPostCodeInnerHTML.value += '</button>';
                selectPostCodeInnerHTML.value += '</li>';
            });

            selectPostCodeInnerHTML.value += `</ul>`;
            innerHTML.value = selectPostCodeInnerHTML.value;
            currentLayer.value = 'postcodeClick';

        })
        .catch((error) => {
            console.log(error);
        })
    }

    else if( clickedAction === 'postcodeClick') {
        let post_office_name = e.target.getAttribute('post_office_name');
        let post_code = e.target.getAttribute('post_code');
        selectedPostOffice.value = post_office_name;
        selectedPostCode.value = post_code;

        selectedPermanentPostOffice.value = post_office_name + ' - ' +post_code;
        isHidden.value = true;
        e.target.classList.remove('dropdown_popup_amimation');
        isSearchAble.value = true;
        emits('onUpdatePermanentAddress', {
            selectedCountry : selectedCountry.value,
            selectedDivision : selectedDivision.value,
            selectedDistrict : selectedDistrict.value,
            selectedUpazila : selectedUpazila.value,
            selectedPostOffice : selectedPostOffice.value,
            selectedPostCode : selectedPostCode.value,
        });
    }

}




onMounted(() => {
    document.addEventListener('load', function (e) {
        setTimeout(function (e) {

        }, 1000);

    }, false);
});

onUpdated(() => {

});


</script>

<template>


    <!-- <div class="od-search-fields"> -->
    <div class="w-100" style="position: relative;">
        <div class="od-search-option-input">
            <div class="od-location-dropdown od-field-type__location od-biodata-search-control" data-field_id="10">
                <button @click="addressHandler" class="od-location-dropdown-trigger block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    {{ selectedPermanentPostOffice }}
                </button>
                <div v-if="!isHidden" v-html="innerHTML" @click="handleLineClicks" class="odl-wrap od-location-panel-wrap active dropdown_popup_amimation" >

                </div>
            </div>
        </div>
    </div>


</template>

<style>
.od-location-dropdown-trigger{
    height: 40px !important;
    color: inherit !important;
    font-size: inherit !important;
}
</style>
