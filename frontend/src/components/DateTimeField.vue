<script setup>
import { Field } from "vee-validate";
import BaseField from "./BaseField.vue";

const props = defineProps({
    id: String,
    name: String,
    label: String,
    errors: String,
    value: String,
});
</script>
<template>
    <BaseField :id="props.id" :label="props.label" :errors="props.errors">
        <Field
            v-model="props.value"
            :id="id"
            :name="props.name"
            type="datetime-local"
            class="form-control"
            :class="{ 'is-invalid': props.errors }"
        />
    </BaseField>
</template>
