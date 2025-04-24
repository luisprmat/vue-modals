<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="overflow-hidden bg-yellow-50 shadow-sm sm:rounded-lg dark:bg-yellow-900"
        >
            <div>
                <div
                    class="flex items-center space-x-4 px-6 py-4 font-medium text-green-800 dark:text-green-100"
                >
                    <div class="text-green-400">
                        <svg
                            class="size-6"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <g data-name="Layer 2">
                                    <g data-name="checkmark-circle-2">
                                        <rect
                                            width="24"
                                            height="24"
                                            opacity="0"
                                        ></rect>
                                        <path
                                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm4.3 7.61l-4.57 6a1 1 0 0 1-.79.39 1 1 0 0 1-.79-.38l-2.44-3.11a1 1 0 0 1 1.58-1.23l1.63 2.08 3.78-5a1 1 0 1 1 1.6 1.22z"
                                        ></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div>{{ message }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
