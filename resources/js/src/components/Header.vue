<template>
    <header class="header">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <router-link class="nav-link" aria-current="page" to="/">Главная</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/some-page">Какая-то страница</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/about">О нас</router-link>
            </li>
        </ul>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>
.header{
    width: 992px;
    margin: 0 auto;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
