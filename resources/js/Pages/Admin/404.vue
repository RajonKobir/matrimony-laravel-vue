<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
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


</script>


<template>

    <Head title="Page Not Found">
        <link rel="shortcut icon" :href="`/assets/css/images/favicon.png`">
        <link rel="stylesheet" :href="`/assets/css/frontend/frontend.css`">
        <link rel="stylesheet" :href="`/assets/css/frontend/font-awesome.min.css`">
    </Head>

    <AdminLayout :translations :locale :locales>
        <div class="flex min-h-screen flex-col items-center justify-center bg-gray-100">
            <div class="">
                <h3 class="p-2">
                    Sorry! Your desired page has not been found!
                </h3>
                <div class="text-center">
                    <Link :href="route('backend.dashboard')" method="get" as="button" class="bg-green-700 p-2 rounded-lg text-white hover:text-black hover:bg-green-100 transition-all" >
                        Back To Home
                    </Link>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>
