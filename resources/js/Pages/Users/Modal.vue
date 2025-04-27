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
        <Transition leave-active-class="duration-300">
            <div
                v-show="show"
                class="fixed inset-0 flex size-full items-center justify-center"
            >
                <Transition
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    enter-active-class="transition duration-300"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                    leave-active-class="transition duration-300"
                >
                    <div
                        v-show="show"
                        class="fixed inset-0 z-40 flex size-full bg-black/75"
                    />
                </Transition>

                <Transition
                    enter-from-class="opacity-0 scale-90"
                    enter-to-class="opacity-100 scale-100"
                    enter-active-class="transition duration-300"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-90"
                    leave-active-class="transition duration-300"
                >
                    <div
                        v-show="show"
                        class="z-50 w-full max-w-md rounded-lg bg-white p-4 dark:bg-gray-800"
                    >
                        <slot />
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
