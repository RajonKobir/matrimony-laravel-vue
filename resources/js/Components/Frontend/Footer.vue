<script setup>

import { ref, onMounted, onUnmounted } from "vue";
const isVisible = ref(false);


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

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>

<template>
    <footer>
        <div class="footer-content">
            <div class="main-container py-8">
                <div class="footer-bottom-text">© {{ new Date().getFullYear() }} shadibari.com</div>

                <div v-if="isVisible" @click="scrollUp" id="scrollUp" class="od-scrollTo-top"
                    style="display: block; cursor: pointer;">
                    <i class="fa fa-angle-up"></i>
                </div>
            </div>
        </div>
    </footer>
</template>
