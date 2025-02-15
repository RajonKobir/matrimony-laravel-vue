<script setup>
import GuestLayout from '../../Layouts/GuestLayout.vue';
import { onMounted } from "vue";
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

onMounted(() => {

    let accordion_link = document.getElementsByClassName("od-accordion-link");

    for (var i = 0; i < accordion_link.length; i++) {
        accordion_link[i].addEventListener('click', function (e) {
            e.preventDefault();
            this.closest(".od-accordion").classList.contains("active") ? this.closest(".od-accordion").classList.remove("active") : this.closest(".od-accordion").classList.add("active");
        })
    }

});


document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.opinions");


</script>


<template>

    <Head title="Opinions" />

    <GuestLayout :translations :locale :locales :single_biodata >

        <div class="content-main min-h-screen">
            <section id="opinions_container">
                <div class="bg-[#3BA038] p-4">
                    <h1 class="od-banner-text">{{ translations.opinions_page.page_header }}</h1>
                </div>
                <div class="od-faq-content-main">
                    <div class="main-container">
                        <div class="od-faq-content">
                            <div class="od-faq-item-list-content">

                                <h1 class="text-center py-4">
                                    শীঘ্রই আসছে...
                                </h1>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </GuestLayout>

</template>
