<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li
                v-for="(crumb, index) in breadcrumbs"
                :key="index"
                class="breadcrumb-item"
                :class="{ active: index === breadcrumbs.length - 1 }"
            >
                <RouterLink
                    v-if="index !== breadcrumbs.length - 1"
                    :to="crumb.path"
                >
                    {{ crumb.label }}
                </RouterLink>
                <span v-else>{{ crumb.label }}</span>
            </li>
        </ol>
    </nav>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { useRoute, RouterLink } from "vue-router";

// Pegando a rota atual
const route = useRoute();

// Gerando os breadcrumbs a partir da rota
const breadcrumbs = computed(() => {
    const paths = route.path.split("/").filter((p) => p);
    return paths.map((p, index) => ({
        label: getNames(p), // Capitaliza o nome
        path: "/" + paths.slice(0, index + 1).join("/"),
    }));
});

function getNames(key: string) {
    const names = {
        dashboard: "Início",
        book: "Livros",
        list: "Lista",
        create: "Criar",
        edit: "Editar",
    };
    return names[key];
}
</script>

<style scoped>
.breadcrumb {
    background: none;
}

.breadcrumb-item a {
    text-decoration: none;
    color: #007bff;
}

.breadcrumb-item.active {
    color: #6c757d;
}
</style>
