<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout title="Dashboard">
        <div
            class="overflow-hidden bg-white shadow-xs sm:rounded-lg dark:bg-gray-800"
        >
            <div class="p-6 text-gray-900 dark:text-gray-100">
                You're logged in!
            </div>
        </div>
    </AuthenticatedLayout>
</template>
