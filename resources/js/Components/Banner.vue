<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div class="mx-auto -mt-6 mb-6 max-w-7xl rounded-lg shadow-sm">
        <div
            class="rounded-lg border-green-400 bg-green-50 p-4 dark:bg-green-800"
        >
            <div class="flex items-center">
                <div class="shrink-0">
                    <!-- Success Icon -->
                    <svg
                        class="size-5 text-green-400 dark:text-green-300"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div class="ml-3">
                    <p
                        class="text-sm font-medium text-green-800 dark:text-green-50"
                    >
                        {{ message }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
