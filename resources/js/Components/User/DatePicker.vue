<script setup>
import Datepicker from 'vue3-datepicker';
import { ref, defineEmits } from 'vue';
const pickedDate = ref(new Date());


const emits = defineEmits([
    'onUpdateDate'
]);


const onChangeDatePicker = (value) => {
    emits('onUpdateDate', value);
}


</script>

<template>
    <label for="my-picker-id">Birth Date:</label>
  <Datepicker v-model="pickedDate" :clearable="true" @update:model-value="onChangeDatePicker" class="my-picker-class" id="my-picker-id" />
</template>

<style>
.my-picker-class{
    width: 90%;
}
</style>
