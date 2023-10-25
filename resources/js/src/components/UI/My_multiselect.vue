<template>
  <multiselect
    v-model="data.value"
    :options="data.options"
    :searchable="false"
    :close-on-select="true"
    :show-labels="false"
    :allow-empty="data.allow_empty"
    :multiple="data.multiple"
    :taggable="data.taggable"
    :select-label="'Выберите'"
    :selected-label="'Выбрано'"
    :deselect-label="'Нажмите Enter, чтобы убрать'"
    placeholder="Добавьте значение"
  ></multiselect>
</template>

<script>
import Multiselect from "vue-multiselect/src/Multiselect.vue";
export default {
  components: {
    Multiselect,
  },
  props: {
    data: Object,
  },
};
</script>

  <style scoped>
</style>
