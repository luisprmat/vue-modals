<script setup>
import { open } from '@/useModal'

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <button type="button" @click="open(href)">
        <slot />
    </button>
</template>
