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
              :taggable="false"
              track-by="number"
              @tag="addTag"
              :select-label="'Выберите'"
              :selected-label="'Выбрано'"
              :deselect-label="'Нажмите Enter, чтобы убрать'"
            ></multiselect>
          </div>
        </template>
      </UTable>
    </div>
  </div>
</template>
  
<script>
import "@/assets/styles/multiselect-styles.css";
import Multiselect from "vue-multiselect";
export default {
  components: {
    Multiselect,
  },
  data() {
    return {
      value: [
        "Команда/преподователи",
        "Команда/доступы",
        "Блог/публикации",
        "Блог/теги",
        "Подкаст/эпизоды",
        "Граматика/публикации",
        "Граматика/уровни",
        "Видео/видео",
        "Видео/категории",
      ],
      headers: ["Пользователь", "Доступы"],
      data: [
        {
          name: "Александр Бутко Олегович",
          selectedAccesses: ["Команда/преподователи", "Команда/доступы"],
        },
        {
          name: "Виктор Семёнов Женчьев",
          selectedAccesses: [],
        },
        {
          name: "Пеле Садоян Григорьевич",
          selectedAccesses: ["Команда/преподователи"],
        },
      ],
    };
  },
  methods: {
    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      // this.value.push(tag);
    },
  },
  created() {
    // Генерируем порядковые номера для каждого элемента в data
    this.data.forEach((entity) => {
      entity.selectedAccesses = entity.selectedAccesses.map(
        (selectedAccess, index) => ({
          name: selectedAccess,
          number: index + 1,
        })
      );
    });
    // Переработка value
    this.value = this.value.map((access, index) => ({
      name: access,
      number: index + 1,
    }));
  },
};
</script>
  
<style scoped></style>
  