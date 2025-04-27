<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import Modal from './Modal.vue'
defineProps({
    users: Array,
})

const editingUser = ref(false)

const openEditModal = (user) => {
    editingUser.value = user

    form.name = user.name
    form.email = user.email
}

const form = useForm({
    name: '',
    email: '',
})

const closeModal = () => {
    editingUser.value = false
}

const updateUser = () =>
    form.put(route('users.update', editingUser.value.id), {
        onSuccess: closeModal,
    })
</script>

<template>
    <Head :title="$t('Users')" />

    <AuthenticatedLayout :title="$t('Users')">
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
                                {{ $t('User') }}
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs leading-none font-medium text-gray-500 uppercase dark:text-gray-400"
                            >
                                {{ $t('Email') }}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">{{ $t('Actions') }}</span>
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
                                    {{ $t('View') }}
                                </Link>
                                <Link
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    :href="route('users.edit', user)"
                                >
                                    {{ $t('Edit') }}
                                </Link>
                                <button
                                    class="cursor-pointer text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                    @click="openEditModal(user)"
                                >
                                    {{ $t('Edit in Modal') }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal :show="editingUser !== false">
        <h1 class="mb-6 text-lg dark:text-white">
            {{ $t('Edit :name', { name: $t('User') }) }}
        </h1>

        <form class="space-y-6" @submit.prevent="updateUser">
            <div>
                <InputLabel for="name">{{ $t('Name') }}</InputLabel>
                <TextInput v-model="form.name" class="mt-1 w-full" />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
                <InputLabel for="email">{{ $t('Email') }}</InputLabel>
                <TextInput v-model="form.email" class="mt-1 w-full" />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div class="flex justify-end space-x-3">
                <SecondaryButton @click="closeModal">
                    {{ $t('Cancel') }}
                </SecondaryButton>
                <PrimaryButton type="submit">{{ $t('Update') }}</PrimaryButton>
            </div>
        </form>
    </Modal>
</template>
