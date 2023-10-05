<template>
  <div class="container_accesses_users animation_top">
    <div class="nav_panel">
      <div class="access_title">Категории видео</div>
      <button class="button_def" @click="openPopup">
        {{ title_popupa }}
      </button>
      <popup
        :show="isPopupVisible"
        :title_popup="title_popupa"
        @close="closePopup"
      >
        <div class="add_teacher_container">
          <div
            v-for="(popup_item, index) in popup_items"
            :key="index"
            :class="popup_item.container_class"
          >
            <label for="Слайдер">{{ popup_item.title }}</label>
            <component
              :is="popup_item.component"
              :data="popup_item"
              @update="handleUpdate(popup_items.indexOf(popup_item), $event)"
            ></component>
          </div>
          <button class="doing_but">Добавить категорию</button>
        </div>
      </popup>
    </div>
    <div class="table_container">
      <UTable :headers="headers" :data="data">
        <template #column0="{ entity }">
          <input
            type="text"
            placeholder="Укажите позицию"
            class="my_inputs_other"
            :value="entity.position"
          />
        </template>
        <template #column1="{ entity }">
          <input
            type="text"
            placeholder="Укажите заголовок"
            class="my_inputs"
            :value="entity.title"
          />
        </template>
        <template #column2="{ entity }">
          <input
            type="text"
            placeholder="URL в строке адреса"
            class="my_inputs"
            :value="entity.url_line"
          />
        </template>
        <template #column3="{ entity }">
          <input
            type="text"
            placeholder="Meta title"
            class="my_inputs"
            :value="entity.meta_title"
          />
        </template>
        <template #column4="{ entity }">
          <input
            type="text"
            placeholder="Meta description"
            class="my_inputs"
            :value="entity.meta_desc"
          />
        </template>
        <template #column5="{ entity }">
          <input
            type="text"
            placeholder="Meta keywords"
            class="my_inputs"
            :value="entity.meta_keywords"
          />
        </template>
        <template #column6="">
          <button class="delete_item">
            <img src="../assets/images/basket.svg" alt="Удалить" />
          </button>
        </template>
      </UTable>
    </div>
  </div>
</template>
    
  <script>
import "@/assets/styles/multiselect-styles.css";
import Multiselect from "vue-multiselect";
import My_multiselect from "@/components/UI/My_multiselect.vue";
import My_QuillEditor from "@/components/UI/My_QuillEditor.vue";
import Popup from "@/components/UI/Popup.vue";
import CustomFileInput from "@/components/UI/UInput_file.vue";

export default {
  components: {
    Multiselect,
    My_QuillEditor,
    My_multiselect,
    Popup,
    CustomFileInput,
  },
  data() {
    return {
      isPopupVisible: false,
      title_popupa: "Добавить категорию",
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
      popup_items: [
        {
          title: "Позиция",
          value: "",
          type: "text",
          placeholder: "Укажите позицию",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Заголовок",
          value: "",
          type: "text",
          placeholder: "Укажите заголовок",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "URL в строке адреса",
          value: "",
          type: "text",
          placeholder: "Укажите URL",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Meta title",
          value: "",
          type: "text",
          placeholder: "80 символов максимум",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Meta description",
          value: "",
          type: "text",
          placeholder: "290 символов максимум",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Meta keywords",
          value: "",
          type: "text",
          placeholder: "200 символов максимум",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
      ],
      slider_value: "",
      headers: [
        "Позиция",
        "Заголовок",
        "URL в строке адреса",
        "Meta Title",
        "Meta Description",
        "Meta Keywords",
        "",
      ],
      data: [
        {
          position: "1",
          title: "Грамматика",
          url_line: "grammar",
          meta_title: "Блог об изучении английского языка: Грамматика",
          meta_desc:
            "Статьи, в которых преподаватели BigAppleSchool объясняют грамматические правила и конструкции английского языка.",
          meta_keywords: "",
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
    // updatePopupItemValue(slider_value, event) {
    //   slider_value = event.target.value;
    // },
    getComponentType(popup_item) {
      if (popup_item == "UInput") {
        return "UInput"; // Используйте название вашего компонента
      }
      if (popup_item == "CustomFileInput") {
        return "CustomFileInput";
      }
      if (popup_item == "My_multiselect") {
        return "My_multiselect";
      }
    },
    handleUpdate(index, newValue) {
      // Обновляем значение в массиве popup_items
      this.popup_items[index].value = newValue;
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
    