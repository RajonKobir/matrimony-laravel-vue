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
document.body.classList.add("frontend.opinions");


</script>


<template>

    <Head title="Opinions" />

    <GuestLayout :translations :locale :locales>

        <div class="content-main min-h-screen">
            <section id="opinions_container">
                <div class="bg-[#3BA038] p-4">
                    <h1 class="od-banner-text">{{ translations.opinions_page.page_header }}</h1>
                </div>
                <div class="od-faq-content-main">
                    <div class="main-container">
                        <div class="od-faq-content">
                            <div class="od-faq-item-list-content">

                                <h1 class="text-center py-4">
                                    শীঘ্রই আসছে...
                                </h1>

                                <!-- <div class="od-accordion">
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </GuestLayout>

</template>
