<script setup>

import { Head } from '@inertiajs/vue3';
import SearchForm from '../../Components/Frontend/Homepage/SearchForm/SearchForm.vue';

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
});

document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.home");


</script>


<template>

    <Head title="Home" />

    <div class="content-main min-h-screen">
        <section class="od-home-top-bg">
            <div class="top-bg-content-container pt-[90px] md:pt-[120px]">
                <div class="od-top-bg-content">

                    <section class="common_section">
                        <div class="main-container">
                            <div class="marquee_mother flex justify-between items-center bg-white">
                                <div class="marquee_child flex flex-row flex-grow-1 flex-fill justify-center items-center py-2 text-white px-1">
                                    <span class="d-flex align-items-center">
                                        {{ translations.homepage.marquee_title }}
                                    </span>
                                </div>
                                <div class="marquee_main">
                                    <div class="marquee_div">
                                        {{ translations.homepage.marquee_inner_text }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- <div class="od-top-bg-text">
                        <h1>{{ translations.homepage.main_heading_1 }}<span> {{ translations.homepage.main_heading_2
                                }}</span>
                        </h1>
                        <h2>{{ translations.homepage.main_sub_heading_1 }}</h2>
                        <div class="od-home-hadith-sec">
                            <p>{{ translations.homepage.quran_qoute_1 }} -</p>
                            <span>({{ translations.homepage.quran_qoute_1_source }})</span>
                        </div>
                    </div> -->


                    <section id="search_form" class="common_section">
                        <div class="main-container">
                            <SearchForm :translations :locale :districts />
                        </div>
                    </section>



                </div>
            </div>
        </section>
        <!-- <section class="od-section od-home-call-to-action">
            <h2> <span>Shadibari</span> {{ translations.homepage.biodata_section_heading }}</h2>
            <div class="cta-btn-group">
                <a href="#" class="od-button"><img
                        src="assets/images/plus-ico.svg" alt="Plus-icon">{{ translations.homepage.biodata_button_text }}</a>
                <a href="#" target="_blank" class="od-button second-btn"><img
                        src="assets/images/youtube-ico.svg" alt="YouTube-icon">{{ translations.homepage.biodata_instructions_button_text }}</a>
            </div>
        </section>


        <section class="od-section">
            <div class="main-container">
                <div class="od-section-widget-container">
                    <div class="od-section-widget-items od-row">
                        <div class="od-col-12">
                            <h2> <span>Shadibari</span> {{ translations.homepage.user_count_section_heading }}</h2>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/couple.svg" alt="Couple Icon">
                                <h4>{{ translations.homepage.user_count_box_1_title }}</h4>
                                <h3><span class="od-count od-total-profiles">6,940</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/male.svg" alt="Male Icon">
                                <h4>{{ translations.homepage.user_count_box_2_title }}</h4>
                                <h3><span class="od-count od-total-men-profiles">2,830</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/female.svg" alt="Female Icon">
                                <h4>{{ translations.homepage.user_count_box_3_title }}</h4>
                                <h3><span class="od-count od-total-female-profiles">4,099</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/married.svg" alt="Success Icon">
                                <h4>{{ translations.homepage.user_count_box_4_title }}</h4>
                                <h3><span class="od-count od-total-success-stories">2,099</span><span>+</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="od-section hiw-section">
            <div class="main-container">
                <div class="od-section-widget-container">
                    <div class="od-section-widget-items od-row">
                        <div class="od-col-12">
                            <h2> <span>Shadibari</span> {{ translations.homepage.how_to_section_title }}</h2>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/hiw-create-biodata.svg"
                                    alt="Create Biodata Icon">
                                <h3>{{ translations.homepage.how_to_box_1_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_1_text }}</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/hiw-search.svg" alt="Search Icon">
                                <h3>{{ translations.homepage.how_to_box_2_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_2_text }}</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/hiw-contact.svg" alt="Contact Icon">
                                <h3>{{ translations.homepage.how_to_box_3_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_3_text }}</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="assets/images/hiw-success.svg" alt="Success Icon">
                                <h3>{{ translations.homepage.how_to_box_4_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_4_text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
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
