import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/home/Home.vue";
import Auth from "@/components/auth/Auth.vue";
import SignIn from "../components/auth/components/SignIn.vue";
import SignUp from "../components/auth/components/SignUp.vue";
import Dashboard from "../components/dashboard/application/Dashboard.vue";
import Book from "../components/book/application/Book.vue";
import BookForm from "../components/book/application/BookForm.vue";
import BookList from "../components/book/application/BookList.vue";

const routes = [
    { path: "/", component: Home },
    {
        path: "/auth",
        component: Auth,
        children: [
            {
                path: "sign-in",
                name: "signin",
                component: SignIn,
            },
            {
                path: "sign-up",
                name: "signup",
                component: SignUp,
            },
        ],
    },
    {
        path: "/dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
        children: [
            {
                path: "book",
                component: Book,
                redirect: "/dashboard/book/list",
                children: [
                    {
                        path: "list",
                        name: "book-list",
                        component: BookList,
                    },
                    {
                        path: "create",
                        name: "book-create",
                        component: BookForm,
                    },
                    {
                        path: "edit/:id",
                        name: "book-edit",
                        component: BookForm,
                    },
                ],
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem("token");
    if (to.meta.requiresAuth && !isAuthenticated) {
        next("/auth/sign-in");
    } else {
        next();
    }
});

export default router;
