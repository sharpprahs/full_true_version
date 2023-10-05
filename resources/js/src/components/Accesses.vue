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
        <!-- <template #column1="{ entity }">
        <li v-for="(access, i) in entity.accesses" :key="`${access}-${i}`">
          {{ access }}
        </li>
      </template> -->
        <template #column1="{ entity }">
          <div>
            <multiselect
              v-model="entity.selectedAccesses"
              tag-placeholder="Add this as new tag"
              placeholder="Добавьте доступ"
              label="name"
              :options="value"
              :multiple="true"
              :taggable="true"
              track-by="access_num"
              @tag="addTag"
              @remove="removeAccess(entity, $event)"
              :select-label="'Выберите'"
              :selected-label="'Выбрано'"
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
import axios from 'axios';

export default {
  components: {
    Multiselect,
      UTable,
  },
  data() {
    return {
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
    };
  },
  methods: {
      addTag(newTag) {
          console.log("sad")
          const tag = {
              name: newTag,
              access_num: this.value.length + 1, // Генерируем новый access_num
          };
          this.value.push(tag);
      },
      removeAccess(entity, removedAccess) {
          const nameParts = entity.name.split(' '); // Разделяем имя, фамилию и отчество
          const name = nameParts[0];
          const surname = nameParts[1];
          const patronymic = nameParts[2];
          var allAccessNumsString;
          if (entity.selectedAccesses.length === 1) {
              allAccessNumsString = entity.selectedAccesses[0].access_num.toString();
          } else if (entity.selectedAccesses.length > 1) {
              allAccessNumsString = entity.selectedAccesses
                  .map(access => access.access_num)
                  .join('');
          }  else {
              // Обработка случая, когда массив пустой
              console.log("Массив пустой");
          }
          axios.put('/api/users/update-accesses', {
              name,
              surname,
              patronymic,
              accesses: allAccessNumsString,
          }, {
              headers: {
                  Authorization: `Bearer ${localStorage.getItem('token')}`, // Передаем токен
              },
          })
              .then(response => {
                  // Обработка успешного ответа от сервера
                  console.log('Доступы пользователя обновлены', response.data);
                  entity.warning = true
                  entity.deleted = removedAccess;
                  setTimeout(() => {
                      entity.warning = false;
                  }, 2000);
              })
              .catch(error => {
                  // Обработка ошибки
                  console.error('Ошибка при обновлении доступов пользователя:', error);
              });
      }
      },
  created() {

      const token = localStorage.getItem('token');

      axios.get('/api/users', {
          headers: {
              Authorization: `Bearer ${token}`,
          }
      })
          .then((response) => {
              const users = response.data;

              // Преобразуйте данные о пользователях в ожидаемый формат
              this.data = users.map((user) => {

                  // const accessesArray = user.accesses.split('');
                  // const selectedAccesses =[];
                      const accessesArray = user.accesses.split('').map(Number); // Преобразуем в числа
                      const selectedAccesses = [];

                      accessesArray.forEach((accessNum) => {
                          const matchingValueItem = this.value.find((valueItem) => valueItem.access_num === accessNum);
                          if (matchingValueItem) {
                              selectedAccesses.push({
                                  name: matchingValueItem.name,
                                  access_num: matchingValueItem.access_num,
                                  warning: false,
                                  warning_title: "",
                              });
                          }
                      });

                  return {
                      name: `${user.name} ${user.surname} ${user.patronymic}`,
                      selectedAccesses,
                  };
              });
          })
          .catch((error) => {
              console.error('Ошибка при получении данных о пользователях:', error);
          });
  },
};
</script>

<style scoped></style>
