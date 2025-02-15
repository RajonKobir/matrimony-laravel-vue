<script setup>

import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";
import PopupMessage from '../../Components/Frontend/Likes/PopupMessage.vue';
import PopupView from '../../Components/Frontend/Likes/PopupView.vue';
import 'animate.css';


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
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    single_biodata: {
        type: Object,
    },
    biodatas: {
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
const single_biodata_data = ref([]);
const isModalOpen = ref(false);
const modalMessage = ref({});
const all_biodatas = ref({});
const isPopupViewModalOpen = ref(false);
const modalInner = ref({});
const self_proposals = ref({});
const proposalReceiverUserIds = ref([]);


const closeModal = (value) => {
    isModalOpen.value = value;
    isPopupViewModalOpen.value = value;
}


const onClickDisLikeBiodata = (single_biodata) => {
    if( single_biodata.user_id == page.props.auth.user.id){
        modalMessage.value = {
            modalHeading : page.props.translations.modal_messages.error_heading,
            modalDescription : page.props.translations.modal_messages.self_like_error,
        }
        isModalOpen.value = true;
        return;
    }
    axios.post(route('likes.single_dislike', {
        csrf_token,
        sender_user_id : page.props.auth.user.id,
        sender_biodata_code : page.props.single_biodata.biodata_code,
        receiver_user_id : single_biodata.user_id,
        receiver_biodata_code : single_biodata.biodata_code,
    }))
    .then((response) => {
        if( response.data ){
            all_biodatas.value.data = all_biodatas.value.data.filter( function(item){
                return item.user_id != single_biodata.user_id;
            });
            all_biodatas.value.total--;
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.translations.modal_messages.remove_like_message,
            }
            isModalOpen.value = true;
        }else{
            all_biodatas.value.data = all_biodatas.value.data.filter( function(item){
                return item.user_id != single_biodata.user_id;
            });
            all_biodatas.value.total--;
        }
    });
}


const onClickProposeBiodata = (single_biodata) => {

    if(confirm( page.props.translations.modal_messages.proposal_send_confirm )){
        axios.post(route('proposals.single_propose', {
            csrf_token,
            sender_user_id : page.props.auth.user.id,
            sender_biodata_code : page.props.single_biodata.biodata_code,
            receiver_user_id : single_biodata.user_id,
            receiver_biodata_code : single_biodata.biodata_code,
        }))
        .then((response) => {
            if( response.data ){
                proposalReceiverUserIds.value.push( single_biodata.user_id );
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.success_heading,
                    modalDescription : page.props.translations.modal_messages.success_propose_message,
                }
                isModalOpen.value = true;
            }else{
                modalMessage.value = {
                    modalHeading : page.props.translations.modal_messages.error_heading,
                    modalDescription : page.props.translations.modal_messages.proposal_daily_limit,
                }
                isModalOpen.value = true;
            }
        });
    }
}


const onClickSingleViewDetails = (single_biodata, tab_index) => {

    let proposed = false;
    if( proposalReceiverUserIds.value.includes(single_biodata.user_id) ){
        proposed = true;
    }

    modalInner.value = {
        single_biodata,
        tab_index,
        proposed
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



onMounted(() => {

    setTimeout(() => {
        single_biodata_data.value = page.props.single_biodata;
        all_biodatas.value = page.props.biodatas;

        self_proposals.value = page.props.proposals;
        if( self_proposals.value.length > 0 ){
            self_proposals.value.forEach(function(item, index, arr){
                proposalReceiverUserIds.value.push( item.receiver_user_id );
            })
        }

    }, 500);
})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.likes");

</script>

<template>


    <Head title="Likes" />

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata="single_biodata_data">

        <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

        <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" />

            <div class="content-main">

                <div class="bg-[#3BA038] p-4">
                    <h1 class="od-banner-text">{{ translations.like_page.page_title }}</h1>
                </div>

                <div class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
                    <div class="top-bg-content-container pt-[30px] md:pt-[40px]">
                        <div class="main-container">

                            <section class="common_section">
                                <div v-if="all_biodatas.total > 0">
                                    <h3 v-if="all_biodatas.total > 0" class="text-center my-4">
                                        {{ props.translations.like_page.biodata_count_title.replace(':count', all_biodatas.total) }}
                                    </h3>
                                    <div class="grid grid-cols-12 gap-0 text-gray-950 text-base">
                                        <div v-for="single_biodata in all_biodatas.data" :key="single_biodata.id" class="biodata_box  col-span-12 md:col-span-6 lg:col-span-4 p-2">
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
                                                            {{ single_biodata.general_highest_degree }}
                                                        </p>
                                                        <p class="truncate">
                                                            {{ single_biodata.job_title }}({{ single_biodata.monthly_income }})
                                                        </p>
                                                        <p class="truncate">
                                                            {{ single_biodata.permanent_upazila }}, {{ single_biodata.permanent_district }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="biodata_single_box_lower col-span-12 text-center mt-4 ">
                                                    <p class="truncate">

                                                        <span @click="onClickDisLikeBiodata(single_biodata)" class="cursor-pointer">
                                                            <i class="fa-regular fa-thumbs-down"></i> {{ translations.profile_page.dislike_title }} &nbsp;
                                                        </span>

                                                        <span class="cursor-pointer">
                                                            <i class="fa-regular fa-message"></i> {{ translations.profile_page.message_title }} &nbsp;
                                                        </span>

                                                        <span v-if="!proposalReceiverUserIds.includes(single_biodata.user_id)" @click="onClickProposeBiodata(single_biodata)" class="cursor-pointer">
                                                            <i class="fa fa-paper-plane"></i>
                                                            {{ translations.profile_page.interested_title }} &nbsp;
                                                        </span>
                                                        <span v-if="proposalReceiverUserIds.includes(single_biodata.user_id)" @click="onClickSingleViewDetails(single_biodata, 4)" class="cursor-pointer">
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
                                        {{ props.translations.like_page.no_items_title }}
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

    </AuthenticatedLayout>

</template>
