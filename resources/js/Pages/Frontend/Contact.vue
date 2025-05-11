<script setup>
import GuestLayout from '../../Layouts/GuestLayout.vue';
import { onMounted } from "vue";
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '../../Components/PrimaryButton.vue';

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


const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submit = () => {
    form.post(route('mails.frontend.contact.post'), {
        onFinish: () => form.reset('name', 'email', 'subject', 'message'),
    });
};

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
document.body.classList.add("frontend.contact");


</script>


<template>

    <Head title="Contact" />

    <GuestLayout :translations :locale :locales :single_biodata >

        <div class="content-main">
            <section id="od_contact_us">
                <div class="od-page-banner">
                    <h1 class="od-banner-text">যোগাযোগ করুন</h1>
                </div>
                <div class="od-contact-us-form-content">
                    <div class="od-contact-us-form-top od-text-align-center">
                        <p>আপনার যে কোন জিজ্ঞাসা, নিম্নোক্ত ফর্মে পূরণ করে আমাদের কাছে পাঠিয়ে দিন। </p>
                        <p>আমরা শীঘ্রই আপনার সাথে যোগাযোগ করবো ইন শা আল্লাহ। </p>
                    </div>

                    <div class="mt-1 od-contact-us-form-top od-text-align-center">
                        <div v-if="$page.props.flash.success" class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ $page.props.flash.success }}
                            </div>
                        </div>
                        <div v-if="$page.props.flash.error" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ $page.props.flash.error }}
                            </div>
                        </div>
                    </div>

                    <div class="od-contact-us-form">
                        <div class="od-contact-us-form-container">
                            <div class="od-card">
                                <div class="od-card-body">

                                    <form id="contactUSForm" @submit.prevent="submit">

                                        <div class="od-form-group-container">
                                            <div class="od-form-group-label">
                                                <label>নাম</label>
                                            </div>
                                            <div class="od-form-group-input">
                                                <input v-model="form.name" type="text" maxlength="50" name="name" required>
                                            </div>
                                            <div v-if="form.errors.name">{{ form.errors.name }}</div>
                                        </div>
                                        <div class="od-form-group-container">
                                            <div class="od-form-group-label">
                                                <label>ইমেইল</label>
                                            </div>
                                            <div class="od-form-group-input">
                                                <input v-model="form.email" type="email" maxlength="50" name="email" required>
                                            </div>
                                            <div v-if="form.errors.email">{{ form.errors.name }}</div>
                                        </div>
                                        <div class="od-form-group-container">
                                            <div class="od-form-group-label">
                                                <label>বিষয়</label>
                                            </div>
                                            <div class="od-form-group-input">
                                                <input v-model="form.subject" type="text" maxlength="50" name="subject" required>
                                            </div>
                                            <div v-if="form.errors.subject">{{ form.errors.subject }}</div>
                                        </div>
                                        <div class="od-form-group-container">
                                            <div class="od-form-group-label">
                                                <label>আপনার বার্তা</label>
                                            </div>
                                            <div class="od-form-group-input">
                                                <textarea v-model="form.message" name="message" maxlength="300" required></textarea>
                                            </div>
                                            <div v-if="form.errors.message">{{ form.errors.message }}</div>
                                        </div>

                                        <div class="od-form-submit-button od-text-align-center">
                                            <PrimaryButton class="od-button justify-center" :class="{       'opacity-25': form.processing }"
                                            :disabled="form.processing">
                                                পাঠান
                                            </PrimaryButton>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </GuestLayout>

</template>
