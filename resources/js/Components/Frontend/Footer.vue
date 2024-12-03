<script setup>
import { ref, onMounted, onUnmounted } from "vue";
const isVisible = ref(false);

const handleScroll = () => {
  if (window.scrollY > 300) {
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
        <div class="od-footer-content">
            <div class="od-container">
                <div class="od-item-container">
                    <div class="od-row od-align-items-center od-justify-content-center">
                        <div class="od-footer-item"><a href="https://shadibari.com/privacy-policy">Privacy Policy</a>
                        </div>
                        <div class="od-footer-item"><a href="https://shadibari.com/terms-and-conditions">Terms &amp;
                                Conditions</a></div>
                        <div class="od-footer-item"><a href="https://shadibari.com/refund-policy">Refund Policy</a>
                        </div>
                    </div>
                </div>
                <div class="od-social-icon">
                    <a href="https://www.facebook.com/shadibari/" target="_blank"><i
                            class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.youtube.com/shadibari" target="_blank"><i
                            class="fa-brands fa-youtube"></i></a>
                </div>
                <div class="od-footer-bottom-text">© 2021-{{ new Date().getFullYear() }} shadibari.com</div>

                <div  v-if="isVisible" @click="scrollUp" id="scrollUp" class="od-scrollTo-top" style="display: block; cursor: pointer;">
                    <i class="fa fa-angle-up"></i>
                </div>
            </div>
        </div>
    </footer>
</template>