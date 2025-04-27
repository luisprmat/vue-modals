<script setup>
import Panel from '@/Components/Panel.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    user: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <Head :title="user.name" />

    <AuthenticatedLayout :title="user.name">
        <!-- <Panel>
            <div class="flex space-x-6">
                <div class="size-40 shrink-0">
                    <img
                        :src="`https://i.pravatar.cc/150?u=${user.id}`"
                        :alt="user.name"
                        class="size-40 rounded-full"
                    />
                </div>
                <div class="text-xl">
                    <span class="font-bold">{{ $t('Email') }}:</span>
                    <span class="italic">{{ user.email }}</span>
                </div>
            </div>
        </Panel> -->
        <Panel>
            <div class="flex items-center space-x-5">
                <div class="shrink-0">
                    <img
                        :src="`https://i.pravatar.cc/150?u=${user.id}`"
                        :alt="user.name"
                        class="size-24 rounded-full border-4 border-white object-cover shadow-sm dark:border-gray-900"
                    />
                </div>
                <div class="min-w-0 flex-1">
                    <h2
                        class="truncate text-2xl font-bold text-gray-900 dark:text-gray-100"
                    >
                        {{ user.name }}
                    </h2>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <span>{{ user.email }}</span>
                    </div>
                </div>
                <div class="shrink-0">
                    <Link
                        :href="route('users.edit', user)"
                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition duration-150 ease-in-out hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden active:bg-indigo-500 dark:hover:bg-indigo-500 dark:focus:bg-indigo-500 dark:focus:ring-offset-indigo-600 dark:active:bg-indigo-400"
                    >
                        {{ $t('Edit :name', { name: $t('Profile') }) }}
                    </Link>
                </div>
            </div>
        </Panel>
    </AuthenticatedLayout>
</template>
