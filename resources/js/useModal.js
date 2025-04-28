import { usePage } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ref } from 'vue'

const modal = ref(null)

const page = usePage()

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
            resolvePageComponent(
                `./Pages/${response.data.component}.vue`,
                import.meta.glob('./Pages/**/*.vue'),
            ).then((component) => {
                modal.value = response.data
                modal.value.resolvedComponent = component
                modal.value.show = true
            })
        })
}

function close() {
    modal.value.show = false
}

function reset() {
    modal.value = null
}

export { close, modal, open, reset }
