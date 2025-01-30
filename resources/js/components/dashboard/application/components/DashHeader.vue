<script setup lang="ts">
import Logo from "../../../system/Logo.vue";
import User from "../../../../../domain/entities/user.entity";

defineProps({
    user: {
        type: User,
        required: true,
    },
});
</script>
<template>
    <div id="dash-header">
        <Logo class="logo" />
        <div :style="{ float: 'right' }" class="mt-1">
            <h5>Bem-vindo {{ user.name }} !</h5>
        </div>
    </div>
</template>

<style lang="scss">
#dash-header {
    width: 100%;
    position: fixed;
    background: #36d1ff;
    z-index: 9999;
    box-shadow: 0px 0px 9px #17181aab;
    padding: 8px 24px;

    .logo {
        text-align: left;
        font-size: 24px;
        display: inline-block;
    }
}
</style>
