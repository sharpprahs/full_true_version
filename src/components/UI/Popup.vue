<template>
  <div v-if="show" class="popup-background">
    <div class="container_popup">
      <div class="container_popup__title_container">
        <div class="popup_title">{{ title_popup }}</div>
        <button class="popup_close" @click="closePopup"></button>
      </div>
      <slot> </slot>
    </div>
  </div>
</template>
  
  <script>
export default {
  props: {
    show: Boolean, // Пропс для управления видимостью попапа
    title_popup: String,
  },
  methods: {
    closePopup() {
      this.$emit("close"); // Вызов события закрытия попапа
    },
  },
};
</script>
  
  <style scoped>
</style>
  