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
    <BaseField :id="id" :label="label" :errors="props.errors">
        <Field
            v-model="props.value"
            :id="id"
            :name="props.name"
            type="email"
            class="form-control"
            :class="{ 'is-invalid': props.errors }"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </BaseField>
</template>
