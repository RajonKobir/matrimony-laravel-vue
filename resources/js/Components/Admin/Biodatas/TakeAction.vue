<script setup>
import { ref, onMounted } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';
import MultipleCategoriesSelection from './MultipleCategoriesSelection.vue';
import axios from 'axios';


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
const createdAtTimeString = ref('');
const updatedAtTimeString = ref('');
const user_id = props.modalInner.viewBiodata.user_id;


const form = useForm({
    csrf_token: csrf_token,
    biodata_code: props.modalInner.viewBiodata.biodata_code,
    free_biodata: props.modalInner.viewBiodata.free_biodata ? props.modalInner.viewBiodata.free_biodata : 0,
    biodata_categories: props.modalInner.viewBiodata.biodata_categories,
    biodata_restrictions: props.modalInner.viewBiodata.biodata_restrictions,
    daily_free: props.modalInner.viewBiodata.daily_free,
    biodata_package: props.modalInner.viewBiodata.biodata_package,
    username: props.modalInner.viewBiodata.user_email ? props.modalInner.viewBiodata.user_email : props.modalInner.viewBiodata.user_mobile,
    password: null,
    is_approved: props.modalInner.viewBiodata.is_approved,
    user_id: props.modalInner.viewBiodata.user_id,
    admin_comment: props.modalInner.viewBiodata.admin_comment,
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

const checkUniqueBiodataCode = async (biodata_code) => {
    try {
        const response = await axios.post(route('backend.biodata.check_unique_biodata_code'), {
            csrf_token,
            user_id,
            biodata_code,
        })
        .then(function (response) {
            if( response.data ){
                form.errors.biodata_code = 'This Biodata Code is Available!';
            }else{
                form.errors.biodata_code = 'This Biodata Code is Taken!';
            }
        });

    } catch (error) {
        if( error.response ){
            form.errors.biodata_code = error.response.data.message;
        }
    }
};


onMounted(() => {

    page.props.flash = [];
    createdAtTimeString.value = (new Date(props.modalInner.viewBiodata.created_at)).toLocaleString('en-US');
    updatedAtTimeString.value = (new Date(props.modalInner.viewBiodata.updated_at)).toLocaleString('en-US');

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
        <input type="text" v-model="form.biodata_code" @input="(e) => { checkUniqueBiodataCode(e.target.value) }" id="biodata_code" name="biodata_code" placeholder="Biodata Code" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
        <InputError class="mt-2" :message="form.errors.biodata_code" />
    </div>

    <div class="form_item col-span-6 p-2">
        <label for="free_biodata" class="text-base">Free Biodata</label>
        <select v-model="form.free_biodata" id="free_biodata" name="free_biodata"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="null" disabled selected>Select</option>
            <option value="1">yes</option>
            <option value="0">no</option>
        </select>
        <InputError class="mt-2" :message="form.errors.free_biodata" />
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

    <div class="form_item col-span-12 md:col-span-6 p-2">
        <textarea v-model="form.admin_comment" @input="(e) => { single_biodata.admin_comment = e.target.value }" name="admin_comment" rows="2" maxlength="250"  placeholder="Admin Comment" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
        <InputError class="mt-2" :message="form.errors.admin_comment" />
    </div>

    <div class="form_item col-span-12 p-2">
        <p class="text-base text-left">
            <span class="text-lg text-left font-bold">
                Created At:
            </span>
            <span class="text-base text-left pl-2">
                {{createdAtTimeString }}
            </span>
        </p>
    </div>

    <div class="form_item col-span-12 p-2">
        <p class="text-base text-left">
            <span class="text-lg text-left font-bold">
                Updated At:
            </span>
            <span class="text-base text-left pl-2">
                {{ updatedAtTimeString }}
            </span>
        </p>
    </div>

    <div class="form_item col-span-12 p-2">
        <button class="biodata_submit_button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing">
            Submit
        </button>
    </div>

</form>

</template>
