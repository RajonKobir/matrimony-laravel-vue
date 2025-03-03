<script setup>

import { ref, onMounted, onUnmounted } from "vue";
const isVisible = ref(false);


const messengerUsername = "shadibari.com.bd";
const whatsappNumber = "+8801637573919";
const telegramUsername = "shadibari";
const emailAddress = "sohel130104@gmail.com";

const messengerLink = `https://m.me/${messengerUsername}`;
const whatsappLink = `https://wa.me/${whatsappNumber}`;
const telegramLink = `https://t.me/${telegramUsername}`;
const emailLink = `mailto:${emailAddress}`;


const handleScroll = () => {
    if (window.scrollY > 100) {
        isVisible.value = true;
    } else {
        isVisible.value = false;
    }
};

const scrollUp = () => {
    window.scrollTo(0, top);
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

</script>


<template>

    <footer>
        <div class="bg-[#522b79] pb-[30px] mb-16 sm:mb-0">
            <div class="main-container py-8 ">

                <div class="footer-bottom-text">© {{ new Date().getFullYear() }} shadibari.com</div>

                <div class="footer_contact_div w-full p-3 flex justify-center items-center">
                    <a :href="messengerLink" target="_blank" class="text-[#3BA038] text-4xl pr-8">
                        <i class="fab fa-facebook-messenger"></i>
                    </a>
                    <a :href="whatsappLink" target="_blank" class="text-[#3BA038] text-4xl pr-8">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a :href="telegramLink" target="_blank" class="text-[#3BA038] text-4xl pr-8">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                    <a :href="emailLink" class="text-[#3BA038] text-4xl">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

                <div class="footer_contact_fixed_div fixed bottom-0 w-full bg-opacity-40 bg-[#FBD5B1]  p-3 flex justify-around items-center md:hidden">
                    <a :href="messengerLink" target="_blank" class="text-[#3BA038] text-4xl">
                        <i class="fab fa-facebook-messenger"></i>
                    </a>
                    <a :href="whatsappLink" target="_blank" class="text-[#3BA038] text-4xl">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a :href="telegramLink" target="_blank" class="text-[#3BA038] text-4xl">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                    <a :href="emailLink" class="text-[#3BA038] text-4xl">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

                <div v-if="isVisible" @click="scrollUp" id="scrollUp" class="fixed z-[998] bottom-[70px] sm:bottom-[20px] right-[10px] px-[10px] py-[5px] bg-[#ad277c] text-white !block cursor-pointer" >
                    <i class="fa fa-angle-up"></i>
                </div>

            </div>
        </div>
    </footer>

</template>


<style scoped>
    .v-enter-active, .v-leave-active {
        transition: opacity 0.5s ease;
    }
    .v-enter-from, .v-leave-to {
        opacity: 0;
    }

    @media (max-width: 768px) {
        div.footer_contact_div {
            display: none;
        }
    }

    @media (min-width: 768px) {
        div.footer_contact_fixed_div {
            display: none;
        }
    }
</style>
