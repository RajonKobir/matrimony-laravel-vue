<script setup>

import { Head } from '@inertiajs/vue3';
import SearchForm from '../../Components/Frontend/SearchForm.vue';

const props = defineProps({
    translations: {
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

    <div class="od-content-main">
        <section class="od-home-top-bg">
            <div class="od-top-bg-content-container">
                <div class="od-top-bg-content">

                    <div class="od-top-bg-text">
                        <h1>{{ translations.homepage.main_heading_1 }}<span> {{ translations.homepage.main_heading_2
                                }}</span>
                        </h1>
                        <h2>{{ translations.homepage.main_sub_heading_1 }}</h2>
                        <div class="od-home-hadith-sec">
                            <p>{{ translations.homepage.quran_qoute_1 }} -</p>
                            <span>({{ translations.homepage.quran_qoute_1_source }})</span>
                        </div>
                    </div>



                    <SearchForm :translations :locale />



                </div>
            </div>
        </section>
        <section class="od-section od-home-call-to-action">
            <h2> <span>Shadibari</span> {{ translations.homepage.biodata_section_heading }}</h2>
            <div class="cta-btn-group">
                <a href="https://ordhekdeen.com/user/account/edit-biodata" class="od-button"><img
                        src="https://ordhekdeen.com/images/plus-ico.svg" alt="Plus-icon">{{ translations.homepage.biodata_button_text }}</a>
                <a href="https://youtu.be/1NFkBACLdJU" target="_blank" class="od-button second-btn"><img
                        src="https://ordhekdeen.com/images/youtube-ico.svg" alt="YouTube-icon">{{ translations.homepage.biodata_instructions_button_text }}</a>
            </div>
        </section>

        <!-- Statictics -->
        <section class="od-section">
            <div class="od-container">
                <div class="od-section-widget-container">
                    <div class="od-section-widget-items od-row">
                        <div class="od-col-12">
                            <h2> <span>Shadibari</span> {{ translations.homepage.user_count_section_heading }}</h2>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/couple.svg" alt="Couple Icon">
                                <h4>{{ translations.homepage.user_count_box_1_title }}</h4>
                                <h3><span class="od-count od-total-profiles">6,940</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/male.svg" alt="Male Icon">
                                <h4>{{ translations.homepage.user_count_box_2_title }}</h4>
                                <h3><span class="od-count od-total-men-profiles">2,830</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/female.svg" alt="Female Icon">
                                <h4>{{ translations.homepage.user_count_box_3_title }}</h4>
                                <h3><span class="od-count od-total-female-profiles">4,099</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/married.svg" alt="Success Icon">
                                <h4>{{ translations.homepage.user_count_box_4_title }}</h4>
                                <h3><span class="od-count od-total-success-stories">2,099</span><span>+</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it works -->
        <section class="od-section hiw-section">
            <div class="od-container">
                <div class="od-section-widget-container">
                    <div class="od-section-widget-items od-row">
                        <div class="od-col-12">
                            <h2> <span>Shadibari</span> {{ translations.homepage.how_to_section_title }}</h2>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-create-biodata.svg"
                                    alt="Create Biodata Icon">
                                <h3>{{ translations.homepage.how_to_box_1_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_1_text }}</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-search.svg" alt="Search Icon">
                                <h3>{{ translations.homepage.how_to_box_2_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_2_text }}</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-contact.svg" alt="Contact Icon">
                                <h3>{{ translations.homepage.how_to_box_3_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_3_text }}</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-success.svg" alt="Success Icon">
                                <h3>{{ translations.homepage.how_to_box_4_title }}</h3>
                                <p>{{ translations.homepage.how_to_box_4_text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Client's feedback -->
        <!-- <section class="od-section">
    <div class="od-container">
        <div class="od-section-fbreview">
            <div class="od-section-fbreview-items od-row">
            	<div class="od-col-12">
            		<h2> <span>Shadibari তের</span> সেবা গ্রহীতাদের মন্তব্য</h2>
            	</div>
                <div class="od-section-fbreview-item od-col-12 od-col-sm-6">
                    <div class="od-section-fbreview-item-content">
                        <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FSaiful806%2Fposts%2Fpfbid02hwHNpYD4URsYu9J2L3HZxXf2Ko1YGaSv55T8VfbMcBcE4cvPNF3ypBTVrgJcDYkbl&width=552&show_text=false&height=266&appId" style="._2162._2_1h._rb9 {display: none !important;} " style="._2162._2_1h._rb9:100%; " allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    </div>
                </div>
                <div class="od-section-fbreview-item od-col-12 od-col-sm-6">
                    <div class="od-section-fbreview-item-content">
                        <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FNuruzzaman789%2Fposts%2Fpfbid037MRKNv6KgHt1HCBhAbcHJhrKBFVY4hHWt8i4tNH84bz1DQbbshS9XovshToPxeN1l&width=552&show_text=false&height=305&appId" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
        <input type="hidden" id="current_page_name" value="search_page">
        <input type="hidden" id="page_type" value="home">
        <input type="hidden" id="biodata_search_url" value="https://ordhekdeen.com/biodatas">
    </div>
</template>
