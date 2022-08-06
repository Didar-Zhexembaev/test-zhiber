<script setup>
import { watch, onMounted, ref, reactive, computed } from "vue";
import { Form, Field, ErrorMessage, configure, defineRule } from "vee-validate";
import SelectField from "../components/SelectField.vue";
import NumberField from "../components/NumberField.vue";
import DateTimeField from "../components/DateTimeField.vue";
import ButtonField from "../components/ButtonField.vue";
import schema from "../schemas/report";
import store from "../store";

configure({
    validateOnBlur: true,
    validateOnChange: true,
    validateOnInput: true,
    validateOnModelUpdate: false,
});

const form = reactive({
    from: "",
    to: "",
    transportType: "",
    departureType: "",
    weight: "",
    dateTime: "",
});

const isPackage = computed(() => {
    let index = store.getters.getPackageIndex;

    return ~index && form.departureType == index;
});
</script>
<template>
    <Form
        v-if="$store.getters.formData"
        @submit="report"
        :validation-schema="schema"
        v-slot="{ isSubmitting, errors }"
        class="form-custom"
    >
        <SelectField
            v-model="form.from"
            id="from"
            name="from"
            label="Откуда"
            :errors="errors.from"
        >
            <option
                v-for="city in $store.getters.formData.cities"
                :key="city.id"
                :value="city.id"
            >
                {{ city.city }}
            </option>
        </SelectField>

        <SelectField id="to" name="to" label="Куда" v-model="form.to" :errors="errors.to">
            <option
                v-for="city in $store.getters.formData.cities"
                :key="city.id"
                :value="city.id"
            >
                {{ city.city }}
            </option>
        </SelectField>

        <SelectField
            v-model="form.transportType"
            id="transport_type"
            name="transportType"
            label="Тип транспорта"
            :errors="errors.transportType"
        >
            <option
                v-for="transport in $store.getters.formData.transports"
                :key="transport.id"
                :value="transport.id"
            >
                {{ transport.transport }}
            </option>
        </SelectField>

        <SelectField
            v-model="form.departureType"
            id="departure_type"
            name="departureType"
            label="Тип отправления"
            :errors="errors.departureType"
        >
            <option
                v-for="departure in $store.getters.formData.departureTypes"
                :key="departure.id"
                :value="departure.id"
            >
                {{ departure.type }}
            </option>
        </SelectField>

        <NumberField
            v-if="isPackage"
            v-model="form.weight"
            id="weight"
            name="weight"
            label="Вес (кг)"
            :errors="errors.weight"
        />

        <DateTimeField
            v-model="form.dateTime"
            id="date_time"
            name="dateTime"
            label="Дата и время поездки"
            :errors="errors.dateTime"
        />

        <ButtonField
            class="btn-primary"
            :loading="isSubmitting"
            text="Отправить"
            type="submit"
        />
    </Form>
</template>
<script>
export default {
    created: function () {
        this.fetchReportFormData();
    },
};
</script>
