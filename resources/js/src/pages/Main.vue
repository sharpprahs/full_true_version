<template>
  <div class="container__panel_authorization">
    <div class="container__panel_authorization__title_main">
      Панель управления
    </div>
    <form class="authorization_form_container" @submit.prevent="loginUser">
      <div class="authorization_form_container__row">
        <label for="email">Логин</label>
        <input
          type="text"
          name="email"
          id="email"
          placeholder="Введите логин"
          class="my_inputs"
          v-model="login"
          autocomplete="email"
        />
      </div>
      <div class="authorization_form_container__row">
        <label for="password">Пароль</label>
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Введите пароль"
          class="my_inputs"
          v-model="password"
          autocomplete="password"
        />
      </div>
        <div v-if="showError" class="error-message">{{ errorMessage }}</div>
      <URemember>Запомнить меня</URemember>
      <button class="enter_us" type="submit">
        Войти
      </button>
    </form>
  </div>
</template>

<script>
import URemember from "@/components/UI/URemember.vue";

export default {
    name: "Main",
  components: {
    URemember,
  },
  data() {
    return {
      login: "",
      password: "",
        showError: false, // Флаг для отображения сообщения об ошибке
        errorMessage: "", // Текст сообщения об ошибке
    };
  },
  methods: {
      async loginUser() {
          try {
              if (!this.login || !this.password) {
                  this.showError = true;
                  this.errorMessage = "Пожалуйста, заполните все поля.";
                  return;
              }

              const response = await fetch("/api/login", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                      email: this.login,
                      password: this.password,
                  }),
              });

              if (response.ok) {
                  const data = await response.json();
                  localStorage.setItem("token", data.token);
                  localStorage.setItem("accesses", data.accesses);
                  this.$router.push("/admin_panel");
              } else if (response.status === 401) {
                  this.showError = true;
                  this.errorMessage = "Неверный пароль";
              } else if (response.status === 404) {
                  this.showError = true;
                  this.errorMessage = "Пользователь не существует";
              } else {
                  this.showError = true;
                  this.errorMessage = "Произошла ошибка аутентификации";
              }
          } catch (error) {
              console.error("Произошла ошибка:", error);
          }
      }
  },
};
</script>

<style scoped>

.error-message {
    color: red;
    margin-top: 10px;
}
</style>
