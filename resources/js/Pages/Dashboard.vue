<script setup>
import Panel from '@/Components/Panel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="$t('Dashboard')" />

    <AuthenticatedLayout :title="$t('Dashboard')">
        <Panel class="overflow-hidden">
            <div class="text-gray-900 dark:text-gray-100">
                {{ $t("You're logged in!") }}
            </div>
        </Panel>
    </AuthenticatedLayout>
</template>
