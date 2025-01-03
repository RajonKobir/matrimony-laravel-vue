<script setup>
import { ref, onMounted } from 'vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../InputError.vue';


const props = defineProps({
    translations: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Array,
    },
    single_biodata: {
        type: Object,
    },
    selectedGender: {
        type: String,
    },
});


const emits = defineEmits([
    'onCompleteTab',
]);


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const user_id = page.props.auth.user["id"];
const modalMessage = ref({});
const isModalOpen = ref(false);


const form = useForm({
    csrf_token: csrf_token,
    biodata_completion: 100,
    running_tab: 4,
    user_id: user_id,
    form_holder_desc: null,
    male_guardian_desc: null,
    male_guardian_agreement: null,
    eleven_digit_mobile_number: '01',
    main_email_address: null,
    reference_code: null,
    deserved_money_pay: null,
    media_terms_one_agreement: null,
    hundred_money_pay: null,
    three_hundred_money_pay: null,
    media_terms_two_agreement: null,
});
const submit = (e) => {
    e.preventDefault();
    form.post(route('user.biodata.post.update_others_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {

            if( page.props.flash.success ){
                emits('onCompleteTab', 4, form.biodata_completion);
            }
            else if( page.props.flash.error ){
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.flash.error,
                }
                isModalOpen.value = true;
            }
        },
    });
};


const closeModal = (value) => {
    isModalOpen.value = value;
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'form_holder_desc':
                form.form_holder_desc = props.single_biodata[item];
                break;
            case 'male_guardian_desc':
                form.male_guardian_desc = props.single_biodata[item];
                break;
            case 'male_guardian_agreement':
                form.male_guardian_agreement = props.single_biodata[item];
                break;
            case 'eleven_digit_mobile_number':
                if( props.single_biodata[item] ){
                    form.eleven_digit_mobile_number = props.single_biodata[item];
                }
                break;
            case 'main_email_address':
                form.main_email_address = props.single_biodata[item];
                break;
            case 'reference_code':
                form.reference_code = props.single_biodata[item];
                break;
            case 'deserved_money_pay':
                form.deserved_money_pay = props.single_biodata[item];
                break;
            case 'media_terms_one_agreement':
                form.media_terms_one_agreement = props.single_biodata[item];
                break;
            case 'hundred_money_pay':
                form.hundred_money_pay = props.single_biodata[item];
                break;
            case 'three_hundred_money_pay':
                form.three_hundred_money_pay = props.single_biodata[item];
                break;
            case 'media_terms_two_agreement':
                form.media_terms_two_agreement = props.single_biodata[item];
                break;
            }
        });

    }, 500);


});


</script>


