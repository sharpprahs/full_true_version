<template>
    <input
        :class="data.class"
        :type="data.type"
        :id="data.name"
        :placeholder="data.placeholder"
        :value="data.value"
        :name="data.name"
        autocomplete="family-name"
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
