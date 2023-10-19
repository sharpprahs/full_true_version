<template>
  <div>
    <label class="custom-file-upload" @click="openFileInput">{{
      data.placeholder
    }}</label>
    <input
      type="file"
      ref="fileInput"
      style="display: none"
      @change="handleFileChange"
    />
    <div>{{ selectedFileName }}</div>
  </div>
</template>
  
  <script>
export default {
  props: {
    data: Object,
  },
  data() {
    return {
      selectedFileName: "",
    };
  },
  methods: {
    openFileInput() {
      this.$refs.fileInput.click();
    },
    handleFileChange() {
      const fileInput = this.$refs.fileInput;
      if (fileInput.files.length > 0) {
        this.selectedFileName = "Выбранный файл: " + fileInput.files[0].name;
      } else {
        this.selectedFileName = "";
      }
    },
  },
};
</script>
  
  <style scoped>
</style>
  