<template>
  <div class="container__panel_authorization">
    <div class="container__panel_authorization__title_main">
      Панель управления
    </div>
    <div class="authorization_form_container">
      <div class="authorization_form_container__row">
        <label for="email">Логин</label>
        <input
          type="email"
          name="email"
          placeholder="Введите логин"
          class="my_inputs"
          :value="login"
        />
      </div>
      <div class="authorization_form_container__row">
        <label for="password">Пароль</label>
        <input
          type="password"
          name="password"
          placeholder="Введите пароль"
          class="my_inputs"
          :value="password"
        />
      </div>
      <URemember>Запомнить меня</URemember>
      <button class="enter_us" @click="loginUser">
        Войти
      </button>
    </div>
  </div>
</template>
   
<script>
import URemember from "@/components/UI/URemember.vue";

export default {
  components: {
    URemember,
  },
  data() {
    return {
      login: "",
      password: "",
    };
  },
  methods: {
    async loginUser() {
      try {
        const response = await fetch('/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            email: this.login,
            password: this.password,
          }),
        });

        if (response.ok) {
          const data = await response.json();
          // Сохраняем токен в локальное хранилище
          localStorage.setItem('token', data.token);
          // Перенаправляем пользователя на страницу после аутентификации
          //this.$router.push('/admin_panel/accesses');
        } else {
          // Обработка ошибки аутентификации
          console.error('Аутентификация не удалась.');
        }
      } catch (error) {
        console.error('Произошла ошибка:', error);
      }
    },
  },
};
</script>
   
<style scoped></style>
   