<template>


    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />


    <form @submit.prevent="submit" class="grid grid-cols-12 gap-0">

        <input v-model="form.csrf_token" type="hidden" name="csrf_token" >
        <input v-model="form.running_tab" type="hidden" name="running_tab" >

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="form_holder_desc" class="text-base">
                {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.form_holder_desc_title_male : translations.biodata_form.others_biodata.form_holder_desc_title_female }}
            </label>
            <textarea v-model="form.form_holder_desc" @input="(e) => { single_biodata.form_holder_desc = e.target.value }" name="form_holder_desc" id="form_holder_desc" rows="3" maxlength="255" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.form_holder_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="male_guardian_desc" class="text-base">
                {{ single_biodata.gender == 'male' ? translations.biodata_form.others_biodata.male_guardian_desc_title_male : translations.biodata_form.others_biodata.male_guardian_desc_title_female }}
            </label>
            <textarea v-model="form.male_guardian_desc" @input="(e) => { single_biodata.male_guardian_desc = e.target.value }" name="male_guardian_desc" id="male_guardian_desc" rows="3" maxlength="255" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.male_guardian_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="male_guardian_agreement" class="text-base">
                {{ translations.biodata_form.others_biodata.male_guardian_agreement_title }}
            </label>
            <select v-model="form.male_guardian_agreement" @change="(e) => { single_biodata.male_guardian_agreement = JSON.parse(e.target.value) }" id="male_guardian_agreement" name="male_guardian_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                <option v-for="(male_guardian_agreement, male_guardian_agreement_key) in translations.biodata_form.others_biodata.male_guardian_agreement_options" :key="male_guardian_agreement.id" :value="JSON.parse(male_guardian_agreement_key)">{{ male_guardian_agreement }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.male_guardian_agreement" />
        </div>

        <!-- <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="eleven_digit_mobile_number" class="text-base">
                {{ translations.biodata_form.others_biodata.eleven_digit_mobile_number_title }}
            </label>
            <input type="tel" v-model="form.eleven_digit_mobile_number" @input="(e) => { single_biodata.eleven_digit_mobile_number = e.target.value }" name="eleven_digit_mobile_number" id="eleven_digit_mobile_number" max="11" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
            <InputError v-if="form.errors.eleven_digit_mobile_number" class="mt-2" :message="translations.biodata_form.others_biodata.eleven_digit_mobile_number_error" />
        </div> -->

        <!-- <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="main_email_address" class="text-base">
                {{ translations.biodata_form.others_biodata.main_email_address_title }}
            </label>
            <input type="text" v-model="form.main_email_address" @input="(e) => { single_biodata.main_email_address = e.target.value }" name="main_email_address" id="main_email_address" max="50" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
            <InputError class="mt-2" :message="form.errors.main_email_address" />
        </div> -->

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="deserved_money_pay" class="text-base">
                {{ translations.biodata_form.others_biodata.deserved_money_pay_title }}
            </label>
            <select v-model="form.deserved_money_pay" @change="(e) => { single_biodata.deserved_money_pay = e.target.value }" id="deserved_money_pay" name="deserved_money_pay"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                <option v-for="deserved_money_pay in translations.biodata_form.others_biodata.deserved_money_pay_options" :key="deserved_money_pay.id" :value="deserved_money_pay">{{ deserved_money_pay }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.deserved_money_pay" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="media_terms_one_agreement" class="text-base">
                {{ translations.biodata_form.others_biodata.media_terms_one_agreement_title }}
            </label>
            <select v-model="form.media_terms_one_agreement" @change="(e) => { single_biodata.media_terms_one_agreement = JSON.parse(e.target.value) }" id="media_terms_one_agreement" name="media_terms_one_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                <option v-for="(media_terms_one_agreement, media_terms_one_agreement_key) in translations.biodata_form.others_biodata.media_terms_one_agreement_options" :key="media_terms_one_agreement.id" :value="JSON.parse(media_terms_one_agreement_key)">{{ media_terms_one_agreement }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.media_terms_one_agreement" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="hundred_money_pay" class="text-base">
                {{ translations.biodata_form.others_biodata.hundred_money_pay_title }}
            </label>
            <select v-model="form.hundred_money_pay" @change="(e) => { single_biodata.hundred_money_pay = JSON.parse(e.target.value) }" id="hundred_money_pay" name="hundred_money_pay"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                <option v-for="(hundred_money_pay, hundred_money_pay_key) in translations.biodata_form.others_biodata.hundred_money_pay_options" :key="hundred_money_pay.id" :value="JSON.parse(hundred_money_pay_key)">{{ hundred_money_pay }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.hundred_money_pay" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="three_hundred_money_pay" class="text-base">
                {{ translations.biodata_form.others_biodata.three_hundred_money_pay_title }}
            </label>
            <select v-model="form.three_hundred_money_pay" @change="(e) => { single_biodata.three_hundred_money_pay = JSON.parse(e.target.value) }" id="three_hundred_money_pay" name="three_hundred_money_pay"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                <option v-for="(three_hundred_money_pay, three_hundred_money_pay_key) in translations.biodata_form.others_biodata.three_hundred_money_pay_options" :key="three_hundred_money_pay.id" :value="JSON.parse(three_hundred_money_pay_key)">{{ three_hundred_money_pay }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.three_hundred_money_pay" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="media_terms_two_agreement" class="text-base">
                {{ translations.biodata_form.others_biodata.media_terms_two_agreement_title }}
            </label>
            <select v-model="form.media_terms_two_agreement" @change="(e) => { single_biodata.media_terms_two_agreement = JSON.parse(e.target.value) }" id="media_terms_two_agreement" name="media_terms_two_agreement"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.form_basics.select_text }}</option>
                <option v-for="(media_terms_two_agreement, media_terms_two_agreement_key) in translations.biodata_form.others_biodata.media_terms_two_agreement_options" :key="media_terms_two_agreement.id" :value="JSON.parse(media_terms_two_agreement_key)">{{ media_terms_two_agreement }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.media_terms_two_agreement" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <label for="reference_code" class="text-base">
                {{ translations.biodata_form.others_biodata.reference_code_title }}
            </label>
            <input type="text" v-model="form.reference_code" @input="(e) => { single_biodata.reference_code = e.target.value }" name="reference_code" id="reference_code" max="50" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" />
            <InputError class="mt-2" :message="form.errors.reference_code" />
        </div>


        <div class="form_item col-span-12 p-2">
            <button class="biodata_submit_button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                {{ translations.biodata_form.submit_button_text }}
            </button>
        </div>

    </form>


</template>


<style>
.biodata_submit_button{
    color: #fff !important;
}
@media(max-width: 768px) {
    .deserved_maritial_statuses{
        padding-left: 5px !important;
    }
}
</style>
