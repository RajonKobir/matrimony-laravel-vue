<script setup>

import { Head, usePage, Link } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";
import PopupMessage from './PopupMessage.vue';
import PopupView from './PopupView.vue';


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

    axios.post(route('likes.single_like', {
        csrf_token,
        sender_user_id : page.props.auth.user.id,
        sender_biodata_code : page.props.single_biodata.biodata_code,
        receiver_user_id : single_biodata.user_id,
        receiver_biodata_code : single_biodata.biodata_code,
    }))
    .then((response) => {
        if( response.data ){
            likeReceiverUserIds.value.push( single_biodata.user_id );
            modalMessage.value = {
                modalHeading : page.props.translations.modal_messages.success_heading,
                modalDescription : page.props.translations.modal_messages.success_like_message,
            }
            isModalOpen.value = true;
        }
    });

}


const onClickDisLikeBiodata = (single_biodata) => {

    axios.post(route('likes.single_dislike', {
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
        tab_index
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
document.body.classList.add("user.proposals.detailed");

</script>

<template>


    <Head title="Detailed Proposals" />

        <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

        <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" />

            <div class="content-main">
            <div class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
                <div class="top-bg-content-container pt-[30px] md:pt-[40px]">
                    <div class="main-container">

                        <section class="common_section">
                            <h1 class="text-center py-4">
                                শীঘ্রই আসছে...
                            </h1>

                            <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
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
