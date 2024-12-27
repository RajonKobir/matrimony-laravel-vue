<script setup>
import RangeSlider from 'vue-simple-range-slider';
import 'vue-simple-range-slider/css';
import { reactive } from 'vue';

const state = reactive({
  value: [16, 65],
});

</script>

<template>

    <label for="range_slider">Deserved Age Range:</label>
    <RangeSlider
      v-model="state.value"
      style="width: 100%"
      :min="16"
      :max="65"
      id="range_slider"
    >
      <!-- <template #suffix>$</template> -->
    </RangeSlider>

</template>

<style scoped></style>
