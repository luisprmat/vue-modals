import { router, usePage } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ref } from 'vue'

const modal = ref(null)

const page = usePage()

const setModal = (data) => {
    if (modal.value) return

    resolvePageComponent(
        `./Pages/${data.component}.vue`,
        import.meta.glob('./Pages/**/*.vue'),
    ).then((component) => {
        modal.value = data
        modal.value.resolvedComponent = component
        modal.value.show = true
    })
}

function open(href) {
    axios
        .get(href, {
            headers: {
                'X-Inertia': true,
                'X-Modal': true,
                'X-Inertia-Version': page.version,
            },
        })
        .then((response) => {
            setModal(response.data)
        })
}

function close() {
    if (modal.value) {
        modal.value.show = false
    }
}

function reset() {
    // redirect back to base url
    if (modal.value?.baseUrl && modal.value.baseUrl !== window.location.href) {
        router.visit(modal.value.baseUrl)
    }

    modal.value = null
}

export { close, modal, open, reset, setModal }
