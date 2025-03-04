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
        if (window.scrollY > 0 && !isPositionSticky) {
            element.classList.add("amimate_header");
            element.classList.remove("header_backgound");
            element2.classList.add("header_transparent_background");
        } else {
            element.classList.add("header_backgound");
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


    <header id="main_header" class="header_backgound">
        <div id="od_header">
            <div id="main_header_inner" class="od-w-100">
                <div class="main-container">
                    <div class="od-row od-align-items-center">
                        <div class="od-col-4 od-col-md-3 md-order-2">
                            <div class="od-site-logo">
                                <Link href="/admin">
                                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                                </Link>
                            </div>
                        </div>
                        <div class="od-col-4 od-col-md-6 md-order-1">
                            <div class="od-mobile-menu-trigger">
                                <a href="#"><i class="fa fa-bars"></i></a>
                            </div>
                            <nav class="menu-lists-container">
                                <ul class="od-menu-lists ">
                                    <li class="od-menu-list-item od-localization-container hide-od-xl">
                                        <a href="javascript:void(0);">
                                            <div class="od-localization-content od-display-flex od-align-items-center">
                                                <div class="od-icon"><i class="fa fa-language text-gray-950"></i></div>
                                                <div class="od-selected-language">
                                                    <span class="text-gray-950">
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

                                    <li class="od-menu-list-item od-localization-container hide-od-xl">
                                        <a href="javascript:void(0);">
                                            <Link :href="route('backend.logout')" method="post" as="button" class="flex items-center justify-center md:ml-4 text-gray-950" >
                                                <img width="25" src="assets/images/logout-ico.svg" alt="Logout-icon" class="logout_image">
                                                Logout
                                            </Link>
                                        </a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <div class="od-col-4 od-col-md-3 md-order-3">
                            <div class="">
                                <div class="od-menu-lists od-display-flex od-align-items-center od-justify-content-end">
                                    <div class="od-menu-list-item">
                                        <div class="od-localization-container hide-od">
                                            <a href="javascript:void(0);">
                                                <div
                                                    class="od-localization-content od-display-flex od-align-items-center">
                                                    <div class="od-icon"><i class="fa fa-language text-gray-950"></i></div>
                                                    <div class="od-selected-language text-gray-950">
                                                        <span class="text-gray-950">
                                                            {{ props.locale == 'en' ? 'Eng' : 'বাংলা' }}
                                                        </span>
                                                        <i class="fa fa-angle-down text-gray-950"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="od-dropdown-menu-container od-animate od-slideIn">
                                                <div class="dropdown-menu-content">
                                                    <ul class="dropdown-menu-lists text-gray-950">
                                                        <li v-for="lang in locales" :key="lang.id" class=" text-gray-950">
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

                                    <div class="od-menu-list-item hide-od">
                                        <Link :href="route('backend.logout')" method="post" as="button" class="flex items-center justify-center md:ml-4 text-gray-950" >
                                            <img width="25" src="assets/images/logout-ico.svg" alt="Logout-icon" class="logout_image">
                                            Logout
                                        </Link>
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
.logout_image{
    background: #fef1f6;
    border-radius: 4px;
    width: 25px;
    height: 25px;
    filter: grayscale(100%);
    transition: filter .29s ease 0s;
    padding: 5px;
    border-radius: 4px;
    object-fit: contain;
    object-position: center;
}
.header_backgound{
    background-color: #FBD5B1;
}
.amimate_header{
    position: sticky !important;
    top: 0;
    z-index: 999 !important;
    /* animation-name: raj_the_dev;
    animation-duration: 0.5s;
    animation-timing-function: ease-in-out; */
}
@keyframes raj_the_dev {
    0% {
        top: -100px;
    }
    100% {
        top: 0;
    }
}
/* @media screen and (min-width: 768px) {
    .free_registration{
        display: none !important;
    }
} */
</style>
