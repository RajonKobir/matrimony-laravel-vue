<script setup>

import { Head } from '@inertiajs/vue3';

const props = defineProps({
    translations: {
        type: Object,
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
                        <h1>{{ translations.homepage.main_heading_1 }}<span> {{ translations.homepage.main_heading_2 }}</span>
                        </h1>
                        <h2>{{ translations.homepage.main_sub_heading_1 }}</h2>
                        <div class="od-home-hadith-sec">
                            <p>{{ translations.homepage.quran_qoute_1 }}। -</p>
                            <span>({{ translations.homepage.quran_qoute_1_source }})</span>
                        </div>
                    </div>

                    <div class="od-search-option">
                        <div class="od-search-fields">
                            <div class="od-search-option-label">আমি খুঁজছি</div>
                            <div class="od-search-option-input">
                                <select name="search_gender">
                                    <option value="no_selected" data-select2-id="3">সকল</option>
                                    <option value="3">পাত্রের বায়োডাটা</option>
                                    <option value="4">পাত্রীর বায়োডাটা</option>
                                </select>
                            </div>
                        </div>
                        <div class="od-search-fields">
                            <div class="od-search-option-label">বৈবাহিক অবস্থা</div>
                            <div class="od-search-option-input">
                                <select name="search_marriage_status">
                                    <option value="no_selected" data-select2-id="6">সকল</option>
                                    <option value="5">অবিবাহিত</option>
                                    <option value="6">বিবাহিত</option>
                                    <option value="7">ডিভোর্সড</option>
                                    <option value="8">বিধবা</option>
                                    <option value="9">বিপত্নীক</option>
                                </select>
                            </div>
                        </div>
                        <div class="od-search-fields">
                            <div class="od-search-option-label">স্থায়ী ঠিকানা</div>
                            <div class="od-search-option-input">
                                <div class="od-location-dropdown od-field-type__location od-biodata-search-control"
                                    data-field_id="10">
                                    <a href="#" class="od-location-dropdown-trigger">
                                        ঠিকানা নির্বাচন করুন
                                    </a>
                                    <div class="odl-wrap od-location-panel-wrap">
                                        <div class="odl-head">
                                            <h3>দেশ নির্বাচন করুন</h3>
                                            <a href="#" class="od-close-panel"><i class="fa fa-times"></i></a>
                                        </div>
                                        <div class="od-form-group-input">
                                            <input class="location-search" data-target="country" type="search"
                                                placeholder="দেশ খুঁজুন">
                                        </div>
                                        <ul class="odl-nav">
                                            <li><a href="#" data-handle="bangladesh" data-name="বাংলাদেশ"
                                                    data-country_name="bangladesh" data-total_index="3"
                                                    data-current_index="" data-has_index="yes">বাংলাদেশ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="od-search-fields odsf-submit">
                            <div class="od-submit-btn">
                                <button type="button" class="od-button"><i class="fa fa-search"></i>&nbsp;
                                    খুঁজুন</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="od-section od-home-call-to-action">
            <h2> <span>অর্ধেকদ্বীনে</span> সম্পূর্ণ বিনামূল্যে বায়োডাটা তৈরি করা যায়</h2>
            <div class="cta-btn-group">
                <a href="https://ordhekdeen.com/user/account/edit-biodata" class="od-button"><img
                        src="https://ordhekdeen.com/images/plus-ico.svg" alt="Plus-icon"> বায়োডাটা তৈরি করুন</a>
                <a href="https://youtu.be/1NFkBACLdJU" target="_blank" class="od-button second-btn"><img
                        src="https://ordhekdeen.com/images/youtube-ico.svg" alt="YouTube-icon"> যেভাবে বায়োডাটা তৈরি
                    করবেন</a>
            </div>
        </section>

        <!-- Statictics -->
        <section class="od-section">
            <div class="od-container">
                <div class="od-section-widget-container">
                    <div class="od-section-widget-items od-row">
                        <div class="od-col-12">
                            <h2> <span>অর্ধেকদ্বীন</span> সেবা গ্রহীতার পরিসংখ্যান</h2>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/couple.svg" alt="Couple Icon">
                                <h4>সর্বমোট পাত্র-পাত্রীর বায়োডাটা</h4>
                                <h3><span class="od-count od-total-profiles">6,940</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/male.svg" alt="Male Icon">
                                <h4>সর্বমোট পাত্রের বায়োডাটা</h4>
                                <h3><span class="od-count od-total-men-profiles">2,830</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/female.svg" alt="Female Icon">
                                <h4>সর্বমোট পাত্রীর বায়োডাটা</h4>
                                <h3><span class="od-count od-total-female-profiles">4,099</span></h3>

                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/married.svg" alt="Success Icon">
                                <h4>সর্বমোট সফল বিবাহ</h4>
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
                            <h2> <span>অর্ধেকদ্বীন</span> যেভাবে কাজ করে</h2>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-create-biodata.svg"
                                    alt="Create Biodata Icon">
                                <h3>বায়োডাটা তৈরি করুন</h3>
                                <p>খুব সহজেই বিনামূল্যে অর্ধেকদ্বীনে বায়োডাটা তৈরি করতে পারবেন।</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-search.svg" alt="Search Icon">
                                <h3>বায়োডাটা খুঁজুন</h3>
                                <p>বয়স, উপজেলা, পেশা, শিক্ষাগত যোগ্যতা সহ অনেক ফিল্টার ব্যবহার করে সহজেই বায়োডাটা খুঁজতে
                                    পারবেন।</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-contact.svg" alt="Contact Icon">
                                <h3>যোগাযোগ করুন</h3>
                                <p>আপনার বায়োডাটা কেউ পছন্দ করলে অথবা আপনি কারো বায়োডাটা পছন্দ করলে সরাসরি অভিভাবকের
                                    সাথে যোগাযোগ করতে পারবেন।</p>
                            </div>
                        </div>
                        <div class="od-section-widget-item od-col-12 od-col-sm-6 od-col-md-3">
                            <div class="od-section-widget-item-content">
                                <img src="https://ordhekdeen.com/images/hiw-success.svg" alt="Success Icon">
                                <h3>বিবাহ সম্পন্ন করুন</h3>
                                <p>বায়োডাটা ও কথাবার্তা পছন্দ হলে নিজ দায়িত্বে ভালভাবে খোঁজ নিয়ে সুন্নতি বিবাহ সম্পন্ন
                                    করুন।</p>
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
            		<h2> <span>অর্ধেকদ্বীনের</span> সেবা গ্রহীতাদের মন্তব্য</h2>
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