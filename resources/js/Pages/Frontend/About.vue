<script setup>
import GuestLayout from '../../Layouts/GuestLayout.vue';
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
    single_biodata: {
        type: Object,
    },
});

document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.about");

</script>


<template>

    <Head :title="`${translations.about_page.page_header}`" />

    <GuestLayout :translations :locale :locales :single_biodata >

        <div class="content-main">
            <section id="od_page_container">
                <div class="od-page-banner">
                    <h1 class="od-banner-text">{{ translations.about_page.page_header }}</h1>
                </div>
                <div class="od-page-content-main">
                    <div class="main-container">
                        <div class="od-page-content">
                            <div style="text-align: center;">
                                <span
                                    style="color: rgb(32, 33, 34); font-family: sans-serif; font-size: 24px; text-align: start;">بِسْمِ
                                    ٱللَّٰهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
                                </span>
                                <br><br>
                            </div>
                            {{ translations.about_page.quran_quote_1 }}
                            <br><br>
                            {{ translations.about_page.quran_explanation_1 }}
                            <br><br>
                            {{ translations.about_page.quran_explanation_2 }}
                            <br><br>
                            {{ translations.about_page.quran_explanation_3 }}
                            <br><br>
                            {{ translations.about_page.quran_explanation_4 }}
                            <br><br><br>
                            <h3>
                                {{ translations.about_page.contact_section_heading }}
                            </h3>
                            <br>
                            {{ translations.company_info.company_title }}<br>
                            {{ translations.company_info.company_address_text }}<br>
                            {{ translations.company_info.company_trade_license_text }} <br>
                            {{ translations.company_info.company_contact_number_text }} <br>
                            {{ translations.company_info.company_email_text }} <a href="mailto:contact@shadibari.com">contact@shadibari.com</a><br><br><br>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </GuestLayout>

</template>
