<script setup>
import { ref } from "vue";
import ButtonField from "../components/ButtonField.vue";
</script>
<template>
    <main>
        <div class="container">
            <header
                class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"
            >
                <router-link
                    :to="{ name: 'home' }"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none"
                >
                    <span class="fs-4">{{ appName }}</span>
                </router-link>

                <ul v-if="!$store.getters.auth.loggedIn" class="nav nav-pills">
                    <li class="nav-item">
                        <router-link
                            v-if="$route.name != 'signup'"
                            :to="{ name: 'signup' }"
                            class="ms-3 btn btn-primary"
                            >Регистрация</router-link
                        >
                        <router-link
                            v-if="$route.name != 'signin'"
                            :to="{ name: 'signin' }"
                            class="ms-3 btn btn-success"
                            >Вход</router-link
                        >
                    </li>
                </ul>
                <ul v-else class="nav nav-pills">
                    <router-link
                        v-if="$route.name != 'report'"
                        :to="{ name: 'report' }"
                        class="ms-3 btn btn-primary"
                        >Отправить заявку</router-link
                    >
                    <li class="nav-item">
                        <ButtonField
                            :loading="loading"
                            @click="signout"
                            class="ms-3 btn-danger"
                            text="Выход"
                        />
                    </li>
                </ul>
            </header>
            <router-view></router-view>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            loading: false,
        };
    },
};
</script>
