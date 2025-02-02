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
document.body.classList.add("frontend.terms");


</script>


<template>

    <Head :title="`${translations.terms_page.page_header}`" />

    <GuestLayout :translations :locale :locales>

        <div class="content-main min-h-screen">
            <section id="terms_container">
                <div class="bg-[#3BA038] p-4">
                    <h1 class="od-banner-text">{{ translations.terms_page.page_header }}</h1>
                </div>
                <div class="od-faq-content-main">
                    <div class="main-container">
                        <div class="od-faq-content">
                            <div class="od-faq-item-list-content">
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_1_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_1_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_2_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_2_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_3_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_3_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_4_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_4_desc }`" class="od-body-part">
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_5_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_5_desc }`" class="od-body-part">
                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_6_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_6_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_7_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_7_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_8_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_8_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_9_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_9_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_10_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_10_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_11_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_11_desc }`" class="od-body-part">

                                        </div>
                                    </div>
                                </div>
                                <div class="od-accordion">
                                    <div class="od-group">
                                        <a class="od-accordion-link" href="#">{{ translations.terms_page.terms_12_title }}</a>
                                        <div v-html="`${ translations.terms_page.terms_12_desc }`" class="od-body-part">

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
