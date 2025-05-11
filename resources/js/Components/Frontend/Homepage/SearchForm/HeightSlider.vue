<script setup>
import { ref, h } from 'vue';
import { Range } from 'vue-range-multi';
import 'vue-range-multi/style.css';


const emits = defineEmits([
    'onUpdateHeightSlider'
]);


const props = defineProps({
    translations: {
        type: Object,
    },
    heightRange: {
        type: String,
    },
});


const getKeyByValue = (object, value) => {
    return Object.keys(object).find(key =>
        object[key] === value);
}


const height_state = ref( props.heightRange == null ? [1, 31] : [ parseInt( getKeyByValue(props.translations.biodata_form.deserved_biodata.deserved_height_range_options, props.heightRange.split("-")[0].trim()) ), parseInt( getKeyByValue(props.translations.biodata_form.deserved_biodata.deserved_height_range_options, props.heightRange.split("-")[1].trim()) ) ]);


const onChangeSlider = (height_state) => {
    emits('onUpdateHeightSlider', height_state);
}

const diplayHeightItem = (data) => {
    let first_or_last = '';
    if( data == 1){
        first_or_last = 'first_child';
    }
    if( data == 31){
        first_or_last = 'last_child';
    }
    return h('div', { class: first_or_last + ' px-2 py-0 shadow', innerHTML: props.translations.biodata_form.deserved_biodata.deserved_height_range_options[data] });
}


</script>

<template>

    <div class="mb-6" >
        <label for="height_slider" class="text-base" >{{ props.translations.biodata_form.deserved_biodata.deserved_height_range_title }}</label>
    </div>
    <Range
        @update:model-value="onChangeSlider"
        v-model="height_state"
        :min="1"
        :max="31"
        :smooth="true"
        :renderTop="diplayHeightItem"
        size="small"
        rangeHighlight
        thumb-size="large"
        class="height_slider text-xs"
        id="height_slider"
        style="width: 100%"
    />


</template>

<style>
/* .height_slider .m-range-thumb-top-container div.first_child{
    min-width: max-content !important;
    margin-left: 40px;
} */
.height_slider .m-range-thumb-top-container div.last_child{
    min-width: max-content !important;
    margin-right: 40px;
}
</style>
