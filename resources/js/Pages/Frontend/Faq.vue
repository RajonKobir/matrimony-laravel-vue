<script setup>
import GuestLayout from '../../Layouts/GuestLayout.vue';
import { onMounted } from "vue";
import { Head } from '@inertiajs/vue3';

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
});

onMounted(() => {

    let accordion_link = document.getElementsByClassName("od-accordion-link");

    for (var i = 0; i < accordion_link.length; i++) {
        accordion_link[i].addEventListener('click', function(e){
            e.preventDefault();
            this.closest(".od-accordion").classList.contains("active") ? this.closest(".od-accordion").classList.remove("active") : this.closest(".od-accordion").classList.add("active");
        })
    }

});


document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.faq");


</script>


<template>

    <Head :title="`${translations.faq_page.page_header}`" />

    <GuestLayout :translations :locale :locales>

        <div class="content-main min-h-screen">
           <!--  <section id="od_faq_container">
                <div class="od-page-banner">
                    <h1 class="od-banner-text">{{ translations.faq_page.page_header }}</h1>
                </div>
                <div class="od-faq-content-main">
                    <div class="main-container">
                        <div class="od-faq-content">
                            <div class="od-faq-item-list-content">
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_1_title }}</a>
                                        <div class="od-body-part">
                                            <p>
                                                {{ translations.faq_page.faq_1_desc }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_2_title }}</a>
                                        <div class="od-body-part">
                                            <p>{{ translations.faq_page.faq_2_desc }}<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_3_title }}</a>
                                        <div class="od-body-part">
                                            <p>{{ translations.faq_page.faq_3_desc }}<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_4_title }}</a>
                                        <div v-html="`${ translations.faq_page.faq_4_desc }`" class="od-body-part">
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_5_title }}</a>
                                        <div v-html="`${ translations.faq_page.faq_5_desc }`" class="od-body-part">
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_6_title }}</a>
                                        <div v-html="`${ translations.faq_page.faq_6_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.faq_page.faq_7_title }}</a>
                                        <div v-html="`${ translations.faq_page.faq_7_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি ৫ ওয়াক্ত নামাযী, কিন্ত আমি সুন্নতী
                                            দাঁড়ি রাখি নি, আমি বায়োডাটা আপলোড করতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>আপনি বায়োডাটা আপলোড করলে এপ্রুভ করা হবে না। যাদের বর্তমানে ওয়াজিব
                                                দাঁড়ি&nbsp;আছে শুধুমাত্র তাদের বায়োডাটা এপ্রুভ করা হবে। (প্রাকৃতিক কারণে
                                                যাদের দাঁড়ি বড় হয় না তারা ব্যতীত।)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমার একটি বায়োডাটা পছন্দ হয়েছে, আমি কি
                                            সরাসরি সেই পাত্র/পাত্রীর সাথে যোগাযোগ করতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>Shadibari সরাসরি পাত্র/পাত্রীর মাঝে যোগাযোগ করাকে সমর্থন করে না।
                                                শুধুমাত্র পাত্র/পাত্রীর অভিভাবকের সাথেই যোগাযোগ করতে পারবেন।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি ৫ ওয়াক্ত নামাযী, আমি বোরকা ও হিজাব পরি
                                            তবে নিকাব পরি না। আমি বায়োডাটা আপলোড করতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>আপনি বায়োডাটা আপলোড করলে এপ্রুভ করা হবে না। যারা নিকাব সহ ফরজ পর্দানশীন
                                                শুধুমাত্র তাদের বায়োডাটা এপ্রুভ করা হয়।<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমার অভিভাবক আমার বিয়েতে রাজি নয়, আমি কি
                                            বায়োডাটা জমা দিতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>আমাদের ওয়েবসাইটে বায়োডাটা তৈরি করতে হলে অবশ্যই পাত্র/পাত্রীর অভিভাবকের
                                                অনুমতি নিয়ে জমা দিতে হবে। অন্যথায় বায়োডাটা এপ্রুভ করা হয় না।<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি একজন ছাত্র, আমার এখনো কোনো আয় নেই, আমি
                                            কি বায়োডাটা আপলোড করতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>হ্যাঁ, পারবেন। তবে অবশ্যই আপনার অভিভাবকের অনুমতি নিয়ে বায়োডাটা তৈরি করতে
                                                হবে।<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">বায়োডাটা জমা দেয়ার পর বিয়ে হয়ে গেলে বা
                                            অন্য কারণে বায়োডাটা ডিলিট করতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>হ্যাঁ, আপনার যখন ইচ্ছা তখন বায়োডাটা ডিলিট করতে পারবেন।&nbsp;<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">একজনের বায়োডাটা আরেকজন তৈরি করতে
                                            পারবে?</a>
                                        <div class="od-body-part">
                                            <p>আমাদের বায়োডাটা ফর্মে অনেক ব্যক্তিগত প্রশ্ন রয়েছে, যেগুলোর উত্তর একমাত্র
                                                পাত্র/পাত্রী নিজেই ভাল জানেন। অন্য কেউ যদি বায়োডাটা তৈরি করে দেয়, তাহলে
                                                সেই প্রশ্নগুলোর উত্তর বাহ্যিকভাবে সত্য হলেও কিছু ত্রুটি থেকে যেতে পারে।
                                                এজন্য যিনি পাত্র/পাত্রী তাকেই লিখতে হবে, এমন শর্ত আবশ্যক করা হয়েছে।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি ইন্টারনেট ব্যবহারে দক্ষ নই। আমি কিভাবে
                                            বায়োডাটা তৈরি করবো?</a>
                                        <div class="od-body-part">
                                            <p>এক্ষেত্রে ইন্টারনেট ব্যবহারে দক্ষ ব্যক্তিকে পাশে বসিয়ে আপনি বায়োডাটায়
                                                উল্লেখিত প্রশ্নগুলোর উত্তর বলে দিবেন। ঐ ব্যক্তি আপনার বায়োডাটার তথ্যগুলো
                                                টাইপ করে আপনার বায়োডাটা তৈরিতে সাহায্য করবে।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">Shadibari তের মাধ্যমে বিয়ে করলে বিবাহ
                                            পরবর্তী কোনো সার্ভিস চার্জ পরিশোধ করতে হয়?</a>
                                        <div class="od-body-part">
                                            <p>না। Shadibari তের মাধ্যমে বিয়ে করলে কোনো প্রকার বিবাহ পরবর্তী চার্জ
                                                পরিশোধ করতে হয় না।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি বাংলাদেশী নই, আমি কি বায়োডাটা জমা দিতে
                                            পারবো?</a>
                                        <div class="od-body-part">
                                            <p>না, আপাতত Shadibari শুধুমাত্র বাংলাদেশে কার্যক্রম পরিচালনা করছে। অন্য
                                                কোনো দেশের নাগরিক Shadibari তের সেবা গ্রহণ করতে পারছে না।<br></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
        </div>

    </GuestLayout>

</template>
