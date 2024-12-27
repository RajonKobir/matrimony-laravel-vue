<script setup>
import Datepicker from 'vue3-datepicker';
import { ref } from 'vue';
import { add } from 'date-fns';
import { usePage } from '@inertiajs/vue3';



const props = defineProps({
    translations: {
        type: Object,
    },
    birth_date: {
        type: String,
    },
});


const emits = defineEmits([
    'onUpdateDate'
]);


// initializing
const page = usePage();
// const birth_date = ref(new Date(props.birth_date));
// const birth_date = ref(new Date());
// const birth_date = ref('');
// const birth_date = ref('0000-00-00');
const birth_date = ref(null);
if( props.birth_date != null && props.birth_date != '' ){
    birth_date.value = new Date(props.birth_date);
}

const disabledDate = ref(add(new Date('2015-12-30'), { days: 1 }));


const onChangeDatePicker = (date) => {
    if( date ){
        let formatedDate = date.getFullYear() + '-' + (parseInt(date.getMonth()) + 1).toString() + '-' + date.getDate();
        emits('onUpdateDate', formatedDate);
    }else{
        emits('onUpdateDate', null);
    }
}


</script>

<template>

    <Datepicker name="birth_date" v-model="birth_date" :clearable="true" :typeable="false"  :startingView="'year'" :lowerLimit="new Date('1975-01-01')" :upperLimit="new Date('2015-12-31')"  @update:model-value="onChangeDatePicker" class="my_date_picker_class appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="my_date_picker_id" :placeholder="translations.biodata_form.personal_biodata.birth_date_title" :disabledDates="{ dates: [disabledDate] }" >
        <!-- <template v-slot:clear="{ onClear }">
            <button @click="onClear" style="color: red">x</button>
        </template> -->
    </Datepicker>

</template>

<style>
.my_date_picker_class::placeholder{
    color: #000;
}
.v3dp__clearable {
    display: inherit !important;
    left: inherit !important;
    position: absolute !important;
    right: 10px !important;
    top: 5px !important;
}
</style>
