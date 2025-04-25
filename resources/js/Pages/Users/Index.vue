<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    users: Array,
});
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout title="Users">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-600"
                >
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs leading-none font-medium text-gray-500 uppercase dark:text-gray-400"
                            >
                                User
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs leading-none font-medium text-gray-500 uppercase dark:text-gray-400"
                            >
                                Email
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-200 bg-white dark:divide-gray-600 dark:bg-gray-800"
                    >
                        <tr
                            v-for="user in users"
                            :key="user.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="size-10 shrink-0">
                                        <img
                                            :src="`https://i.pravatar.cc/150?u=${user.id}`"
                                            :alt="user.name"
                                            class="size-10 rounded-full"
                                        />
                                    </div>
                                    <div class="ml-4">
                                        <div
                                            class="text-sm font-medium text-gray-900 dark:text-gray-50"
                                        >
                                            {{ user.name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm text-gray-500 dark:text-gray-400"
                                >
                                    {{ user.email }}
                                </div>
                            </td>
                            <td
                                class="space-x-3 px-6 py-4 text-right whitespace-nowrap"
                            >
                                <Link
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    :href="route('users.show', user)"
                                >
                                    View
                                </Link>
                                <Link
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    :href="route('users.edit', user)"
                                >
                                    Edit
                                </Link>
                                <button
                                    class="cursor-pointer text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    @click="openEditModal(user)"
                                >
                                    Edit in Modal
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
