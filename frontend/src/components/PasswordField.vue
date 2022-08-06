<script setup>
import { inject } from "vue";
import { Field } from "vee-validate";
import BaseField from "./BaseField.vue";

const props = defineProps({
    id: String,
    name: String,
    label: String,
    errors: String,
    value: String,
    toggle: Boolean,
});

const showPassword = inject("showPassword");
</script>
<template>
    <BaseField :id="props.id" :label="props.label" :errors="props.errors">
        <Field
            v-model="props.value"
            :id="id"
            :name="props.name"
            :type="togglePassword(showPassword)"
            class="form-control"
            :class="{ 'is-invalid': props.errors }"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <template v-if="props.toggle" v-slot:end>
            <div class="form-check mt-2">
                <label class="form-check-label">
                    <input
                        v-model="showPassword"
                        class="form-check-input"
                        type="checkbox"
                    />
                    Показать пароль
                </label>
            </div>
        </template>
    </BaseField>
</template>
