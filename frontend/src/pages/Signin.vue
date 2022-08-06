<script setup>
import { reactive, computed } from "vue";
import { Form, Field, ErrorMessage, configure, defineRule } from "vee-validate";
import EmailField from "../components/EmailField.vue";
import PasswordField from "../components/PasswordField.vue";
import ButtonField from "../components/ButtonField.vue";
import FlashMessages from "../components/FlashMessages.vue";
import schema from "../schemas/signin";

configure({
    validateOnBlur: true,
    validateOnChange: true,
    validateOnInput: true,
    validateOnModelUpdate: true,
});

const form = reactive({
    email: "",
    password: "",
    showPassword: false,
});
</script>
<template>
    <FlashMessages />
    <Form
        @submit="signin"
        :validation-schema="schema"
        v-slot="{ isSubmitting, errors }"
        class="form-custom"
    >
        <EmailField
            v-model="form.email"
            id="email"
            name="email"
            label="Адрес электронной почты"
            :errors="errors.email"
        />
        <PasswordField
            v-model="form.password"
            id="password"
            name="password"
            label="Пароль"
            :errors="errors.password"
            :toggle="true"
        />

        <ButtonField :loading="isSubmitting" class="btn-primary" text="Войти" />
    </Form>
</template>
