<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3"; // Importar usePage para acceder al usuario autenticado
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const page = usePage(); // Obtiene los datos de la página

// Añadir el user_id automáticamente desde los props de la página (usuario autenticado)
const form = ref({
    event_date: "",
    description: "",
    location: "",
    user_id: page.props.auth.user.id, // Obtener el user_id
});

const submit = () => {
    router.post("/events", form.value);
};
</script>

<template>
    <AppLayout title="Crear Evento">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Crear Evento</h1>
        </template>

        <div class="p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <input v-model="form.event_date" type="date" class="border border-green-600 p-2 w-full" required />
                <input v-model="form.description" type="text" placeholder="Descripción" class="border border-green-600 p-2 w-full" required />
                <input v-model="form.location" type="text" placeholder="Ubicación" class="border border-green-600 p-2 w-full" required />

                <button type="submit" class="bg-green-600 text-white p-2 hover:bg-green-500 w-full mt-4">Guardar</button>
                <a href="/events" class="bg-gray-500 text-white p-2 hover:bg-gray-400 w-full mt-4 block text-center">Cancelar</a>
            </form>
        </div>
    </AppLayout>
</template>