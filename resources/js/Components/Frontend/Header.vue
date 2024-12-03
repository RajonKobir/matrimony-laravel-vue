<script setup>

import { onMounted } from "vue";
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '../ApplicationLogo.vue';

const props = defineProps({
    locales: {
        type: Array,
    },
    locale: {
        type: String,
    },
});

onMounted(() => {
    // smooth sticky header
    let element = document.querySelector('#main_header'); 
    let element2 = document.querySelector('#main_header_inner'); 
    let isPositionSticky = (element.style.position == 'sticky');

    window.addEventListener("scroll", function(e){ 
        e.preventDefault();
        if (window.scrollY > 200 && !isPositionSticky){ 
            element.classList.add("amimate_header");
            element2.classList.add("header_transparent_background");
        }else {
            element.classList.remove("amimate_header");
            element2.classList.remove("header_transparent_background");
        } 
    });

    document.querySelector(".od-mobile-menu-trigger").addEventListener("click", function(e){
        e.preventDefault();
        document.querySelector(".od-menu-lists-container").classList.toggle("active");
    });

});


</script>

<template>
    <header id="main_header">
        <div id="od_header">
            <div id="main_header_inner" class="od-w-100">
                <div class="od-container">
                    <div class="od-row od-align-items-center">
                        <div class="od-col-4 od-col-md-3 md-order-2">
                            <div class="od-site-logo">
                                <Link href="/">
                                    <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                                </Link>
                            </div>
                        </div>
                        <div class="od-col-4 od-col-md-6 md-order-1">
                            <div class="od-mobile-menu-trigger">
                                <a href="#"><i class="fa fa-bars"></i></a>
                            </div>
                            <nav class="od-menu-lists-container">
                                <ul class="od-menu-lists ">
                                    <li class="od-menu-list-item">
                                        <Link href="/">হোম</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/about">আমাদের
                                            সম্পর্কে</Link>
                                        </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/faq">জিজ্ঞাসা</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/instructions">নির্দেশনা</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/contact">যোগাযোগ</Link>
                                    </li>
                                    <li class="od-menu-list-item od-localization-container hide-od-xl">
                                        <a href="javascript:void(0);">
                                            <div class="od-localization-content od-display-flex od-align-items-center">
                                                <div class="od-icon"><i class="fa fa-language"></i></div>
                                                <div class="od-selected-language">
                                                    <span>
                                                        {{ props.locale == 'en' ? 'Eng' : 'বাংলা' }}
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="od-dropdown-menu-container od-animate od-slideIn">
                                            <div class="od-dropdown-menu-content">
                                                <ul class="od-dropdown-menu-lists">
                                                    <li v-for="lang in locales">
                                                            <Link v-if="lang != locale" :href="route('localization', lang)">
                                                                {{ lang == 'en' ? 'English' : 'বাংলা' }}
                                                            </Link>
                                                        </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="od-col-4 od-col-md-3 md-order-3">
                            <div class="od-header-right-container">
                                <div class="od-menu-lists od-display-flex od-align-items-center od-justify-content-end">
                                    <div class="od-menu-list-item">
                                        <div class="od-localization-container hide-od">
                                            <a href="javascript:void(0);">
                                                <div
                                                    class="od-localization-content od-display-flex od-align-items-center">
                                                    <div class="od-icon"><i class="fa fa-language"></i></div>
                                                    <div class="od-selected-language">
                                                        <span>
                                                            {{ props.locale == 'en' ? 'Eng' : 'বাংলা' }}
                                                        </span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="od-dropdown-menu-container od-animate od-slideIn">
                                                <div class="od-dropdown-menu-content">
                                                    <ul class="od-dropdown-menu-lists">
                                                        <li v-for="lang in locales">
                                                            <Link v-if="lang != locale" :href="route('localization', lang)">
                                                                {{ lang == 'en' ? 'English' : 'বাংলা' }}
                                                            </Link>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="od-menu-list-item">
                                        <div class="od-my-account-container">
                                            <Link :href="route('login')" class="od-button signin-button">
                                                <i class="fa fa-user"></i>
                                                <span>লগইন</span>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

</template>