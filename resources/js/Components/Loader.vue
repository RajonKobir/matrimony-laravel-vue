<script setup>
const props = defineProps({
  isLoading: Boolean,
  fadeOut: Boolean // Track fade-out state
});
</script>

<template>
  <div v-if="isLoading" :class="{ 'fade-out': fadeOut }" class="loader-container">
    <img src="/assets/images/logo/logo.png" alt="Loading..." class="loader-logo" />
  </div>
</template>

<style scoped>
.loader-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #fff;
  z-index: 9999;
  transition: opacity 0.5s ease-in-out; /* Smooth fade effect */
}

.fade-out {
  opacity: 0;
  pointer-events: none;
}

.loader-logo {
  width: 120px;
  height: auto;
  animation: pulse 1.5s infinite ease-in-out;
}

@keyframes pulse {
  0% { transform: scale(1); opacity: 0.8; }
  50% { transform: scale(1.1); opacity: 1; }
  100% { transform: scale(1); opacity: 0.8; }
}
</style>
