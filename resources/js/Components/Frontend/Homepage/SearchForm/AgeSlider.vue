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
});

const age_state = ref([16, 65]);

const onChangeSlider = (age_state) => {
    emits('onUpdateAgeSlider', age_state);
}

const diplayAgeItem = (data) => {
    return h('div', { class: 'px-2 py-0 shadow', innerHTML: data });
}


</script>

<template>

    <div class="mb-6" >
        <label for="age_slider" class="text-base" >{{ props.translations.biodata_form.deserved_biodata.deserved_age_range_title }}-</label>
    </div>
    <Range
        @update:model-value="onChangeSlider"
        v-model="age_state"
        :min="16"
        :max="65"
        :smooth="true"
        :render-top="diplayAgeItem"
        thumb-size="large"
        size="small"
        rangeHighlight
        class="text-xs"
        id="age_slider"
        style="width: 100%"
    />


</template>

<style scoped></style>
