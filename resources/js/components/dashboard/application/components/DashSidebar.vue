<script setup lang="ts">
import User from "../../../../../domain/entities/user.entity";
import { UserType } from "../../../../../domain/enums/user-type.enum";
import { Menu } from "../../domain/data/menu";
import { useRouter } from "vue-router";

const router = useRouter();

const props = defineProps({
    menus: {
        type: Array<Menu>,
    },
    user: {
        type: User,
        required: true,
    },
});

const user = User.getCurrentUser();

function logout() {
    try {
        if (!props.user) throw new Error("User not logged in");

        const result = props.user.logout();
        if (result) router.push("/");
    } catch (error) {
        console.log("error => ", error);
    }
}
function getPermission(roles: Array<UserType>) {
    if (!user) return;
    if (!roles) return true;
    return roles.includes(user.role);
}
</script>
<template>
    <div id="sidebar" class="bg-dark text-white p-3">
        <ul class="nav flex-column">
            <li class="nav-item" v-for="menu in menus">
                <RouterLink
                    v-if="!menu.submenus"
                    class="nav-link text-white"
                    :to="menu.path"
                >
                    {{ menu.title }}
                </RouterLink>
                <button v-if="menu.submenus" @click="menu.open = !menu.open">
                    {{ menu.title }}
                </button>
                <ul
                    v-if="menu.submenus && menu.open"
                    class="nav flex-column ms-3"
                >
                    <div v-for="submenu in menu.submenus">
                        <li
                            class="nav-item"
                            v-if="getPermission(submenu.roles)"
                        >
                            <RouterLink
                                class="nav-link text-white"
                                :to="submenu.path"
                            >
                                {{ submenu.title }}
                            </RouterLink>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
        <button class="btn btn-logout" @click="logout">Sair</button>
    </div>
</template>
<style scoped lang="scss">
#sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    padding-top: 70px !important;
    button {
        display: block;
        width: 100%;
        background: transparent;
        border: none;
        color: #fff;
        padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
        text-align: left;
    }
    .btn-logout {
        position: absolute;
        bottom: 0px;
        width: 100%;
        background: #a6a6a6;
        left: 0px;
        border-radius: 0px;
        padding: 10px;
        color: #212529;
    }
}
</style>
