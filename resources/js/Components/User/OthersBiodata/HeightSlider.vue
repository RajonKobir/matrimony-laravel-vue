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
    deserved_height: {
        type: String,
    },
});


const getKeyByValue = (object, value) => {
    return Object.keys(object).find(key =>
        object[key] === value);
}


const height_state = ref( props.deserved_height == null ? [1, 31] : [ parseInt( getKeyByValue(props.translations.biodata_form.personal_biodata.height_options, props.deserved_height.split("-")[0].trim()) ), parseInt( getKeyByValue(props.translations.biodata_form.personal_biodata.height_options, props.deserved_height.split("-")[1].trim()) ) ]);


const onChangeSlider = (height_state) => {
    emits('onUpdateHeightSlider', height_state);
}

const diplayHeightItem = (data) => {
    return h('div', { class: 'px-2 py-0 shadow', innerHTML: props.translations.biodata_form.personal_biodata.height_options[data] });
}


</script>

<template>

    <div class="text-center mb-6" >
        <label for="height_slider" class="text-base" >{{ props.translations.biodata_form.deserved_biodata.deserved_height_title }}-</label>
    </div>
    <Range
        @update:model-value="onChangeSlider"
        v-model="height_state"
        :min="1"
        :max="31"
        :smooth="true"
        :renderTop="diplayHeightItem"
        size="medium"
        rangeHighlight
        thumb-size="medium"
        class="text-xs"
        id="height_slider"
        style="width: 100%"
    />


</template>

<style scoped></style>
