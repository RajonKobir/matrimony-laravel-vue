<script setup>
import { ref, onMounted } from 'vue';
import PopupMessage from './PopupMessage.vue';
import { usePage, useForm } from '@inertiajs/vue3';
import InputError from '../../../InputError.vue';
import MultipleIslamicStudiesSelection from './MultipleIslamicStudiesSelection.vue';


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
const user_id = page.props.auth.user.id;
const modalMessage = ref({});
const isModalOpen = ref(false);


const form = useForm({
    csrf_token: csrf_token,
    biodata_completion: 40,
    running_tab: 2,
    user_id: user_id,
    gender: props.selectedGender,
    five_waqt_salat: null,
    beard_quantity: null,
    pants_worn_style: null,
    veiling_style: null,
    islamic_studies: null,
    drugs_taken: null,
    dowry_deserve_male: null,
    dowry_deserve_female: null,
    akida_majhhab: null,
    three_choosen_alems: null,
    family_islam_maintain: null,
    physical_weakness: null,
    physical_weakness_desc: null,
    good_affairs: null,
    religious_future_plan: null,
    borka_wearing: null,
    nikab_with_borka: null,
});
const submit = (e) => {
    e.preventDefault();
    form.post(route('user.biodata.post.update_religious_biodata'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (response) => {

            if( page.props.flash.success ){
                form.reset();
                emits('onCompleteTab', 2, form.biodata_completion);
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


const onSelectIslamicStudies = (selectedIslamicStudiesArray) =>{
    props.single_biodata.islamic_studies = form.islamic_studies = selectedIslamicStudiesArray.map((islamic_study) => islamic_study).join(', ');
}


onMounted(() => {

    setTimeout(function(){

        let single_biodata_keys = Object.keys(props.single_biodata);
        single_biodata_keys.forEach(function(item, index, arr){
            switch(item) {
            case 'five_waqt_salat':
                form.five_waqt_salat = props.single_biodata[item];
                break;
            case 'beard_quantity':
                form.beard_quantity = props.single_biodata[item];
                break;
            case 'pants_worn_style':
                form.pants_worn_style = props.single_biodata[item];
                break;
            case 'veiling_style':
                form.veiling_style = props.single_biodata[item];
                break;
            case 'islamic_studies':
                form.islamic_studies = props.single_biodata[item];
                break;
            case 'drugs_taken':
                form.drugs_taken = props.single_biodata[item];
                break;
            case 'dowry_deserve_male':
                form.dowry_deserve_male = props.single_biodata[item];
                break;
            case 'dowry_deserve_female':
                form.dowry_deserve_female = props.single_biodata[item];
                break;
            case 'akida_majhhab':
                form.akida_majhhab = props.single_biodata[item];
                break;
            case 'three_choosen_alems':
                form.three_choosen_alems = props.single_biodata[item];
                break;
            case 'family_islam_maintain':
                form.family_islam_maintain = props.single_biodata[item];
                break;
            case 'physical_weakness':
                form.physical_weakness = props.single_biodata[item];
                break;
            case 'physical_weakness_desc':
                form.physical_weakness_desc = props.single_biodata[item];
                break;
            case 'good_affairs':
                form.good_affairs = props.single_biodata[item];
                break;
            case 'religious_future_plan':
                form.religious_future_plan = props.single_biodata[item];
                break;
            case 'borka_wearing':
                form.borka_wearing = props.single_biodata[item];
                break;
            case 'nikab_with_borka':
                form.nikab_with_borka = props.single_biodata[item];
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

        <div class="form_item col-span-6 p-2">
            <select v-model="form.five_waqt_salat" @change="(e) => { single_biodata.five_waqt_salat = e.target.value }" id="five_waqt_salat" name="five_waqt_salat"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.five_waqt_salat_title }}</option>
                <option v-for="five_waqt_salat in translations.biodata_form.religious_biodata.five_waqt_salat_options" :key="five_waqt_salat.id" :value="five_waqt_salat">{{ five_waqt_salat }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.five_waqt_salat" />
        </div>

        <div v-if="selectedGender == 'male'" class="form_item col-span-6 p-2">
            <select v-model="form.beard_quantity" @change="(e) => { single_biodata.beard_quantity = e.target.value }" id="beard_quantity" name="beard_quantity"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.beard_quantity_title }}</option>
                <option v-for="beard_quantity in translations.biodata_form.religious_biodata.beard_quantity_options" :key="beard_quantity.id" :value="beard_quantity">{{ beard_quantity }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.beard_quantity" />
        </div>

        <div v-if="selectedGender == 'male'" class="form_item col-span-6 p-2">
            <select v-model="form.pants_worn_style" @change="(e) => { single_biodata.pants_worn_style = e.target.value }" id="pants_worn_style" name="pants_worn_style"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.pants_worn_style_title }}</option>
                <option v-for="pants_worn_style in translations.biodata_form.religious_biodata.pants_worn_style_options" :key="pants_worn_style.id" :value="pants_worn_style">{{ pants_worn_style }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.pants_worn_style" />
        </div>

        <div v-if="selectedGender == 'female'" class="form_item col-span-6 p-2">
            <select v-model="form.borka_wearing" @change="(e) => { single_biodata.borka_wearing = e.target.value }" id="borka_wearing" name="borka_wearing"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.borka_wearing_title }}</option>
                <option v-for="borka_wearing in translations.biodata_form.religious_biodata.borka_wearing_options" :key="borka_wearing.id" :value="borka_wearing">{{ borka_wearing }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.borka_wearing" />
        </div>

        <div v-if="selectedGender == 'female'" class="form_item col-span-6 p-2">
            <select v-model="form.nikab_with_borka" @change="(e) => { single_biodata.nikab_with_borka = e.target.value }" id="nikab_with_borka" name="nikab_with_borka"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.nikab_with_borka_title }}</option>
                <option v-for="nikab_with_borka in translations.biodata_form.religious_biodata.nikab_with_borka_options" :key="nikab_with_borka.id" :value="nikab_with_borka">{{ nikab_with_borka }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.nikab_with_borka" />
        </div>

        <div class="form_item col-span-6 p-2">
            <select v-model="form.veiling_style" @change="(e) => { single_biodata.veiling_style = e.target.value }" id="veiling_style" name="veiling_style"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.veiling_style_title }}</option>
                <option v-for="veiling_style in translations.biodata_form.religious_biodata.veiling_style_options" :key="veiling_style.id" :value="veiling_style">{{ veiling_style }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.veiling_style" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <MultipleIslamicStudiesSelection :translations :islamicStudies="single_biodata.islamic_studies" @onSelectIslamicStudies="onSelectIslamicStudies" />
            <InputError class="mt-2" :message="form.errors.islamic_studies" />
        </div>


        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.drugs_taken" @change="(e) => { single_biodata.drugs_taken = e.target.value }" id="drugs_taken" name="drugs_taken"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.drugs_taken_title }}</option>
                <option v-for="drugs_taken in translations.biodata_form.religious_biodata.drugs_taken_options" :key="drugs_taken.id" :value="drugs_taken">{{ drugs_taken }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.drugs_taken" />
        </div>

        <div v-if="selectedGender == 'male'" class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.dowry_deserve_male" @change="(e) => { single_biodata.dowry_deserve_male = e.target.value }" id="dowry_deserve_male" name="dowry_deserve_male"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.dowry_deserve_title_male }}</option>

                <option v-if="selectedGender == 'male'" v-for="dowry_deserve_male in translations.biodata_form.religious_biodata.dowry_deserve_options_male" :key="dowry_deserve_male.id" :value="dowry_deserve_male">{{ dowry_deserve_male }}</option>

            </select>
            <InputError class="mt-2" :message="form.errors.dowry_deserve_male" />
        </div>

        <div v-if="selectedGender == 'female'" class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.dowry_deserve_female" @change="(e) => { single_biodata.dowry_deserve_female = e.target.value }" id="dowry_deserve_female" name="dowry_deserve_female"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.dowry_deserve_title_female }}</option>

                <option v-if="selectedGender == 'female'" v-for="dowry_deserve_female in translations.biodata_form.religious_biodata.dowry_deserve_options_female" :key="dowry_deserve_female.id" :value="dowry_deserve_female">{{ dowry_deserve_female }}</option>

            </select>
            <InputError class="mt-2" :message="form.errors.dowry_deserve_female" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.akida_majhhab" @change="(e) => { single_biodata.akida_majhhab = e.target.value }" id="akida_majhhab" name="akida_majhhab"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.akida_majhhab_title }}</option>
                <option v-for="akida_majhhab in translations.biodata_form.religious_biodata.akida_majhhab_options" :key="akida_majhhab.id" :value="akida_majhhab">{{ akida_majhhab }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.akida_majhhab" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.family_islam_maintain" @change="(e) => { single_biodata.family_islam_maintain = e.target.value }" id="family_islam_maintain" name="family_islam_maintain"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.family_islam_maintain_title }}</option>
                <option v-for="family_islam_maintain in translations.biodata_form.religious_biodata.family_islam_maintain_options" :key="family_islam_maintain.id" :value="family_islam_maintain">{{ family_islam_maintain }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.family_islam_maintain" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.three_choosen_alems" @input="(e) => { single_biodata.three_choosen_alems = e.target.value }" name="three_choosen_alems" rows="1" maxlength="255" :placeholder="translations.biodata_form.religious_biodata.three_choosen_alems_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.three_choosen_alems" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <select v-model="form.physical_weakness" @change="(e) => { single_biodata.physical_weakness = JSON.parse(e.target.value) }" id="physical_weakness" name="physical_weakness"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="null" disabled selected >{{ translations.biodata_form.religious_biodata.physical_weakness_title }}</option>
                <option v-for="(physical_weakness, physical_weakness_key) in translations.biodata_form.religious_biodata.physical_weakness_options" :key="physical_weakness.id" :value="JSON.parse(physical_weakness_key)" >{{ physical_weakness }}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.physical_weakness" />
        </div>

        <div v-if="form.physical_weakness" class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.physical_weakness_desc" @input="(e) => { single_biodata.physical_weakness_desc = e.target.value }" name="physical_weakness_desc" rows="1" maxlength="255" :placeholder="translations.biodata_form.religious_biodata.physical_weakness_desc_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.physical_weakness_desc" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.good_affairs" @input="(e) => { single_biodata.good_affairs = e.target.value }" name="good_affairs" rows="1" maxlength="255" :placeholder="translations.biodata_form.religious_biodata.good_affairs_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.good_affairs" />
        </div>

        <div class="form_item col-span-12 md:col-span-6 p-2">
            <textarea v-model="form.religious_future_plan" @input="(e) => { single_biodata.religious_future_plan = e.target.value }" name="religious_future_plan" rows="2" maxlength="255" :placeholder="translations.biodata_form.religious_biodata.religious_future_plan_title" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"></textarea>
            <InputError class="mt-2" :message="form.errors.religious_future_plan" />
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
</style>
