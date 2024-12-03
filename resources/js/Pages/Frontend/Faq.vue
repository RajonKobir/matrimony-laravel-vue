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

    <Head title="FAQ" />

    <GuestLayout :translations :locale :locales>

        <div class="od-content-main">
            <section id="od_faq_container">
                <div class="od-page-banner">
                    <h1 class="od-banner-text">সচরাচর জিজ্ঞাসা সমূহ</h1>
                </div>
                <div class="od-faq-content-main">
                    <div class="od-container">
                        <div class="od-faq-content">
                            <div class="od-faq-item-list-content">
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">অর্ধেকদ্বীন ডটকম কী? এটি কিভাবে কাজ
                                            করে?</a>
                                        <div class="od-body-part">
                                            <p>এটি একটি বাংলাদেশী ইসলামিক ম্যাটরিমনি ওয়েবসাইট। এটির যাত্রা শুরু হয়
                                                জানুয়ারির ১ তারিখ ২০২১ । এখানে উপজেলা ভিত্তিক প্রেক্টিসিং মুসলিম
                                                পাত্রপাত্রীর বায়োডাটা খোঁজা ও অভিভাবকের সাথে যোগাযোগ করা যায়। একই সাথে
                                                পাত্র-পাত্রী চাইলে ওয়েবসাইটে বায়োডাটা তৈরি করে জমা দিতে পারে।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">বায়োডাটা জমা দিতে কত টাকা লাগে?</a>
                                        <div class="od-body-part">
                                            <p>অর্ধেকদ্বীনে সম্পূর্ণ বিনামূল্যে বায়োডাটা জমা দেয়া যায়।<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">এই ওয়েবসাইট কি সবার জন্য উন্মুক্ত?</a>
                                        <div class="od-body-part">
                                            <p>না, এই ওয়েবসাইট সবার জন্য নয়, এই ওয়েবসাইট শুধুমাত্র প্রেক্টিসিং মুসলিমদের
                                                জন্য।&nbsp;<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">বায়োডাটা তৈরি করার কোনো বিশেষ শর্ত
                                            আছে?</a>
                                        <div class="od-body-part">
                                            <p>আমাদের ওয়েবসাইটে বায়োডাটা&nbsp; নূন্যতম আবশ্যকতা নিম্নরূপ-</p>
                                            <p><br></p>
                                            <p>পুরুষ-</p>
                                            <p>১/ ৫ ওয়াক্ত নামাযী হতে হবে।</p>
                                            <p>২/ ওয়াজিব দাড়ি সুন্নতি পদ্ধতিতে বড় থাকতে হবে।</p>
                                            <p>৩/ টাখনুর উপর কাপড় পরতে হবে।</p>
                                            <p>৪/ অভিভাবকের অনুমতি।</p>
                                            <p><br></p>
                                            <p>নারী-</p>
                                            <p>১/ ৫ ওয়াক্ত নামাযী হতে হবে।</p>
                                            <p>২/ “নিকাব” সহ ফরজ পর্দানশীন হতে হবে।</p>
                                            <p>৩/ অভিভাবকের অনুমতি।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">অর্ধেকদ্বীনে বায়োডাটা জমা দিলে আমার তথ্য
                                            কতটুকু গোপন থাকবে? কতটুকু প্রকাশিত হবে?</a>
                                        <div class="od-body-part">
                                            <p>আপনার বায়োডাটা এপ্রুভ করা হলে আপনার ও আপনার পিতা-মাতার নাম, মোবাইল
                                                নাম্বার এবং ইমেইল এড্রেস গোপন রাখা হবে। বাকি সকল তথ্য সাধারণ ইউজাররা
                                                দেখতে পারবে। অর্থাৎ সাধারণ ইউজাররা আপনার বায়োডাটা পড়তে পারবে কিন্ত আপনার
                                                পরিচয় জানতে পারবে না।
                                                <br><br>যদি কেউ বিয়ের জন্য যোগাযোগ করতে আগ্রহী হয় তাহলে কানেকশন ব্যবহার
                                                করে আপনার নাম, অভিভাবকের মোবাইল নাম্বার ও ইমেইল এড্রেস দেখতে পারবে এবং
                                                বিয়ের জন্য যোগাযোগ করতে পারবে। বিস্তারিত জানতে <a href="/privacy-policy"
                                                    target="_blank">Privacy Policy</a> পড়ুন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমার বায়োডাটা এপ্রুভ হয় নি কেন?</a>
                                        <div class="od-body-part">
                                            <p>বিভিন্ন কারণে বায়োডাটা এপ্রুভ করা হয় না। তার মাঝে কয়েকটি কারণ উল্লেখ করা
                                                হলো।<br><br>১/ যদি অভিভাবককে না জানিয়ে আমাদের ওয়েবসাইটে বায়োডাটা জমা
                                                দেয়া হয়।<br>২/ অভিভাবকের নাম্বারের ঘরে নিজের নাম্বার লিখে রাখলে।<br>৩/ ৫
                                                ওয়াক্ত নামাযী না হলে।<br>৪/ পুরুষদের ক্ষেত্রে, ওয়াজিব দাঁড়ি সুন্নতি
                                                পদ্ধতীতে বড় না থাকলে। (প্রাকৃতিক কারণে যাদের দাঁড়ি&nbsp;বড় হয় না তারা
                                                ব্যতীত।)<br>৫/ পুরুষদের ক্ষেত্রে, টাখনুর উপর কাপড় না পরলে।<br>৬/
                                                নারীদের&nbsp;ক্ষেত্রে, নিকাব সহ ফরজ পর্দা না করলে।<br>৭/ বায়োডাটাতে কোনো
                                                মিথ্যা তথ্য দিয়ে থাকলে।<br>৮/ বিশেষ প্রশ্নের উত্তর স্পষ্ট ভাবে না দিয়ে
                                                অন্য ভাবে দিলে। যেমনঃ অনেকেই শুধু “আলহামদুলিল্লাহ” বা “হুম” ইত্যাদি
                                                লিখেন, অথচ এটি দ্বারা হ্যাঁ/না স্পষ্টভাবে বোঝা যায় না ।<br>৯/ ইসলামের
                                                সাথে সাংঘর্ষিক কোনো কিছু লিখলে।<br></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">কিছু তথ্য সঠিকভাবে না দেয়ার কারণে আমার
                                            বায়োডাটা এপ্রুভ হয় নি, আমি কি আবার বায়োডাটা জমা দিতে পারবো?</a>
                                        <div class="od-body-part">
                                            <p>হ্যাঁ পারবেন। যে ঘরে ভুল তথ্য দেয়ার জন্য আপনার বায়োডাটা নট এপ্রুভ করা
                                                হয়েছে, সেই ঘরে সঠিক তথ্য দিয়ে বায়োডাটা&nbsp;<span
                                                    style="color: rgb(0, 0, 0); font-family: Arial; white-space: pre-wrap;">Submit
                                                </span>করবেন তাহলে এপ্রুভ করা হবে ইন শা আল্লাহ। তবে অর্ধেকদ্বীনের রুলস
                                                ফলো না করার কারণে যদি বায়োডাটা নট এপ্রুভ হয় তাহলে আর এপ্রুভ হবে
                                                না।&nbsp;</p>
                                            <div><br></div>
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
                                            <p>অর্ধেকদ্বীন সরাসরি পাত্র/পাত্রীর মাঝে যোগাযোগ করাকে সমর্থন করে না।
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
                                        <a class="od-accordion-link" href="#">অর্ধেকদ্বীনের মাধ্যমে বিয়ে করলে বিবাহ
                                            পরবর্তী কোনো সার্ভিস চার্জ পরিশোধ করতে হয়?</a>
                                        <div class="od-body-part">
                                            <p>না। অর্ধেকদ্বীনের মাধ্যমে বিয়ে করলে কোনো প্রকার বিবাহ পরবর্তী চার্জ
                                                পরিশোধ করতে হয় না।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি বাংলাদেশী নই, আমি কি বায়োডাটা জমা দিতে
                                            পারবো?</a>
                                        <div class="od-body-part">
                                            <p>না, আপাতত অর্ধেকদ্বীন শুধুমাত্র বাংলাদেশে কার্যক্রম পরিচালনা করছে। অন্য
                                                কোনো দেশের নাগরিক অর্ধেকদ্বীনের সেবা গ্রহণ করতে পারছে না।<br></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </GuestLayout>

</template>