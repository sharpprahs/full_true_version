<template>
  <button @click="executeCommand" :class="buttonClasses">
    <!-- Иконка или текст для кнопки -->
    <span class="ck-icon">Link</span>
  </button>
</template>
  
  <script>
export default {
  props: ["editor"],
  computed: {
    buttonClasses() {
      // Добавьте необходимые классы стиля для кнопки
      return "custom-link-button";
    },
  },
  methods: {
    executeCommand() {
      // Выполните команду для создания или редактирования ссылки
      this.editor.execute("link");
    },
  },
};
</script>
  
  <style>
/* Добавьте стили для кнопки по вашему усмотрению */
.custom-link-button {
  color: blue;
  text-decoration: underline;
  font-weight: bold;
  /* Другие стили */
}
</style>
  