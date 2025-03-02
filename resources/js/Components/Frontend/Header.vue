<script setup>

import { ref, onMounted } from "vue";
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '../ApplicationLogo.vue';
import { Head } from '@inertiajs/vue3';
import 'animate.css';


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
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    single_biodata: {
        type: Object,
    },
});


//initializing
const deferredPrompt = ref(null);



onMounted(() => {
    // smooth sticky header
    let element = document.querySelector('#main_header');
    let element2 = document.querySelector('#main_header_inner');
    let isPositionSticky = (element.style.position == 'sticky');

    window.addEventListener("scroll", function (e) {
        e.preventDefault();
        if (window.scrollY > 0 && !isPositionSticky) {
            element.classList.add("amimate_header");
            element2.classList.add("header_transparent_background");
        } else {
            element.classList.remove("amimate_header");
            element2.classList.remove("header_transparent_background");
        }
    });

    document.querySelector(".od-mobile-menu-trigger").addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(".menu-lists-container").classList.toggle("active");
    });

});


</script>

<template>

    <Head>
        <link rel="stylesheet" :href="`/assets/css/frontend/frontend.css`">
        <link rel="stylesheet" :href="`/assets/css/frontend/font-awesome.min.css`">
    </Head>

    <header id="main_header">
        <div id="od_header">
            <div id="main_header_inner" class="od-w-100">
                <div class="main-container">
                    <div class="od-row od-align-items-center">
                        <div class="od-col-4 od-col-md-3 md-order-2">
                            <div class="od-site-logo">
                                <Link :href="route('frontend.home')">
                                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                                </Link>
                            </div>
                        </div>
                        <div class="od-col-4 od-col-md-6 md-order-1">
                            <div class="od-mobile-menu-trigger">
                                <a href="#"><i class="fa fa-bars"></i></a>
                            </div>
                            <nav class="menu-lists-container">
                                <ul class="od-menu-lists text-gray-950">
                                    <li class="od-menu-list-item font-bold">
                                        <Link :href="route('frontend.home')" >{{ translations.main_menu.home }}</Link>
                                    </li>
                                    <li class="od-menu-list-item font-bold">
                                        <Link :href="route('frontend.terms')" >{{ translations.main_menu.terms }}</Link>
                                    </li>
                                    <li class="od-menu-list-item font-bold">
                                        <Link :href="route('frontend.opinions')" >{{ translations.main_menu.opinions }}</Link>
                                    </li>
                                    <li v-if="!$page.props.auth.user" class="free_registration od-menu-list-item font-bold text-[#ad277c] animate__animated animate__fadeInLeft">
                                        <Link :href="route('register')" class="animate__animated animate__pulse animate__delay-2s animate__infinite infinite">{{ translations.main_menu.free_registration }}</Link>
                                    </li>
                                    <li class="od-menu-list-item od-localization-container hide-od-xl ">
                                        <a href="javascript:void(0);">
                                            <div class="od-localization-content od-display-flex od-align-items-center">
                                                <div class="od-icon"><i class="fa fa-language text-gray-950"></i></div>
                                                <div class="od-selected-language text-gray-950">
                                                    <span>
                                                        {{ props.locale == 'en' ? 'Eng' : 'বাংলা' }}
                                                    </span>
                                                    <i class="fa fa-angle-down text-gray-950"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="od-dropdown-menu-container od-animate od-slideIn">
                                            <div class="dropdown-menu-content">
                                                <ul class="dropdown-menu-lists text-gray-950">
                                                    <li v-for="lang in locales" :key="lang.id">
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
                                                    <div class="od-icon"><i class="fa fa-language text-gray-950"></i></div>
                                                    <div class="od-selected-language text-gray-950">
                                                        <span>
                                                            {{ props.locale == 'en' ? 'Eng' : 'বাংলা' }}
                                                        </span>
                                                        <i class="fa fa-angle-down text-gray-950"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="od-dropdown-menu-container od-animate od-slideIn">
                                                <div class="dropdown-menu-content">
                                                    <ul class="dropdown-menu-lists text-gray-950">
                                                        <li v-for="lang in locales" :key="lang.id">
                                                            <Link v-if="lang != locale"
                                                                :href="route('localization', lang)">
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
                                            <Link v-if="!$page.props.auth.user" :href="route('login')" class="od-button signin-button">
                                                <span>{{ translations.main_menu.login }}</span>
                                            </Link>
                                            <span v-if="$page.props.auth.user" :href="route('user.profile')" class="od-button signin-button">
                                                <i class="fa fa-user"></i>
                                            </span>

                                            <div v-if="$page.props.auth.user" class="od-dropdown-menu-container od-animate od-slideIn">
                                                <div class="odd-user-info">

                                                    <img v-if="single_biodata.gender == 'male'" src="assets/images/groom.png" alt="Male-Avatar" style="margin: 0 auto;">

                                                    <img v-if="single_biodata.gender == 'female'" src="assets/images/bride.png" alt="Female-Avatar" style="margin: 0 auto;">

                                                    <div class="odd-bio-status-wrap">
                                                        <h3 v-if="!single_biodata.is_approved">{{ translations.header.biodata_condition }}</h3>
                                                        <h3 v-if="single_biodata.is_approved" class="my-2 text-base">কোড : {{ single_biodata.biodata_code }}</h3>
                                                        <div class="odd-bio-status">
                                                            <span class="od-incomplete">{{ single_biodata.biodata_completion ? single_biodata.biodata_completion + '%' : '0%' }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <nav class="odd-nav dropdown-menu-content">
                                                    <ul class="dropdown-menu-lists">
                                                        <li>
                                                            <Link :href="route('user.profile')" as="button">
                                                                <img src="assets/images/editbiodata-ico.svg"
                                                                    alt="Edit biodata-icon">
                                                                    {{ translations.main_menu.biodata_settings }}
                                                            </Link>
                                                        </li>

                                                        <li>
                                                            <Link :href="route('user.likes')" method="get" as="button">
                                                                <i class="fa-regular fa-thumbs-up"></i> {{ translations.profile_page.like_title }}
                                                            </Link>
                                                        </li>

                                                        <li>
                                                            <button>
                                                                <i class="fa-regular fa-message"></i> {{ translations.profile_page.message_title }}
                                                            </button>
                                                        </li>

                                                        <li>
                                                            <Link :href="route('user.proposals')" method="get" as="button">
                                                                <i class="fa fa-paper-plane"></i>
                                                                {{ translations.profile_page.proposal_title }}
                                                            </Link>
                                                        </li>

                                                        <li>
                                                            <Link :href="route('user.packages')" method="get" as="button">
                                                                <i class="fa-solid fa-box"></i>
                                                                {{ translations.profile_page.package_title }}
                                                            </Link>
                                                        </li>

                                                        <li>
                                                            <Link :href="route('user.settings.edit')" as="button">
                                                                <img src="assets/images/settings-ico.svg"
                                                                    alt="Setting-icon">
                                                                    {{ translations.main_menu.profile_settings }}</Link>
                                                        </li>
                                                        <li>
                                                            <Link :href="route('logout')"
                                                            method="post" as="button" >
                                                                <img src="assets/images/logout-ico.svg"
                                                                    alt="Logout-icon">
                                                                    {{ translations.main_menu.logout }}
                                                            </Link>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>

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

<style>
/* @media screen and (min-width: 768px) {
    .free_registration{
        display: none !important;
    }
} */
</style>
