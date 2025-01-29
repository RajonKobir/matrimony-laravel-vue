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
        accordion_link[i].addEventListener('click', function (e) {
            e.preventDefault();
            this.closest(".od-accordion").classList.contains("active") ? this.closest(".od-accordion").classList.remove("active") : this.closest(".od-accordion").classList.add("active");
        })
    }

});


document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.instructions");


</script>


<template>

    <Head title="Instructions" />

    <GuestLayout :translations :locale :locales>

        <div class="content-main min-h-screen">
            <!-- <section id="od_faq_container">
                <div class="od-page-banner">
                    <h1 class="od-banner-text">সাধারণ নির্দেশিকা</h1>
                </div>
                <div class="od-faq-content-main">
                    <div class="main-container">
                        <div class="od-faq-content">
                            <div class="od-faq-item-list-content">
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">Shadibari ডটকমে কিভাবে একাউন্ট তৈরি
                                            করবো?</a>
                                        <div class="od-body-part">
                                            <p>১) প্রথমে shadibari.com প্রবেশ করুন এবং হোম পেজের উপরের ডান কোণে থাকা
                                                ইউজার আইকনে ক্লিক করুন।<br><br>২) Create Account এ ক্লিক করুন।<br>
                                                <br>৩) রেজিস্ট্রেশন ফর্ম প্রদর্শিত হবে। আপনার নাম লিখুন এবং জেন্ডার
                                                সিলেক্ট করুন।<br> <br>৪) আপনার ইমেইল লিখে Verify বাটনে ক্লিক করুন। আপনার
                                                ইমেইল সঠিক হলে সেখানে একটি ভেরিফিকেশন কোড যাবে। নির্ধারিত স্থানে
                                                ভেরিফিকেশন কোড প্রবেশ করিয়ে Confirm বাটনে ক্লিক করে ইমেইল ভেরিফিকেশন
                                                সম্পন্ন করুন।<br> <br>৫) আপনার মোবাইল নাম্বার লিখে Verify বাটনে ক্লিক
                                                করুন। আপনার মোবাইল নাম্বার সঠিক হলে সেখানে একটি ভেরিফিকেশন কোড যাবে।
                                                নির্ধারিত স্থানে ভেরিফিকেশন কোড প্রবেশ করিয়ে Confirm বাটনে ক্লিক করে
                                                মোবাইল নাম্বার ভেরিফিকেশন সম্পন্ন করুন।<br> <br>৬) একটি পাসওয়ার্ড
                                                নির্বাচন করুন।<br> <br>৭) Shadibari -র <a href="/terms-and-conditions"
                                                    target="_blank">Terms and Condition</a> এবং <a href="
                                                    /privacy-policy" target="_blank">Privacy Policy</a> এর সাথে একমত
                                                হলে চেকবক্স চেক করুন। <br><br>৮) Create account বাটনে ক্লিক করে
                                                অ্যাকাউন্ট তৈরি সম্পন্ন করুন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">Shadibari ডটকমে কিভাবে
                                            বায়োডাটা জমা দিবো ?</a>
                                        <div class="od-body-part">
                                            <p>১. প্রথমে Shadibari তে লগইন করুন। Shadibari তে অ্যাকাউন্ট
                                                না থাকলে অ্যাকাউন্ট তৈরি করুন।<br><br> ২. লগইন করার পর
                                                হোম পেজ বা ড্যাশবোর্ড থেকে বায়োডাটা তৈরি করুন বাটনে
                                                ক্লিক করুন। <br><br>৩. বায়োডাটা তৈরির পূর্বে
                                                Shadibari তের শর্ত সমূহ পড়ুন এবং সম্মত হলে চেকবক্স চেক
                                                করে বায়োডাটা তৈরি করুন বাটনে ক্লিক করুন। <br><br>৪.
                                                বায়োডাটা ফর্ম প্রদর্শিত হবে। ফর্মে সকল তথ্য সঠিকভাবে
                                                দেয়া শেষ হলে বায়োডাটা রিভিউ পেজে প্রবেশ করবেন এবং সব
                                                তথ্য ভালভাবে পরিদর্শন করে Submit বাটনে ক্লিক করে
                                                বায়োডাটা জমা দিন। <br><br>৫. কয়েকদিনের মাঝে Shadibari
                                                কাস্টমার কেয়ার থেকে আপনার অভিভাবক এবং আপনাকে কল করে
                                                ভেরিফাই করা হতে পারে।<br><br>৬. Shadibari কাস্টমার
                                                কেয়ার কর্তৃক আপনার বায়োডাটা রিভিউ শেষে একটি মেইল দিয়ে
                                                এপ্রুভ অথবা নট-এপ্রুভ স্ট্যাটাস জানানো হবে ইন শা আল্লাহ
                                                । <br><br><br><b> লক্ষণীয়ঃ বায়াডাটায় সকল তথ্য স্পষ্ট করে
                                                    লিখবেন।</b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">Shadibari তে বায়োডাটা এডিট করবো
                                            কিভাবে?</a>
                                        <div class="od-body-part">
                                            <p>১. প্রথমে Shadibari একাউন্টে লগইন করুন।<br><br>২. লগইন করার
                                                উপরের ডান কোণে থাকা ইউজার আইকনে ক্লিক করুন।<br><br>৩. বায়োডাটা
                                                এডিট করুন বাটনে ক্লিক করুন।<br><br>৪. বায়োডাটা ফর্মটি প্রদর্শিত
                                                হবে, আপনি যে তথ্যটি এডিট করতে চান সেখানে প্রবেশ করে এডিট শেষে
                                                বায়োডাটা রিভিউ করুন এবং Submit বাটনে ক্লিক করুন।<br><br>৫.
                                                Shadibari কাস্টমার কেয়ার থেকে আপনার এডিট করা তথ্য রিভিউ করা
                                                হবে।<br><br>৬. রিভিউ শেষে একটি মেইল দিয়ে এপ্রুভ অথবা নট-এপ্রুভ
                                                স্ট্যাটাস জানানো হবে ইন শা আল্লাহ। </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">Shadibari তে বায়োডাটা সাময়িক সময়ের
                                            জন্য হাইড করবো কিভাবে?</a>
                                        <div class="od-body-part">
                                            <p><b>পাত্র/পাত্রী পক্ষের সাথে বিয়ের কথা চলা অবস্থায় আপনার বায়োডাটা
                                                    হাইড করে রাখুন।</b> এছাড়াও আপনি যে কোনো কারণে যে কোনো
                                                সময়কালের জন্য এক ক্লিকে বায়োডাটা হাইড করে রাখতে পারবেন। অর্থাৎ
                                                আপনার বায়োডাটা সার্চ রেজাল্টে দেখানো হবে না।<br><br><br>১.
                                                প্রথমে Shadibari একাউন্টে লগইন করুন।<br><br>২. লগইন করার পর
                                                ড্যাশবোর্ডে যান অথবা উপরের ডান কোণে থাকা ইউজার আইকনে ক্লিক
                                                করুন।<br><br>৩. Biodata Status এর নিচে স্লাইড বাটনে ক্লিক
                                                করুন।<br><br>৪. আপনাকে একটি কনফার্মেশন পপআপ দেখাবে।<br><br>৫. Ok
                                                বাটনে ক্লিক করে বায়োডাটা হাইড করুন। <br><br><br>একই উপায়ে আবার
                                                যে কোনো সময় বায়োডাটা লাইভ করতে পারবেন। তবে কোন তথ্য এডিট করা হলে
                                                কাস্টমার কেয়ার আপনার বায়োডাটা আবার রিভিউ করবে।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">Shadibari তে বায়োডাটা ডিলিট করবো
                                            কিভাবে?</a>
                                        <div class="od-body-part">
                                            <p>আপনি যে কোনো সময় আপনার বায়োডাটা নিজেই ডিলিট করতে
                                                পারবেন।<br><br><br>১. প্রথমে Shadibari একাউন্টে লগইন
                                                করুন।<br><br>২. লগইন করার পর ড্যাশবোর্ডে যান অথবা উপরের ডান কোণে
                                                থাকা ইউজার আইকনে ক্লিক করুন।<br><br>৩. সেটিংস এ ক্লিক
                                                করুন।<br><br>৪. বায়োডাটা ডিলিট বাটনে ক্লিক করে ডিলিট সম্পন্ন
                                                করুন। <br><br><br><b>লক্ষণীয়:</b> আপনার বায়োডাটা ডিলিট করলে আর
                                                ফেরত আনতে পারবেন না। সাময়িক সময়ের জন্য প্রয়োজন হলে হাইড করে
                                                রাখতে পারেন। </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">কোনো বায়োডাটার ব্যাপারে অভিযোগ
                                            করবো কিভাবে?</a>
                                        <div class="od-body-part">
                                            <p>আপনি কানেকশন ব্যবহারের মাধ্যমে কোনো বায়োডাটার যোগাযোগ তথ্য দেখে
                                                থাকলে, সেই বায়োডাটার ব্যাপারে কোনো অভিযোগ করতে
                                                চাইলে-<br><br><br>১. উক্ত বায়োডাটার নিচে Report বাটনে ক্লিক
                                                করুন। অথবা ড্যাশবোর্ড থেকে আমার ক্রয়সমূহ মেনুতে যান। সেখান থেকে
                                                অভিযুক্ত বায়োডাটার পাশের Report বাটনে ক্লিক করুন।<br><br>২.
                                                নির্ধারিত ফর্ম পূরণ করে আপনার অভিযোগ করুন।<br><br>কাস্টমার কেয়ার
                                                থেকে তা যাচাই করে উপযুক্ত পদক্ষেপ নেয়া হবে ইন শা আল্লাহ।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">কিভাবে কানেকশন ক্রয় করবো?</a>
                                        <div class="od-body-part">
                                            <p>Shadibari ডটকমে একজন পাত্র বা পাত্রীর অভিভাবকের যোগাযোগের
                                                নাম্বার দেখতে একটি কানেকশন ব্যবহার করতে হয়। নিম্নবর্ণিত উপায়ে
                                                কানেকশন ক্রয় করতে পারবেন- <br><br><br>১. প্রথমে Shadibari
                                                ড্যাসবোর্ডে প্রবেশ করুন। <br><br>২. “কানেকশন কিনুন” এই বাটনটিতে
                                                ক্লিক করুন। <br><br>৩. এই পেজে ৩ টি কানেকশন প্যাকেজ দেখতে পাবেন।
                                                আপনার প্রয়োজন অনুযায়ী একটি প্যাকেজ নির্বাচন করুন এবং Purchage
                                                Now বাটনটিতে ক্লিক করুন। <br><br>৪. বিকাশ অথবা নগদ যে একাউন্ট
                                                থেকে পেমেন্ট করতে চাচ্ছেন তা সিলেক্ট করুন এবং Pay Now বাটনে
                                                ক্লিক করুন। <br><br>৫. যদি বিকাশ সিলেক্ট করে Pay Now বাটনে ক্লিক
                                                করেন তাহলে বিকাশ থেকে পেমেন্ট করার চেক আউট দেখতে পারবেন। প্রথমে
                                                আপনার বিকাশ নাম্বারটি লিখুন এবং Confirm বাটনে ক্লিক
                                                করুন।<br><br>৬. আপনার বিকাশ মোবাইল নাম্বারে একটি OTP কোড যাবে
                                                সেটি প্রবেশ করান এবং Confirm বাটনে ক্লিক করুন। <br><br>৭. আপনার
                                                বিকাশের PIN কোডটি বসান এবং Confirm বাটনে ক্লিক করুন। <br><br>৮.
                                                এভাবে খুব সহজেই আপনার পেমেন্ট করা সম্পন্ন হবে এবং আপনার একাউন্টে
                                                কানেকশন যোগ হয়ে যাবে ইন শা আল্লাহ। <br><br>৯. ড্যাসবোর্ডে এসে
                                                আপনার কানেকশন দেখতে পারবেন এবং অভিভাবকের নাম্বার পেতে এটি
                                                ব্যবহার করতে পারবেন।</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">কিভাবে কানেকশন রিফান্ড পেতে
                                            পারি?</a>
                                        <div class="od-body-part">
                                            <p>কানেকশন ব্যবহার করে কোনো বায়োডাটার যোগাযোগ তথ্য নিয়ে যোগাযোগ করতে
                                                ব্যর্থ হলে আপনি কানেকশন ফেরত পেতে পারেন। তবে বিপরীত পক্ষ যদি
                                                তাদের ব্যক্তিগত অপছন্দের কারণে আপনার প্রস্তাব প্রত্যাখ্যান করে
                                                তাহলে রিফান্ড পাবেন না।<br><br>১) সর্বপ্রথম উক্ত বায়োডাটার সবার
                                                নিচে Report বাটনে ক্লিক করুন। অথবা ড্যাশবোর্ড থেকে আমার
                                                ক্রয়সমূহ মেনুতে যান। সেখান থেকে সেই বায়োডাটার পাশের Report
                                                বাটনে ক্লিক করুন। <br><br>২) নির্ধারিত ফর্ম পূরণ করে আপনার
                                                অভিযোগ দাখিল করুন। কাস্টমার কেয়ার থেকে আপনার অভিযোগ যাচাই করা
                                                হবে এবং খুব দ্রুত আপনাকে জানানো হবে ইন শা আল্লাহ।
                                                <br><br><br>বিস্তারিত জানতে Shadibari তের <a href="/refund-policy"
                                                    target="_blank">Refund Policy</a><a href="/refund-policy"
                                                    target="_blank"></a> দেখুন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">আমি Shadibari একাউন্ট ডিলিট করতে
                                            চাই। আমার অবশিষ্ট কানেক্ট কাজে লাগছেনা, কিভাবে টাকা রিফান্ড পেতে
                                            পারি?</a>
                                        <div class="od-body-part">
                                            <p>আমাদের রিফান্ড পলিসিতে বিস্তারিত লিখা আছে। এখানে ক্লিক করুন <a
                                                    href="/refund-policy" target="_blank">রিফান্ড পলিসি</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
        </div>

    </GuestLayout>

</template>
