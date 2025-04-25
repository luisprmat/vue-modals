<script setup>
import Panel from '@/Components/Panel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="$t('Dashboard')" />

    <AuthenticatedLayout :title="$t('Dashboard')">
        <Panel> {{ $t("You're logged in!") }} </Panel>
    </AuthenticatedLayout>
</template>
