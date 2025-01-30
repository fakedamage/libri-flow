<script setup>
import { ref } from "vue";
import httpClient from "../../../plugins/http-client";
import swalPlugin from "../../../plugins/swalPlugin";
import User from "../../../../domain/entities/user.entity";
import { useRouter } from "vue-router";

const router = useRouter();

const email = ref("");
const password = ref("");
const loading = ref(false);
const errorMessage = ref();

const submitLogin = () => {
    if (email.value && password.value) signIn();
};

const signIn = async () => {
    try {
        loading.value = true;
        const response = await httpClient.post("/auth/sign-in", {
            email: email.value,
            password: password.value,
        });

        if (response.status === 200) {
            const user = new User(response.data.user);
            const result = user.signIn(response.data.token);
            if (result) router.push("/dashboard");
        }
    } catch (error) {
        if (error.response && error.response.data) {
            swalPlugin.error("Ooops!", error.response.data.message);
        } else {
            errorMessage.value = "Ocorreu um erro inesperado!";
        }
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="login-page">
        <p class="text-center mb-4">Bem-vindo de volta!</p>
        <form @submit.prevent="submitLogin">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input
                    type="email"
                    id="email"
                    class="form-control"
                    v-model="email"
                    placeholder="Digite seu e-mail"
                    required
                />
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Senha</label>
                <input
                    type="password"
                    id="password"
                    class="form-control"
                    v-model="password"
                    placeholder="Digite sua senha"
                    required
                />
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="text-center mt-3">
            <span>Não possui conta? </span>
            <router-link to="/auth/sign-up">Registre-se agora!</router-link>
        </p>
    </div>
</template>
