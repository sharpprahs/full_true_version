<template>
    <div>
        <table>
            <tr>
                <th
                    v-for="(header, i) in headers"
                    :key="`${header}${i}`"
                    class="header-item"
                >
                    {{ header }}
                </th>
            </tr>
            <tr
                v-for="entity in data"
                :key="`entity-${entity.name}`"
                class="table-rows"
            >
                <td v-for="(header, i) in headers" :key="`${header}-${i}`">
                    <slot :name="`column${i}`" :entity="entity"></slot>
                    <div class="warning_table" v-if="shouldDisplayWarning(i,entity.warning)">
                        <div>У {{ entity.name }} Удален доступ к <span>{{ entity.deleted.name}}</span></div>
                    </div>
                </td>
            </tr>
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
            warningDisplayed: false, // Добавляем переменную для отслеживания отображения предупреждения
        };
    },
    methods: {
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
