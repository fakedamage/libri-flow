<script setup lang="ts">
import { ref } from "vue";
import httpClient from "../../../plugins/http-client";
import swalPlugin from "../../../plugins/swalPlugin";
import User from "../../../../domain/entities/user.entity";
import { useRouter } from "vue-router";
import { UserType } from "../../../../domain/enums/user-type.enum";

const router = useRouter();
const userTypes = UserType;

const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");
const selectedUserType = ref(UserType.USER);
const errorMessage = ref();
const loading = ref(false);

const submitSignup = () => {
    if (password.value === confirmPassword.value) {
        signUp();
    }
};
const signUp = async () => {
    try {
        loading.value = true;
        const response = await httpClient.post("/auth/sign-up", {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirmPassword.value,
            role: selectedUserType.value,
        });

        if (response.status === 200) {
            swalPlugin.success(
                "Sucesso!",
                "Seu cadastro foi realizado com sucesso!",
                () => {
                    const user = new User(response.data.user);
                    const result = user.signIn(response.data.token);
                    if (result) router.push("/dashboard");
                }
            );
        }
    } catch (error) {
        if (error.response && error.response.data) {
            const data = error.response.data;
            swalPlugin.error(
                "Ooops!",
                data.errors ? formatErrors(data) : data.message
            );
        } else {
            errorMessage.value = "Ocorreu um erro inesperado!";
        }
    } finally {
        loading.value = false;
    }
};
function formatErrors(errorResponse) {
    if (!errorResponse.errors) return "";

    return Object.entries(errorResponse.errors)
        .map(([field, messages]) => `${messages.join(", ")}`)
        .join(" | ");
}
function getUserTypeName(type: UserType) {
    const names = {};
    names[UserType.USER] = "Usuário";
    names[UserType.ADMIN] = "Administrador";
    return names[type];
}
</script>

<template>
    <div class="signup-page">
        <p class="text-center mb-4">
            Preencha os campos abaixo para criar sua conta e começar a usar o
            aplicativo.
        </p>

        <form @submit.prevent="submitSignup">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input
                    type="text"
                    id="name"
                    class="form-control"
                    v-model="name"
                    placeholder="Digite seu nome completo"
                    required
                />
            </div>
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
            <div class="mb-3">
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
            <div class="mb-3">
                <label for="confirm_password" class="form-label"
                    >Confirme sua senha</label
                >
                <input
                    type="password"
                    id="confirm_password"
                    class="form-control"
                    v-model="confirmPassword"
                    placeholder="Confirme sua senha"
                    required
                />
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">
                    Selecione o tipo de usuário
                </label>
                <select v-model="selectedUserType" class="form-select">
                    <option
                        v-for="(value, key) in userTypes"
                        :key="key"
                        :value="value"
                    >
                        {{ getUserTypeName(value) }}
                    </option>
                </select>
            </div>
            <p v-if="password !== confirmPassword" class="text-danger">
                As senhas não coincidem. Por favor, verifique.
            </p>

            <p v-if="errorMessage" class="text-danger">
                {{ errorMessage }}
            </p>

            <button
                type="submit"
                class="btn btn-primary w-100"
                :disabled="password !== confirmPassword"
            >
                Criar Conta
            </button>
        </form>

        <p class="text-center mt-3">
            <span>Já tem uma conta? </span>
            <router-link to="/auth/sign-in">Faça login</router-link>
        </p>
    </div>
</template>

<style scoped lang="scss">
#signup-page {
    max-width: 400px;
    margin: 0 auto;
    padding: 30px;

    h2 {
        font-family: "Poppins", sans-serif;
        font-weight: bold;
    }

    a {
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }

    .text-danger {
        font-size: 0.875rem;
    }
}
</style>
