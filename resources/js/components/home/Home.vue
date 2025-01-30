<script setup>
import Logo from "../system/Logo.vue";
</script>

<template>
    <div>
        <section
            id="home-page"
            class="hero-section vh-100 d-flex align-items-center justify-content-center text-center text-white"
        >
            <div class="container">
                <Logo class="logo" />
                <h1 class="display-4 fw-bold">Sistema de Gestão de Livros</h1>
                <p class="lead">
                    Gerencie sua biblioteca de forma simples e eficiente.
                </p>
                <router-link class="btn btn-primary btn-lg" to="/auth/sign-up">
                    Cadastre-se agora!
                </router-link>
            </div>
            <svg class="wave" viewBox="0 0 1440 320">
                <path
                    fill="#f8f9fa"
                    fill-opacity="1"
                    d="M0,128L48,122.7C96,117,192,107,288,128C384,149,480,203,576,213.3C672,224,768,192,864,170.7C960,149,1056,139,1152,149.3C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                ></path>
            </svg>
        </section>

        <section id="features" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Funcionalidades</h2>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <i class="bi bi-book fs-1 text-primary"></i>
                        <h3>Catálogo de Livros</h3>
                        <p>Organize todos os livros da sua biblioteca.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-people fs-1 text-primary"></i>
                        <h3>Gestão de Usuários</h3>
                        <p>Controle o acesso de leitores e administradores.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-bar-chart fs-1 text-primary"></i>
                        <h3>Relatórios</h3>
                        <p>
                            Gere relatórios detalhados sobre o uso da
                            biblioteca.
                        </p>
                    </div>
                </div>
            </div>

            <svg class="wave2" viewBox="0 0 1440 320">
                <path
                    fill="#f8f9fa"
                    fill-opacity="1"
                    d="M0,128L48,122.7C96,117,192,107,288,128C384,149,480,203,576,213.3C672,224,768,192,864,170.7C960,149,1056,139,1152,149.3C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                ></path>
            </svg>
        </section>

        <section
            class="parallax-section vh-100 d-flex align-items-center justify-content-center text-center text-white"
        >
            <div class="container">
                <h2 class="display-4 fw-bold">Explore Nossa Biblioteca</h2>
                <p class="lead">Descubra milhares de livros disponíveis.</p>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Sobre o Sistema</h2>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img
                            src="/public/imgs/home/books.jpg"
                            alt="Biblioteca"
                            class="img-fluid rounded"
                            :style="{ 'max-height': '300px' }"
                        />
                    </div>
                    <div class="col-md-6">
                        <h3>Moderno e Intuitivo</h3>
                        <p>
                            Nosso sistema foi desenvolvido para oferecer a
                            melhor experiência de gestão de bibliotecas.
                        </p>
                        <ul>
                            <li>Interface amigável</li>
                            <li>Segurança de dados</li>
                            <li>Suporte 24/7</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="parallax-section-2 vh-100 d-flex align-items-center justify-content-center text-center text-white"
        >
            <div class="container">
                <h2 class="display-4 fw-bold">Leitura para Todos</h2>
                <p class="lead">
                    Promovemos o acesso à leitura de forma inclusiva.
                </p>
            </div>
        </section>

        <section id="contact" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Contato</h2>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label"
                                    >Nome</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    required
                                />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"
                                    >E-mail</label
                                >
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    required
                                />
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label"
                                    >Mensagem</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message"
                                    rows="5"
                                    required
                                ></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped lang="scss">
#home-page {
    .logo {
        font-size: 90px;
    }
}
.parallax-section {
    background-image: url("/imgs/home/bg-02.jpg");
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.parallax-section-2 {
    background-image: url("/imgs/home/bg-03.jpg");
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.hero-section {
    background-image: url("/imgs/home/bg-01.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

section {
    padding: 100px 0;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.text-white {
    color: white !important;
}

.wave {
    position: absolute;
    bottom: -25px;
    left: 0;
    width: 100%;
    height: 340px;
    z-index: 1;
}
.container {
    z-index: 2;
}
#features {
    position: relative;
    .wave2 {
        position: absolute;
        bottom: -325px;
        left: 0;
        width: 100%;
        height: 340px;
        z-index: 1;
        transform: rotate(180deg);
        display: none;
    }
}
</style>
