<script setup>

import { ref, onMounted } from 'vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import PopupView from '../../Components/Frontend/Searchpage/ViewDetails/PopupView.vue';
import PopupMessage from '../../Components/Frontend/Searchpage/ViewDetails/PopupMessage.vue';
import axios from 'axios';
import 'animate.css';


const props = defineProps({
    translations: {
        type: Object,
    },
    districts: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Object,
    },
    biodatas: {
        type: Object,
    },
    single_biodata: {
        type: Object,
    },
    likes: {
        type: Object,
    },
    proposals: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const isPopupViewModalOpen = ref(false);
const isModalOpen = ref(false);
const modalInner = ref({});
const modalMessage = ref({});
const self_likes = ref({});
const self_proposals = ref({});
const likeReceiverUserIds = ref([]);
const proposalUserIds = ref([]);


const onClickLikeBiodata = (single_biodata) => {

    axios.post(route('user.likes.single_like', {
        csrf_token,
        sender_user_id : props.single_biodata.user_id,
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
    if( single_biodata.user_id == props.single_biodata.user_id){
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.self_like_error,
        }
        isModalOpen.value = true;
        return;
    }
    axios.post(route('user.likes.single_dislike', {
        csrf_token,
        sender_user_id : props.single_biodata.user_id,
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


const onClickProposeBiodata = (single_biodata) => {

    if(confirm( page.props.translations.modal_messages.proposal_send_confirm )){
        axios.post(route('user.proposals.single_propose', {
            csrf_token,
            sender_user_id : props.single_biodata.user_id,
            sender_biodata_code : page.props.single_biodata.biodata_code,
            receiver_user_id : single_biodata.user_id,
            receiver_biodata_code : single_biodata.biodata_code,
        }))
        .then((response) => {
            if( typeof response.data.message == 'undefined' ){
                if( response.request.responseURL ){
                    return router.visit(response.request.responseURL);
                }
            }else{
                if( response.data.message == true ){
                    proposalUserIds.value.push( single_biodata.user_id );
                    modalMessage.value = {
                        modalHeading : page.props.translations.modal_messages.success_heading,
                        modalDescription : page.props.translations.modal_messages.success_propose_message,
                    }
                    isModalOpen.value = true;
                }else{
                    modalMessage.value = {
                        modalHeading : page.props.translations.modal_messages.error_heading,
                        modalDescription : response.data.message,
                    }
                    isModalOpen.value = true;
                }
            }
        });
    }
}


const onClickSingleViewDetails = (single_biodata, tab_index) => {

    modalInner.value = {
        single_biodata,
        tab_index,
        self_proposals
    }
    isPopupViewModalOpen.value = true;
}

const closeModal = (value) => {
    isPopupViewModalOpen.value = value;
    isModalOpen.value = value;
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


onMounted(() => {

    setTimeout(() => {
        self_likes.value = page.props.likes;
        if( self_likes.value.length > 0 ){
            self_likes.value.forEach(function(item, index, arr){
                likeReceiverUserIds.value.push( item.receiver_user_id );
            })
        }
        self_proposals.value = page.props.proposals;
        if( self_proposals.value.length > 0 ){
            self_proposals.value.forEach(function(item, index, arr){
                if( item.receiver_user_id == props.single_biodata.user_id ){
                    proposalUserIds.value.push( item.sender_user_id );
                }else{
                    proposalUserIds.value.push( item.receiver_user_id );
                }
            })
        }
    }, 500);

})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.search");


</script>


<template>


    <Head title="Search" />

    <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

    <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" />

    <GuestLayout :translations :locale :locales :single_biodata >

            <div class="content-main">
            <div class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
                <div class="top-bg-content-container pt-[30px] md:pt-[40px]">
                    <div class="main-container">

                        <section class="common_section">
                            <h3 v-if="biodatas.total > 0" class="text-center my-4">
                                {{ props.translations.searchForm.biodata_count_title.replace(':count', biodatas.total) }}
                            </h3>
                            <div class="grid grid-cols-12 gap-0 text-gray-950 text-base">
                                <div v-for="single_biodata in biodatas.data" :key="single_biodata.id" class="biodata_box  col-span-12 md:col-span-6 lg:col-span-4 p-2">
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

                                                <span v-if="$page.props.auth.user && !likeReceiverUserIds.includes(single_biodata.user_id)" @click="onClickLikeBiodata(single_biodata)" class="cursor-pointer">
                                                    <i class="fa-regular fa-thumbs-up"></i> {{ translations.profile_page.like_title }} &nbsp;
                                                </span>
                                                <span v-if="$page.props.auth.user && likeReceiverUserIds.includes(single_biodata.user_id)" @click="onClickDisLikeBiodata(single_biodata)" class="cursor-pointer">
                                                    <i class="fa-regular fa-thumbs-down"></i> {{ translations.profile_page.dislike_title }} &nbsp;
                                                </span>
                                                <span v-if="!$page.props.auth.user" class="cursor-pointer">
                                                    <Link :href="route('register')" method="get" >
                                                        <i class="fa-regular fa-thumbs-up"></i> {{ translations.profile_page.like_title }} &nbsp;
                                                    </Link>
                                                </span>

                                                <span v-if="$page.props.auth.user" class="cursor-pointer">
                                                    <i class="fa-regular fa-message"></i> {{ translations.profile_page.message_title }} &nbsp;
                                                </span>
                                                <span v-if="!$page.props.auth.user" class="cursor-pointer">
                                                    <Link :href="route('register')" method="get" >
                                                        <i class="fa-regular fa-message"></i> {{ translations.profile_page.message_title }} &nbsp;
                                                    </Link>
                                                </span>

                                                <span v-if="$page.props.auth.user && !proposalUserIds.includes(single_biodata.user_id)" @click="onClickProposeBiodata(single_biodata)" class="cursor-pointer">
                                                    <i class="fa fa-paper-plane"></i>
                                                    {{ translations.profile_page.interested_title }} &nbsp;
                                                </span>
                                                <!-- <span v-if="$page.props.auth.user && $page.props.single_biodata.free_biodata && !single_biodata.free_biodata && !proposalUserIds.includes(single_biodata.user_id)" class="cursor-pointer">
                                                    <Link :href="route('user.packages')" method="get" >
                                                        <i class="fa fa-paper-plane"></i>
                                                        {{ translations.profile_page.interested_title }} &nbsp;
                                                    </Link>
                                                </span> -->
                                                <span v-if="$page.props.auth.user &&proposalUserIds.includes(single_biodata.user_id)" @click="onClickSingleViewDetails(single_biodata, 4)" class="cursor-pointer">
                                                    <i class="fa fa-paper-plane"></i>
                                                    {{ translations.profile_page.interested_done_title }} &nbsp;
                                                </span>
                                                <span v-if="!$page.props.auth.user" class="cursor-pointer">
                                                    <Link :href="route('register')" method="get" >
                                                        <i class="fa fa-paper-plane"></i>
                                                        {{ translations.profile_page.interested_title }} &nbsp;
                                                    </Link>
                                                </span>

                                                <span v-if="$page.props.auth.user" @click="onClickSingleViewDetails(single_biodata, 0)" class="cursor-pointer">
                                                    <i class="fa-regular fa-eye"></i>
                                                    {{ translations.profile_page.details_title }}
                                                </span>
                                                <span v-if="!$page.props.auth.user" class="cursor-pointer">
                                                    <Link :href="route('register')" method="get" >
                                                        <i class="fa-regular fa-eye"></i>
                                                        {{ translations.profile_page.details_title }}
                                                    </Link>
                                                </span>

                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                    <template v-if="biodatas.data.length > 0">
                                        <template v-for=" (link, index) in biodatas.links" :key="index">
                                            <Link
                                                preserve-state
                                                v-if="link.url && !link.active"
                                                :href="link.url"
                                                class="pagination-link px-1 border-2"
                                                v-html="link.label"
                                            />
                                        </template>
                                    </template>

                                    <template v-if="biodatas.data.length == 0">
                                        <h3 class="p-2">
                                            {{ props.translations.searchForm.no_items_title }}
                                        </h3>
                                    </template>

                                </div>

                                <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                    <Link :href="route('frontend.home')" method="get"  as="button" class="bg-green-700 p-2 rounded-lg !text-white hover:!text-black hover:bg-green-100 transition-all font-bold" >
                                        BackToHome
                                    </Link>
                                </div>


                            </div>
                        </section>



                    </div>
                </div>
            </div>
        </div>

    </GuestLayout>

</template>

<style>
.marquee_child{
    background: #ad277c;
    color: #FFFFFF;
    width: 160px;
    height: 60px;
    font-size: 24px;
}
.marquee_main{
    position: relative;
    overflow-x: hidden;
    width: 100vw;
    background: #3BA038;
    color: #FFFFFF;
    padding: 13px 0;
    font-size: 24px;
    height: 60px;
}

.marquee_div {
  position: absolute;
  white-space: nowrap;
  will-change: transform;
  animation: marquee 20s linear infinite;
}

@keyframes marquee {
    from {
        transform: translateX(50%);
    }
    to {
        transform: translateX(-100%);
    }
}
@media screen and (max-width: 768px) {
    .marquee_child{
        width: 60px;
        height: 40px;
        font-size: 16px;
    }
    .marquee_main{
        padding: 8px 0;
        font-size: 16px;
        height: 40px;
    }
    .marquee_div {
        animation: marquee 20s linear infinite;
    }
    @keyframes marquee {
        from {
            transform: translateX(25%);
        }
        to {
            transform: translateX(-100%);
        }
    }
}
</style>
