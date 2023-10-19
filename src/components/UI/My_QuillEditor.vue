<template>
  <div class="quill_container">
    <div ref="quillEditor"></div>
  </div>
</template>

<script>
import Quill from "quill/dist/quill.js";
import "quill/dist/quill.snow.css";

export default {
  props: {
    data: Object,
  },
  mounted() {
    const quill = new Quill(this.$refs.quillEditor, {
      theme: "snow",
      modules: {
        toolbar: [
          [{ font: [] }],
          [{ align: [] }],
          ["bold", "italic", "underline", "strike"],
          [{ color: [] }, { background: [] }],
          [{ list: "ordered" }, { list: "bullet" }],
          ["blockquote", "code-block"],
          ["link", "image"],
          [{ header: "1" }, { header: "2" }],
          ["clean"],
        ],
      },
    });

    quill.on("text-change", () => {
      const html = this.$refs.quillEditor.children[0].innerHTML;
      this.$emit("update", html);
    });

    // Устанавливаем начальное значение из props.data.value
    quill.root.innerHTML = this.data.value || "";

    this.quill = quill;
  },
  watch: {
    "data.value": function (newVal) {
      // Обновляем значение Quill Editor при изменении props.data.value
      this.quill.root.innerHTML = newVal || "";
    },
  },
};
</script>

<style scoped>
</style>
