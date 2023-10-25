<template>
  <div class="container_accesses_users animation_top">
    <div class="nav_panel">
      <div class="access_title">Видео</div>
    </div>
    <div class="conatainer_type_content">
      <a href="#" class="types_content active">Все</a>
      <a href="#" class="types_content">Программы</a>
      <a href="#" class="types_content">Преподаватели</a>
      <a href="#" class="types_content">Слэнг</a>
    </div>
    <div class="table_container">
      <UTable :headers="headers" :data="data">
        <template #column0="{ entity }">
          <a :href="entity.date_link">{{ entity.date }}</a>
        </template>
        <template #column1="{ entity }">
          <a :href="entity.name_link">{{ entity.name }}</a>
        </template>
        <template #column2="{ entity }">
          <a :href="entity.youtube_id_link">{{ entity.youtube_id }}</a>
        </template>
        <template #column3="{ entity }">
          <a :href="entity.category_link">{{ entity.category }}</a>
        </template>
        <template #column4="{ entity }">
          <multiselect
            v-model="entity.display"
            :options="options"
            :searchable="false"
            :close-on-select="true"
            :show-labels="false"
            :allow-empty="false"
            placeholder="Pick a value"
          ></multiselect>
        </template>
        <template #column5="">
            <button class="delete_item">
            </button>
        </template>
      </UTable>
    </div>
  </div>
</template>

    <script>
import "@/assets/styles/multiselect-styles.css";
// import "@/assets/styles/quill.css";
import Multiselect from "vue-multiselect";
import Popup from "@/components/UI/Popup.vue";
// import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
// import CKEditor from "@ckeditor/ckeditor5-vue";
import CustomFileInput from "@/components/UI/UInput_file.vue";
// import "@/assets/styles/ckeditor-styles.css";

export default {
  components: {
    Multiselect,
    Popup,
    CustomFileInput,
  },
  data() {
    return {
      isPopupVisible: true,
      title_popupa: "Добавить преподавателя",
      wideMultiselect: false,
      options: ["Отображать", "Не отображать"],
      type_text: "text",
      type_pas: "password",
      type_email: "email",
      input_class: "my_inputs",
      input_custom: "my_inputs_custom",
      input_class_other: "my_inputs_other",
      enter_password_placeholder: "Введите пароль",
      enter_login_placeholder: "Введите логин",
      enter_text_placeholder: "Введите текст",
      input_value: "26",
      search_items: [
        {
          name: "Страны",
          options: ["Египет", "Париж"],
          value: "",
        },
        {
          name: "Тип",
          options: ["Активный", "Не активный", "Skype", "Архив", "Скрыт"],
          value: "",
        },
      ],
      headers: [
        "Дата",
        "Название",
        "Youtube ID",
        "Категория",
        "Отображение на странице учителя",
        "",
      ],
      data: [
        {
          date: "27 апреля в 14:23",
          date_link: "#",
          name: "Bucket list: what is it and why do you need it?",
          name_link: "#",
          youtube_id: "vvY758ghALI",
          youtube_id_link: "#",
          category: "Лексика",
          category_link: "vvY758ghALI",
          display: "Отображать",
        },
      ],
      slider_value: "",
      teachers_value: "",
      podcast_value: "",
      name_value: "",
      name_ru_value: "",
      surname_value: "",
      b_short_value: "",
      appointment_value: "",
      practise_value: "",
      where_value: "",
      video_value: "",
      blog_url_value: "",
      meta_title_value: "",
      meta_desc_value: "",
      meta_keywords_value: "",
      color_value: "",
    };
  },
  methods: {
    openPopup() {
      this.isPopupVisible = true;
      document.body.style.overflow = "hidden";
    },
    closePopup() {
      this.isPopupVisible = false;
      document.body.style.overflow = "auto";
    },
    updatePopupItemValue(slider_value, event) {
      slider_value = event.target.value;
    },
    onEditorReady(editor) {
      // Обработчик срабатывает, когда редактор CKEditor готов
      // Вы можете выполнить здесь дополнительные настройки
      editor.model.document.on("dialogDefinition", (event, data) => {
        if (data.name === "linkEdit") {
          // Задаем z-index для модального окна
          data.definition.dialog.parts.dialog.setStyle("z-index", "9999");
        }
      });
    },
    // getComponentType(popup_item) {
    //   if (popup_item.type !== "file") {
    //     return "UInput"; // Используйте название вашего компонента
    //   } else {
    //     return "CustomFileInput"; // Используйте название вашего компонента для файлов
    //   }
    // },
  },
};
</script>

    <style scoped></style>
