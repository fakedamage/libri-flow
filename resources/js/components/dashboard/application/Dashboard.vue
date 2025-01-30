<script setup lang="ts">
import { onMounted, ref } from "vue";
import User from "../../../../domain/entities/user.entity";
import Logo from "../../../components/system/Logo.vue";
import { type Menu, Menus } from "../domain/data/menu";
import DashHeader from "./components/DashHeader.vue";
import DashSidebar from "./components/DashSidebar.vue";
import DashContent from "./components/DashContent.vue";

const user = ref<User>();
const menus = ref<Array<Menu>>(Menus);

onMounted(() => {
    user.value = User.getCurrentUser();
});
</script>
<template>
    <div id="dashboard">
        <div v-if="user">
            <DashHeader :user="user" />
            <DashSidebar :user="user" :menus="menus" />
            <DashContent :user="user">
                <router-view></router-view>
            </DashContent>
        </div>
    </div>
</template>
