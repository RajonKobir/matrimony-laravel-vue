<script setup>

import { Head, Link, usePage } from '@inertiajs/vue3';
import GuestLayout from '../../Layouts/GuestLayout.vue';

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
    locales: {
        type: Object,
    },
    biodatas: {
        type: Object,
    },
});


// initializing
const page = usePage();
const csrf_token = page.props.csrf_token;


document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.home");


</script>


<template>


    <Head title="Home" />

    <GuestLayout :translations :locale :locales>
        <div class="content-main min-h-screen">
            <section class="od-home-top-bg">
                <div class="top-bg-content-container pt-[90px] md:pt-[120px]">
                    <div class="od-top-bg-content">

                        <section class="common_section">
                            <div class="main-container">
                                <h3 v-if="biodatas.total > 0" class="text-center my-4">
                                    {{ props.translations.searchForm.biodata_count_title.replace(':count', biodatas.total) }}
                                </h3>
                                <div class="grid grid-cols-12 gap-0 text-gray-950 text-base">
                                    <div v-for="single_biodata in biodatas.data" :key="single_biodata.id" class="biodata_box cursor-pointer col-span-12 md:col-span-6 lg:col-span-4 p-2">
                                        <div  class="biodata_single_box grid grid-cols-12 gap-0 bg-[#ad277c] text-white text-base w-full overflow-hidden p-4 pb-2 shadow-md sm:max-w-md rounded-xl">
                                            <div class="biodata_single_box_upper col-span-12 p-2 pr-0">
                                                <h3 class="font-bold text-center">
                                                    {{ single_biodata.gender == 'male' ? props.translations.searchForm.male_title : props.translations.searchForm.female_title }}
                                                </h3>
                                                <p class="truncate font-bold text-center mb-4">
                                                    {{ props.translations.searchForm.biodata_code_title }} : {{ single_biodata.biodata_code }}
                                                </p>

                                                <div class="leading-8">
                                                    <p class="truncate">
                                                        {{ props.translations.searchForm.biodata_age_title.replace(':age', single_biodata.age) }}, {{ single_biodata.height }}, {{ single_biodata.skin_color }}
                                                    </p>
                                                    <p class="truncate">
                                                        {{ single_biodata.general_highest_degree }}
                                                    </p>
                                                    <p class="truncate">
                                                        {{ single_biodata.job_title }}({{ single_biodata.monthly_income }})
                                                    </p>
                                                    <p class="truncate">
                                                        {{ single_biodata.permanent_upazila }}, {{ single_biodata.permanent_district }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="biodata_single_box_lower col-span-12 text-center mt-4 ">
                                                <p class="truncate">
                                                    <i class="fa-regular fa-thumbs-up"></i> পছন্দ &nbsp; <i class="fa-regular fa-message"></i> ম্যাসেজ &nbsp;
                                                    <i class="fa fa-paper-plane"></i>
                                                    আগ্রহী &nbsp;
                                                    <i class="fa-regular fa-eye"></i>
                                                    বিস্তারিত &nbsp;

                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                        <template v-if="biodatas.data.length > 0">
                                            <template v-for=" (link, index) in biodatas.links" :key="index">
                                                <Link
                                                    preserve-state
                                                    v-if="link.url && !link.active"
                                                    :href="link.url"
                                                    class="pagination-link px-1 border-2"
                                                    v-html="link.label"
                                                />
                                            </template>
                                        </template>

                                        <template v-if="biodatas.data.length == 0">
                                            <h3 class="p-2">
                                                {{ props.translations.searchForm.no_items_title }}
                                            </h3>
                                        </template>

                                    </div>

                                    <div class="px-1 pt-10 col-span-12 flex justify-center items-center">
                                        <Link :href="route('frontend.home')" method="get"  as="button" class="bg-green-700 p-2 rounded-lg text-white hover:text-black hover:bg-green-100 transition-all font-bold" >
                                            BackToHome
                                        </Link>
                                    </div>


                                </div>

                            </div>
                        </section>



                    </div>
                </div>
            </section>

        </div>

    </GuestLayout>

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
