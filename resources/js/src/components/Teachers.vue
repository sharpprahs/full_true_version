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
            <label :for="popup_item.name" v-if="popup_item.type !== 'select' && popup_item.type !== 'tip-tap'" >{{ popup_item.title }}</label>
              <div v-else class="special_title_label">{{ popup_item.title }}</div>
            <component
              :is="popup_item.component"
              :data="popup_item"
              @update="handleUpdate(popup_items.indexOf(popup_item), $event)"
            ></component>
          </div>
          <button class="doing_but" @click="create_new_teacher">Добавить перподавателя</button>
        </div>
      </popup>
    </div>
    <div class="conatainer_type_content">
      <button class="types_content" v-for="(tab_item, index) in tabs_items"
         :key="index" :class="{ active: tab_item.title === teacherTypeTitle }" @click="chose_type(tab_item)">
          {{tab_item.title}}
      </button>
    </div>
      <!--      <a href="#" class="types_content active" :class="tab_item.container_class">Активный</a>-->

      <UTable :headers="headers" :data="data" >
        <template #column0="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs_other block_interaction"
            :value="entity.id"
            name="slider"
          />
        </template>
        <template #column1="{ entity }">
          <input
            type="number"
            placeholder="Введите текст"
            class="my_inputs_custom"
            v-model="entity.posBlog"
            name="teachers"
          />
        </template>
        <template #column2="{ entity }">
          <input
            type="number"
            placeholder="Введите текст"
            class="my_inputs_other"
            v-model="entity.podcastPos"
            name="podcast"
          />
        </template>
        <template #column3="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs"
            v-model="entity.title"
            name="name_user"
          />
        </template>
        <template #column4="{ entity }">
          <input
            type="text"
            placeholder="Введите текст"
            class="my_inputs"
            v-model="entity.place"
            name="from"
          />
        </template>
        <template #column5="{ entity }">
          <multiselect
            :model-value="entity.teacher_type.title"
            @update:model-value="
                updateSelected(entity, $event)
              "
            :options="tabs_items.map(item => item.title)"
            :searchable="false"
            :close-on-select="true"
            :show-labels="false"
            :allow-empty="false"
            placeholder="Pick a value"
          ></multiselect>
        </template>
        <template #column6="{ entity }">
          <button class="delete_item" @click="delete_teacher(entity)">
          </button>
        </template>
          <template #column7="{ entity }">
              <button class="save_item" @click="save_changes_teacher(entity)">
              </button>
          </template>
      </UTable>
      <div class="paginate_container" v-if="page_num > 1" >
          <paginate
              :page-count="page_num"
              prev-text="Предыдущая страница"
              next-text="Следующая страница"
              prev-link-class="custom-button"
              next-link-class="custom-button"
              @click="handlePageClick"
          ></paginate>
      </div>
  </div>
</template>

  <script>
import UTable from "@/components/UI/UTable.vue";
import Multiselect from "vue-multiselect/src/Multiselect.vue";
import My_multiselect from "@/components/UI/My_multiselect.vue";
import "@/assets/styles/multiselect-styles.css";
import Popup from "@/components/UI/Popup.vue";
import My_tiptap from "@/components/UI/My_TiptapEditor.vue";
import CustomFileInput from "@/components/UI/UInput_file.vue";
import axios from "axios";
import Paginate from 'vuejs-paginate/src/components/Paginate.vue';


