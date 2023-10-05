<template>
  <div class="container_accesses_users animation_top">
    <div class="nav_panel">
      <div class="access_title">Преподаватели</div>
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
          <button class="doing_but">Добавить</button>
        </div>
      </popup>
    </div>
    <div class="conatainer_type_content">
      <a href="#" class="types_content active">Активный</a>
      <a href="#" class="types_content">Не активный</a>
      <a href="#" class="types_content">Skype</a>
      <a href="#" class="types_content">Архив</a>
      <a href="#" class="types_content">Скрыт</a>
      <a href="#" class="types_content">Все</a>
    </div>
    <div class="table_container">
      <UTable :headers="headers" :data="data">
        <template #column0="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs_other"
            :value="entity.slider"
            name="slider"
          />
        </template>
        <template #column1="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs_custom"
            :value="entity.teachers"
            name="teachers"
          />
        </template>
        <template #column2="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs_other"
            :value="entity.podcast"
            name="podcast"
          />
        </template>
        <template #column3="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs"
            :value="entity.name"
            name="name_user"
          />
        </template>
        <template #column4="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs"
            :value="entity.from"
            name="from"
          />
        </template>
        <template #column5="{ entity }">
          <multiselect
            v-model="entity.type"
            :options="options"
            :searchable="false"
            :close-on-select="true"
            :show-labels="false"
            :allow-empty="false"
            placeholder="Pick a value"
          ></multiselect>
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
// import "@/assets/styles/multiselect-styles.css";
import UTable from "@/components/UI/UTable.vue";
import Multiselect from "vue-multiselect/src/Multiselect.vue";
import My_multiselect from "@/components/UI/My_multiselect.vue";
import "@/assets/styles/multiselect-styles.css";
import My_QuillEditor from "@/components/UI/My_QuillEditor.vue";
import Popup from "@/components/UI/Popup.vue";
import CustomFileInput from "@/components/UI/UInput_file.vue";

export default {
  components: {
    Multiselect,
    My_QuillEditor,
    My_multiselect,
    Popup,
      UTable,
    CustomFileInput,
  },
  data() {
    return {
      isPopupVisible: false,
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
      popup_items: [
        {
          title: "Слайдер",
          value: "",
          type: "text",
          name:"slider",
          placeholder: "Номер слайдера",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Преподаватели",
          value: "",
          type: "text",
          name: "teachers",
          placeholder: "Преподаватели",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Подкаст",
          value: "",
          type: "text",
          name:"podcast",
          placeholder: "Подкаст",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Имя",
          value: "",
          type: "text",
          name:"name",
          placeholder: "Укажите имя",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Фамилия рус.",
          value: "",
          type: "text",
          name: "surname",
          placeholder: "Укажите фамилию на рус.",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Краткая биография",
          value: "",
          type: "text",
          name: "short_biography",
          placeholder: "Краткая биография",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Записаться к",
          value: "",
          type: "text",
          name: "make_an_appointment",
          placeholder: "Записаться к",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Заниматься с",
          value: "",
          name: "practise_with",
          type: "text",
          placeholder: "Заниматься с",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Откуда",
          value: "",
          name: "where",
          type: "text",
          placeholder: "Откуда",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Видео на странице преподавателя",
          value: "",
          name: "video_on_page_teacher",
          type: "text",
          placeholder: "Откуда",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Блог URL в строке адреса",
          value: "",
          type: "text",
          name: "blog_url_in_address_string",
          placeholder: "Откуда",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Meta title",
          value: "",
          type: "text",
          name: "meta_title",
          placeholder: "80 символов максимум",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Meta description",
          value: "",
          type: "text",
          name: "meta_description",
          placeholder: "290 символов максимум",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Meta keywords",
          value: "",
          name: "meta_keywords",
          type: "text",
          placeholder: "200 символов максимум",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Страна",
          value: "Египет",
          options: ["Египет", "Россия", "Казахстан", "Италия", "Франция"],
          allow_empty: false,
          multiple: false,
          taggable: false,
          container_class: "add_teacher_container__item",
          component: "My_multiselect",
        },
        {
          title: "Тип",
          value: "Активный",
          options: ["Активный", "Не активный", "Skype", "Архив", "Скрыт"],
          allow_empty: false,
          multiple: false,
          taggable: false,
          container_class: "add_teacher_container__item",
          component: "My_multiselect",
        },
        {
          title: "Специализация",
          value: "Дошкольники",
          options: [
            "Дошкольники",
            "Младшекласники",
            "Старшеклассники",
            "Разговорный курс",
            "Онлайн обучение",
          ],
          allow_empty: true,
          multiple: true,
          taggable: false,
          container_class: "add_teacher_container__item_one",
          component: "My_multiselect",
        },
        {
          title: "Отображение",
          value: [
            "Отображать в тесте удовлетворённости",
            "Не отображать в слайдере",
          ],
          options: [
            "Отображать в тесте удовлетворённости",
            "Не отображать в слайдере",
          ],
          allow_empty: true,
          multiple: true,
          taggable: false,
          container_class: "add_teacher_container__item_one",
          component: "My_multiselect",
        },
        {
          title: "Фото в слайдер 220x220",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Фото в банер 300x300",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в список статей",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в шапку статьи",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в шапку преподавателя",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в плашку с тестом",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Футер мобильный",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Футер планшет",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Футер десктоп",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "OgImage",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "OgImage в пост",
          value: "",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Цвет",
          value: "",
          type: "color",
          class: "my_inputs__color",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Описание",
          value: "",
          container_class: "add_teacher_container__item_one",
          component: "My_QuillEditor",
        },
        {
          title: "Описание полное",
          value: "",
          container_class: "add_teacher_container__item_one",
          component: "My_QuillEditor",
        },
      ],
      slider_value: "",
      headers: [
        "Слайдер",
        "Преподаватели",
        "Подкаст",
        "Имя",
        "Откуда",
        "Тип",
        "",
      ],
      data: [
        {
          slider: "26",
          teachers: "1023",
          podcast: "1",
          name: "Александр Бутко Олегович",
          from: "Nigeria, Africa",
          type: "Архив",
        },
        {
          slider: "26",
          teachers: "1023",
          podcast: "1",
          name: "Александр Бутко Олегович",
          from: "Nigeria, Africa",
          type: "Не активный",
        },
      ],
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
