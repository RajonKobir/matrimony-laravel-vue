<script setup>

import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";
import PopupMessage from '../../Components/Frontend/Likes/PopupMessage.vue';
import PopupView from '../../Components/Frontend/Likes/PopupView.vue';


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
});

// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;
const single_biodata_data = ref([]);
const isModalOpen = ref(false);
const modalMessage = ref({});
const isPopupViewModalOpen = ref(false);
const modalInner = ref({});



const form = useForm({
    csrf_token: csrf_token,
    selectedPackage: null,
});


const closeModal = (value) => {
    isModalOpen.value = value;
    isPopupViewModalOpen.value = value;
}



onMounted(() => {

    setTimeout(() => {
        single_biodata_data.value = page.props.single_biodata;
    }, 500);
})


document.body.classList.remove(...document.body.classList);
document.body.classList.add("user.packages");

</script>

<template>


    <Head title="Packages" />

    <AuthenticatedLayout :translations :locale :locales :canLogin :canRegister :single_biodata="single_biodata_data">

        <PopupMessage :translations :isModalOpen :modalMessage @closeModal=closeModal />

        <PopupView :translations :locale :locales :isPopupViewModalOpen :modalInner @closeModal="closeModal" />

            <div class="content-main">

                <div class="bg-[#3BA038] p-4">
                    <h1 class="od-banner-text">{{ translations.package_page.page_title }}</h1>
                </div>

                <div class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
                    <div class="top-bg-content-container pt-[30px] md:pt-[40px]">
                        <div class="main-container">

                            <section class="common_section">
                                <h1 class="text-center py-4">
                                    ফ্রি বায়োডাটা ছাড়া কাউকে প্রস্তাব পাঠাতে আপনাকে নিম্নের যেকোন একটি প্যাকেজ কিনতে হবে।
                                </h1>

                                <p>
                                    ক) ১ জনকে প্রস্তাব পাঠানো ১০০ টাকা।
                                    <br>
                                    <br>
                                    খ) ২ জন ১৮০ টাকা।
                                    <br>
                                    <br>
                                    গ) ৩ জন ২০০ টাকা।
                                    <br>
                                    <br>
                                    ঘ) ৫ জন ৩০০ টাকা।
                                    <br>
                                    <br>
                                    ঙ) ১০ জন ৫০০ টাকা।
                                    <br>
                                    <br>
                                    চ) ২৫ জন ১০০০ টাকা।
                                    <br>
                                    <br>
                                    ছ) স্পেশাল প্যাকেজ (৫০ জন ২০০০ টাকা)
                                    <br>
                                    <br>
                                    স্পেশাল প্যাকেজের সুবিধা সমূহ-
                                    <br>
                                    (১) ৫০ জনকে প্রস্তাব পাঠানো যাবে।
                                    <br>
                                    (২)বায়োডাটা রিসিভ হবার পরে যদি মনে হয় কোন ধর্মীয়,শিক্ষা,বা পারিবারিক তথ্য জানার প্রয়োজন আরো সেক্ষেত্রে  ম্যাসেজ পাঠানো যাবে উক্ত বিষয় লিখে।
                                    <br>
                                    (৩)বায়োডাটা ফ্রি করে দেয়া হবে। ফলে অন্য বায়োডাটা থেকে আপনার বায়োডাটায় ফ্রিতে প্রস্তাব পাঠাতে পারবে। এটির ফলে প্রস্তাব বেশি পাবার সম্ভাবনা থাকবে ইনশাআল্লাহ।
                                    <br>
                                    (৪) ফেসবুকে পোস্ট করা হবে বায়োডাটা যাতে করে অধিক প্রস্তাব পাওয়া যায়। তবে কেউ না চাইলে করা হবেনা পোস্ট।
                                    <br>
                                    (৫) ওয়েবসাইটের ফ্রন্টে রাখা হবে ১২ ঘন্টার জন্য যাতে যে কেউ সহজেই দেখে প্রস্তাব পাঠাতে পারে।
                                    <br>
                                    (৬) স্পেশালভাবে সার্চ করার অপশন পাবেন যা কিনা হোমপেইজে দেয়া আছে।
                                    <br>
                                    (৭) যদি আপনি চান আপনার চাহিদার বাইরে (যেমন-  জেলা,বয়স,উচ্চতা, শিক্ষা,পেশা,পারিবারিক অবস্থা,আকিদা/মাজহাব ইত্যাদি আপনার পছন্দের বাইরের প্রস্তাব আসবে না)  কোন প্রস্তাব আসবে না। সেক্ষেত্রেও এই প্যাকেজে আপনি এডমিনের সাথে কথা বলে উক্ত সুবিধাগুলো নিতে পারবেন।
                                    <br>
                                    (৮) নিজের বায়োডাটা হাইড করে মানে পাবলিকভাবে না দেখিয়েও প্রস্তাব পাঠাতে পারবেন। বি.দ্রঃ হাইড করে রাখলে বায়োডাটা কেউ দেখবে না আর কোন প্রস্তাব আসবে না। শুধু যাকে পাঠাবেন সে দেখতে পারবে।
                                    <br>

                                    বি.দ্রঃ এই  প্যাকেজে বিবাহ পরবর্তী ফি ৫ হাজার টাকা।
                                    <br>
                                    <br>
                                    (জ) মাসনা/সুলাসা/রুবায়া(২য়/৩য়/৪র্থ) বিয়ের ক্ষেত্রে প্যাকেজঃ ১ জনকে প্রস্তাব পাঠানো ৩৫০ টাকা ,২ জনকে ৫৫০ টাকা,৩ জনকে ৭৫০ টাকা ,৫ জন ১০৫০ টাকা, ১৫ জন ২০৫০ টাকা,৩০ জন ৩০৫০ টাকা।)

                                    <br>
                                    <br>

                                    >প্যাকেজ কিনতে নিম্নের পার্সোনাল নাম্বারে আপনার চাহিদা প্যাকেজ অনুযায়ী সেন্ড মানি করুন।

                                    <br>

                                    বিকাশ/নগদ/উপায়
                                    01644546402
                                    রকেট
                                    016445464020

                                    <br>

                                    টাকা পাঠিয়ে এডমিনের সাথে যোগাযোগ করুন
                                </p>

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

    </AuthenticatedLayout>

</template>
