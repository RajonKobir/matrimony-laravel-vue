<script setup>
import { ref, onMounted } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';
import MultipleCategoriesSelection from './MultipleCategoriesSelection.vue';


const props = defineProps({
    translations: {
        type: Object,
    },
    modalInner: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const isModalOpen = ref(false);


const form = useForm({
    csrf_token: csrf_token,
    biodata_code: props.modalInner.viewBiodata.biodata_code,
    special_biodata: props.modalInner.viewBiodata.special_biodata,
    biodata_categories: props.modalInner.viewBiodata.biodata_categories,
    biodata_restriction: props.modalInner.viewBiodata.biodata_restriction,
    daily_free: props.modalInner.viewBiodata.daily_free,
    biodata_package: props.modalInner.viewBiodata.biodata_package,
    username: props.modalInner.viewBiodata.user_email ? props.modalInner.viewBiodata.user_email : props.modalInner.viewBiodata.user_mobile,
    password: null,
    is_approved: props.modalInner.viewBiodata.is_approved,
    user_id: props.modalInner.viewBiodata.user_id,
});

const submit = (e) => {
    e.preventDefault();
    page.props.flash = [];
    form.post(route('backend.biodata.take_action'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {
            setTimeout(() => {
                page.props.flash = [];
            }, 3000);
        }
    })
}


const onSelectCategories = (selectedCategoryArray) =>{
    form.biodata_categories = selectedCategoryArray.map((category) => category).join(', ');
}

const closeModal = (value) => {
    isModalOpen.value = value;
}


onMounted(() => {


})


</script>



<template>


<h2 class="text-center mt-4 text-xl font-bold text-gray-800 my-4">
    Action Form
</h2>

<div class="mt-1 od-contact-us-form-top od-text-align-center">
    <div v-if="$page.props.flash.success" class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="alert-body">
            {{ $page.props.flash.success }}
        </div>
    </div>
    <div v-if="$page.props.flash.error" class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-body">
            {{ $page.props.flash.error }}
        </div>
    </div>
</div>

<form @submit.prevent="submit" class="grid grid-cols-12 gap-0">

    <input v-model="form.csrf_token" type="hidden" name="csrf_token" >
    <input v-model="form.user_id" type="hidden" name="user_id" >

    <div class="form_item col-span-6 p-2">
        <label for="biodata_code" class="text-base">Biodata Code</label>
        <input type="text" v-model="form.biodata_code" id="biodata_code" name="biodata_code" placeholder="Biodata Code" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
        <InputError class="mt-2" :message="form.errors.biodata_code" />
    </div>

    <div class="form_item col-span-6 p-2">
        <label for="special_biodata" class="text-base">Special Biodata</label>
        <select v-model="form.special_biodata" id="special_biodata" name="special_biodata"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="null" disabled selected>Select</option>
            <option value="1">yes</option>
            <option value="0">no</option>
        </select>
        <InputError class="mt-2" :message="form.errors.special_biodata" />
    </div>

    <div class="form_item col-span-12 md:col-span-6 p-2">
        <label class="text-base">Biodata Categories</label>
        <MultipleCategoriesSelection :translations :Categories="form.biodata_categories" @onSelectCategories="onSelectCategories" />
        <InputError class="mt-2" :message="form.errors.biodata_categories" />
    </div>


    <div class="form_item col-span-6 p-2">
        <label for="daily_free" class="text-base">Daily Free</label>
        <input type="text" v-model="form.daily_free" id="daily_free" name="daily_free" placeholder="Daily Free" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
        <InputError class="mt-2" :message="form.errors.daily_free" />
    </div>

    <div class="form_item col-span-6 p-2">
        <label for="biodata_package" class="text-base">Biodata Package</label>
        <input type="text" v-model="form.biodata_package" id="biodata_package" name="biodata_package" placeholder="Biodata Package" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
        <InputError class="mt-2" :message="form.errors.biodata_package" />
    </div>

    <div class="form_item col-span-12 md:col-span-6 p-2">
        <label for="username" class="text-base">Username</label>
        <input type="text" v-model="form.username" id="username" name="username" placeholder="Username" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
        <InputError class="mt-2" :message="form.errors.username" />
    </div>

    <div class="form_item col-span-12 md:col-span-6 p-2">
        <label for="password" class="text-base">Password</label>
        <input type="text" v-model="form.password" id="password" name="password" placeholder="Password" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
        <InputError class="mt-2" :message="form.errors.password" />
    </div>

    <div class="form_item col-span-12 md:col-span-6 p-2">
        <label for="is_approved" class="text-base">Approve?</label>
        <select v-model="form.is_approved" id="is_approved" name="is_approved"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="null" disabled selected>Select</option>
            <option value="1">yes</option>
            <option value="0">no</option>
        </select>
        <InputError class="mt-2" :message="form.errors.is_approved" />
    </div>

    <div class="form_item col-span-12 p-2">
        <button class="biodata_submit_button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing">
            Submit
        </button>
    </div>

</form>

</template>
