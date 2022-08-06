<script setup>
import { watch, reactive, computed } from "vue";
import { Form, Field, ErrorMessage, configure, defineRule } from "vee-validate";
import FlashMessages from "../components/FlashMessages.vue";
import TextField from "../components/TextField.vue";
import EmailField from "../components/EmailField.vue";
import PasswordField from "../components/PasswordField.vue";
import ButtonField from "../components/ButtonField.vue";
import schema from "../schemas/signup";

configure({
    validateOnBlur: true,
    validateOnChange: true,
    validateOnInput: true,
    validateOnModelUpdate: true,
});

const form = reactive({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
    showPassword: false,
});
</script>
<template>
    <FlashMessages />
    <Form
        @submit="signup"
        :validation-schema="schema"
        v-slot="{ isSubmitting, errors }"
        class="form-custom"
    >
        <TextField
            v-model="form.name"
            id="name"
            name="name"
            label="ФИО"
            :errors="errors.name"
        />

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
        />

        <PasswordField
            v-model="form.password"
            id="confirm_password"
            name="confirmPassword"
            label="Подтвердите пароль"
            :errors="errors.confirmPassword"
            :toggle="true"
        />

        <ButtonField
            :loading="isSubmitting"
            class="btn-primary"
            text="Зарегистрироваться"
        />
    </Form>
</template>
