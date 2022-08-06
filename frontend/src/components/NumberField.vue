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
            :id="id"
            :name="props.name"
            type="number"
            class="form-control"
            v-model="props.value"
            @input="$emit('update:modelValue', $event.target.value)"
            :class="{ 'is-invalid': props.errors }"
        />
    </BaseField>
</template>
