<template>
    <table v-if="$store.getters.allReports" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Email</th>
                <th>Откуда</th>
                <th>Куда</th>
                <th>Тип транспорта</th>
                <th>Тип отправления</th>
                <th>Вес (кг)</th>
                <th>Дата и время поездки</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="report in $store.getters.allReports">
                <td v-for="info in report">{{ info }}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    created() {
        this.reportAll();
    },
};
</script>
