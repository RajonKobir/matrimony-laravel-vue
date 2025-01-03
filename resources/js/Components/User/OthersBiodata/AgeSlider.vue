<script setup>
import { ref, h } from 'vue';
import { Range } from 'vue-range-multi';
import 'vue-range-multi/style.css';


const emits = defineEmits([
    'onUpdateAgeSlider'
]);


const props = defineProps({
    translations: {
        type: Object,
    },
    deserved_age_range: {
        type: String,
    },
});

const age_state = ref( props.deserved_age_range == null ? [16, 65] : [parseInt(props.deserved_age_range.split("-")[0].trim()), parseInt(props.deserved_age_range.split("-")[1].trim())] );

const onChangeSlider = (age_state) => {
    emits('onUpdateAgeSlider', age_state);
}

const diplayAgeItem = (data) => {
    return h('div', { class: 'px-2 py-0 shadow', innerHTML: data });
}


</script>

<template>

    <div class="text-center mb-6" >
        <label for="age_slider" class="text-base" >{{ props.translations.biodata_form.deserved_biodata.deserved_age_range_title }}-</label>
    </div>
    <Range
        @update:model-value="onChangeSlider"
        v-model="age_state"
        :min="16"
        :max="65"
        :smooth="true"
        :render-top="diplayAgeItem"
        thumb-size="medium"
        size="medium"
        rangeHighlight
        class="text-xs"
        id="age_slider"
        style="width: 100%"
    />


</template>

<style scoped></style>
