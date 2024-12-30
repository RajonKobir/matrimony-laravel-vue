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
});


const height_state = ref([1, 31]);


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
