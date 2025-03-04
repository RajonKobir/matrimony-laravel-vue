<script setup>

import { Head, usePage, Link } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";
import PopupMessage from './PopupMessage.vue';
import PopupView from './PopupView.vue';
import 'animate.css';


const emits = defineEmits([
    'onUpdateReceivedProposals',
]);


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
    biodatas: {
        type: Object,
    },
    proposals: {
        type: Object,
    },
    likes: {
        type: Object,
    },
});

// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const single_biodata_data = ref([]);
const isModalOpen = ref(false);
const modalMessage = ref({});
const all_biodatas = ref({});
const isPopupViewModalOpen = ref(false);
const modalInner = ref({});
const self_likes = ref({});
const likeReceiverUserIds = ref([]);


const closeModal = (value) => {
    isModalOpen.value = value;
    isPopupViewModalOpen.value = value;
}


const onClickLikeBiodata = (single_biodata) => {

    axios.post(route('user.likes.single_like', {
        csrf_token,
        sender_user_id : page.props.auth.user.id,
        sender_biodata_code : page.props.single_biodata.biodata_code,
        receiver_user_id : single_biodata.user_id,
        receiver_biodata_code : single_biodata.biodata_code,
    }))
    .then((response) => {
        if( response.data == true ){
            likeReceiverUserIds.value.push( single_biodata.user_id );
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.translations.modal_messages.success_like_message,
            }
            isModalOpen.value = true;
        }else{
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.error_heading,
                modalDescription : response.data,
            }
            isModalOpen.value = true;
        }
    });

}


const onClickDisLikeBiodata = (single_biodata) => {

    axios.post(route('user.likes.single_dislike', {
        csrf_token,
        sender_user_id : page.props.auth.user.id,
        sender_biodata_code : page.props.single_biodata.biodata_code,
        receiver_user_id : single_biodata.user_id,
        receiver_biodata_code : single_biodata.biodata_code,
    }))
    .then((response) => {
        if( response.data ){
            likeReceiverUserIds.value = likeReceiverUserIds.value.filter( function(item){
                return item != single_biodata.user_id;
            });
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.translations.modal_messages.remove_like_message,
            }
            isModalOpen.value = true;
        }else{
            likeReceiverUserIds.value = likeReceiverUserIds.value.filter( function(item){
                return item != single_biodata.user_id;
            });
        }
    });

}


const onClickSingleViewDetails = (single_biodata, tab_index) => {
    modalInner.value = {
        single_biodata,
        tab_index,
        proposals : props.proposals,
    }
    isPopupViewModalOpen.value = true;
}


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}


const highestDegreeSelection = (single_biodata) => {
    let highestDegree = '';
    if( single_biodata.medium_of_study ){
        if( single_biodata.medium_of_study != '' ){
            let educationMediumArray = single_biodata.medium_of_study.split(",").map(item => item.trim());
            educationMediumArray.forEach(function(item, index, arr){
                const wordBeforeBracket = item.split("(")[0].trim().toLowerCase();
                if( index > 0 ){
                    highestDegree += ', ';
                }
                switch(wordBeforeBracket) {
                    case 'জেনারেল' || 'general':
                        if( single_biodata.general_selected ){
                            highestDegree += single_biodata.general_highest_degree;
                        }
                        break;
                    case 'আলিয়া' || 'aliya':
                        if( single_biodata.aliya_selected ){
                            highestDegree += single_biodata.aliya_highest_degree;
                        }
                        break;
                    case 'ক্বওমী' || 'kowmi':
                        if( single_biodata.kowmi_selected ){
                            highestDegree += single_biodata.kowmi_highest_degree;
                        }
                        break;
                    case 'অন্যান্য' || 'others' || 'other':
                        if( single_biodata.study_others_selected ){
                            highestDegree += single_biodata.study_others_highest_degree;
                        }
                        break;
                }

                if( highestDegree != '' ){
                    highestDegree += ' ';
                    highestDegree += item.match(/\(.*?\)/)[0];
                }

            });
        }
    }

    if( highestDegree == '' ){
        if( single_biodata.medium_of_study ){
            highestDegree = single_biodata.medium_of_study;
        }
    }

    return highestDegree;
}


const onUpdateReceivedProposals = (proposals) => {
    emits('onUpdateReceivedProposals', proposals);
}


onMounted(() => {
    setTimeout(() => {
        single_biodata_data.value = props.single_biodata;
        all_biodatas.value = props.biodatas;

        self_likes.value = props.likes;
        if( self_likes.value.length > 0 ){
            self_likes.value.forEach(function(item, index, arr){
                likeReceiverUserIds.value.push( item.receiver_user_id );
            })
        }

    }, 500);
})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.proposals.received");

</script>

