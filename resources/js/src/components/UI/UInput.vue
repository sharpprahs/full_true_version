<template>
    <input
        :class="data.class"
        :type="data.type"
        :placeholder="data.placeholder"
        :value="data.value"
        :name="data.name"
        @input="updatePopupItemValue($event)"
    />
</template>

<script>
export default {
    name: "UInput",
    props: {
        data: Object,
    },
    methods: {
        updatePopupItemValue(event) {
            this.$emit("update", event.target.value); // Эмитируем событие и передаем новое значение
        },
    },
};
</script>

<style scoped></style>
