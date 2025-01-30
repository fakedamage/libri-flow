<script setup lang="ts">
import { ref, onMounted } from "vue";
import HttpClient from "../../../plugins/http-client";
import Book from "../domain/entities/book.entity";
import Breadcrumb from "../../dashboard/application/components/Breadcrumb.vue";
import { IconEdit, IconCalendarStats, IconTrash } from "@tabler/icons-vue";
import User from "../../../../domain/entities/user.entity";
import { UserType } from "../../../../domain/enums/user-type.enum";
import swalPlugin from "../../../plugins/swalPlugin";

const books = ref<Array<Book>>([]);
const searchTitle = ref<string>("");
const searchAuthor = ref<string>("");
const perPage = ref<number>(10);
const user = ref(User.getCurrentUser());

onMounted(() => {
    getBooks();
});

const getBooks = async (pageUrl: string | null = null) => {
    const url = pageUrl
        ? pageUrl
        : `/books?title=${searchTitle.value}&author=${searchAuthor.value}&per_page=${perPage.value}`;
    try {
        const response = await HttpClient.get(url);
        books.value = response.data.data;
    } catch (error) {
        console.error("Error fetching books", error);
    }
};

async function reserveBook(bookId: string) {
    try {
        const response = await HttpClient.post(`/books/${bookId}/reserve`);

        if (response.status === 200) {
            swalPlugin.success("Sucesso!", "Livro reservado com sucesso.");
            getBooks();
        }
    } catch (error) {
        console.error("Error reserving book", error);
        swalPlugin.error("Ooops!", "Não foi possivel reservar este livro.");
    }
}
async function deleteBook(bookId: string) {
    swalPlugin.warning(
        "Atenção!",
        "Tem certeza que deseja excluir este livro?",
        async () => {
            try {
                const response = await HttpClient.delete(`/books/${bookId}`);
                if (response.status === 200) {
                    swalPlugin.success(
                        "Sucesso!",
                        "Livro excluído com sucesso."
                    );
                    getBooks();
                }
            } catch (error) {
                console.error("Error reserving book", error);
                swalPlugin.error(
                    "Ooops!",
                    "Não foi possivel excluir este livro."
                );
            }
        }
    );
}

function loadPage(url: string | null) {
    if (url) {
        getBooks(url);
    }
}

function searchBooks() {
    getBooks();
}
</script>
<template>
    <div>
        <Breadcrumb />
        <h1>Listagem de Livros</h1>

        <!-- Formulário de busca -->
        <div>
            <input
                v-model="searchTitle"
                placeholder="Busque pelo título"
                @input="searchBooks"
            />
            <input
                v-model="searchAuthor"
                placeholder="Busque pelo autor"
                @input="searchBooks"
            />
        </div>

        <!-- <div v-if="books.length === 0">No books available</div> -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Descrição</th>
                        <th>ISBN</th>
                        <th>Quantidade Disponível</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody v-if="books.length">
                    <tr v-for="(book, index) in books">
                        <td>{{ index + 1 }}</td>
                        <td>{{ book.title }}</td>
                        <td>{{ book.author }}</td>
                        <td>{{ book.description }}</td>
                        <td>{{ book.isbn }}</td>
                        <td>{{ book.available_quantity }}</td>
                        <td class="actions">
                            <router-link
                                v-if="user?.role === UserType.ADMIN"
                                class="btn btn-primary"
                                :to="`/dashboard/book/edit/${book.id}`"
                            >
                                <IconEdit />
                            </router-link>
                            <button
                                class="btn btn-primary"
                                v-if="book.id"
                                @click="reserveBook(book.id)"
                            >
                                <IconCalendarStats />
                            </button>
                            <button
                                v-if="user?.role === UserType.ADMIN && book.id"
                                @click="deleteBook(book.id)"
                                class="btn btn-primary"
                            >
                                <IconTrash />
                            </button>
                        </td>
                    </tr>
                </tbody>

                <tbody v-else>
                    Nenhum livro registrado.
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped lang="scss">
.table-responsive {
    margin-top: 20px;
}
.actions {
    button,
    a {
        margin: 0px 3px;
        padding: 2px 6px;
        svg {
            width: 20px;
        }
    }
}
</style>