<template>


    <Head title="Received Proposals" />

        <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

        <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" @onUpdateReceivedProposals="onUpdateReceivedProposals" />

            <div class="content-main">
            <div class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
                <div class="top-bg-content-container pt-[30px] md:pt-[40px]">
                    <div class="main-container">

                        <section class="common_section">
                            <div v-if="all_biodatas.total > 0">
                                <h3 v-if="all_biodatas.total > 0" class="text-center my-4">
                                    {{ props.translations.proposal_page.received_count_title.replace(':count', all_biodatas.total) }}
                                </h3>
                                <div class="grid grid-cols-12 gap-0 text-gray-950 text-base">
                                    <div v-for="(single_biodata, single_biodata_key) in all_biodatas.data" :key="single_biodata.id" class="biodata_box  col-span-12 md:col-span-6 lg:col-span-4 p-2">
                                        <div  class="biodata_single_box relative grid grid-cols-12 gap-0 bg-[#ad277c] text-white text-base w-full overflow-hidden p-4 pb-2 shadow-md sm:max-w-md rounded-xl">
                                            <div class="biodata_single_box_upper col-span-12 p-2 pr-0">
                                                <h3 class="font-bold text-center">
                                                    {{ single_biodata.gender == 'male' ? props.translations.searchForm.male_title : props.translations.searchForm.female_title }}
                                                </h3>
                                                <p class="truncate font-bold text-center mb-4">
                                                    {{ props.translations.searchForm.biodata_code_title }} : {{ single_biodata.biodata_code }}
                                                </p>

                                                <img v-if="single_biodata.free_biodata" class="absolute top-4 right-4 animate__animated animate__heartBeat animate__delay-2s animate__infinite infinite" src="/assets/images/free.png" alt="free" width="30">

                                                <div class="leading-8">
                                                    <p class="truncate">
                                                        {{ props.translations.searchForm.biodata_age_title.replace(':age', getAge(single_biodata.birth_date)) }}, {{ single_biodata.height }}, {{ single_biodata.skin_color }}
                                                    </p>
                                                    <p class="truncate">
                                                        {{ highestDegreeSelection(single_biodata) }}
                                                    </p>
                                                    <p class="truncate">
                                                        {{ single_biodata.job_title }}{{ ['নাই', 'None', null].includes(single_biodata.monthly_income) ? '' : ' (' + single_biodata.monthly_income + ')' }}
                                                    </p>
                                                    <p class="truncate">
                                                        {{ single_biodata.permanent_upazila }}, {{ single_biodata.permanent_district }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="biodata_single_box_lower col-span-12 text-center mt-4 ">
                                                <p class="truncate">

                                                    <span v-if="!likeReceiverUserIds.includes(single_biodata.user_id)" @click="onClickLikeBiodata(single_biodata)" class="cursor-pointer">
                                                        <i class="fa-regular fa-thumbs-up"></i> {{ translations.profile_page.like_title }} &nbsp;
                                                    </span>
                                                    <span v-if="likeReceiverUserIds.includes(single_biodata.user_id)" @click="onClickDisLikeBiodata(single_biodata)" class="cursor-pointer">
                                                        <i class="fa-regular fa-thumbs-down"></i> {{ translations.profile_page.dislike_title }} &nbsp;
                                                    </span>

                                                    <span class="cursor-pointer">
                                                        <i class="fa-regular fa-message"></i> {{ translations.profile_page.message_title }} &nbsp;
                                                    </span>

                                                    <span @click="onClickSingleViewDetails(single_biodata, 4)" class="cursor-pointer">
                                                        <i class="fa fa-paper-plane"></i>
                                                        {{ translations.profile_page.interested_done_title }} &nbsp;
                                                    </span>

                                                    <span @click="onClickSingleViewDetails(single_biodata, 0)" class="cursor-pointer">
                                                        <i class="fa-regular fa-eye"></i>
                                                        {{ translations.profile_page.details_title }}
                                                    </span>

                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                        <template v-for=" (link, index) in all_biodatas.links" :key="index">
                                            <Link
                                                v-if="link.url && !link.active"
                                                :href="link.url"
                                                class="pagination-link px-1 border-2"
                                                v-html="link.label"
                                            />
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <template v-if="all_biodatas.total == 0">
                                <h3 class="p-2 text-center">
                                    {{ props.translations.proposal_page.received_no_items_title }}
                                </h3>
                            </template>
                            <div v-if="all_biodatas.total || all_biodatas.total == 0" class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                <Link :href="route('user.profile')" method="get"  as="button" class="bg-green-700 p-2 rounded-lg !text-white hover:!text-black hover:bg-green-100 transition-all font-bold" >
                                    BackToProfile
                                </Link>
                            </div>

                        </section>



                    </div>
                </div>
            </div>

        </div>

</template>
