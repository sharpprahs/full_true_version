<template>
  <div class="container_accesses_users animation_top">
    <div class="nav_panel">
      <div class="access_title">Публикации блога</div>
    </div>
    <div class="conatainer_type_content">
      <a href="#" class="types_content active">Все</a>
      <a href="#" class="types_content">Граматика</a>
      <a href="#" class="types_content">Культура</a>
      <a href="#" class="types_content">Советы</a>
      <a href="#" class="types_content">Практика</a>
      <a href="#" class="types_content">Про детей</a>
    </div>
    <div class="table_container">
      <UTable :headers="headers" :data="data">
        <template #column0="{ entity }">
          <a :href="entity.teacher_link">{{ entity.teacher }}</a>
        </template>
        <template #column1="{ entity }">
          <a :href="entity.date_link">{{ entity.date }}</a>
        </template>
        <template #column2="{ entity }">
          <a :href="entity.title_link">{{ entity.title }}</a>
        </template>
        <template #column3="">
            <button class="delete_item">
            </button>
        </template>
      </UTable>
    </div>
  </div>
</template>

    <script>
import "@/assets/styles/multiselect-styles.css";
import Multiselect from "vue-multiselect";
import Popup from "@/components/UI/Popup.vue";
import CustomFileInput from "@/components/UI/UInput_file.vue";

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
      options: ["Активный", "Не активный", "Skype", "Архив", "Скрыт"],
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
      headers: ["Преподаватель", "Дата", "Заголовок", ""],
      data: [
        {
          teacher: "Lister Strainer",
          teacher_link: "#",
          date: "27 апреля в 14:23",
          date_link: "#",
          title:
            "Future tenses: способы выражения будущего времени в английском языке",
          title_link: "#",
        },
        {
          teacher: "Lister Strainer",
          teacher_link: "#",
          date: "27 апреля в 14:23",
          date_link: "#",
          title:
            "Future tenses: способы выражения будущего времени в английском языке",
          title_link: "#",
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
