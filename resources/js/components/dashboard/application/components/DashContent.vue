<script setup lang="ts"></script>
<template>
    <div id="content" class="flex-grow-1 p-4">
        <div>
            <slot />
        </div>
    </div>
</template>
<style scoped lang="scss">
#content {
    margin-left: 250px;
    padding-top: 70px !important;

    width: calc(100% - 250px);
}
</style>
