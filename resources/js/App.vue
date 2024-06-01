<template>
    <router-view v-slot="{ Component, route }">
        <component :is="route.meta.layout || 'div'">
            <component :is="Component" :key="route.fullPath" />
        </component>
    </router-view>
</template>

<script>
export default {
    name: 'App',
};
</script>

