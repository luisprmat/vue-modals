<script setup>
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
})
</script>

<template>
    <Teleport to="body">
        <div
            v-show="show"
            class="fixed inset-0 flex size-full items-center justify-center"
        >
            <div class="fixed inset-0 z-40 flex size-full bg-black/75" />
            <div
                class="z-50 w-full max-w-md rounded-lg bg-white p-4 dark:bg-gray-800"
            >
                <slot />
            </div>
        </div>
    </Teleport>
</template>
