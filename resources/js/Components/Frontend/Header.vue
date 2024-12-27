<script setup>

import { onMounted } from "vue";
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '../ApplicationLogo.vue';

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
});

onMounted(() => {
    // smooth sticky header
    let element = document.querySelector('#main_header');
    let element2 = document.querySelector('#main_header_inner');
    let isPositionSticky = (element.style.position == 'sticky');

    window.addEventListener("scroll", function (e) {
        e.preventDefault();
        if (window.scrollY > 200 && !isPositionSticky) {
            element.classList.add("amimate_header");
            element2.classList.add("header_transparent_background");
        } else {
            element.classList.remove("amimate_header");
            element2.classList.remove("header_transparent_background");
        }
    });

    document.querySelector(".od-mobile-menu-trigger").addEventListener("click", function (e) {
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
                                        <Link href="/">{{ translations.main_menu.home }}</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/about">{{ translations.main_menu.about }}</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/faq">{{ translations.main_menu.faq }}</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/instructions">{{ translations.main_menu.instructions }}</Link>
                                    </li>
                                    <li class="od-menu-list-item">
                                        <Link href="/contact">{{ translations.main_menu.contact }}</Link>
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
                                            <Link :href="$page.props.auth.user ? '#' : route('login')" class="od-button signin-button">
                                            <i v-if="$page.props.auth.user" class="fa fa-user"></i>
                                            <span v-if="!$page.props.auth.user">{{ translations.main_menu.login }}</span>
                                            </Link>

                                            <div v-if="$page.props.auth.user" class="od-dropdown-menu-container od-animate od-slideIn">
                                                <div class="odd-user-info">

                                                    <img src="https://ordhekdeen.com/images/male.svg" alt="Male-Avatar" style="margin: 0 auto;">


                                                    <div class="odd-bio-status-wrap">
                                                        <h3>বায়োডাটার অবস্থা</h3>
                                                        <div class="odd-bio-status">
                                                            <span class="od-incomplete">Incomplete</span>
                                                        </div>

                                                    </div>

                                                    <div class="od-preview-biodata-link">
                                                        <a class="od-button"
                                                            href="/dashboard">আমার
                                                            বায়োডাটা</a>
                                                    </div>
                                                </div>
                                                <nav class="odd-nav od-dropdown-menu-content">
                                                    <ul class="od-dropdown-menu-lists">
                                                        <li>
                                                            <Link :href="route('user.profile')" as="button">
                                                                <img src="https://ordhekdeen.com/images/editbiodata-ico.svg"
                                                                    alt="Edit biodata-icon">
                                                                    {{ translations.main_menu.biodata_settings }}
                                                            </Link>
                                                        </li>

                                                        <!-- <li>
                                                            <a href="https://shadibari.com/user/account/short-list">
                                                                <img src="https://shadibari.com/images/shortlist-ico.svg"
                                                                    alt="Shortlist-icon">
                                                                পছন্দের তালিকা
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://shadibari.com/user/account/ignore-list">
                                                                <img src="https://shadibari.com/images/ignorelist-ico.svg"
                                                                    alt="Ignorelist-icon">
                                                                অপছন্দের তালিকা
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://shadibari.com/user/account/my-purchased">
                                                                <img src="https://shadibari.com/images/mypurchased-ico.svg"
                                                                    alt="Mypurchased-icon">
                                                                আমার ক্রয়সমূহ
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="https://shadibari.com/user/account/support-report">
                                                                <img src="https://shadibari.com/images/support-ico.svg"
                                                                    alt="Support-icon">
                                                                সাপোর্ট &amp; রিপোর্ট
                                                            </a>
                                                        </li> -->
                                                        <li>
                                                            <Link :href="route('user.settings.edit')" as="button">
                                                                <img src="https://ordhekdeen.com/images/settings-ico.svg"
                                                                    alt="Setting-icon">
                                                                    {{ translations.main_menu.profile_settings }}</Link>
                                                        </li>
                                                        <li>
                                                            <Link :href="route('logout')"
                                                            method="post" as="button" >
                                                                <img src="https://ordhekdeen.com/images/logout-ico.svg"
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
