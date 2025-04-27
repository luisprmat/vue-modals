<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { useForm } from '@inertiajs/vue3'
import { watch } from 'vue'

const props = defineProps({
    user: Object,
})

const emit = defineEmits(['close'])

const form = useForm({
    name: '',
    email: '',
})

watch(
    () => props.user,
    (user) => {
        if (user) {
            form.name = user.name
            form.email = user.email
        }
    },
)

const closeModal = () => {
    form.clearErrors()
    emit('close')
}

const updateUser = () =>
    form.put(route('users.update', props.user.id), {
        onSuccess: closeModal,
    })
</script>

<template>
    <Modal
        :show="user !== null"
        @close="closeModal"
        size="md"
        :title="$t('Edit :name', { name: $t('User') })"
    >
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
