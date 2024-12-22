<script setup>
import Checkbox from '../../Components/Checkbox.vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import InputError from '../../Components/InputError.vue';
import InputLabel from '../../Components/InputLabel.vue';
import PrimaryButton from '../../Components/PrimaryButton.vue';
import TextInput from '../../Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


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
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const loginWithGoogle = () => {
    window.location.href = route('googleRedirect');
};

const loginWithFacebook = () => {
    window.location.href = route('facebookRedirect');
};

document.body.classList.remove(...document.body.classList);
document.body.classList.add("frontend.login");

</script>

<template>

    <Head title="Login" />

    <GuestLayout :translations :locale :locales>

        <div class="flex min-h-screen flex-col items-center bg-gray-100 sm:justify-center sm:pt-0">

            <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <div v-if="$page.props.flash.error" class="alert alert-danger alert-dismissible">
                    {{ $page.props.flash.error }}
                </div>

                <div class="mt-4 flex items-center justify-center">
                    <button @click="loginWithGoogle"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <svg width="20px" height="20px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg"
                            preserveAspectRatio="xMidYMid">
                            <path
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                fill="#4285F4" />
                            <path
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                fill="#34A853" />
                            <path
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                fill="#FBBC05" />
                            <path
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                fill="#EB4335" />
                        </svg>
                        <span class="ml-1">Login With Google</span>
                    </button>
                </div>

                <div class="mt-4 flex items-center justify-center">
                    <button @click="loginWithFacebook"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <svg width="20px" height="20px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Color-" transform="translate(-200.000000, -160.000000)" fill="#4460A0">
                                    <path
                                        d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z"
                                        id="Facebook">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span class="ml-1">Login With Facebook</span>
                    </button>
                </div>

                <form @submit.prevent="submit" class="mt-4">
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autofocus autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="current-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4 block">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Forgot your password?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <Link :href="route('register')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            New? Register Here!
                        </Link>
                    </div>

                </form>

            </div>
        </div>

    </GuestLayout>

</template>
