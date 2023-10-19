<template>
  <div class="container_accesses_users animation_top">
    <div class="nav_panel">
      <div class="access_title">Доступы пользователей</div>
    </div>
    <div class="table_container">
      <UTable :headers="headers" :data="data">
        <template #column0="{ entity }">
          {{ entity.name }}
        </template>
        <template #column1="{ entity }">
          <div>
            <multiselect
              tag-placeholder="Add this as new tag"
              placeholder="Добавьте доступ"
              label="name"
              :options="value"
              :multiple="true"
              :taggable="false"
              track-by="access_num"
              :select-label="'Выберите'"
              :selected-label="'Выбрано'"
              :model-value="entity.selectedAccesses"
              @update:model-value="
                updateSelected(entity, $event)
              "
              :deselect-label="'Нажмите Enter, чтобы убрать'"
            >
            </multiselect>
          </div>
        </template>
      </UTable>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect/src/Multiselect.vue";
import "@/assets/styles/multiselect-styles.css";
import UTable from "@/components/UI/UTable.vue";
import axios from "axios";

export default {
  components: {
    Multiselect,
    UTable,
  },
  data() {
    return {
        warning_text_watcher:"",
        warning_text_watcher_action:"",
      value: [
        { name: "Команда/доступы", access_num: 1 },
        { name: "Команда/преподователи", access_num: 2 },
        { name: "Блог/публикации", access_num: 3 },
        { name: "Блог/теги", access_num: 4 },
        { name: "Подкаст/эпизоды", access_num: 5 },
        { name: "Граматика/публикации", access_num: 6 },
        { name: "Граматика/уровни", access_num: 7 },
        { name: "Видео/видео", access_num: 8 },
        { name: "Видео/категории", access_num: 9 },
      ],
      headers: ["Пользователь", "Доступы"],
      data: [],
      selectedAccessesCopy: [],
        oldVal: [],
      first_val: [],
      first_status: true,
    };
  },
  methods: {

      async sendDataToServer(name, surname, patronymic, accessNumArray) {
          try {
              const token = localStorage.getItem("token"); // Получите токен из локального хранилища
              const response = await axios.put(
                  "/api/users/update-accesses",
                  {
                      name,
                      surname,
                      patronymic,
                      accesses: accessNumArray,
                  },
                  {
                      headers: {
                          Authorization: `Bearer ${token}`,
                      },
                  }
              );

              // Обработка успешного ответа от сервера
              console.log("Сервер ответил:", response.data);
          } catch (error) {
              // Обработка ошибок
              console.error("Произошла ошибка:", error);
          }
      },
      splitName(name) {
          const parts = name.split(' '); // Разделить строку по пробелу
          const [firstName, lastName, patronymic] = parts;
          return {
              name: firstName || '',
              surname: lastName || '',
              patronymic: patronymic || '',
          };
      },
    updateSelected(entity, newValue) {
          let deleted;
          let added;
        const previousValue = entity.selectedAccesses;
        const { name, surname, patronymic } = this.splitName(entity.name);
        let accessNumArray;
        accessNumArray = newValue.map((access) => access.access_num).join('');
        if(newValue.length === 0){
            accessNumArray = "ㅤ";
        }
this.sendDataToServer(name,surname,patronymic,accessNumArray)
        // Найдем добавленные элементы
        const addedItems = newValue.filter((item) => !previousValue.some((prevItem) => prevItem.access_num === item.access_num));

        // Найдем удаленные элементы
        const removedItems = previousValue.filter((prevItem) => !newValue.some((item) => item.access_num === prevItem.access_num));

        // Вывод информации о добавленных элементах
        if (addedItems.length > 0) {
            addedItems.forEach((addedItem) => {
                entity.warning = true;
                entity.warning_title = `У ${entity.name} добавлен доступ на <span class="warning_table_special"> ${addedItem.name}</span>`;
                setTimeout(() => {
                    entity.warning = false;
                    entity.warning_title = '';
                }, 2000);

            });
        }

        // Вывод информации о удаленных элементах
        if (removedItems.length > 0) {
            removedItems.forEach((removedItem) => {
                entity.warning = true;
                entity.warning_title = `У ${entity.name} удалён доступ <span class="warning_table_special">${removedItem.name}</span>`;
                setTimeout(() => {
                    entity.warning = false;
                    entity.warning_title = '';
                }, 2000);

            });
        }

        // Присваиваем новое значение selectedAccesses
        entity.selectedAccesses = newValue;
    },
  },
    created() {
        const token = localStorage.getItem("token");
        let newData = [];

        axios
            .get("/api/users", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            })
            .then((response) => {
                const users = response.data;

                // Преобразуйте данные о пользователях в ожидаемый формат
                this.data = users.map((user) => {
                    // Добавьте проверку на null перед использованием accesses
                    const accessesArray = user.accesses ? user.accesses.split("").map(Number) : [];
                    const selectedAccesses = [];

                    accessesArray.forEach((accessNum) => {
                        const matchingValueItem = this.value.find(
                            (valueItem) => valueItem.access_num === accessNum
                        );
                        if (matchingValueItem) {
                            selectedAccesses.push({
                                name: matchingValueItem.name,
                                access_num: matchingValueItem.access_num,
                                warning: false,
                                warning_title: "",
                                action: "",
                            });
                        }
                    });

                    return {
                        name: `${user.name} ${user.surname} ${user.patronymic}`,
                        selectedAccesses,
                    };
                });

                newData = JSON.parse(JSON.stringify(this.data));
                Object.defineProperty(this, "first_val", { value: [...newData] });
            })
            .catch((error) => {
                console.error("Ошибка при получении данных о пользователях:", error);
            });
    },
};
</script>

<style scoped></style>
