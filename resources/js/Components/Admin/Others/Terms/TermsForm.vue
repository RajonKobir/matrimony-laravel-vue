<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage, Head, useForm } from '@inertiajs/vue3';
import PopupMessage from './PopupMessage.vue';
import InputError from '../../../InputError.vue';


const emits = defineEmits([
    'onAddedSingleTerm'
]);


const props = defineProps({
    translations: {
        type: Object,
    },
    single_term: {
        type: Object,
    },
    on_edit: {
        type: Boolean,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
// const user_id = page.props.auth.user.id;
const isModalOpen = ref(false);
const modalMessage = ref({});


const form = useForm({
    csrf_token: csrf_token,
    id: props.single_term.id,
    serial_no: props.single_term.serial_no,
    question: props.single_term.question,
    question_en: props.single_term.question_en,
    answer: props.single_term.answer,
    answer_en: props.single_term.answer_en,
});
const submit = (e) => {
    e.preventDefault();
    let selectedRoute = 'backend.terms.store';
    if( props.on_edit ){
        selectedRoute = 'backend.terms.update';
    }
    form.post(route(selectedRoute), {
        onSuccess: (response) => {
            const flash = page.props.flash;

            if (flash.success) {
                let modalDescription = 'Term updated successfully';
                if( !props.on_edit ){
                    emits('onAddedSingleTerm', {
                        id: flash.success,
                        serial_no: form.serial_no,
                        question: form.question,
                        question_en: form.question_en,
                        answer: form.answer,
                        answer_en: form.answer_en,
                    });
                    modalDescription = 'Term added successfully';
                }
                modalMessage.value = {
                    modalHeading: page.props.translations.modal_messages.success_heading,
                    modalDescription: modalDescription,
                };
            } else {
                modalMessage.value = {
                    modalHeading: page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.flash.error,
                };
            }
            isModalOpen.value = true;
        },
    });
};


const closeModal = (value) => {
    isModalOpen.value = value;
}


onMounted(() => {

    setTimeout(() => {

    }, 500);

});


</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

    <div class="biodata_main w-full min-h-screen">

        <div class="main-container">

            <form @submit.prevent="submit" class="grid grid-cols-12 gap-0">

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <input type="text" v-model="form.serial_no" @input="(e) => { single_term.serial_no = e.target.value }" name="serial_no" maxlength="3" placeholder="Serial No" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
                    <InputError class="mt-2" :message="form.errors.serial_no" />
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <textarea v-model="form.question" @input="(e) => { single_term.question = e.target.value }" name="question" rows="3" maxlength="3000" placeholder="Question" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    <InputError class="mt-2" :message="form.errors.question" />
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <textarea v-model="form.question_en" @input="(e) => { single_term.question_en = e.target.value }" name="question_en" rows="3" maxlength="3000" placeholder="Question in English" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    <InputError class="mt-2" :message="form.errors.question_en" />
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <textarea v-model="form.answer" @input="(e) => { single_term.answer = e.target.value }" name="answer" rows="3" maxlength="3000" placeholder="Answer" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    <InputError class="mt-2" :message="form.errors.answer" />
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <textarea v-model="form.answer_en" @input="(e) => { single_term.answer_en = e.target.value }" name="answer_en" rows="3" maxlength="3000" placeholder="Answer in English" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    <InputError class="mt-2" :message="form.errors.answer_en" />
                </div>

                <div class="form_item col-span-12 p-2">
                    <button class="biodata_submit_button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Submit
                    </button>
                </div>

            </form>

        </div>

    </div>

</template>
