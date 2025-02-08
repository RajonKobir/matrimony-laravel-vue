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

    <div class="content-main ">
        <section class="od-home-top-bg min-h-screen bg-[#FBD5B1]">
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


                    <section id="search_form" class="common_section">
                        <div class="main-container">
                            <SearchForm :translations :locale :districts />
                        </div>
                    </section>



                </div>
            </div>
        </section>

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
