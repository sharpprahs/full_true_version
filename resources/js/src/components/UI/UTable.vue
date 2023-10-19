<template>
    <div class="table_container" ref="tableContainer">
        <table>
            <tr class="tr_container">
                <th
                    v-for="(header, i) in headers"
                    :key="`${header}${i}`"
                    class="header-item"
                >
                    {{ header }}
                </th>
            </tr>
            <transition-group name="list">
            <tr
                v-for="entity in data"
                :key="`entity-${entity.name}`"
                class="table-rows"
                @mousedown="startDragging"
                @mousemove="dragging"
                @mouseup="stopDragging"
            >

                <td v-for="(header, i) in headers" :key="`${header}-${i}`" class="warning_table_container">
                    <slot :name="`column${i}`" :entity="entity"></slot>
                </td>
                <td class="warning_table" v-if="shouldDisplayWarning(1,entity.warning)">
                    <div v-html="entity.warning_title"></div>
                </td>
            </tr>
            </transition-group>
        </table>
    </div>
</template>

<script>
export default {
    name: "UTable",
    props: {
        headers: {
            type: Array,
            required: true,
        },
        data: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            isDragging: false,
            startX: 0,
            startScrollLeft: 0,
            maxScrollLeft: 0, // Максимальное значение scrollLeft
            warningDisplayed: false, // Добавляем переменную для отслеживания отображения предупреждения
        };
    },
    methods: {
        startDragging(event) {
            this.isDragging = true;
            this.startX = event.clientX;
            this.startScrollLeft = this.$refs.tableContainer.scrollLeft;
            this.maxScrollLeft = this.$refs.tableContainer.scrollWidth - this.$refs.tableContainer.clientWidth;
        },
        dragging(event) {
            if (this.isDragging) {
                const deltaX = event.clientX - this.startX;
                let newScrollLeft = this.startScrollLeft - deltaX;

                // Ограничиваем значение scrollLeft в пределах видимой области
                newScrollLeft = Math.max(0, Math.min(this.maxScrollLeft, newScrollLeft));

                this.scrollTable(newScrollLeft);
            }
        },
        stopDragging() {
            this.isDragging = false;
        },
        scrollTable(newScrollLeft) {
            // Используем requestAnimationFrame для более плавного скроллинга
            requestAnimationFrame(() => {
                this.$refs.tableContainer.scrollLeft = newScrollLeft;
            });
        },
        shouldDisplayWarning(index,warning) {
            // Проверяем, должно ли отображаться предупреждение только при второй итерации (index === 1)
            if (index === 1 && warning === true) {
                this.warningDisplayed = true; // Устанавливаем флаг, что предупреждение уже было отображено
                return true; // Отображаем предупреждение
            }
            return false; // В остальных случаях не отображаем предупреждение
        },
    },
};
</script>

<style>
.list-enter-active, .list-leave-active {
    transition: opacity 0.5s, transform 0.5s ease-in-out;
}
.list-enter-from, .list-leave-to {
    opacity: 0;
    transform: translateY(-30px);
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease-in-out;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
