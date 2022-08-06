<script setup>
import { Field } from "vee-validate";
import BaseField from "./BaseField.vue";

const props = defineProps({
    id: String,
    name: String,
    label: String,
    errors: String,
    value: Number,
});
</script>
<template>
    <BaseField :id="props.id" :label="props.label" :errors="props.errors">
        <Field
            :id="id"
            :name="props.name"
            as="select"
            class="form-select"
            v-model="props.value"
            @change="$emit('update:modelValue', Number($event.target.value))"
            :class="{ 'is-invalid': props.errors }"
        >
            <slot />
        </Field>
    </BaseField>
</template>