export default {
  components: {
    Multiselect,
    My_tiptap,
    My_multiselect,
    Popup,
      UTable,
    CustomFileInput,
      Paginate,
  },
  data() {
    return {
  last_data_watcher: null,
        page_num: 1,
        active_page: 1,
        length_page: null,
      isPopupVisible: false,
      title_popupa: "Добавить преподавателя",
      wideMultiselect: false,
      type_text: "text",
        specialization: [],
        specializationOptions:[],
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
        tabs_items: [],
        titles: [],
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
          name: "country",
          type:"select",
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
          name: "type",
          type:"select",
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
          type:"select",
          name: "specialization",
          options: [
              "Школьники",
              "Дошкольники"
          ],
          allow_empty: true,
          multiple: true,
          taggable: false,
          container_class: "add_teacher_container__item_one",
          component: "My_multiselect",
        },
        {
          title: "Отображение",
          name: "visible",
          type:"select",
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
          name: "photo_into_slider_220x220",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Фото в банер 300x300",
          value: "",
          type: "file",
          name: "photo_into_slider_300x300",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в список статей",
          value: "",
          type: "file",
          name: "img_into_list_article",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в шапку статьи",
          value: "",
          type: "file",
          name: "img_into_header_article",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в шапку преподавателя",
          value: "",
          type: "file",
          name: "img_into_header_teacher",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Картинка в плашку с тестом",
          value: "",
          type: "file",
          name: "img_into_test_plate",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Футер мобильный",
          value: "",
          type: "file",
          name: "footer_mobile",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Футер планшет",
          value: "",
          type: "file",
          name: "footer_tablet",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Футер десктоп",
          value: "",
          type: "file",
          name: "footer_pc",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "OgImage",
          value: "",
          name: "og_image",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "OgImage в пост",
          value: "",
          name: "og_image_into_post",
          type: "file",
          placeholder: "Выберите файл",
          class: "my_inputs_popups",
          container_class: "add_teacher_container__item",
          component: "CustomFileInput",
        },
        {
          title: "Цвет",
          value: "#0f1344",
          name: "color",
          type: "color",
          class: "my_inputs__color",
          container_class: "add_teacher_container__item",
          component: "UInput",
        },
        {
          title: "Описание",
          value: "<p>123asd</p>",
          type:"tip-tap",
          name: "description",
          container_class: "add_teacher_container__item_one",
          component: "My_tiptap",
        },
        // {
        //   title: "Описание полное",
        //   value: "",
        //   name: "full_description",
        //   container_class: "add_teacher_container__item_one",
        //   component: "My_QuillEditor",
        // },
      ],
      slider_value: "",
      headers: [
        "Номер ID",
        "Преподаватели",
        "Подкаст",
        "Имя",
        "Откуда",
        "Тип",
        "",
          "",
      ],
      data: [],
        teacherTypeTitle: "Все",
    };
  },
    mounted() {
        this.fetchTeacherTableData();
        this.fetchTeacherData();
        this.fetchTeacherSpecTableData();
    },
        methods: {
            create_new_teacher(){
                const variables = {};

                // Пройдитесь по массиву popup_items и извлеките name и value для каждого элемента
                this.popup_items.forEach(item => {
                    const name = item.name;
                    const value = item.value;

                    // Добавьте переменную в объект variables
                    variables[name] = value;
                });

                // Теперь у вас есть объект variables с переменными name и их значениями
                // Вы можете использовать этот объект для дальнейшей обработки
                console.log(variables);
            },
            updateSelected(entity, newValue){
                const item = this.tabs_items.find(tab => tab.title === newValue);

                if (item) {
                 entity.teacherType = item.id;
                 entity.teacher_type.id = item.id;
                 entity.teacher_type.title = newValue;
                } else {
                    console.log("Элемент не найден");
                }
            },
            save_changes_teacher(entity){
                this.edit_teacher(entity)
            },
            edit_teacher(entity){
                const token = localStorage.getItem("token");
                // Путь к маршруту удаления и ID учителя
                const apiUrl = `/api/teacher/edit_teacher?id=${entity.id}&place=${entity.place}&podcastPos=${entity.podcastPos}&posBlog=${entity.posBlog}&teacherType=${entity.teacherType}&title=${entity.title}`;

                // Выполняем запрос на удаление
                axios
                    .get(apiUrl, {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    })
                    .then((response) => {
                        entity.warning = true;
                        if(response.data.message !== "Нет изменений в данных"){
                            entity.warning_title = `<span class="warning_table_small">Данные пользователя <span class="warning_table_special"> ${entity.title}</span> обновлены</span>`;
                        } else {
                            entity.warning_title = `<span class="warning_table_small">У пользователя <span class="warning_table_special"> ${entity.title}</span> нечего изменять</span>`
                        }
                        setTimeout(() => {
                            entity.warning = false;
                            entity.warning_title = '';
                        }, 2000);
                        console.log(`Всё ок`,response.data);
                    })
                    .catch((error) => {
                        // Обработка ошибки удаления
                        console.error(`Ошибка редактирования пользователя:`, error);
                    });
            },
            upload_single_teacher_before_delete(id){
                const token = localStorage.getItem("token");
                // Путь к маршруту удаления и ID учителя
                const apiUrl = `/api/teacher/loading_next?id=${id}&title=${this.teacherTypeTitle}`;

                // Выполняем запрос на удаление
                axios
                    .get(apiUrl, {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    })
                    .then((response) => {
                        const nextTeacher = response.data.data;

                        if (nextTeacher) {
                            if (Array.isArray(this.data)) {
                                this.data.push(nextTeacher);
                            } else {
                                this.data = [nextTeacher];
                            }
                        } else {
                            console.log('Следующий учитель не найден.');
                        }
                    })
                    .catch((error) => {
                        // Обработка ошибки удаления
                        console.error(`Ошибка при подгрузки пользователя после ${id}:`, error);
                    });
            },
            delete_teacher(entity){
                entity.warning = true;
                entity.warning_title = `<span class="warning_table_small">Пользователь <span class="warning_table_special"> ${entity.title}</span> был удалён</span>`;
                setTimeout(() => {
                    entity.warning = false;
                    entity.warning_title = '';
                    // Находим индекс объекта с соответствующим entity.id
                    const indexToDelete = this.data.findIndex(item => item.id === entity.id);

                    if (indexToDelete !== -1) {
                        this.data.splice(indexToDelete, 1);
                        this.length_page--;
                        let new_data = this.data;
                        if (new_data && new_data.length > 0) { // Проверяем, что массив не пустой
                            const lastItem = new_data[new_data.length - 1]; // Получаем последний элемент массива
                            const lastItemId = lastItem.id; // Получаем id последнего элемента
                            this.upload_single_teacher_before_delete(lastItemId);
                        }
                        // Удаляем объект из массива this.data
                        this.delete_teacher_data(entity.id);
                    }
                }, 2000);
            },
            delete_teacher_data(id){
                const token = localStorage.getItem("token");
                // Путь к маршруту удаления и ID учителя
                const apiUrl = `/api/teacher/delete/${id}`;

                // Выполняем запрос на удаление
                axios
                    .delete(apiUrl, {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    })
                    .then((response) => {
                        // Успешное удаление учителя
                        console.log(`Учитель с ID ${id} удален.`);
                        // Возможно, вам захочется обновить список учителей после удаления
                        this.fetchTeacherData(); // Вызывайте функцию, которая обновляет данные
                    })
                    .catch((error) => {
                        // Обработка ошибки удаления
                        console.error(`Ошибка при удалении учителя с ID ${id}:`, error);
                    });

            },
            handlePageClick(event) {
                const buttonText = event.target.textContent;
            // target.__vueParentComponent.data.target.innerValue[0]
                if (buttonText === "Предыдущая страница") {
                    this.active_page--;
                    if(this.active_page <= 0){
                        this.active_page = 1;
                    }
                } else if (buttonText === "Следующая страница") {
                    this.active_page++;
                    if(this.active_page > this.page_num){
                        this.active_page = this.page_num;
                    }
                } else {
                    // Кликнули на другую страницу
                    this.active_page = parseInt(event.target.__vueParentComponent.data.innerValue);
                    // Ваш код для обработки нажатия на другую страницу
                }
            },
            fetchTeacherSpecTableData(){
                const token = localStorage.getItem("token");
                // Выполняем запрос к бэкэнду для получения заголовков
                axios.get('/api/teacher-specialization', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }})
                    .then((response) => {
                        const specialization = response.data;

                        // Создаем массив вкладок tabs_items
                        this.specialization = specialization.map(item => ({ id: item.id, title: item.title }));
                    })
                    .catch((error) => {
                        console.error('Ошибка при получении заголовков:', error);
                    });
            },
      fetchTeacherTableData(){
          const token = localStorage.getItem("token");
          // Выполняем запрос к бэкэнду для получения заголовков
          axios.get('/api/teacher-types/titles', {
              headers: {
                  Authorization: `Bearer ${token}`
              }})
              .then((response) => {
                  const titles = response.data;
                  // Создаем массив вкладок tabs_items
                  this.tabs_items = [
                      {
                          title: "Все",
                          status: true,
                      },
                      // Добавляем заголовки из полученных данных
                      ...titles.map(item => ({ title: item.title, status: false, id: item.id }))
                  ];
              })
              .catch((error) => {
                  console.error('Ошибка при получении заголовков:', error);
              });
      },
            chose_type(tab_item){
                this.teacherTypeTitle = tab_item.title;
                this.active_page = 1;
            },
            // Метод для выполнения запроса на основе teacherTypeTitle
            fetchTeacherData() {
                const token = localStorage.getItem("token");
                const page = this.active_page;
                const apiUrl = `/api/teachers?page=${page}&title=${this.teacherTypeTitle}`;

                axios
                    .get(apiUrl, {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    })
                    .then((response) => {
                        this.data = response.data.data.data;
                        this.length_page = response.data.data.total;
                    })
                    .catch((error) => {
                        console.error('Ошибка при получении данных:', error);
                    });

                if (!token) {
                    console.error('Отсутствует токен аутентификации.');
                }
            },
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
    watch: {
      // data(newV,OldV){
      //     if (newV && newV.length > 0) { // Проверяем, что массив не пустой
      //         const lastItem = newV[newV.length - 1]; // Получаем последний элемент массива
      //         this.last_data_watcher = lastItem.id;
      //     }
      //     // console.log("Data изменилась")
      //     // console.log(newV)
      //     // console.log(OldV)
      // },
        // Наблюдатель для отслеживания изменений teacherTypeTitle
        teacherTypeTitle(newValue, oldValue) {
            // Вызов метода для выполнения запроса при изменении teacherTypeTitle
            this.fetchTeacherData();
        },
        length_page(newLengthPage, oldLengthPage) {
            // Вотчер, следящий за изменениями length_page
            if (newLengthPage !== oldLengthPage) {
                // Проверяем, изменилось ли значение length_page
                this.page_num = Math.ceil(newLengthPage / 11);
                // Выполняем деление на 11 и записываем результат в page_num
            }
        },
        active_page(newVal,OldVal){
          this.fetchTeacherData();
        },
    },
};
</script>

  <style scoped></style>
