<script setup>
import { onMounted, onUnmounted, watch } from 'vue'

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
        required: false,
    },
    size: {
        type: String,
        required: true,
        default: 'md',
        validator: (value) => ['sm', 'md', 'lg', 'xl'].includes(value),
    },
    closeManually: {
        type: Boolean,
        required: false,
        default: false,
    },
})

const emit = defineEmits(['close', 'after-leave'])

watch(
    () => props.show,
    (show) => {
        document.body.style.overflow = show ? 'hidden' : ''
    },
    { immediate: true },
)

const close = () => {
    emit('close')
}

const closeOnEscape = (e) => {
    if (!props.show) return

    if (e.key !== 'Escape') return

    const focusedElementName = e.target.nodeName

    if (['INPUT', 'SELECT'].includes(focusedElementName)) return

    close()
}

if (!props.closeManually) {
    onMounted(() => document.addEventListener('keydown', closeOnEscape))
    onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))
}
</script>

<template>
    <Teleport to="body">
        <Transition
            @after-leave="emit('after-leave')"
            leave-active-class="duration-300"
        >
            <div
                dusk="modal-wrapper"
                v-show="show"
                class="fixed inset-0 flex size-full items-center justify-center"
            >
                <Transition
                    appear
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
                        @click="closeManually ? null : close()"
                    />
                </Transition>

                <Transition
                    appear
                    enter-from-class="opacity-0 scale-90"
                    enter-to-class="opacity-100 scale-100"
                    enter-active-class="transition duration-300"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-90"
                    leave-active-class="transition duration-300"
                >
                    <div
                        dusk="modal-content"
                        v-show="show"
                        class="scrollbar:w-1.5 scrollbar:h-1.5 scrollbar:bg-transparent scrollbar-track:bg-gray-100 scrollbar-thumb:rounded scrollbar-thumb:bg-gray-300 scrollbar-track:rounded dark:scrollbar-track:bg-gray-500/10 dark:scrollbar-thumb:bg-gray-500/50 z-50 max-h-[calc(100vh-2rem)] w-full overflow-auto rounded-lg bg-white p-4 dark:bg-gray-800 dark:text-gray-100"
                        :class="{
                            'max-w-sm': size === 'sm',
                            'max-w-md': size === 'md',
                            'max-w-lg': size === 'lg',
                            'max-w-xl': size === 'xl',
                        }"
                    >
                        <slot name="title">
                            <h1 class="mb-6 text-lg">
                                {{ title }}
                            </h1>
                        </slot>

                        <slot />
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
