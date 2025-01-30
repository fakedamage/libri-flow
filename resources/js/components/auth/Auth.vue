<script setup>
import { ref } from "vue";
import Logo from "../../components/system/Logo.vue";

const email = ref("");
const password = ref("");

const submitLogin = () => {
    console.log("Login attempt:", {
        email: email.value,
        password: password.value,
    });
    // Lógica de autenticação vai aqui
};
</script>

<template>
    <div id="auth-layout">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="auth-card p-4">
                        <router-link
                            style="text-decoration: none; color: inherit"
                            to="/"
                        >
                            <Logo class="logo" />
                        </router-link>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
#auth-layout {
    min-height: 100vh;
    background: url("/imgs/auth/library-bg.jpg") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;

    .auth-card {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-family: "Arial", sans-serif;
        font-weight: bold;
        color: #333;
        margin-top: 0px;
    }

    a {
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }
    .logo {
        font-size: 54px;
    }
}
</style>
