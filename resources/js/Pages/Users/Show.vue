<script setup>
import Panel from '@/Components/Panel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head :title="user.name" />

    <AuthenticatedLayout :title="user.name">
        <Panel>
            <div class="flex space-x-6">
                <div class="size-40 shrink-0">
                    <img
                        :src="`https://i.pravatar.cc/150?u=${user.id}`"
                        :alt="user.name"
                        class="size-40 rounded-full"
                    />
                </div>
                <div class="text-xl">
                    <span class="font-bold">Email:</span>
                    <span class="italic">{{ user.email }}</span>
                </div>
            </div>
        </Panel>
    </AuthenticatedLayout>
</template>
