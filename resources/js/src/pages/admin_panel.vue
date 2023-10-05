<template>
  <div class="admin_panel_container">
    <header class="header_container">
      <div class="header_container__row">
        <div class="container__panel_authorization__title font_corrected">
          BigAppleSchool
        </div>
        <img
          src="../assets/images/menu_list.svg"
          alt=""
          class="menu_list"
          @click="show_mobile_panel"
        />
      </div>
    </header>
    <div class="panel_menu_container">
      <div class="container_title">
        <div class="container__panel_authorization__title font_corrected">
          BigAppleSchool
        </div>
        <img
          src="../assets/images/close.svg"
          alt="закрыть панель"
          class="close_panel"
          @click="close_mobile_panel"
        />
      </div>
      <ul class="panel_menu_list">
        <li
          class="menu-item"
          v-for="(menuItem, index) in menuItems"
          :key="index"
        >
          <a href="#" class="menu-item-link" @click="toggleSubMenu(index)">
              <img :src="getImagePath(menuItem.imgSrc)" alt="ds"/>
            <span>{{ menuItem.text }}</span>
          </a>
          <ul
            class="submenu"
            :style="{ display: subMenuVisible === index ? 'flex' : 'none' }"
          >
            <li
              class="submenu-item"
              v-for="(subMenuItem, subIndex) in filteredSubMenu(menuItem.submenu)"
              :key="subIndex"
            >
              <router-link :to="subMenuItem.route" @click="mobile_menu_hidden">
                <img :src="getImagePath(subMenuItem.imgSrc)" alt="sd"/>
                <span>{{ subMenuItem.text }}</span>
              </router-link>
            </li>
          </ul>
        </li>
        <!-- <li class="menu-item">
          <a href="#" class="menu-item-link" @click="toggleSubMenu(0)"><img
              src="../assets/images/menu-teachers.svg"><span>Команда</span></a>
          <ul class="submenu">
            <li class="submenu-item"><a href="#"><img src="../assets/images/accesses.svg">
                <span>Доступы</span></a></li>
            <li class="submenu-item"><a href="#"> <img src="../assets/images/teacher.svg">
                <span>Преподователи</span></a></li>

          </ul>
        </li> -->
      </ul>
        <button class="logout" @click="logoutUser">ВЫЙТИ</button>

    </div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
    name: "admin_panel",
  data() {
    return {
      general_admin: "/",
      menuItems: [
        {
          imgSrc: "menu-teachers.svg",
          text: "Команда",
          submenu: [
            {
              imgSrc: "accesses.svg",
              text: "Доступы",
              route: "/admin_panel/accesses",
              access_key: 1,
              access: false,
            },
            {
              imgSrc: "teacher.svg",
              text: "Преподаватели",
              route: "/admin_panel/teachers",
              access_key: 2,
              access: false,
            },
          ],
        },
        {
          imgSrc: "menu-blog.svg",
          text: "Блог",
          submenu: [
            {
              imgSrc: "publication.svg",
              text: "Публикации",
              route: "/admin_panel/blogPost",
              access_key: 3,
              access: false,
            },
            {
              imgSrc: "tags.svg",
              text: "Теги",
              route: "/admin_panel/blogTag",
              access_key: 4,
              access: false,
            },
          ],
        },
        {
          imgSrc: "menu-podcast.svg",
          text: "Подкаст",
          submenu: [
            {
              imgSrc: "episode.svg",
              text: "Эпизоды",
              route: "/admin_panel/podcast",
              access_key: 5,
              access: false,
            },
          ],
        },
        {
          imgSrc: "menu-tips.svg",
          text: "Граматика",
          submenu: [
            {
              imgSrc: "publication.svg",
              text: "Публикации",
              route: "/admin_panel/grammarPost",
              access_key: 6,
              access: false,
            },
            {
              imgSrc: "levels.svg",
              text: "Уровни",
              route: "/admin_panel/grammarLevel",
              access_key: 7,
              access: false,
            },
          ],
        },
        {
          imgSrc: "menu-video.svg",
          text: "Видео",
          submenu: [
            {
              imgSrc: "video.svg",
              text: "Видео",
              route: "/admin_panel/video",
              access_key: 8,
              access: false,
            },
            {
              imgSrc: "categories.svg",
              text: "Категории",
              route: "/admin_panel/videoCategory",
              access_key: 9,
              access: false,
            },
          ],
        },
      ],
      subMenuVisible: null,
    };
  },
  methods: {
    toggleSubMenu(index) {
      this.subMenuVisible = this.subMenuVisible === index ? null : index;
    },
    show_mobile_panel() {
      let mobile_container = document.querySelector(".panel_menu_container");
      mobile_container.style.display = "flex";
      mobile_container.style.opacity = "1";
    },
    close_mobile_panel() {
        let mobile_container = document.querySelector(".panel_menu_container");
      mobile_container.style.display = "none";
    },
    mobile_menu_hidden() {
        let mobile_container = document.querySelector(".panel_menu_container");
      if (window.innerWidth < 1509) {
        mobile_container.style.display = "none";
      }
    },
      getImagePath(imgSrc) {
          let imageUrl;
          imageUrl = new URL(`../assets/images/${imgSrc}`, import.meta.url).href;
          return imageUrl;
      },
      async logoutUser() {
          try {
              const response = await fetch("/api/logout", {
                  method: "POST",
                  headers: {
                      Authorization: `Bearer ${localStorage.getItem("token")}`,
                  },
              });

              if (response.ok) {
                  localStorage.removeItem("token");
                  localStorage.removeItem("accesses");
                  this.$router.push("/"); // Перенаправьте пользователя на страницу входа
              } else {
                  console.error("Произошла ошибка при выходе из системы.");
              }
          } catch (error) {
              console.error("Произошла ошибка:", error);
          }
      },

    // toggleSubMenu(index) {
    //   const menuItems = document.querySelectorAll('.menu-item'); // Получаем все элементы с классом 'menu-item'
    //   const menuItem = menuItems[index]; // Получаем элемент menu-item по индексу

    //   if (menuItem) {
    //     const submenu = menuItem.querySelector('.submenu'); // Находим дочерний элемент с классом 'submenu'

    //     if (submenu) {
    //       // Если submenu существует, то добавляем/удаляем класс 'active'
    //       submenu.classList.toggle('active');
    //     }
    //   }
    // }
  },
    created() {
        const accessesArray = localStorage.getItem("accesses").split('');
        this.menuItems.forEach((menuItem, index) => {
            // Перебираем элементы submenu
            menuItem.submenu.forEach((subMenuItem, subIndex) => {
                if (accessesArray.includes(subMenuItem.access_key.toString())) {
                    subMenuItem.access = true;
                }
            });
        });
    },
    computed: {
        filteredSubMenu() {
            return (submenu) => submenu.filter((subMenuItem) => subMenuItem.access);
        },
    },
};
</script>

<style scoped></style>
