<script setup>
import Datepicker from 'vue3-datepicker'
import { ref } from 'vue'
const pickedDate = ref(new Date())
</script>

<template>
    <label>Birth Day:</label>
  <Datepicker v-model="pickedDate" :clearable="true" />
</template>
