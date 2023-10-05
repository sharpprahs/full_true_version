<template>
    <div>
        <h1>Counter: {{ counter }}</h1>
        <button @click="incrementCounter">Increment</button>
    </div>
</template>

<script>


export default {
    name: "SomePage",
    computed: {
        counter() {
            return this.$store.state.count;
        },
    },
    methods: {
        incrementCounter() {
            this.$store.commit("increment");
        },
    },
}
</script>

<style scoped>

</style>
