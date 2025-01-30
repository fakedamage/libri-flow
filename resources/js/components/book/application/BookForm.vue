<script setup lang="ts">
import { ref, defineProps, defineEmits, watch, onMounted } from "vue";
import Breadcrumb from "../../dashboard/application/components/Breadcrumb.vue";
import HttpClient from "../../../plugins/http-client";
import swalPlugin from "../../../plugins/swalPlugin";
import { useRouter } from "vue-router";
import Book from "../domain/entities/book.entity";
const router = useRouter();

const props = defineProps<{
    modelValue: Book | undefined;
    id: number | undefined;
}>();

const emit = defineEmits(["update:modelValue", "submit"]);

const isEditing = ref(false);
const id = router.currentRoute.value.params["id"];
if (id) isEditing.value = true;

const book = ref<Book>({
    title: "",
    author: "",
    description: "",
    isbn: "",
    available_quantity: 0,
});

onMounted(() => {
    if (id) fetchBook();
});

watch(
    () => props.modelValue,
    (newVal) => {
        if (newVal) {
            book.value = { ...newVal };
            // isEditing.value = true;
        } else {
            book.value = {
                title: "",
                author: "",
                description: "",
                isbn: "",
                available_quantity: 0,
            };
            // isEditing.value = false;
        }
    },
    { immediate: true }
);

async function submitForm() {
    if (!isEditing.value) create();
    else update();
}
async function create() {
    try {
        const response = await HttpClient.post(`/books`, book.value);
        if (response.status === 201) {
            swalPlugin.success(
                "Sucesso!",
                isEditing.value ? "Livro atualizado." : "Livro registrado.",
                () => {
                    router.push("/dashboard/book");
                }
            );
        }
    } catch (error) {
        swalPlugin.error("Ooops!", "Ocorreu um erro ao registrar esse livro.");
    }
}
async function update() {
    try {
        const response = await HttpClient.put(`/books/${id}`, book.value);
        if (response.status === 200) {
            swalPlugin.success(
                "Sucesso!",
                isEditing.value ? "Livro atualizado." : "Livro registrado.",
                () => {
                    router.push("/dashboard/book");
                }
            );
        }
    } catch (error) {
        swalPlugin.error("Ooops!", "Ocorreu um erro ao registrar esse livro.");
    }
}
async function fetchBook() {
    try {
        const response = await HttpClient.get(`/books/${id}`);
        book.value = response.data;
    } catch (error) {
        console.error("Erro ao buscar livros:", error);
    }
}
</script>

<template>
    <div id="book-form">
        <Breadcrumb />
        <div class="card">
            <div class="card-header">
                <h5>{{ isEditing ? "Editar Livro" : "Criar Livro" }}</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitForm">
                    <div class="mb-3">
                        <label class="form-label">Titulo</label>
                        <input
                            v-model="book.title"
                            type="text"
                            class="form-control"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input
                            v-model="book.author"
                            type="text"
                            class="form-control"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea
                            v-model="book.description"
                            class="form-control"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input
                            v-model="book.isbn"
                            type="text"
                            class="form-control"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantidade</label>
                        <input
                            v-model="book.available_quantity"
                            type="number"
                            class="form-control"
                            required
                        />
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isEditing ? "Editar" : "Criar" }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
